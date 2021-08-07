<?php
if ($_POST['id'] && $_POST['email'] && $_POST['email'] != 'undefined') {
	try {
		// REGISTER
		$member = $DB->selectMember(null, $_POST['email']);
		if (empty($member['no'])) {
			$columns = array(
				'email',
				'pw',
				'appr',
				'type',
				'nickname',
				'logo_img'
			);
			$values = array(
				'email' => $_POST['email'],
				'pw' => md5($_POST['id']),
				'appr' => '1',
				'type' => '1',
				'nickname' => $_POST['name'],
				'logo_img' => $_POST['picture']
			);
			$DB->edit('member', $columns, $values);
		} else if (empty($member['pw'])) {
			$columns = array(
				'pw',
				'appr',
				'type',
				'nickname',
				'logo_img'
			);
			$values = array(
				'no' => $member['no'],
				'pw' => md5($_POST['id']),
				'appr' => '1',
				'type' => '1',
				'nickname' => $_POST['name'],
				'logo_img' => $_POST['picture']
			);
			$DB->edit('member', $columns, $values);
		} else if (empty($member['type'])) {
			echo '<script>Alert("The email address already exists.");</script>';
			exit();
		} else {
			echo '<script>Dialog("Failed");</script>';
		}
		// LOG IN
		if ($member = $DB->login($_POST['email'], md5($_POST['id']))) {
			if ($member['appr'] == 1) {
				session_start();
				$USER = $DB->selectUser($member['no']);
				$_SESSION['ID'] = $member['no'];
				$_SESSION['EMAIL'] = $member['email'];
				$_SESSION['ADMIN'] = $member['admin'];
				$_SESSION['RECRUITER'] = $member['recruiter'];
				$_SESSION['EMPLOYER'] = $USER['work_credit'];
				$_SESSION['CURRENT_COMPANY'] = $USER['work_company'];
				$_SESSION['CURRENT_COMPANY_NAME'] = $USER['work_company_name'];
				$_SESSION['EMPLOYER_TEFL'] = 1;
				$_SESSION['SEEKER'] = $USER['work_resume'];
				$DB->updateMemberLastLoginDate();
				echo '<script>location.replace("' . ($_SESSION['PREV_URL'] ? $_SESSION['PREV_URL'] : '/') . '");</script>';
				exit();
			} else {
				echo '<script>Alert("This is a blocked account.", function(){ location.replace("/"); });</script>';
			}
		} else {
			echo '<script>Dialog("Failed");</script>';
		}
	} catch (Exception $e) {
		echo '<script>Dialog("Error");</script>';
		$WP->printStatus($e->getMessage());
	}
} else {
	echo '<script>Dialog("Failed");</script>';
}
