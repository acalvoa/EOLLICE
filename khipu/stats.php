<?php
$receiver_id = 4530;
$secret = 'cfd70a255d2d65d188dfefbbb92d74820edabd59';
$concatenated = "receiver_id=$receiver_id&secret=$secret";
$hash = sha1($concatenated);

$url = 'https://khipu.com/api/1.1/receiverStatus';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, true);


$data = array('receiver_id' => $receiver_id, 'hash' => $hash);


curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$output = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch);

echo $output;
?>