<?php
if (isset($_POST['action']) && $_POST['action'] == 'DupCheck') {
	try {
		if ($_POST['table'] == 'work_company') {
			$rs = $DB->selectWorkCompany(null, null, $_POST['domain']);
			if (!isset($rs['no']) || empty($rs['no']))
				echo true;
			else
				echo false;
		} else
			echo false;
	} catch (Exception $e) {
		echo false;
		$WP->printStatus($e->getMessage());
	}
}