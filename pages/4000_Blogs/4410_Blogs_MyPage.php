<?php

include_once 'pages/4000_Blogs/4000_Blogs_header.php';

if (empty($USER['story_profile'])) {
	echo '<script>location.replace("/Blogs");</script>';
	exit();
} else {
	$serieses = $DB->selectStorySeries(null, $_SESSION['ID']);
	$articles = $DB->selectStoryArticle(null, $USER['story_profile'], $_GET['series']);
}

if (!isset($_GET['page']) || empty($_GET['page'])) {
	$_GET['page'] = 1;
}

if (!isset($_GET['list']) || empty($_GET['list'])) {
	$_GET['list'] = 0;
}

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

			<a class="float-right text-dark mt-2" href="/Blogs/MyPage?series=<?= $_GET['series'] ?>&list=<?= $_GET['list']?0:1 ?>&page=<?= $_GET['page'] ?>"><i class="fa fa-th-<?= $_GET['list']?'large':'list' ?>"></i></a>
			<h4 class="border-bottom pb-2 mb-3" title="<?= $CONF['pagination_total'] ?> results">My Posts</h4>

			<!-- section -->
			<section class="mt-n2">
				<a class="btn btn-light mb-2 mr-2<?= $series['no']==$_GET['series']?' active':'' ?>" href="/Blogs/MyPage">All</a>
<?php foreach($serieses as $series){ ?>
				<a class="btn btn-light mb-2 mr-2<?= $series['no']==$_GET['series']?' active':'' ?>" href="/Blogs/MyPage?series=<?= $series['no'] ?>"><?= $series['series_title'] ?></a>
<?php } ?>
			</section>
			<!-- /section -->

			<!-- .row -->
			<div class="row">
<?php foreach($articles as $article){ ?>
				<div class="<?= $_GET['list']?'col-12':'col-6 col-lg-4' ?>">
<?php include 'pages/4000_Blogs/4000_Blogs_article.php'; ?>
				</div>
<?php } ?>
			</div>
			<!-- /.row -->

<?php include_once 'pages/common/pagination.php'; ?>

		</section>
		<!-- /section -->

			</div>
		</div>
	</main>
	<!-- /main -->