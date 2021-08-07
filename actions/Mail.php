<?php
set_time_limit(0);
include_once 'classes/Mailer.php';
$mailer = new Mailer();

$_REQUEST['domain'] = $WP->getCurrentHost();

if ($_SESSION['DEBUG_MODE']) {
	$_REQUEST['email'] = "jbj0728@naver.com";
}

// MailAuth
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'MailAuth') {
	$address = $_REQUEST['email'];
	$name = '';
	$subject = '[WorknPlay] Verify your WorknPlay account';
	$body = file_get_contents('pages/mail/' . $_REQUEST['action'] . '.html');
	foreach (array(
		'domain',
		'email',
		'auth'
	) as $param) {
		$body = str_replace('{' . $param . '}', $_REQUEST[$param], $body);
	}
	$mailer->send($address, $name, $subject, $body);
}

// FindPass
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'FindPass') {
	$address = $_REQUEST['email'];
	$name = '';
	$subject = '[WorknPlay] Reset your WorknPlay password';
	$body = file_get_contents('pages/mail/' . $_REQUEST['action'] . '.html');
	foreach (array(
		'domain',
		'email',
		'auth'
	) as $param) {
		$body = str_replace('{' . $param . '}', $_REQUEST[$param], $body);
	}
	$mailer->send($address, $name, $subject, $body);
}

// Message
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'Message') {
	$address = $_REQUEST['email'];
	$name = $_REQUEST['receive_name'];
	$subject = '[WorknPlay] ' . $_REQUEST['send_name'] . ' sent a message to your ' . $_REQUEST['target'];
	$body = file_get_contents('pages/mail/' . $_REQUEST['action'] . '.html');
	foreach (array(
		'domain',
		'receive_name',
		'send_name',
		'target',
		'title',
		'href'
	) as $param) {
		$body = str_replace('{' . $param . '}', $_REQUEST[$param], $body);
	}
	$mailer->send($address, $name, $subject, $body);
}

// ApplyJobWithResume
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'ApplyJobWithResume') {
	$address = $_REQUEST['email'];
	$name = $_REQUEST['company_name'];
	$subject = '[WorknPlay] An applicant applied your job posted';
	$body = file_get_contents('pages/mail/' . $_REQUEST['action'] . '.html');
	foreach (array(
		'domain',
		'company_name',
		'title',
		'name',
		'nationality',
		'gender',
		'birthday',
		'job',
		'logo_img'
	) as $param) {
		$body = str_replace('{' . $param . '}', $_REQUEST[$param], $body);
	}
	$mailer->send($address, $name, $subject, $body);
}