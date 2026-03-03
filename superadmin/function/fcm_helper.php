<?php
class FCMHelper {
    private $serviceAccount;
    private $accessToken;

    public function __construct($serviceAccountPath) {
        if (!file_exists($serviceAccountPath)) {
            throw new Exception("Service Account JSON file not found.");
        }
        $json = file_get_contents($serviceAccountPath);
        $this->serviceAccount = json_decode($json, true);
        if (!$this->serviceAccount) {
            throw new Exception("Invalid JSON format in Service Account file.");
        }
    }

    private function base64UrlEncode($data) {
        return rtrim(str_replace(['+', '/'], ['-', '_'], base64_encode($data)), '=');
    }

    private function getAccessToken() {
        if ($this->accessToken) return $this->accessToken;

        $now = time();
        // BIG FIX: 5-minute cushion for Hostinger time sync
        $payload = [
            'iss'   => $this->serviceAccount['client_email'],
            'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
            'aud'   => 'https://oauth2.googleapis.com/token',
            'exp'   => $now + 3600,
            'iat'   => $now - 300 
        ];

        // Header MUST be compact
        $header = ['alg' => 'RS256', 'typ' => 'JWT'];
        
        // Use flags to ensure NO escaping that breaks signature
        $headerJSON = json_encode($header, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $payloadJSON = json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        
        $headerEncoded = $this->base64UrlEncode($headerJSON);
        $payloadEncoded = $this->base64UrlEncode($payloadJSON);
        
        $signatureInput = $headerEncoded . "." . $payloadEncoded;
        
        $privateKey = $this->serviceAccount['private_key'];
        $privateKey = str_replace(["\\n", '\n'], "\n", $privateKey);
        
        $signature = '';
        if (!openssl_sign($signatureInput, $signature, $privateKey, OPENSSL_ALGO_SHA256)) {
            throw new Exception("Local Signing Failed: " . openssl_error_string());
        }

        $jwt = $signatureInput . "." . $this->base64UrlEncode($signature);

        // --- MASTER CURL FIX: Manual Raw Body ---
        $postData = 'grant_type=' . urlencode('urn:ietf:params:oauth:grant-type:jwt-bearer') . '&assertion=' . urlencode($jwt);

        $ch = curl_init('https://oauth2.googleapis.com/token');
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        $result = curl_exec($ch);
        $data = json_decode($result, true);
        curl_close($ch);

        if (isset($data['access_token'])) {
            $this->accessToken = $data['access_token'];
            return $this->accessToken;
        }

        throw new Exception("Google Token Auth Error: " . ($data['error_description'] ?? $result));
    }

    public function sendNotification($token, $title, $body, $link = '', $image = '') {
        try {
            $accessToken = $this->getAccessToken();
            $projectId = $this->serviceAccount['project_id'];

            $message = [
                'message' => [
                    'token' => $token,
                    'notification' => [
                        'title' => (string)$title,
                        'body'  => (string)$body
                    ],
                    'webpush' => [
                        'fcm_options' => [
                            'link' => (string)$link
                        ]
                    ]
                ]
            ];

            if ($image) {
                $message['message']['notification']['image'] = (string)$image;
            }

            $ch = curl_init("https://fcm.googleapis.com/v1/projects/$projectId/messages:send");
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer ' . $accessToken,
                'Content-Type: application/json'
            ]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));

            $result = curl_exec($ch);
            curl_close($ch);
            
            $resData = json_decode($result, true);
            $success = isset($resData['name']);

            return [
                'success' => $success,
                'response' => $resData
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
