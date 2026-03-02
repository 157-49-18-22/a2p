<?php
class FCMHelper {
    private $serviceAccount;
    private $accessToken;

    public function __construct($serviceAccountPath) {
        if (!file_exists($serviceAccountPath)) {
            throw new Exception("Service account file not found at: " . $serviceAccountPath);
        }
        $this->serviceAccount = json_decode(file_get_contents($serviceAccountPath), true);
    }

    private function getAccessToken() {
        if ($this->accessToken) return $this->accessToken;

        $header = json_encode(['alg' => 'RS256', 'typ' => 'JWT']);
        $now = time();
        $payload = json_encode([
            'iss' => $this->serviceAccount['client_email'],
            'scope' => 'https://www.googleapis.com/auth/cloud-platform',
            'aud' => 'https://oauth2.googleapis.com/token',
            'exp' => $now + 3600,
            'iat' => $now
        ], JSON_UNESCAPED_SLASHES);

        $base64UrlHeader = $this->base64UrlEncode($header);
        $base64UrlPayload = $this->base64UrlEncode($payload);

        $signature = '';
        $privateKey = $this->serviceAccount['private_key'];
        
        // Final ultimate cleaning: Replace literal \n and real newlines
        $privateKey = str_replace(['\n', '\\n', "\r", "\n"], "\n", $privateKey);
        
        // Remove any whitespace at beginning/end of each line
        $lines = explode("\n", $privateKey);
        $cleanLines = [];
        foreach($lines as $line) {
            $line = trim($line);
            if(!empty($line)) $cleanLines[] = $line;
        }
        $privateKey = implode("\n", $cleanLines);

        // Validate key with OpenSSL
        $keyRes = openssl_pkey_get_private($privateKey);
        if (!$keyRes) {
            throw new Exception("OpenSSL could not read your private key. Check if the format in the JSON is correct (starts with -----BEGIN PRIVATE KEY-----)");
        }
        
        if (!openssl_sign($base64UrlHeader . "." . $base64UrlPayload, $signature, $keyRes, 'SHA256')) {
            $err = openssl_error_string();
            openssl_pkey_free($keyRes);
            throw new Exception("OpenSSL sign failed: " . $err);
        }
        openssl_pkey_free($keyRes);
        
        $base64UrlSignature = $this->base64UrlEncode($signature);

        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://oauth2.googleapis.com/token');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
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

        throw new Exception("Failed to get access token: " . $result);
    }

    private function base64UrlEncode($data) {
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($data));
    }

    public function sendNotification($token, $title, $body, $link = '', $image = '') {
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

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/v1/projects/$projectId/messages:send");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));

        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return [
            'success' => $httpCode === 200,
            'response' => json_decode($result, true)
        ];
    }
}
