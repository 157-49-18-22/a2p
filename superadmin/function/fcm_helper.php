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
        $payload = [
            'iss'   => $this->serviceAccount['client_email'],
            'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
            'aud'   => 'https://oauth2.googleapis.com/token',
            'exp'   => $now + 3600,
            'iat'   => $now - 60 
        ];

        $header = ['alg' => 'RS256', 'typ' => 'JWT'];
        
        // Manual Base64Url to ensure NO padding or issues
        $headerEncoded  = $this->base64UrlEncode(json_encode($header));
        $payloadEncoded = $this->base64UrlEncode(json_encode($payload));
        
        $dataToSign = $headerEncoded . "." . $payloadEncoded;
        
        $privateKey = $this->serviceAccount['private_key'];
        $privateKey = str_replace("\\n", "\n", $privateKey);
        
        $signature = '';
        if (!openssl_sign($dataToSign, $signature, $privateKey, "SHA256")) {
            throw new Exception("Local Signing Failed: " . openssl_error_string());
        }

        $jwt = $dataToSign . "." . $this->base64UrlEncode($signature);

        $postData = http_build_query([
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion'  => $jwt
        ]);

        $ch = curl_init('https://oauth2.googleapis.com/token');
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
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

            $siteUrl = defined('SITE_URL') ? SITE_URL : 'https://pink-sheep-796549.hostingersite.com/';
            $logoUrl  = $siteUrl . 'assets/images/favicons/android-chrome-192x192.png';

            $message = [
                'message' => [
                    'token' => $token,
                    'data' => [
                        'title' => (string)$title,
                        'body'  => (string)$body,
                        'link'  => (string)$link,
                        'image' => (string)$image
                    ],
                    'webpush' => [
                        'notification' => [
                            'title' => (string)$title,
                            'body'  => (string)$body,
                            'icon'  => $logoUrl,
                            'badge' => $logoUrl,
                            'image' => (string)$image,
                            'requireInteraction' => true,
                            'tag'   => 'a2p-notif'
                        ],
                        'fcm_options' => [
                            'link' => (string)$link
                        ]
                    ]
                ]
            ];

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
