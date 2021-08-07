<?php

// EDIT STORY_PROFILE
if ($_POST['nickname']) {
	$columns = array(
		'publ',
		'member',
		'nickname',
		'profile_title',
		'profile_desc',
		'logo_img'
	);
	$values = array(
		':no' => $USER['story_profile'],
		':publ' => $_POST['publ'] ? 1 : 0,
		':member' => $_SESSION['ID'],
		':nickname' => htmlspecialchars(trim($_POST['nickname'])),
		':profile_title' => $_POST['profile_title'],
		':profile_desc' => $_POST['profile_desc'],
		':logo_img' => $_POST['logo_img']
	);
	if ($USER['story_profile'] = $DB->edit('story_profile', $columns, $values)) {
		if (empty($_POST['title'])) {
			echo '<script>location.href="/Blogs/Detail/Profile/' . $USER['story_profile'] . '";</script>';
			exit();
		}
	} else
		echo '<script>alert("Failed");history.back();</script>';
}

// EDIT STORY_ARTICLE
if ($_POST['title']) {
	if ($_POST['pk'] && $DB->selectStoryArticle($_POST['pk'])['member'] != $_SESSION['ID'] && !$_SESSION['ADMIN']) {
		blockMember();
	}
	$columns = array(
		'publ',
		'story_profile',
		'story_series',
		'work_company',
		'title',
		'story_category',
		'hashtag',
		'desc',
		'header_img',
		'header_href',
		'header_target',
		'header_size',
		'header_text',
		'list_img',
		'photos',
		'videos',
		'attachment'
	);
	$values = array(
		':no' => $_POST['pk'],
		':publ' => $_POST['publ'] ? 1 : 0,
		':story_profile' => $DB->selectStoryProfile(null, $_SESSION['ID'])[0]['no'],
		':story_series' => $_POST['story_series'] ? $_POST['story_series'] : null,
		':work_company' => $_GET['company'] ? $_GET['company'] : null,
		':title' => htmlspecialchars(trim($_POST['title'])),
		':story_category' => $_POST['story_category'],
		':hashtag' => $_POST['hashtag'],
		':desc' => $_POST['desc'],
		':header_img' => $_POST['header_img'],
		':header_href' => $_POST['header_href'],
		':header_target' => $_POST['header_target'],
		':header_size' => $_POST['header_size'],
		':header_text' => $_POST['header_text'],
		':list_img' => $_POST['list_img'],
		':photos' => $_POST['photos'],
		':videos' => $_POST['videos'],
		':attachment' => join('|', $_POST['attachment'])
	);
	if ($_POST['pk'] = $DB->edit('story_article', $columns, $values)) {
		if ($_POST['save']) {
			echo $_POST['pk'];
		} else if ($_POST['preview']) {
			echo '<script>location.replace("/Blogs/Detail/Article/' . $_POST['pk'] . '#preview");</script>';
		} else if ($_GET['company']) {
			echo '<script>location.replace("/Work/Detail/Company/' . $_GET['company'] . '/Blogs");</script>';
		} else {
			echo '<script>location.replace("/Blogs/Detail/Article/' . $_POST['pk'] . '");</script>';
		}
	} else
		echo '<script>alert("Failed");history.back();</script>';
	exit();
}

if ($_GET['PK'] && $_GET['PK'] != '_NEW') {
	$rs = $DB->selectStoryArticle($_GET['PK']);
	if ($rs['member'] != $_SESSION['ID']) {
		echo '<script>location.replace("/Blogs/Edit/Article/_NEW");</script>';
	}
}

include_once 'pages/common/header.php';

?>
	<!-- form : Form-Story -->
	<form data-beforeunload="true" action="" method="post" class="needs-validation" id="Form-Story" name="story_article">

<?php $form_header_title = "Post a Blog"; include_once 'pages/common/header-Edit.php'; ?>

		<!-- .container : Post_a_Blog -->
		<div class="container" id="Post_a_Blog">
			<div class="row">

		<!-- aside -->
		<aside class="col-lg-3">

			<!-- article.card -->
			<article class="card mb-5 mt-4">
				<div class="list-group list-group-flush" id="list-fieldset">
					<a class="list-group-item list-group-item-action py-2 active" href="">1. Post a Blog</a>
					<a class="list-group-item list-group-item-action py-2" href="<?= $USER['story_profile']?'/Blogs/Edit/Profile/'.$USER['story_profile']:'' ?>">2. My Profile</a>
				</div>
			</article>
			<!-- /article.card -->

		</aside>
		<!-- /aside -->

		<!-- section -->
		<section class="col-lg-9">

			<h2 class="form-heading<?= $USER['story_profile']?'':' form-heading-1' ?>">Post a Blog</h2>

			<!-- fieldset : Title -->
			<fieldset class="mb-5" id="fieldset-title">
				<legend class="required">Title</legend>
				<input type="text" class="form-control form-control-lg" name="title" value="<?= $rs['title'] ?>" placeholder="Title" maxlength="255" data-type="title" required />
			</fieldset>
			<!-- /fieldset : Title -->

<?php if($_SESSION['ADMIN']){ ?>
			<!-- fieldset : Date -->
			<fieldset class="mb-5" id="fieldset-date">
				<legend>Date</legend>
				<input type="text" class="form-control form-control-lg" id="date" name="date" value="<?= $rs['date'] ?>" placeholder="Date" autocomplete="off" />
				<script defer>$(function(){ $('#date').datepicker({ dateFormat: 'yy-mm-dd' }); });</script>
			</fieldset>
			<!-- /fieldset : Date -->

<?php } ?>
<?php include_once 'pages/common/Edit/header.php'; ?>

			<!-- fieldset : List Image -->
			<fieldset class="mb-5" id="fieldset-list-img">
				<legend class="required">List Image</legend>
				<div class="collapse<?= $rs['list_img']?'':' show' ?>" id="list-img-target-collapse">
					<label class="btn btn-secondary" for="list_img"><i class="fa fa-plus-square"></i> Browse</label>
				</div>
				<div id="list-img-target">
<?php if(isset($rs['list_img']) && !empty($rs['list_img'])){ ?>
					<figure><a class="form-remove" href="javascript:void(0);" data-toggle="remove">&times;</a><img src="<?= $rs['list_img']?>" onerror="this.src='/assets/images/common-noimage.png'" /></figure>
<?php } ?>
				</div>
				<input type="file" accept="image/gif, image/jpeg, image/png" class="d-none" id="list_img" data-name="list_img" data-target="#list-img-target" data-target-collapse="#list-img-target-collapse" />
				<input type="hidden" name="list_img" value="<?= $rs['list_img'] ?>" />
				<style>
					.is-invalid {
						box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgb(169, 68, 66, 0.6);
					}
				</style>
				<script defer>
					$('form.needs-validation').on('click', 'button[type="submit"]', function(e) {
						if (!$('#fieldset-list-img [name="list_img"]').val()) {
							if (!$('#fieldset-list-img').parent().is('.is-invalid')) {
								$('#fieldset-list-img').wrap('<div class="is-invalid"></div>');
							}
						} else {
							$('#fieldset-list-img').unwrap();
						}
					});
				</script>
			</fieldset>
			<!-- /fieldset : List Image -->

			<!-- fieldset : Series -->
			<fieldset class="mb-5" id="fieldset-series">
				<legend>Series</legend>
				<div class="form-group mb-0 dropdown">
					<a class="form-control custom-select custom-select-lg dropdown-toggle" data-toggle="dropdown" data-name="story_series"><?= $rs['series_title']?$rs['series_title']:'Not Selected' ?></a>
					<div class="dropdown-menu">
						<a class="dropdown-item" data-value="">Not Selected</a>
<?php foreach($DB->selectStorySeries(null, $_SESSION['ID']) as $series){ ?>
						<a class="dropdown-item" data-value="<?= $series['no'] ?>"><?= $series['series_title'] ?></a>
<?php } ?>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item dropdown-toggle" data-toggle="collapse" data-target="#Form-Series">New Series</a>
						<div class="container-fluid mt-2 collapse" id="Form-Series" data-form-name="story_series">
							<div class="form-row">
								<div class="col-lg-8">
									<input type="text" class="form-control" name="series_title" placeholder="Series Title" maxlength="255" />
									<input type="hidden" name="series_no" value="" />
								</div>
								<div class="col-lg-2">
									<button type="button" class="btn btn-block btn-secondary" data-type="publish">Submit</button>
								</div>
								<div class="col-lg-2">
									<button type="button" class="btn btn-block btn-light" data-toggle="collapse" data-target="#Form-Series">Cancel</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<input type="hidden" name="story_series" value="<?= $rs['story_series'] ?>" />
				<script defer>
					$(document).on('click', '#fieldset-series .dropdown-item[data-value]', function(){
						var series_title= $(this).text();
						var series_no = $(this).data('value');
						$('.dropdown-toggle[data-name="story_series"]').text(series_title);
						$('input[name="story_series"]').val(series_no);
					});
					$('[data-toggle="collapse"][data-target="#Form-Series"]').on('click', function(e){
						e.stopPropagation();
						$('#Form-Series').collapse('toggle');
						$('#Form-Series').parent('.dropdown-menu').animate({ 'scrollTop' : $('#Form-Series').parent('.dropdown-menu')[0].scrollHeight }, 200);
						$('input[name="series_title"], input[name="series_no"]').val('');
					});
					$('#Form-Series [data-type="publish"]').on('click', function(e){
						e.stopPropagation();
						var series_no = $('input[name="series_no"]').val();
						var series_title = $('input[name="series_title"]').val();
						if(series_title){
							$.ajax({
								type: 'post', url: '/actions/EditSeries', data: 'action=EditSeries&pk=' + series_no + '&series_title=' + series_title,
								success: function(result){
									if (!isNaN(parseInt(result))) { 
										$('.dropdown-item[data-value=""]').after('<a class="dropdown-item" data-value="' + result + '">' + series_title + '</a>');
									} else {
										Alert("This name already exists.");
									}
								},
								complete: function(){
									$('#Form-Series').collapse('hide');
									$('input[name="series_title"], input[name="series_no"]').val('');
								}
							});
						}
					});
				</script>
			</fieldset>
			<!-- /fieldset : Series -->

			<!-- fieldset : Category -->
			<fieldset class="mb-5" id="fieldset-category">
				<legend class="required">Category</legend>
				<select class="form-control custom-select custom-select-lg" name="story_category" required>
					<option value="">Category</option>
<?php foreach($CONF['story_category'] as $category){ ?>
					<option value="<?= $category ?>"<?= $rs['story_category']==$category || $_GET['category']==$category?' selected':'' ?>><?= str_replace('_', ' ', $category) ?></option>
<?php } ?>
				</select>
			</fieldset>
			<!-- /fieldset : Category -->

			<!-- fieldset : Content -->
			<fieldset class="mb-5" id="fieldset-desc">
				<legend class="required">Content
<?php if(false){ ?>
					<div class="form-check float-right small">
						<input type="checkbox" class="form-check-input" id="fieldset-desc-toggler"<?= $rs['photos'] || $rs['videos']?' checked':'' ?> />
						<label class="form-check-label text-muted" for="fieldset-desc-toggler" 번역필요>Photos만 등록하기</label>
					</div>
					<style>#fieldset-videos{display:none;}</style>
<?php } ?>
				</legend>
				<div class="collapse<?= $rs['photos'] || $rs['videos']?'':' show' ?>">
					<textarea class="ckeditor required" id="desc" name="desc"><?= $rs['desc'] ?></textarea>
					<!-- script defer>$(function(){ CKEDITOR.replace('desc'); });</script -->
				</div>
				<div class="collapse<?= $rs['photos'] || $rs['videos']?' show':'' ?>">
					<div class="card">
						<div class="card-body mb-n3">
<?php include_once 'pages/common/Edit/photos&videos.php'; ?>
						</div>
					</div>
				</div>
				<script defer>
					$('#fieldset-desc-toggler').on('change', function(){
						if ($(this).prop('checked')) {
							CKEDITOR.instances['desc'].destroy();
							$('#desc').val('');
						} else {
							CKEDITOR.replace('desc');
							$('#photos-img-target, #videos-target').empty();
						}
						$('#fieldset-desc .collapse').toggleClass('show');
					});
				</script>
			</fieldset>
			<!-- /fieldset : Content -->

<?php include_once 'pages/common/Edit/hashtag.php'; ?>

<?php include_once 'pages/common/Edit/attachment.php'; ?>

		</section>
		<!-- /section -->

			</div>
		</div>
		<!-- /.container : Post_a_Blog -->

<?php if(empty($USER['story_profile'])){ include_once 'pages/4000_Blogs/4310_Blogs_Edit_Profile.php'; } ?>

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
						<a class="btn btn-outline-secondary btn-block btn-lg" href="/Blogs<?= $USER['story_profile']?'/MyPage':'' ?>">Cancel</a>
					</div>
				</div>
			</div>
				</div>
			</div>
		</div>

		<input type="hidden" name="pk" value="<?= $rs['no'] ?>" />
		<input type="hidden" name="fk" value="<?= $USER['story_profile'] ?>" />
		<input type="hidden" name="publ" value="<?= $rs['publ'] ?>" />

	</form>
	<!-- /form : Form-Story -->