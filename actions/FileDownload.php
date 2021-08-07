<?php

if ($_SESSION['DEBUG_MODE']) {
	$real_path = 'D:/workspace/_uploads/';
} else {
	$real_path = '/data/worknplay/uploads/';
}

if (substr($_GET['path'], 0, 9) == '/uploads/' && strpos($_GET['path'], '..') === false) {
	$filename = $_GET['title'];
	session_start();
	$filepath = $real_path . substr($_GET['path'], 9);
	$file = fopen($filepath, 'rb');
	if (strstr($_SERVER['HTTP_USER_AGENT'], 'MSIE')) {
		header('Content-Type: file/unknown');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Content-Disposition: attachment; filename=' . $filename);
		header('Content-Length: ' . filesize($filepath));
		header('Content-Transfer-Encoding: binary');
		header('Pragma: public');
		header('Expires: 0');
	} else {
		header('Content-Type: file/unknown');
		header('Content-Disposition: attachment; filename=' . $filename);
		header('Content-Length: ' . filesize($filepath));
		header('Content-Transfer-Encoding: binary');
		header('Pragma: no-cache');
		header('Expires: 0');
	}
	try {
		fpassthru($file);
		fclose($file);
	} catch (Exception $e) {
		print_r($e->getMessage());
	}
}

?>
<script>window.close();</script>