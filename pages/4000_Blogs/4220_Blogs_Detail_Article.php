<?php

include_once 'pages/4000_Blogs/4000_Blogs_header.php';

if (empty($_GET['PK']) || empty($rs = $DB->selectStoryArticle($_GET['PK']))) {
	echo '<script>location.replace("/Blogs");</script>';
	exit();
} else {
	$profile = $DB->selectStoryProfile($rs['story_profile']);
}

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
			<h5 class="<?= $rs['header_img']?'line-clamp-1 text-center text-shadow':'' ?>"><?= $rs['series_title']?$rs['series_title'] . ' | ':'' ?><?= $profile['nickname'] ?></h5>
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

<?php include_once 'pages/common/Detail/photos&videos.php'; ?>

			<!-- .row -->
			<div class="row mb-4">
				<div class="col-12">
					<div class="cke_published"><?= $rs['desc'] ?></div>
				</div>
			</div>
			<!-- /.row -->

<?php if(isset($rs['attachment']) && !empty($rs['attachment'])){ ?>
			<!-- .row -->
			<div class="row mb-4">
				<div class="col-12">
					<h5>Attachments</h5>
					<div><?= $WP->printAttachments($rs); ?></div>
				</div>
			</div>
			<!-- /.row -->

<?php } ?>
<?php include_once 'pages/common/Detail/hashtag.php'; ?>
			<style>a[href^="/Blogs/Search/Article"]{pointer-events:none;}</style>
			<script defer>$(function(){ $('a[href^="/Blogs/Search/Article"]').each(function(){ $(this).attr('href', $(this).attr('href').replace('/Blogs/Search/Article','/Blogs')); }); });</script>

			<!-- .row -->
			<div class="row">
				<div class="col-12">
					<h5>SHARE WITH FRIENDS</h5>
					<div class="sharethis-inline-share-buttons float-left"></div>
<?php if($_SESSION['ADMIN'] || ($_SESSION['ID'] && $profile['member']==$_SESSION['ID'])){ ?>
					<a class="btn btn-light btn-sm mr-1 rounded-sm" href="/Blogs/Edit/Article/<?= $rs['no'] ?>" style="height:32px;" _remove="window_preview">Edit</a>
					<a class="btn btn-light btn-sm mr-1 rounded-sm" data-toggle="action" data-action="delete" data-table="story_article" data-pk="<?= $rs['no'] ?>" style="height:32px;" _remove="window_preview">Delete</a>
<?php } ?>
				</div>
			</div>
			<!-- /.row -->

			<!-- .row -->
			<div class="row">
				<div class="col-12"><hr /></div>
<?php if(isset($profile['logo_img']) && !empty($profile['logo_img'])){ ?>
				<div class="col-12 text-center"><img src="<?= $profile['logo_img'] ?>" alt="<?= $profile['nickname'] ?>" title="<?= $profile['nickname'] ?>" onerror="this.src='/assets/images/common-profile.png'" style="max-width:10rem;max-height:10rem;" /></div>
<?php } ?>
				<div class="col-12 text-center"><h3><?= $profile['profile_title'] ?></h3></div>
				<div class="col-12 text-center"><h4><?= $profile['nickname'] ?></h4></div>
<?php if(isset($profile['profile_desc']) && !empty($profile['profile_desc'])){ ?>
				<div class="col-12 text-center"><p class="text-muted line-clamp-3"><?= $WP->stringFilter($profile['profile_desc']) ?></p></div>
<?php } ?>
				<div class="col-12 text-center mt-3"><a class="btn btn-outline-primary font-weight-bold" href="/Blogs/Detail/Profile/<?= $profile['no'] ?>">PROFILE</a></div>
			</div>
			<!-- /.row -->

		</section>
		<!-- /section -->

		<!-- aside -->
		<aside class="col-lg-3">

<?php include 'pages/common/adsbygoogle-square.php'; ?>

		</aside>
		<!-- /aside -->

			</div>

		</div>
	</main>
	<!-- /main -->