<?php

if (empty($_GET['PK']) || empty($rs = $DB->selectWorkEvent($_GET['PK']))) {
	echo '<script>location.replace("/Work");</script>';
	exit();
} else {
	$company = $DB->selectWorkCompany($rs['work_company']);
	$events = $DB->selectWorkEvent(null, $company['no']);
	$stories = $DB->selectWorkStory($company['no']);
	foreach ($events as $i => $event)
		if ($event['no'] == $rs['no'])
			unset($events[$i]);
	sort($events);
}

include_once 'pages/3000_Work/3000_Work_header.php';

?>
	<style>.text-shadow{text-shadow:1px 1px 1px black;}</style>

	<!-- header -->
	<header class="position-relative container<?= !$rs['header_img'] || !$rs['header_size']?'-fluid':'' ?> px-0<?= !$rs['header_img']?' bg-light':'' ?>" title="<?= $rs['title'] ?>" style="<?= $rs['header_img']?'height:400px;':'' ?>">

<?php if(isset($rs['header_img']) && !empty($rs['header_img'])){ ?>
		<figure class="position-absolute w-100 h-100" style="z-index:-1;background-image:url(<?= $rs['header_img']?$rs['header_img']:'/assets/images/4000-story-header-201805011747.jpg' ?>);"></figure>

<?php } ?>
		<a class="container d-block py-5<?= $rs['header_img']?' text-white':' text-dark' ?>" href="<?= $rs['header_href'] ?>"<?= $rs['header_target']?' target="_blank"':'' ?>>
<?php if(!$rs['header_text']){ ?>
			<h1 class="<?= $rs['header_img']?'line-clamp-2 text-center text-shadow my-5" style="margin-bottom:6rem !important;':'' ?>"><?= $rs['title'] ?></h1>
			<h5 class="<?= $rs['header_img']?'line-clamp-1 text-center text-shadow':'' ?>"><?= $rs['series_title']?$rs['series_title'] . ' | ':'' ?><?= $company['name'] ?></h5>
			<h6 class="<?= $rs['header_img']?'line-clamp-1 text-center text-shadow':'' ?>"><?= date($CONF['date_format'], strtotime($rs['date'])) ?></h6>
<?php } ?>
		</a>

	</header>
	<!-- /header -->

	<!-- main -->
	<main class="py-3 py-lg-5">
		<div class="container">
			<div class="row">

		<!-- section -->
		<section class="col-lg-9">

			<!-- .row -->
			<div class="row mb-4">
				<div class="col-12">
					<div class="cke_published"><?= $rs['desc'] ?></div>
				</div>
			</div>
			<!-- /.row -->

<?php include_once 'pages/common/Detail/hashtag.php'; ?>
			<style>a[href^="/Work/Search/Event"]{pointer-events:none;}</style>
			<script defer>$(function(){ $('a[href^="/Work/Search/Event"]').removeAttr('href'); });</script>

			<!-- .row -->
			<div class="row">
				<div class="col-12">
					<h5>SHARE WITH FRIENDS</h5>
					<div class="sharethis-inline-share-buttons float-left"></div>
<?php if($_SESSION['ADMIN'] || ($_SESSION['ID'] && $company['member']==$_SESSION['ID'])){ ?>
					<a class="btn btn-light btn-sm mr-1 rounded-sm" href="/Work/Edit/Event/<?= $rs['no'] ?>" style="height:32px;" _remove="window_preview">Edit</a>
					<a class="btn btn-light btn-sm mr-1 rounded-sm" data-toggle="action" data-action="delete" data-table="work_event" data-pk="<?= $rs['no'] ?>" style="height:32px;" _remove="window_preview">Delete</a>
<?php } ?>
				</div>
			</div>
			<!-- /.row -->

		</section>
		<!-- /section -->

		<!-- aside -->
		<aside class="col-lg-3">

<?php include 'pages/common/adsbygoogle-square.php'; ?>

<?php include 'pages/3000_Work/3000_Work_aside_hot.php'; ?>

		</aside>
		<!-- /aside -->

			</div>
		</div>
	</main>
	<!-- /main -->