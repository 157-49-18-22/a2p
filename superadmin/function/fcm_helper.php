<?php
class FCMHelper {
    private $serviceAccount;
    private $accessToken;

    public function __construct($serviceAccountPath) {
        if (!file_exists($serviceAccountPath)) {
            throw new Exception("Service Account JSON file not found.");
        }
        $this->serviceAccount = json_decode(file_get_contents($serviceAccountPath), true);
    }

    private function base64UrlEncode($data) {
        return rtrim(str_replace(['+', '/'], ['-', '_'], base64_encode($data)), '=');
    }

    private function getAccessToken() {
        if ($this->accessToken) return $this->accessToken;

        $now = time();
        $payload = [
            'iss' => $this->serviceAccount['client_email'],
            'scope' => 'https://www.googleapis.com/auth/cloud-platform',
            'aud' => 'https://oauth2.googleapis.com/token',
            'exp' => $now + 3600,
            'iat' => $now - 30 
        ];

        $headerStr = $this->base64UrlEncode(json_encode(['alg' => 'RS256', 'typ' => 'JWT']));
        $payloadStr = $this->base64UrlEncode(json_encode($payload));
        $signatureInput = $headerStr . "." . $payloadStr;

        $privateKey = $this->serviceAccount['private_key'];
        $privateKey = str_replace(['\n', '\\n'], "\n", $privateKey);
        
        $signature = '';
        if (!openssl_sign($signatureInput, $signature, $privateKey, 'SHA256')) {
            throw new Exception("Signing failed: " . openssl_error_string());
        }

        $jwt = $signatureInput . "." . $this->base64UrlEncode($signature);

        $ch = curl_init('https://oauth2.googleapis.com/token');
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion' => $jwt
        ]));

        $result = curl_exec($ch);
        $data = json_decode($result, true);
        curl_close($ch);

        if (isset($data['access_token'])) {
            $this->accessToken = $data['access_token'];
            return $this->accessToken;
        }

        throw new Exception("Google Auth Error: " . ($data['error_description'] ?? $result));
    }

    public function sendNotification($token, $title, $body, $link = '', $image = '') {
        try {
            $accessToken = $this->getAccessToken();
            $projectId = $this->serviceAccount['project_id'];

            $message = [
                'message' => [
                    'token' => $token,
                    'notification' => [
                        'title' => $title,
                        'body' => $body
                    ],
                    'webpush' => [
                        'fcm_options' => [
                            'link' => $link
                        ]
                    ]
                ]
            ];

            if ($image) {
                $message['message']['notification']['image'] = $image;
            }

            $ch = curl_init("https://fcm.googleapis.com/v1/projects/$projectId/messages:send");
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer ' . $accessToken,
                'Content-Type: application/json'
            ]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));

            $result = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            return [
                'success' => $httpCode === 200,
                'response' => json_decode($result, true)
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'response' => ['error' => ['message' => $e->getMessage()]]
            ];
        }
    }
}
?>
