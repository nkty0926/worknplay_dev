<?php
if (isset($_POST['action']) && $_POST['action'] == 'SaveResume') {
	try {
		if ($_POST['save_work_resume_folder']) {
			$query = "select no from save_work_resume where member = :member and work_resume = :work_resume and save_work_resume_folder = :save_work_resume_folder";
			$stmt = $DB->conn->prepare($query);
			$stmt->bindParam(":member", $_SESSION['ID']);
			$stmt->bindParam(":work_resume", $_POST['work_resume']);
			$stmt->bindParam(":save_work_resume_folder", $_POST['save_work_resume_folder']);
			$stmt->execute();
			$rs = $stmt->fetchColumn();
			if ($rs) {
				echo "This resume already exists in the folder you selected.";
				exit();
			}
		} else {
			$query = "insert into save_work_resume_folder (member, folder_name) values(:member, :folder_name)";
			$stmt = $DB->conn->prepare($query);
			$stmt->bindParam(":member", $_SESSION['ID']);
			$stmt->bindParam(":folder_name", $_POST['folder_name']);
			$stmt->execute();
			$_POST['save_work_resume_folder'] = $DB->conn->lastInsertId();
		}
		$query = "insert into save_work_resume (member, work_resume, save_work_resume_folder) values(:member, :work_resume, :save_work_resume_folder)";
		$stmt = $DB->conn->prepare($query);
		$stmt->bindParam(":member", $_SESSION['ID']);
		$stmt->bindParam(":work_resume", $_POST['work_resume']);
		$stmt->bindParam(":save_work_resume_folder", $_POST['save_work_resume_folder']);
		$stmt->execute();
		echo "Saved";
	} catch (Exception $e) {
		echo "Error";
		$WP->printStatus($e->getMessage());
	}
}