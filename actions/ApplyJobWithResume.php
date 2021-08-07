<?php
if (isset($_POST['action']) && $_POST['action'] == 'ApplyJobWithResume') {
	$columns = array(
		'member',
		'work_job',
		'work_resume',
		'cover_letter',
		'questions',
		'answers'
	);
	$values = array(
		':member' => $_SESSION['ID'],
		':work_job' => $_POST['pk'],
		':work_resume' => $_POST['work_resume'],
		':cover_letter' => $_POST['cover_letter'],
		':questions' => join('|', $_POST['questions']),
		':answers' => join('|', $_POST['answers'])
	);
	$DB->edit('work_job_application', $columns, $values);
	$job = $DB->selectWorkJob($_POST['pk']);
	$resume = $DB->selectWorkResume($_POST['work_resume']);
	$_SESSION['script'] = "$.ajax({ type: 'post', url: '/actions/Mail', data: 'action=ApplyJobWithResume&job=" . $job['no'] . "&email=" . $job['appl_text'] . "&company_name=" . $job['company_name'] . "&title=" . $resume['title'] . "&name=" . $resume['fullname'] . "&nationality=" . $resume['nationality_name'] . "&gender=" . ($resume['personal_gender'] == 1 ? 'Male' : ($resume['personal_gender'] == 2 ? 'Female' : 'Other')) . "&birthday=" . date($CONF['date_format'], strtotime($resume['personal_birthday'])) . "' });";
	$_SESSION['dialog'] = "Resume Sent.";
}