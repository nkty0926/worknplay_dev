<?php
if (isset($_POST['action']) && $_POST['action'] == 'Save') {
	try {
		$query = "select count(*) from save_" . $_POST['table'] . " where member = :member and " . $_POST['table'] . " = :no";
		$stmt = $DB->conn->prepare($query);
		$stmt->bindParam(":member", $_SESSION['ID']);
		$stmt->bindParam(":no", $_POST['pk']);
		$stmt->execute();
		$row = $stmt->fetchColumn();
		$stmt->closeCursor();
		if ($row == 0) {
			$query = "insert into save_" . $_POST['table'] . " (member, " . $_POST['table'] . ") values (:member, :no)";
			$stmt = $DB->conn->prepare($query);
			$stmt->bindParam(":member", $_SESSION['ID']);
			$stmt->bindParam(":no", $_POST['pk']);
			$stmt->execute();
			$stmt->closeCursor();
			if ($_POST['table'] == 'work_job')
				echo "Saved to My Jobs List.";
			else
				echo "Saved to My Page.";
		} else {
			$query = "delete from save_" . $_POST['table'] . " where member = :member and " . $_POST['table'] . " = :no";
			$stmt = $DB->conn->prepare($query);
			$stmt->bindParam(":member", $_SESSION['ID']);
			$stmt->bindParam(":no", $_POST['pk']);
			$stmt->execute();
			$stmt->closeCursor();
			if ($_POST['table'] == 'work_job')
				echo "Deleted from My Jobs List.";
			else
				echo "Deleted from My Page.";
		}
	} catch (Exception $e) {
		echo "Error";
		$WP->printStatus($e->getMessage());
	}
}