<?php


if ($_SESSION['CURRENT_COMPANY']) {
	$employer = $DB->selectWorkCompany($_SESSION['CURRENT_COMPANY']);
}
$purchase = $DB->selectWorkPurchase();
$jobs = $DB->selectWorkJob(null, null, $_SESSION['ID']);

include_once 'pages/3000_Work/3000_Work_header.php';

?>
	<!-- main -->
	<main class="py-3 py-lg-5">
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

<?php
include_once 'pages/3000_Work/3521_Work_Employer_PostAJob.php';
if ($employer['no'] && $employer['publ'] && $jobs) {
	include_once 'pages/3000_Work/3570_Work_Employer_CandidateList.php';
	include_once 'pages/3000_Work/3550_Work_Employer_ManageJobs.php';
}
?>

			<div class="row mt-5">
				<div class="col-lg-6">
					<h4 class="mb-2">Message Box</h4>
					<div class="card">
						<div class="card-body">
							<p><a class="stretched-link" href="/Work/Employer/MessageBox">New Message</a></p>
							<footer class="text-right"><span><?= $USER['work_message'] ?></span> EA</footer>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<h4 class="mb-2">Blogs</h4>
					<div class="card">
						<div class="card-body">
							<p><a class="stretched-link" href="/Blogs/MyPage">My Posts</a></p>
							<footer class="text-right"><span><?= $USER['story_profile']?count($articles = $DB->selectStoryArticle(null, $USER['story_profile'])):'0' ?></span> Articles</footer>
						</div>
					</div>
				</div>
			</div>

		</section>
		<!-- /section -->

			</div>
		</div>
	</main>
	<!-- /main -->