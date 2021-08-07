<?php

if (isset($_POST['action']) && $_POST['action'] == 'delete') {
	try {
		$query = "delete work_resume_hit from work_resume_hit left join work_resume on work_resume_hit.work_resume = work_resume.no where work_resume.member = :member and work_resume_hit.no = :no";
		$stmt = $DB->conn->prepare($query);
		$stmt->bindParam(":member", $_SESSION['ID']);
		foreach ($_POST['view_no'] as $view_no) {
			$stmt->bindParam(":no", $view_no);
			$stmt->execute();
			$stmt->closeCursor();
		}
		header('Location: /Work/Seeker/EmployerViews');
		exit();
	} catch (PDOException $e) {
		$WP->printStatus($e->getMessage());
	}
}

$views = $DB->selectWorkResumeHit();

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
				<a class="mx-2 mx-lg-3 text-muted" href="/Work/Seeker/ManageApplications">My Applications</a>
				<span class="text-muted">|</span>
				<a class="mx-2 mx-lg-3 text-muted" href="/Work/Seeker/SavedJobs">My Saved Jobs</a>
				<span class="text-muted">|</span>
				<a class="mx-2 mx-lg-3 text-dark font-weight-bold" href="/Work/Seeker/EmployerViews">Views</a>
			</h6>

			<!-- table -->
			<table class="table table-bordered table-hover text-center">
				<thead class="thead-light">
					<tr>
						<th width="5%"><input type="checkbox" name="view_no[]" data-type="checkall" /></th>
						<th width="18%">Date Viewed</th>
						<th width="50%">Resume Title</th>
						<th width="30%">Company Name</th>
					</tr>
				</thead>
				<tbody>
<?php foreach($views as $view){ $company = $DB->selectWorkCompany($view['work_company']); ?>
					<tr>
						<td><input type="checkbox" name="view_no[]" value="<?= $view['no'] ?>" /></td>
						<td><?= date($CONF['date_format'], strtotime($view['date'])) ?></td>
						<td class="text-left"><a class="text-muted" href="/Work/Detail/Resume/<?= $view['work_resume'] ?>"><?= $view['resume_title'] ?></a></td>
						<td><a class="text-muted" href="/Work/Detail/Company/<?= $view['work_company'] ?>"><?= $view['company_name'] ?></a></td>
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