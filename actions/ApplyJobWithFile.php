<?php
require_once 'pages/common/ncaptcha.php';
if (isset($_POST['action']) && $_POST['action'] == 'ApplyJobWithFile' && $ncaptcha_result) {
	$columns = array(
		'work_job',
		'title',
		'contact_email',
		'personal_firstname',
		'personal_lastname',
		'personal_nationality',
		'attachment',
		'cover_letter'
	);
	$values = array(
		':work_job' => $_POST['pk'],
		':title' => $_POST['title'],
		':contact_email' => $_POST['contact_email'],
		':personal_firstname' => $_POST['personal_firstname'],
		':personal_lastname' => $_POST['personal_lastname'],
		':personal_nationality' => join(',', $_POST['personal_nationality']),
		':attachment' => join('|', $_POST['attachment']),
		':cover_letter' => $_POST['cover_letter']
	);
	$DB->edit('work_job_application', $columns, $values);
	// $job = $DB->selectWorkJob($_POST['pk']);
	// $resume = $DB->selectWorkResume($_POST['work_resume']);
	// $_SESSION['script'] = "$.ajax({ type: 'post', url: '/actions/Mail', data: 'action=ApplyJobWithResume&job=" . $job['no'] . "&email=" . $job['appl_text'] . "&company_name=" . $job['company_name'] . "&title=" . $resume['title'] . "&name=" . $resume['fullname'] . "&nationality=" . $resume['nationality_name'] . "&gender=" . ($resume['personal_gender'] == 1 ? 'Male' : ($resume['personal_gender'] == 2 ? 'Female' : 'Other')) . "&birthday=" . date($CONF['date_format'], strtotime($resume['personal_birthday'])) . "' });";
	$_SESSION['dialog'] = "Application Sent.";
} else if (!$ncaptcha_result) {
	$_SESSION['dialog'] = "Captcha Failed.";
}