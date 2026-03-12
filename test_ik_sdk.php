<?php
require 'vendor/autoload.php';

$imageKit = new \ImageKit\ImageKit(
    'public_S27pY9bOfwZ6hIzvL7PeLV31E/g=',
    'private_WoGKR8PLIbT9fTWa+mk1Bt/dpkk=',
    'https://ik.imagekit.io/qfu5tz9sf'
);

$upload = $imageKit->uploadFile([
    'file' => fopen(__DIR__ . '/test_ik.php', 'r'),
    'fileName' => 'test_ik.php'
]);

var_dump($upload);
