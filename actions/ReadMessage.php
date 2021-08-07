<?php
if (isset($_POST['action']) && $_POST['action'] == 'Read') {
	try {
		if ($_POST['table'] == 'work_message' || $_POST['table'] == 'tefl_message') {
			if ($_POST['table'] == 'tefl_message') {
				$message = $DB->selectTeflMessage($_POST['pk']);
			} else {
				$message = $DB->selectWorkMessage($_POST['pk']);
			}
			$query = "update " . $_POST['table'] . " set `read` = 1 where (member_receive = :member_receive) and (";
			if ($message['work_company'])
				$query .= "work_company = :work_company";
			else
				$query .= "work_company is null";
			if ($message['work_resume'])
				$query .= " and work_resume = :work_resume";
			else
				$query .= " and work_resume is null";
			if ($message['work_job_application'])
				$query .= " and work_job_application = :work_job_application";
			else
				$query .= " and work_job_application is null";
			$query .= ")";
			$stmt = $DB->conn->prepare($query);
			$stmt->bindParam(":member_receive", $_SESSION['ID']);
			if ($message['work_company'])
				$stmt->bindParam(":work_company", $message['work_company']);
			if ($message['work_resume'])
				$stmt->bindParam(":work_resume", $message['work_resume']);
			if ($message['work_job_application'])
				$stmt->bindParam(":work_job_application", $message['work_job_application']);
			$stmt->execute();
			$stmt->closeCursor();
			echo "Read";
		} else {
			echo "Failed";
		}
	} catch (Exception $e) {
		echo "Error";
		$WP->printStatus($e->getMessage());
	}
}