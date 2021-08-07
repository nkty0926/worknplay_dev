<?php
if (isset($_POST['action']) && $_POST['action'] == 'Message') {
	try {
		if (isset($_POST['main']) && !empty($_POST['main'])) {
			$table = strtolower($_POST['main']) . '_message';
		} else {
			$table = 'work_message';
		}
		if ($_POST['table'] == 'work_company') {
			$company = $DB->selectWorkCompany($_POST['pk']);
			$resume = $DB->selectWorkResumeProfile();
			$columns = array(
				'member_send',
				'member_send_email',
				'member_receive',
				'member_receive_email',
				'work_company',
				'title',
				'content'
			);
			$values = array(
				':member_send' => $_SESSION['ID'],
				':member_send_email' => $resume['contact_email'] ? $resume['contact_email'] : $_SESSION['EMAIL'],
				':member_receive' => $company['member'],
				':member_receive_email' => $company['contact_email'],
				':work_company' => $company['no'],
				':title' => $_POST['title'],
				':content' => $_POST['content']
			);
			if ($DB->edit($table, $columns, $values)) {
				$_SESSION['script'] = "$.ajax({ type: 'post', url: '/actions/Mail', data: 'action=Message&email=" . $company['contact_email'] . "&receive_name=" . $company['name'] . "&send_name=" . ($resume['fullname'] ? $resume['fullname'] : 'Anonymous') . "&target=" . 'Company' . "&title=" . $company['name'] . "&href=/Work/Employer/MessageBox' });";
				$_SESSION['dialog'] = "Message Sent.";
			} else {
				$_SESSION['dialog'] = "Failed";
			}
		} else if ($_POST['table'] == 'work_resume') {
			$resume = $DB->selectWorkResume($_POST['pk']);
			$company = $DB->selectWorkCompany($_SESSION['CURRENT_COMPANY']);
			$columns = array(
				'member_send',
				'member_send_email',
				'member_receive',
				'member_receive_email',
				'work_company',
				'work_resume',
				'title',
				'content'
			);
			$values = array(
				':member_send' => $_SESSION['ID'],
				':member_send_email' => $company['contact_email'] ? $company['contact_email'] : $_SESSION['EMAIL'],
				':member_receive' => $resume['member'],
				':member_receive_email' => $resume['contact_email'],
				':work_company' => $company['no'],
				':work_resume' => $resume['no'],
				':title' => $_POST['title'],
				':content' => $_POST['content']
			);
			if ($DB->edit($table, $columns, $values)) {
				$_SESSION['script'] = "$.ajax({ type: 'post', url: '/actions/Mail', data: 'action=Message&email=" . $resume['contact_email'] . "&receive_name=" . $resume['fullname'] . "&send_name=" . $company['name'] . "&target=" . 'Resume' . "&title=" . $resume['title'] . "&href=/Work/Seeker/MessageBox' });";
				$_SESSION['dialog'] = "Message Sent.";
			} else {
				$_SESSION['dialog'] = "Failed";
			}
		} else {
			if ($_POST['table'] == 'tefl_application') {
				$application = $DB->selectTeflApplication($_POST['pk']);
			} else {
				$application = $DB->selectWorkJobApplication($_POST['pk']);
			}
			$resume = $DB->selectWorkResume($application['work_resume']);
			$job = $DB->selectWorkJob($application['work_job']);
			$company = $DB->selectWorkCompany($job['work_company']);
			$columns = array(
				'member_send',
				'member_send_email',
				'member_receive',
				'member_receive_email',
				'work_company',
				'work_resume',
				$_POST['table'],
				'title',
				'content'
			);
			$values = array(
				':member_send' => $_SESSION['ID'],
				':member_send_email' => $job['appl_text'] ? $job['appl_text'] : $company['contact_email'],
				':member_receive' => $resume['member'],
				':member_receive_email' => $resume['contact_email'],
				':work_company' => $company['no'],
				':work_resume' => $resume['no'],
				':' . $_POST['table'] => $application['no'],
				':title' => $_POST['title'],
				':content' => $_POST['content']
			);
			if ($DB->edit($table, $columns, $values)) {
				$_SESSION['script'] = "$.ajax({ type: 'post', url: '/actions/Mail', data: 'action=Message&email=" . $resume['contact_email'] . "&receive_name=" . $resume['fullname'] . "&send_name=" . $job['company_name'] . "&target=" . 'Application' . "&title=" . $resume['title'] . "&href=/Work/Seeker/MessageBox' });";
				$_SESSION['dialog'] = "Message Sent.";
			} else {
				$_SESSION['dialog'] = "Failed";
			}
		}
	} catch (Exception $e) {
		$_SESSION['dialog'] = "Error";
		$WP->printStatus($e->getMessage());
	}
}