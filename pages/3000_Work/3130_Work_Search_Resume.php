<?php

if (empty($USER['work_credit_res_day']))
	$USER['work_credit_res_day'] = $USER['work_credit_hot_day'];

$articles = $DB->searchWorkResume(trim($_GET['keyword']), $params);

include_once 'pages/3000_Work/3000_Work_header.php';

if (empty($USER['work_credit_res_day'])) {
?>
	<script defer>$(function(){ $('#Sidebar button[type="submit"]').css('cursor', 'not-allowed').on('click', function(){ Confirm('This feature requires payment.<br/>Click &quot;Yes&quot; to go to the instruction page.', function(){ window.open('/Work/Employer/Intro'); }); return false; }); });</script>
<?php } ?>

	<!-- main -->
	<main class="py-3 py-lg-5">
		<div class="container">
			<div class="row">

		<!-- section -->
		<section class="col-lg-12">

			<h3 class="border-bottom pb-2 mb-3" title="<?= $CONF['pagination_total'] ?> results"><?= $params || trim($_GET['keyword'])?'Found ' . $CONF['pagination_total']:'' ?> Resumes</h3>

		</section>
		<!-- /section -->

		<!-- aside -->
		<aside class="col-lg-3">

			<!-- article.card -->
			<article class="card bg-light mb-4 d-none d-lg-block">
				<div class="card-body">
					<h5>인재검색 서칭서비스</h5>
					<p>이력서의 전체 내용을 확인하실 수 있습니다.</p>
					<a class="btn btn-light btn-block" href="/Work/Product/Select">신청하기</a>
				</div>
			</article>
			<!-- /article.card -->

<?php include_once 'pages/3000_Work/3100_Work_Search_sidebar.php'; ?>

<?php include 'pages/common/adsbygoogle-square.php' ?>

		</aside>
		<!-- /aside -->

		<!-- section -->
		<section class="col-lg-9">

			<!-- .row -->
			<div class="row">
<?php foreach($articles as $article){ ?>
				<div class="col-12">
<?php include 'pages/3000_Work/3000_Work_article_resume.php'; ?>
				</div>
<?php } ?>
			</div>
			<!-- /.row -->

<?php include_once 'pages/common/pagination.php'; ?>

<?php include 'pages/common/adsbygoogle-horizontal.php' ?>

		</section>
		<!-- /section -->

			</div>
		</div>
	</main>
	<!-- /main -->

<?php

if ($USER['work_credit_res_day']) {
	include_once 'pages/modal/SaveResume.php';
}

?>