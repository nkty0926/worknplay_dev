<?php

$rs = $DB->selectStoryProfile($USER['story_profile']);

if ($_GET['PK'] && $_GET['PK'] != '_NEW') {
	if ($_GET['PK'] != $USER['story_profile']) {
		echo '<script>location.replace("/Blogs/Edit/Article/_NEW");</script>';
	}
}

include_once 'pages/common/header.php';

if ($_GET['MENU'] == 'Profile') {
?>
	<!-- form : Form-Story -->
	<form data-beforeunload="true" action="/Blogs/Edit/Article/_NEW" method="post" class="needs-validation" id="Form-Story" name="story_profile">

<?php
	$form_header_title = "Manage My Profile"; include_once 'pages/common/header-Edit.php';
} else {
?>
		<hr />

<?php } ?>
		<!-- .container : My_Profile -->
		<div class="container" id="My_Profile">
			<div class="row">

		<!-- aside -->
		<aside class="col-lg-3">

			<!-- article.card -->
			<article class="card mb-5 mt-4">
				<div class="list-group list-group-flush" id="list-fieldset">
					<a class="list-group-item list-group-item-action py-2" href="<?= $_GET['MENU']=='Profile'?'/Blogs/Edit/Article/_NEW':'' ?>">1. Post a Blog</a>
					<a class="list-group-item list-group-item-action py-2 active" href="">2. My Profile</a>
				</div>
			</article>
			<!-- /article.card -->

		</aside>
		<!-- /aside -->

		<!-- section -->
		<section class="col-lg-9">

<?php if($rs['no']){ ?>
			<a class="float-right mt-4 pt-3 d-none d-lg-block" href="javascript:void(0);" data-toggle="action" data-action="delete" data-table="story_profile" data-pk="<?= $USER['story_profile'] ?>">Delete my blog profile</a>
<?php } ?>
			<h2 class="form-heading<?= $_GET['MENU']=='Profile'?'':' form-heading-2' ?>">Manage My Profile</h2>

			<!-- fieldset : Title -->
			<fieldset class="mb-5" id="fieldset-profiletitle">
				<legend class="required">Title</legend>
				<div class="form-group">
					<input type="text" class="form-control form-control-lg" name="profile_title" value="<?= $rs['profile_title'] ?>" placeholder="Title" maxlength="255" required />
				</div>
			</fieldset>
			<!-- /fieldset : Title -->

			<!-- fieldset : Nickname -->
			<fieldset class="mb-5" id="fieldset-nickname">
				<legend class="required">Nickname</legend>
				<input type="text" class="form-control form-control-lg" name="nickname" value="<?= $rs['nickname'] ?>" placeholder="Nickname" maxlength="255" required />
			</fieldset>
			<!-- /fieldset : Nickname -->

<?php include_once 'pages/common/Edit/logo.php'; ?>

			<!-- fieldset : My Introduction -->
			<fieldset class="mb-5" id="fieldset-profiledesc">
				<legend class="required">My Introduction</legend>
				<textarea class="form-control textarea-autosize" name="profile_desc" required><?= $rs['profile_desc'] ?></textarea>
			</fieldset>
			<!-- /fieldset : My Introduction -->

		</section>

			</div>
		</div>
		<!-- /.container : My_Profile -->
<?php if($_GET['MENU']=='Profile'){ ?>

		<div class="container">
			<div class="row justify-content-end">
				<div class="col-lg-9">
			<div class="mb-5 border-top">
				<h2 class="text-center mt-5 mb-4">Nice Job! You're almost done.</h2>
				<div class="row">
					<div class="col-6">
						<button type="submit" class="btn btn-outline-primary btn-block btn-lg" data-type="publish"><?= isset($_GET['next']) && !empty($_GET['next'])?'Next':'Publish' ?></button>
					</div>
					<div class="col-6">
						<a class="btn btn-outline-secondary btn-block btn-lg" href="/Blogs/MyPage">Cancel</a>
					</div>
				</div>
			</div>
				</div>
			</div>
		</div>

		<input type="hidden" name="pk" value="<?= $rs['no'] ?>" />
		<input type="hidden" name="publ" value="<?= $rs['publ'] ?>" />

	</form>
	<!-- /form : Form-Story -->
<?php } ?>