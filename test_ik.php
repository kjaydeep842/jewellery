<?php
require 'vendor/autoload.php';

$imageKit = new \ImageKit\ImageKit(
    'public_S27pY9bOfwZ6hIzvL7PeLV31E/g=',
    'private_geAVo/Q/qYRcAIe3A7rgT1MbdLA=',
    'https://ik.imagekit.io/qfu5tz9sf'
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://upload.imagekit.io/api/v1/files/upload');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
$post = array(
    'file' => base64_encode(file_get_contents(__DIR__ . '/test_ik.php')),
    'fileName' => 'test_ik.php'
);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_USERPWD, 'private_WoGKR8PLIbT9fTWa+mk1Bt/dpkk=' . ':' . '');

$headers = array();
$headers[] = 'Content-Type: multipart/form-data';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

echo "HTTP Code: $httpcode\n";
echo "Response body:\n$result\n";

var_dump($upload);
