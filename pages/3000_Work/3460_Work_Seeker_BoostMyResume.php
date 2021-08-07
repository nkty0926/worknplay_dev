<?php

if (isset($_POST['action']) && $_POST['action'] == 'Boost' && isset($_POST['resume_no']) && !empty($_POST['resume_no'])) {
	try {
		$query = "update work_resume set date = now(), `mod` = now(), publ = 1 where member = :member and no = :no";
		$stmt = $DB->conn->prepare($query);
		$stmt->bindParam(":member", $_SESSION['ID']);
		$stmt->bindParam(":no", $_POST['resume_no']);
		$stmt->execute();
		$stmt->closeCursor();
		header('Location: /Work/Seeker/BoostMyResume');
		exit();
	} catch (PDOException $e) {
		$WP->printStatus($e->getMessage());
	}
}

$resumes = $DB->selectWorkResume(null, $_SESSION['ID']);

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

			<h4 class="border-bottom mb-4 pb-2">Boost My Resume</h4>

			<p class="border bg-light p-3">Boost your resume for free to bring it back to the top of the resume list and show employers that you’re searching for jobs.</p>

			<!-- table -->
			<table class="table table-bordered table-hover text-center">
				<thead class="thead-light">
					<tr>
						<th width="5%"></th>
						<th width="50%">Resume Title</th>
						<th width="10%">Views</th>
						<th width="15%">Visibility</th>
						<th width="20%">Last Modified</th>
					</tr>
				</thead>
				<tbody>
<?php foreach($resumes as $resume){ if(isset($resume['publ']) && !empty($resume['publ'])){ ?>
					<tr>
						<td><input type="radio" name="resume_no" value="<?= $resume['no'] ?>"<?= $resume['publ']==1?'':' confirm' ?> required /></td>
						<td class="text-left"><a class="text-muted" href="/Work/Detail/Resume/<?= $resume['no'] ?>"><?= $resume['title'] ?></a></td>
						<td><?= $resume['hits'] ?></td>
						<td><?= $resume['publ']==1?'Public':'Private' ?></td>
						<td><?= date($CONF['date_format'], strtotime($resume['mod'])) ?></td>
					</tr>
<?php }} ?>
				</tbody>
			</table>
			<!-- /table -->

			<button type="submit" class="btn btn-outline-secondary" name="action" value="Boost">Boost My Resume</button>

		</section>
		<!-- /section -->

			</div>
		</div>
	</form>
	<!-- /form -->