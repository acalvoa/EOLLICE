<?php
$receiver_id = 4507;
$secret = '1ad27afcfc33c729cef0d308fd2e1d2b270278e9';
$concatenated = "receiver_id=$receiver_id";
$hash = hash_hmac('sha256', $concatenated, $secret);

$url = 'https://khipu.com/api/1.2/receiverBanks';

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