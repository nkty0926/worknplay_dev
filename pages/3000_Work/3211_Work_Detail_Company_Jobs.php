<?php

include_once 'pages/3000_Work/3200_Work_Detail_header.php';

if (!isset($_GET['page']) || empty($_GET['page'])) {
	$_GET['page'] = 1;
}

$CONF['pagination_total'] = count($articles);
$CONF['pagination_articles'] = 9;

?>
	<!-- main -->
	<main class="py-3">
		<div class="container">
			<div class="row">

		<!-- section -->
		<section class="col-lg-9">

<?php if($_SESSION['ID'] && $rs['member']==$_SESSION['ID']){ ?>
			<a class="btn btn-primary btn-sm float-right" href="/Work/Employer/ManageJobs">Manage Jobs</a>
<?php } ?>
			<h5 class="border-bottom pb-2 mb-3" title="<?= $CONF['pagination_total'] ?> results">Jobs</h5>

			<div class="row mx-lg-n2">
<?php for($i=($_GET['page']-1)*$CONF['pagination_articles']; $i<$_GET['page']*$CONF['pagination_articles'] && $i<$CONF['pagination_total']; $i++){ $article = $articles[$i]; ?>
				<div class="col-12 col-sm-6 col-lg-4 mb-3 mb-sm-4 mb-lg-3 px-lg-2">
<?php include 'pages/3000_Work/3000_Work_article_hot.php'; ?>
				</div>
<?php } ?>
			</div>

<?php // include_once 'pages/common/pagination.php'; ?>
<?php if($CONF['pagination_total']>1){ ?>
			<a class="btn btn-light" href="/Work/Search/Job?keyword=<?= $rs['name'] ?>">See all jobs</a>
<?php } ?>

		</section>
		<!-- /section -->

		<!-- aside -->
		<aside class="col-lg-3">

<?php include_once 'pages/3000_Work/3210_Work_Detail_aside.php'; ?>

		</aside>
		<!-- /aside -->

			</div>
		</div>
	</main>
	<!-- /main -->