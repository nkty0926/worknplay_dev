<?php

if ($_SESSION['DEBUG_MODE']) {
	$real_path = 'D:/workspace/_uploads/';
} else {
	$real_path = '/data/worknplay/uploads/';
}

$image_exts = array(
	'gif',
	'jpeg',
	'jpg',
	'png'
);

$path = get_absolute_path();
$time = date('YmdHis', strtotime('now+9hours'));
if (is_dir($path)) {
	$path .= date('Y') . '/';
	if (!is_dir($path))
		mkdir($path);
	$path .= date('m') . '/';
	if (!is_dir($path))
		mkdir($path);
	$path .= date('d') . '/';
	if (!is_dir($path))
		mkdir($path);
	$path = get_relative_path($path);
} else {
	echo "directory creation failed";
	exit();
}

if ($_FILES) {
	foreach ($_FILES as $form_name => $files) {
		if (is_array($files['tmp_name'])) {
			for ($i = 0; $i < count($files['tmp_name']); $i++) {
				$name_tmp = $files['tmp_name'][$i];
				$hash_sha1 = sha1_file($name_tmp);
				if (check_hash($hash_sha1)) exit;
				$name_new = $path . $time . $i . $_SESSION['ID'] . '.' . $form_name . '.dat';
				$name_ext = strtolower(array_pop(explode('.', $files['name'][$i])));
				if (move_uploaded_file($name_tmp, get_absolute_path($name_new))) {
					if (in_array($name_ext, $image_exts) && $files['size'][$i] > 10 * 1024)
						$name_new = get_relative_path(image_compress(get_absolute_path($name_new)));
					if ($form_name == 'upload')
						echo '{ "uploaded": 1, "filename": "' . basename($name_new) . '?hash_sha1=' . $hash_sha1 . '", "url": "' . $name_new . '" }';
					else
						echo $name_new . '?hash_sha1=' . $hash_sha1;
				} else
					echo "file upload failed";
				if ($i < count($files['tmp_name']) - 1) {
					if ($form_name == 'attachment')
						echo '|';
					else
						echo ',';
				}
			}
		} else {
			$name_tmp = $files['tmp_name'];
			$hash_sha1 = sha1_file($name_tmp);
			if (check_hash($hash_sha1)) exit;
			if (substr($files['name'], strlen($files['name']) - 4, strlen($files['name'])) == '.pdf')
				$name_new = $path . $time . $_SESSION['ID'] . '.' . $form_name . '.pdf';
			else
				$name_new = $path . $time . $_SESSION['ID'] . '.' . $form_name . '.dat';
			$name_ext = strtolower(array_pop(explode('.', $files['name'])));
			if (move_uploaded_file($name_tmp, get_absolute_path($name_new))) {
				if (in_array($name_ext, $image_exts) && $files['size'] > 10 * 1024)
					$name_new = get_relative_path(image_compress(get_absolute_path($name_new)));
				if ($form_name == 'upload')
					echo '{ "uploaded": 1, "filename": "' . basename($name_new) . '?hash_sha1=' . $hash_sha1 . '", "url": "' . $name_new . '" }';
				else
					echo $name_new . '?hash_sha1=' . $hash_sha1;
			} else
				echo "file upload failed";
		}
		exit();
	}
	echo "file upload failed";
}

function image_compress($file) {
	$mime = getimagesize($file)['mime'];
	if ($mime == 'image/gif')
		$image = imagecreatefromgif($file);
	else if ($mime == 'image/jpeg')
		$image = imagecreatefromjpeg($file);
	else if ($mime == 'image/png')
		$image = imagecreatefrompng($file);
	else
		return $file;
	$result = str_replace('.dat', '.jpg', $file);
	imagejpeg($image, $result, 90);
	unlink($file);
	return $result;
}

function get_absolute_path($relative_path = null) {
	global $real_path;
	if ($relative_path) {
		return $real_path . substr($relative_path, 9);
	} else{
		return $real_path;
	}
}

function get_relative_path($absolute_path) {
	global $real_path;
	return str_replace($real_path, '/uploads/', $absolute_path);
}

function check_hash($hash_sha1) {
	if ($hash_sha1 == "82ac9db5e9a45ce21edba575d601b101adc2b073") {
		$hash_sha1 = "f093e7767bb63ac973b697d3fd1d40a78b87b8bf";
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
	return $response->totalRows;
}
