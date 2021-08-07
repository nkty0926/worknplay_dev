<?php
if (isset($_POST['action']) && $_POST['action'] == 'JobAddr') {
	try {
		$rs = $DB->selectWorkCompany($_POST['pk']);
		if ($rs['member'] == $_SESSION['ID'])
			include_once 'pages/common/Edit/address.php';
		else
			echo "Failed";
	} catch (Exception $e) {
		echo "Error";
		$WP->printStatus($e->getMessage());
	}
}