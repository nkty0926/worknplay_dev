<?php
if (isset($_POST['action']) && $_POST['action'] == 'CurrentCompany') {
	$company = $DB->selectWorkCompany($_POST['pk']);
	if ($company['member'] == $_SESSION['ID'] && $company['no'] != $_SESSION['CURRENT_COMPANY']) {
		$_SESSION['CURRENT_COMPANY'] = $company['no'];
		$_SESSION['CURRENT_COMPANY_NAME'] = $company['name'];
		echo "Current company profile changed";
	} else {
		echo "Error";
	}
}