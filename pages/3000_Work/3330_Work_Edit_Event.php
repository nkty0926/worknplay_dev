<?php

if ($_POST) {
	if ($_POST['pk'] && $DB->selectWorkEvent($_POST['pk'])['member'] != $_SESSION['ID'] && !$_SESSION['ADMIN']) {
		blockMember();
	}
	$columns = array(
		'publ',
		'work_company',
		'title',
		'location_country',
		'location_parent',
		'location_child',
		'location_tag',
		'location_city',
		'desc',
		'period',
		'hashtag',
		'header_img',
		'header_href',
		'header_target',
		'header_size',
		'header_text'
	);
	$values = array(
		':publ' => $_POST['publ'] ? 1 : 0,
		':work_company' => $_POST['fk'],
		':title' => htmlspecialchars(trim($_POST['title'])),
		':location_country' => $_POST['location_country'],
		':location_parent' => $_POST['location_parent']?$_POST['location_parent']:null,
		':location_child' => $_POST['location_child']?$_POST['location_child']:null,
		':location_tag' => $_POST['location_tag'],
		':location_city' => $_POST['location_city'],
		':desc' => $_POST['desc'],
		':period' => $_POST['period_to'] ? $_POST['period_from'] . ' ~ ' . $_POST['period_to'] : $_POST['period_from'],
		':hashtag' => $_POST['hashtag'],
		':header_img' => $_POST['header_img'],
		':header_href' => $_POST['header_href'],
		':header_target' => $_POST['header_target'],
		':header_size' => $_POST['header_size'],
		':header_text' => $_POST['header_text'],
		':no' => $_POST['pk']
	);
	if ($_POST['pk'] = $DB->edit('work_event', $columns, $values)) {
		if ($_POST['submit_type'] == 'save') {
			echo $_POST['pk'];
		} else if ($_POST['submit_type'] == 'preview') {
			echo '<script>location.replace("/Work/Detail/Event/' . $_POST['pk'] . '#preview");</script>';
		} else {
			echo '<script>location.replace("/Work/Detail/Event/' . $_POST['pk'] . '");</script>';
		}
	} else
		echo '<script>alert("Failed");history.back();</script>';
	exit();
}

if ($_GET['PK'] && $_GET['PK'] != '_NEW') {
	$rs = $DB->selectWorkEvent($_GET['PK']);
	if ($rs['member'] != $_SESSION['ID']) {
		echo '<script>location.replace("/Work/Employer/Event");</script>';
	}
} else if (empty($_GET['profile']) || $DB->selectWorkCompany($_GET['profile'])['member'] != $_SESSION['ID']) {
	echo '<script>location.replace("/Work/Employer/Event");</script>';
} else if ($_GET['profile'] && !$rs['work_company']) {
	$rs['work_company'] = $_GET['profile'];
}

include_once 'pages/3000_Work/3000_Work_header.php';

?>
	<!-- form : Form-Event -->
	<form data-beforeunload="true" action="" method="post" class="needs-validation" id="Form-Event" name="work_event">

<?php $form_header_title = "Create an Event"; include_once 'pages/common/header-Edit.php'; ?>

		<div class="container">
			<div class="row">

		<!-- aside -->
		<aside class="col-lg-3">

			<!-- article.card -->
			<article class="card sticky-top mb-5" style="margin-top:1.5rem;top:5rem;z-index:999;">
				<h5 class="card-header">Event</h5>
				<div class="list-group list-group-flush" id="list-fieldset">
					<a class="list-group-item list-group-item-action py-2" href="#fieldset-title">Title</a>
					<a class="list-group-item list-group-item-action py-2" href="#fieldset-header">Header Image</a>
					<a class="list-group-item list-group-item-action py-2" href="#fieldset-desc">Description</a>
					<a class="list-group-item list-group-item-action py-2" href="#fieldset-period">Period</a>
					<a class="list-group-item list-group-item-action py-2" href="#fieldset-location">Location</a>
					<a class="list-group-item list-group-item-action py-2" href="#fieldset-hashtag">Hash Tag</a>
				</div>
			</article>
			<!-- /article.card -->

		</aside>
		<!-- /aside -->

		<!-- section -->
		<section class="col-lg-9">

			<h2 class="form-heading">Post an Event</h2>
			<p class="text-muted">Create a vacancy post. By providing clear instructions on what you expect from your employees you can optimize the recruitment process and find the best match for the position.</p>

			<!-- fieldset : Title -->
			<fieldset class="mb-5" id="fieldset-title">
				<legend class="required">Title</legend>
				<input type="text" class="form-control form-control-lg" name="title" value="<?= $rs['title'] ?>" placeholder="Title" maxlength="255" data-type="title" required />
			</fieldset>
			<!-- /fieldset : Title -->

<?php include_once 'pages/common/Edit/header.php'; ?>

			<!-- fieldset : Description -->
			<fieldset class="mb-5" id="fieldset-desc">
				<legend>Description</legend>
				<div class="form-group mb-0">
					<textarea id="desc" name="desc"><?= $rs['desc'] ?></textarea>
<?php if($_SESSION['RECRUITER']){ ?>
					<script defer>
						$(function(){ CKEDITOR.replace('desc'); });
					</script>
<?php }else{ ?>
					<script defer>
						$(function(){ CKEDITOR.replace('desc', {
							toolbarStartupExpanded: true,
							toolbar: [
								{ name: 'document', items: [ 'NewPage' ] },
								{ name: 'clipboard', items: [ 'Undo', 'Redo' ] },
								{ name: 'paragraph', items: [ 'Outdent', 'Indent', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
								{ name: 'blocks', items: [ 'NumberedList', 'BulletedList' ] },
								{ name: 'links', items: [ 'Link', 'Unlink' ] },
								{ name: 'insert', items: [ 'HorizontalRule', 'SpecialChar' ] },
								{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] }
							]
						}); });
					</script>
<?php } ?>
				</div>
			</fieldset>
			<!-- /fieldset : Description -->

<?php include_once 'pages/common/Edit/period.php'; ?>

<?php include_once 'pages/common/Edit/location.php'; ?>

<?php include_once 'pages/common/Edit/hashtag.php'; ?>

			<div class="my-5 border-top">
				<h2 class="text-center mt-5 mb-4">Nice Job! You're almost done.</h2>
				<div class="row">
					<div class="col-6">
						<button type="submit" class="btn btn-outline-primary btn-block btn-lg" data-type="publish"><?= isset($_GET['next']) && !empty($_GET['next'])?'Next':'Publish' ?></button>
					</div>
					<div class="col-6">
						<a class="btn btn-outline-secondary btn-block btn-lg" href="/Work/Employer">Cancel</a>
					</div>
				</div>
			</div>

		</section>
		<!-- /section -->

			</div>
		</div>

		<input type="hidden" name="pk" value="<?= $rs['no'] ?>" />
		<input type="hidden" name="fk" value="<?= $rs['work_company'] ?>" />
		<input type="hidden" name="publ" value="<?= $rs['publ'] ?>" />

		<script defer>$(function(){$('body').addClass('position-relative').attr('data-spy','scroll').attr('data-target','#list-fieldset').attr('data-offset','95');});</script>

	</form>
	<!-- /form : Form-Event -->