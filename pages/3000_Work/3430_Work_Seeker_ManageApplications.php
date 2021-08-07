<?php

if (isset($_POST['action']) && $_POST['action'] == 'delete') {
	try {
		$query = "update work_job_application set canceled = now() where member = :member and no = :no";
		$stmt = $DB->conn->prepare($query);
		$stmt->bindParam(":member", $_SESSION['ID']);
		foreach ($_POST['application_no'] as $application) {
			$stmt->bindParam(":no", $application);
			$stmt->execute();
			$stmt->closeCursor();
		}
		// $DB->conn->query("delete from work_job_application where deleted is not null and canceled is not null");
		header('Location: /Work/Seeker/ManageApplications');
		exit();
	} catch (PDOException $e) {
		$WP->printStatus($e->getMessage());
	}
}

$applications = $DB->selectWorkJobApplication();

include_once 'pages/3000_Work/3000_Work_header.php';

?>
	<!-- form -->
	<form class="py-3 py-lg-5" method="post" action="" data-required="checkbox">
		<div class="container">
			<div class="row">

		<!-- section -->
		<section class="col-lg-12">

			<h3 class="mb-4">My Page</h3>

		</section>
		<!-- /section -->

		<!-- aside -->
		<aside class="col-lg-3">

<?php include_once 'pages/2000_Account/2000_Account_sidebar.php'; ?>

		</aside>
		<!-- /aside -->

		<!-- section -->
		<section class="col-lg-9">

			<h4>My Jobs</h4>

			<h6 class="bg-light border text-center p-2 mb-3">
				<a class="mx-2 mx-lg-3 text-dark font-weight-bold" href="/Work/Seeker/ManageApplications">My Applications</a>
				<span class="text-muted">|</span>
				<a class="mx-2 mx-lg-3 text-muted" href="/Work/Seeker/SavedJobs">My Saved Jobs</a>
				<span class="text-muted">|</span>
				<a class="mx-2 mx-lg-3 text-muted" href="/Work/Seeker/EmployerViews">Views</a>
			</h6>

			<!-- table -->
			<table class="table table-bordered table-hover text-center">
				<thead class="thead-light">
					<tr>
						<th width="5%"><input type="checkbox" name="application_no[]" data-type="checkall" /></th>
						<th width="18%">Date Applied</th>
						<th width="40%">Job Title</th>
						<th width="40%">Resume Title</th>
					</tr>
				</thead>
				<tbody>
<?php foreach($applications as $application){ ?>
					<tr>
						<td><input type="checkbox" name="application_no[]" value="<?= $application['no'] ?>" /></td>
						<td><?= date($CONF['date_format'], strtotime($application['date'])) ?></td>
						<td class="text-left"><a class="text-muted<?= $application['job_title']?'':' disabled' ?>" href="/Work/Detail/Job/<?= $application['work_job'] ?>"><?= $application['job_title']?$application['job_title']:'<span class="text-danger">Deleted Job</span>' ?></a><?= $application['deleted']?'<br /><small class="text-danger">(This application has been deleted by the company.)</small>':'' ?></td>
						<td class="text-left"><a class="text-muted<?= $application['resume_title']?'':' disabled' ?>" href="/Work/Detail/Resume/<?= $application['work_resume'] ?>?application=<?= $application['no'] ?>"><?= $application['resume_title']?$application['resume_title']:'<span class="text-danger">Deleted Resume</span>' ?></a></td>
					</tr>
<?php } ?>
				</tbody>
			</table>
			<!-- /table -->

			<button type="submit" class="btn btn-outline-secondary" name="action" value="delete">Delete</button>

		</section>
		<!-- /section -->

			</div>
		</div>
	</form>
	<!-- /form -->