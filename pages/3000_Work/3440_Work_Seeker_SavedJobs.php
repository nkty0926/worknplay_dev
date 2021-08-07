<?php

if (isset($_POST['action']) && $_POST['action'] == 'delete') {
	try {
		$query = "delete from save_work_job where member = :member and no = :no";
		$stmt = $DB->conn->prepare($query);
		$stmt->bindParam(":member", $_SESSION['ID']);
		foreach ($_POST['save_no'] as $save_no) {
			$stmt->bindParam(":no", $save_no);
			$stmt->execute();
			$stmt->closeCursor();
		}
		header('Location: /Work/Seeker/SavedJobs');
		exit();
	} catch (PDOException $e) {
		$WP->printStatus($e->getMessage());
	}
}

$saves = $DB->selectSave('work_job');

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
				<a class="mx-2 mx-lg-3 text-dark font-weight-bold" href="/Work/Seeker/SavedJobs">My Saved Jobs</a>
				<span class="text-muted">|</span>
				<a class="mx-2 mx-lg-3 text-muted" href="/Work/Seeker/EmployerViews">Views</a>
			</h6>

			<!-- table -->
			<table class="table table-bordered table-hover text-center">
				<thead class="thead-light">
					<tr>
						<th width="5%"><input type="checkbox" name="save_no[]" data-type="checkall" /></th>
						<th width="15%">Date Saved</th>
						<th width="40%">Job Title</th>
						<th width="25%">Company Name</th>
						<th width="15%">Date Posted</th>
					</tr>
				</thead>
				<tbody>
<?php foreach($saves as $save){ $article = $DB->selectWorkJob($save['work_job']); $company = $DB->selectWorkCompany($article['work_company']); ?>
					<tr>
						<td><input type="checkbox" name="save_no[]" value="<?= $save['no'] ?>" /></td>
						<td><?= date($CONF['date_format'], strtotime($save['date'])) ?></td>
						<td class="text-left"><a class="text-muted" href="/Work/Detail/Job/<?= $article['no'] ?>"><?= $article['title']?$article['title']:'<span class="text-danger">Deleted Job</span>' ?></a></td>
<?php if(!$article['company_name']){ ?>
						<td><span class="text-danger">Deleted Company</span></td>
<?php }else{ ?>
						<td><a class="text-muted" href="/Work/Detail/Company/<?= $article['work_company'] ?>" target="_blank"><?= $article['company_name'] ?></a></td>
<?php } ?>
						<td><?= date($CONF['date_format'], strtotime($article['date'])) ?></td>
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