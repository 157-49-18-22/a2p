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
            throw new Exception("Invalid JSON formatting in service account file.");
        }
    }

    private function base64UrlEncode($data) {
        return rtrim(str_replace(['+', '/'], ['-', '_'], base64_encode($data)), '=');
    }

    private function getAccessToken() {
        if ($this->accessToken) return $this->accessToken;

        $now = time();
        $payload = [
            'iss'   => $this->serviceAccount['client_email'],
            'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
            'aud'   => 'https://oauth2.googleapis.com/token',
            'exp'   => $now + 3600,
            'iat'   => $now - 60 
        ];

        $header = [
            'alg' => 'RS256',
            'typ' => 'JWT',
            'kid' => $this->serviceAccount['private_key_id']
        ];
        
        // Compact JSON encoding for Google
        $headerJSON = json_encode($header);
        $payloadJSON = json_encode($payload);
        
        $headerEncoded = $this->base64UrlEncode($headerJSON);
        $payloadEncoded = $this->base64UrlEncode($payloadJSON);
        
        $signatureInput = $headerEncoded . "." . $payloadEncoded;
        
        $privateKey = $this->serviceAccount['private_key'];
        $privateKey = str_replace('\n', "\n", $privateKey);
        
        $signature = '';
        if (!openssl_sign($signatureInput, $signature, $privateKey, 'SHA256')) {
            throw new Exception("JWT Sign Failed on Server: " . openssl_error_string());
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

        // Detailed LOG for us to see WHY Google is angry
        $detailedLog = "Time: ".date('Y-m-d H:i:s')."\nResponse: ".$result."\nJWT Head: ".$headerEncoded."\nJWT Pay: ".$payloadEncoded."\n";
        file_put_contents('fcm_critical_log.txt', $detailedLog, FILE_APPEND);

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
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));

            $result = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            
            $resData = json_decode($result, true);
            $success = ($httpCode === 200);

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
