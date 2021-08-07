<?php
$hash_sha1 = $_REQUEST['hash_sha1'];
if (empty($hash_sha1)) {
	echo "empty request"; exit;
}

list ($usec, $sec) = explode(" ", microtime());
$timestamp = floor(($sec + $usec) * 1000);
$api_domain = "https://filesafer.apigw.ntruss.com";
$api_url = "/hashfilter/v1/checkHash?hashCode=" . $hash_sha1 . "&hashType=sha1";
$api_key = "YxiwtSC4hHKNsnStazcyzxjjfgkllp2mib1Xa8z6"; // primary key
$access_key = "2PQTfRvGgeJCLAXwoG6E";
$secret_key = "qGmPov6zTVSZuPuyWzp0oo1NQDPNPK1YXpJ3N9G1";
$signature = base64_encode(hash_hmac('sha256', "GET $api_url\n$timestamp\n$access_key", $secret_key, true));

$is_post = false;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_domain . $api_url);
curl_setopt($ch, CURLOPT_POST, $is_post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$headers = array();
$headers[] = "x-ncp-apigw-timestamp: " . $timestamp;
$headers[] = "x-ncp-apigw-api-key: " . $api_key;
$headers[] = "x-ncp-iam-access-key: " . $access_key;
$headers[] = "x-ncp-apigw-signature-v2: " . $signature;
$headers[] = "accept: application/json";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($ch);
curl_close($ch);
$response = json_decode($response);
print_r($response);