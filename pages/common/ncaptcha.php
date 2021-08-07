<?php

if ($_SESSION['DEBUG_MODE']) {
	$real_path = 'D:/workspace/_uploads/';
} else {
	$real_path = '/data/worknplay/uploads/';
}

$client_id = "uT_AfwpFzE9rz03JHZEH"; // 네이버 개발자센터에서 발급받은 CLIENT ID
$client_secret = "dqZHVe9sq2";// 네이버 개발자센터에서 발급받은 CLIENT SECRET

if(empty($_REQUEST['ncaptcha_value'])){

	$code = "0";
	$url = "https://openapi.naver.com/v1/captcha/nkey?code=".$code;
	// echo "url:".$url."<br>";
	$is_post = false;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, $is_post);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$headers = array();
	$headers[] = "X-Naver-Client-Id: ".$client_id;
	$headers[] = "X-Naver-Client-Secret: ".$client_secret;
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$response = curl_exec ($ch);
	$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	// echo "status_code:".$status_code."<br>";
	curl_close ($ch);
	if($status_code == 200) {
		// echo $response;
	} else {
		echo "Error 내용:".$response;
	}

	$response = json_decode($response);
	$_SESSION['ncaptcha_key'] = $response->key;

	$key = $_SESSION['ncaptcha_key']; // "YOUR_CAPTCHA_KEY";
	$url = "https://openapi.naver.com/v1/captcha/ncaptcha.bin?key=".$key;
	// echo "url:".$url."<br>";
	$is_post = false;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, $is_post);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$headers = array();
	$headers[] = "X-Naver-Client-Id: ".$client_id;
	$headers[] = "X-Naver-Client-Secret: ".$client_secret;
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$response = curl_exec ($ch);
	$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	// echo "status_code:".$status_code."<br>";
	curl_close ($ch);
	if($status_code == 200) {
		// echo $response;
		$fp = fopen($real_path."ncaptcha/captcha.jpg", "w+");
		fwrite($fp, $response);
		fclose($fp);
		echo "/uploads/ncaptcha/captcha.jpg?date=" . date('YmdHis').$key;
	} else {
		echo "Error 내용:".$response;
	}

}else{

	$code = "1";
	$key = $_SESSION['ncaptcha_key']; // "YOUR_CAPTCHA_KEY";
	$value = $_REQUEST['ncaptcha_value']; // "YOUR_INPUT";
	$url = "https://openapi.naver.com/v1/captcha/nkey?code=".$code."&key=".$key."&value=".$value;
	// echo "url:".$url."<br>";
	$is_post = false;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, $is_post);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$headers = array();
	$headers[] = "X-Naver-Client-Id: ".$client_id;
	$headers[] = "X-Naver-Client-Secret: ".$client_secret;
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	$response = curl_exec ($ch);
	$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	// echo "status_code:".$status_code."<br>";
	curl_close ($ch);
	if($status_code == 200) {
		// echo $response;
	} else {
		echo "Error 내용:".$response;
	}

	$response = json_decode($response);
	if($response->result=='true'){
		$ncaptcha_result = true;
		// echo '<h2>success</h2>';
	}else{
		$ncaptcha_result = false;
		// echo '<h2>failed</h2>';
	}

}
?>