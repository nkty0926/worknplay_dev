<?php

if ($_POST) {
	if (empty($_POST['pk']))
		$_POST['pk'] = $USER['work_resume'];
	$columns = array(
		'publ',
		'member',
		'personal_firstname',
		'personal_lastname',
		'personal_nationality',
		'personal_gender',
		'personal_marital',
		'personal_birthday',
		'personal_visa',
		'contact_private',
		'contact_phone1',
		'contact_phone2',
		'contact_email',
		'contact_person',
		'contact_messengers',
		'contact_urls',
		'logo_img'
	);
	$values = array(
		':no' => $_POST['pk'],
		':publ' => $_POST['publ'] ? 1 : 0,
		':member' => $_SESSION['ID'],
		':personal_firstname' => $_POST['personal_firstname'],
		':personal_lastname' => $_POST['personal_lastname'],
		':personal_nationality' => join(',', $_POST['personal_nationality']),
		':personal_gender' => $_POST['personal_gender'] ? $_POST['personal_gender'] : 0,
		':personal_marital' => $_POST['personal_marital'] ? $_POST['personal_marital'] : 0,
		':personal_birthday' => $_POST['birth_year'] && $_POST['birth_month'] && $_POST['birth_date'] ? $_POST['birth_year'] . '-' . $_POST['birth_month'] . '-' . $_POST['birth_date'] : '',
		':personal_visa' => $_POST['personal_visa'],
		':contact_private' => $_POST['contact_private'] ? 1 : 0,
		':contact_phone1' => (isset($_POST['contact_phone1_code']) && !empty($_POST['contact_phone1_code']) ? $_POST['contact_phone1_code'] : '') . $_POST['contact_phone1'],
		':contact_phone2' => (isset($_POST['contact_phone2_code']) && !empty($_POST['contact_phone2_code']) ? $_POST['contact_phone2_code'] : '') . $_POST['contact_phone2'],
		':contact_email' => $_POST['contact_email'],
		':contact_person' => $_POST['contact_person'],
		':contact_messengers' => join(',', $_POST['contact_messengers']),
		':contact_urls' => join(',', $_POST['contact_urls']),
		':logo_img' => $_POST['logo_img']
	);
	if ($_POST['pk'] = $DB->edit('work_resume_profile', $columns, $values)) {
		$_SESSION['SEEKER'] = $_POST['pk'];
		if ($_POST['submit_type'] == 'save') {
			echo $_POST['pk'];
//		} else if ($_POST['submit_type'] == 'preview') {
//
		} else if ($_GET['next']) {
			echo '<script>location.replace("/Work/Edit/Resume/' . $_GET['next'] . '");</script>';
		} else {
			echo '<script>location.replace("/Work/Seeker/ManageResumes");</script>';
		}
	} else
		echo '<script>alert("Failed");history.back();</script>';
	exit();
}

$rs = $DB->selectWorkResumeProfile();

include_once 'pages/3000_Work/3000_Work_header.php';

?>
	<!-- form : Form-Resume -->
	<form data-beforeunload="true" action="" method="post" class="needs-validation" id="Form-Resume" name="work_resume_profile">

<?php $form_header_title = "Create My Profile" . (isset($_GET['next']) && !empty($_GET['next'])?'<small> &gt;&gt; CREATE A RESUME</small>':''); include_once 'pages/common/header-Edit.php'; ?>

		<div class="container">
			<div class="row">

		<!-- aside -->
		<aside class="col-lg-3">

			<!-- article.card -->
			<article class="card sticky-top mb-5" style="margin-top:1.5rem;top:5rem;z-index:999;">
				<h5 class="card-header"><?= $_GET['next']?'1. ':'' ?>Profile</h5>
				<div class="list-group list-group-flush" id="list-fieldset">
					<a class="list-group-item list-group-item-action py-2" href="#fieldset-logo">Profile Picture</a>
					<a class="list-group-item list-group-item-action py-2" href="#fieldset-personal">Personal Information</a>
					<a class="list-group-item list-group-item-action py-2" href="#fieldset-contact">Contact Information</a>
				</div>
			</article>
			<!-- /article.card -->

		</aside>
		<!-- /aside -->

		<!-- section -->
		<section class="col-lg-9">

			<h2 class="form-heading">Profile</h2>
			<!-- <p class="text-muted">Provide general information about yourself. Please make sure to include only the correct and relevant information that will highlight your skills and achievements.</p> -->

<?php include_once 'pages/common/Edit/logo.php'; ?>

<?php include_once 'pages/common/Edit/personal.php'; ?>

<?php include_once 'pages/common/Edit/contact.php'; ?>

			<input type="hidden" class="ckeditor d-none" />

			<div class="my-5 border-top">
				<h2 class="text-center mt-5 mb-4">Nice Job! You're almost done.</h2>
				<div class="row">
					<div class="col-6">
						<button type="submit" class="btn btn-outline-primary btn-block btn-lg" data-type="publish"><?= isset($_GET['next']) && !empty($_GET['next'])?'Next':'Publish' ?></button>
					</div>
					<div class="col-6">
						<a class="btn btn-outline-secondary btn-block btn-lg" href="/Work/Seeker">Cancel</a>
					</div>
				</div>
			</div>

		</section>
		<!-- /section -->

			</div>
		</div>

		<input type="hidden" name="pk" value="<?= $rs['no'] ?>" />
		<input type="hidden" name="publ" value="<?= $rs['publ'] ?>" />

		<script defer>$(function(){$('body').addClass('position-relative').attr('data-spy','scroll').attr('data-target','#list-fieldset').attr('data-offset','95');});</script>

	</form>
	<!-- /form : Form-Resume -->