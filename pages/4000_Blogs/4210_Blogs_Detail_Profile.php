<?php

include_once 'pages/4000_Blogs/4000_Blogs_header.php';

if (empty($_GET['PK']) || empty($rs = $DB->selectStoryProfile($_GET['PK']))) {
	echo '<script>location.replace("/Blogs");</script>';
	exit();
} else {
	$serieses = $DB->selectStorySeries(null, $rs['member']);
	$articles = $DB->selectStoryArticle(null, $rs['no'], $_GET['series']);
	if (isset($_GET['series'])) {
		$_GET['series_title'] = $DB->selectStorySeries($_GET['series'])['series_title'];
	}
}

if (!isset($_GET['page']) || empty($_GET['page'])) {
	$_GET['page'] = 1;
}

if (!isset($_GET['list'])) {
	$_GET['list'] = 0;
}

?>
	<style>main{min-height:auto !important;}</style>

	<!-- main -->
	<main class="py-3 py-lg-5 bg-light">
		<div class="container">
			<div class="row">
<?php if($rs['logo_img']){ ?>
				<div class="col-lg-2">
					<figure class="float-lg-left mr-3 mr-lg-5">
						<img src="<?= $rs['logo_img'] ?>" alt="<?= $rs['profile_title'] ?>" title="<?= $rs['profile_title'] ?>" onerror="this.src='/assets/images/common-profile.png'" style="max-width:10rem;max-height:10rem;" />
					</figure>
				</div>
<?php } ?>
				<div class="col-lg-<?= $rs['logo_img']?'10':'12' ?>">
					<h2 class="mb-3"><?= $rs['profile_title'] ?></h2>
					<h3 class="mb-3"><?= $rs['nickname'] ?></h3>
<?php if(isset($rs['profile_desc']) && !empty($rs['profile_desc'])){ ?>
					<div><?= nl2br($rs['profile_desc']) ?></div>
<?php } ?>
				</div>
			</div>
<?php if($_SESSION['ID'] && $rs['member']==$_SESSION['ID']){ ?>
			<div class="row">
				<div class="col">
					<a class="btn btn-light mr-1 rounded-sm float-right" href="/Blogs/Edit/Profile/<?= $rs['no'] ?>" style="height:32px;" _remove="window_preview">Edit</a>
				</div>
			</div>
<?php } ?>
		</div>
	</main>
	<!-- /main -->

	<!-- main -->
	<main class="py-3 py-lg-5 bg-white">
		<div class="container">
			<div class="row">

		<!-- section -->
		<section class="col-lg-9">

			<a class="float-right text-dark mt-1" href="/Blogs/Detail/Profile/<?= $rs['no'] ?>?page=<?= $_GET['page'] ?>&series=<?= $series['no'] ?>&list=<?= $_GET['list']?0:1 ?>"><i class="fa fa-th-<?= $_GET['list']?'large':'list' ?>"></i></a>
			<h4 class="border-bottom pb-2 mb-3" title="<?= $CONF['pagination_total'] ?> results">Posts<?= $_GET['series_title']?' : ' . $_GET['series_title']:'' ?> <small>(<?= $CONF['pagination_total'] ?>)</small></h4>

<?php if(isset($serieses) && !empty($serieses)){ ?>
			<!-- section -->
			<section class="mt-n2">
				<a class="btn btn-light mb-2 mr-2<?= empty($_GET['series'])?'':' border-0' ?>" href="/Blogs/Detail/Profile/<?= $rs['no'] ?>">All</a>
<?php $pagination_total = $CONF['pagination_total']; foreach($serieses as $series){ $DB->selectStoryArticle(null, $rs['no'], $series['no']); if(empty($CONF['pagination_total'])) continue; ?>
				<a class="btn btn-light mb-2 mr-2<?= $series['no']==$_GET['series']?'':' border-0' ?>" href="/Blogs/Detail/Profile/<?= $rs['no'] ?>?series=<?= $series['no'] ?>"><?= $series['series_title'] ?> <small>(<?= $CONF['pagination_total'] ?>)</small></a>
<?php } $CONF['pagination_total'] = $pagination_total; ?>
			</section>
			<!-- /section -->

<?php } ?>
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

		<!-- aside -->
		<aside class="col-lg-3">

<?php include_once 'pages/common/adsbygoogle-square.php'; ?>

		</aside>
		<!-- /aside -->

			</div>
		</div>
	</main>
	<!-- /main -->