<?php
if (isset($_POST['action'])) {
	if (!$_SESSION['ADMIN']) {
		if ($_POST['table'] == 'work_company') {
			if ($DB->selectWorkCompany($_POST['pk'])['member'] != $_SESSION['ID'])
				exit();
		} else if ($_POST['table'] == 'work_job') {
			if ($DB->selectWorkJob($_POST['pk'])['member'] != $_SESSION['ID'])
				exit();
		} else if ($_POST['table'] == 'work_event') {
			if ($DB->selectWorkEvent($_POST['pk'])['member'] != $_SESSION['ID'])
				exit();
		} else if ($_POST['table'] == 'save_work_resume_folder') {
			if ($DB->selectWorkResumeFolder($_POST['pk'])['member'] != $_SESSION['ID'])
				exit();
		} else if ($_POST['table'] == 'work_resume') {
			if ($DB->selectWorkResume($_POST['pk'])['member'] != $_SESSION['ID'])
				exit();
		} else if ($_POST['table'] == 'story_profile') {
			if ($DB->selectStoryProfile($_POST['pk'])['member'] != $_SESSION['ID'])
				exit();
		} else if ($_POST['table'] == 'story_article') {
			if ($DB->selectStoryArticle($_POST['pk'])['member'] != $_SESSION['ID'])
				exit();
		} else if ($_POST['table'] == 'story_series') {
			if ($DB->selectStorySeries($_POST['pk'])['member'] != $_SESSION['ID'])
				exit();
		} else if ($_POST['table'] == 'tefl_course') {
			if ($DB->selectTeflPosting($_POST['pk'])['member'] != $_SESSION['ID'])
				exit();
		} else {
			exit();
		}
	}
	try {
		// open
		if ($_POST['action'] == 'open') {
			$query = "update " . $_POST['table'] . " set publ = 1 where no = :no";
			$stmt = $DB->conn->prepare($query);
			$stmt->bindParam(":no", $_POST['pk']);
			$stmt->execute();
			$stmt->closeCursor();
			if ($_POST['table'] == 'work_resume') {
				echo "Your resume visibility has now been changed to public.";
			} else {
				echo "Opened.";
			}
		}
		// close
		if ($_POST['action'] == 'close') {
			$query = "update " . $_POST['table'] . " set publ = 2 where no = :no";
			$stmt = $DB->conn->prepare($query);
			$stmt->bindParam(":no", $_POST['pk']);
			$stmt->execute();
			$stmt->closeCursor();
			if ($_POST['table'] == 'work_job') {
				echo "Deleted.";
			} else if ($_POST['table'] == 'work_resume') {
				echo "Your resume visibility has now been changed to private.";
			} else {
				echo "Closed.";
			}
		}
		// delete
		if ($_POST['action'] == 'delete') {
			if ($_POST['table'] == 'work_job') {
				if (!$_SESSION['ADMIN']) {
					blockMember();
				} else {
					$rs = $DB->selectWorkJob($_POST['pk']);
					if ($rs['hot']) {
						$query = "update work_credit set used = null where product = 1 and member = :member and no = :work_credit";
						$stmt = $DB->conn->prepare($query);
						$stmt->bindParam(":member", $_SESSION['ID']);
						$stmt->bindParam(":work_credit", $rs['work_credit']);
						$stmt->execute();
						$stmt->closeCursor();
					}
				}
			}
			$query = "delete from " . $_POST['table'] . " where no = :no";
			$stmt = $DB->conn->prepare($query);
			$stmt->bindParam(":no", $_POST['pk']);
			$stmt->execute();
			$stmt->closeCursor();
			echo "Deleted.";
		}
	} catch (Exception $e) {
		echo "Error";
		$WP->printStatus($e->getMessage());
	}
}