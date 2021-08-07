<?php

if (empty($USER['work_credit_res_day']))
	$USER['work_credit_res_day'] = $USER['work_credit_hot_day'];

if (empty($_GET['PK']) || empty($rs = $DB->selectWorkResume($_GET['PK']))) {
	echo '<script>location.replace("/Work");</script>';
	exit();
} else if(isset($_GET['application']) && !empty($_GET['application'])){
	$application = $DB->selectWorkJobApplication($_GET['application']);
	if ($application['resume_member'] != $_SESSION['ID'] && $application['job_member'] != $_SESSION['ID'])
		unset($application);
}
$saved = $DB->selectSave('work_resume', $rs['no']);

if ($_GET['credit']) {
	$DB->updateWorkCreditUsed($_GET['credit'], $_SESSION['ID'], '3');
	header('Location: /Work/Detail/Resume/' . $_GET['PK']);
	exit();
} else if ($rs['member'] != $_SESSION['ID'] && !$_SESSION['RECRUITER'] && !$USER['work_credit_hot_day'] && !$USER['work_credit_res_day'] && !$application) {
	if ($USER['work_credit_res'][0] && $USER['work_credit_res'][0]['no']) {
		include_once 'pages/3000_Work/3000_Work_header.php';
		echo '<main></main><script defer>$(function(){ Confirm("Do you want to use 1 purchased credit for Resume Search?", function(){ location.replace("/Work/Detail/Resume/' . $_GET['PK'] . '?credit=' . $USER['work_credit_res'][0]['no'] . '"); }, function(){ history.back(); }); });</script>';
		include_once 'pages/common/footer.php';
		exit();
	} else {
		header('Location: /Work/Product/Select');
		exit();
	}
}

include_once 'pages/3000_Work/3000_Work_header.php';

?>
	<style>.navbar.sticky-top{position:relative;}</style>

	<!-- nav.navbar -->
	<nav class="navbar navbar-expand navbar-light bg-light border-bottom fixed-top py-0 shadow fade">
		<div class="container py-2 px-lg-3">
			<h3 class="navbar-brand mw-100 mb-0"><span class="line-clamp-1"><?= $rs['title'] ?></span><small class="line-clamp-1"><?= $rs['fullname'] ?></small></h3>
			<ul class="navbar-nav ml-auto d-none d-lg-flex">
<?php if($_SESSION['ID'] && $_SESSION['ID']==$rs['member']){ ?>
				<li class="nav-item ml-lg-3 d-print-none d-preview-none d-none d-lg-inline-block"><a class="nav-link" href="/Work/Edit/Resume/<?= $rs['no'] ?>">Edit</a></li>
<?php } if($USER['work_credit_res_day']){ ?>
				<li class="nav-item ml-lg-3"><a class="nav-link" data-toggle="modal" data-target="#modalFormSaveResume"><?= $saved?'Saved Resume':'Add to resume folder' ?></a></li>
<?php } ?>
				<li class="nav-item ml-lg-3 d-print-none d-preview-none d-none d-lg-inline-block"><a class="nav-link" data-toggle="print">Print</a></li>
			</ul>
		</div>
	</nav>
	<!-- nav.navbar -->

	<!-- main -->
	<main class="py-3 py-lg-5 bg-light">
		<div class="container">
			<div class="row">

		<!-- section -->
		<section class="col-lg-12 bg-white pt-3">

			<h2><?= $rs['title'] ?></h2>

			<!-- .row -->
			<div class="row">
				<div class="col-lg-3 mb-4">

					<!-- .card -->
					<div class="card h-100">
						<div class="card-body">
							<figure class="d-flex align-items-center mx-auto" style="width:144px;height:192px;">
								<img class="d-block mx-auto mh-100 mw-100" src="<?= $rs['logo_img'] ?>" alt="<?= $rs['fullname'] ?>" title="<?= $rs['fullname'] ?>" onerror="this.src='/assets/images/common-profile.png'" />
							</figure>
							<h5 class="text-center"><?= $rs['fullname'] ?></h5>
						</div>
					</div>
					<!-- /.card -->

				</div>
				<div class="col-lg-9 mb-4">

					<!-- .card -->
					<div class="card h-100">
						<div class="card-body">
							<span class="text-muted text-right float-lg-right d-none d-lg-block"><?= substr($rs['date'], 0, 10)==substr($rs['mod'], 0, 10)?'Date Posted':'Last Modified' ?> : <time><?= date($CONF['date_format'], strtotime($rs['mod'])) ?></time></span>
							<h4><?= $rs['fullname'] ?></h4>
							<div class="row">
								<div class="col-lg-10">
							<div class="row">
<?php if(isset($rs['personal_nationality']) && !empty($rs['personal_nationality'])){ ?>
							<div class="col-sm-4 col-lg-3 font-weight-bold">Citizenship</div>
							<div class="col-sm-8 col-lg-9 mb-1"><?= $WP->printNationality($rs) ?></div>
<?php } if(isset($rs['personal_gender']) && !empty($rs['personal_gender'])){ ?>
							<div class="col-sm-4 col-lg-3 font-weight-bold">Gender</div>
							<div class="col-sm-8 col-lg-9 mb-1"><?= $WP->printGender($rs) ?></div>
<?php } if(isset($rs['personal_birthday']) && !empty($rs['personal_birthday'])){ ?>
							<div class="col-sm-4 col-lg-3 font-weight-bold">Date of Birth</div>
							<div class="col-sm-8 col-lg-9 mb-1"><?= date($CONF['date_format'], strtotime($rs['personal_birthday'])) ?></div>
<?php } if(isset($rs['current_location_parent_name']) && !empty($rs['current_location_parent_name']) || isset($rs['current_location_country_name']) && !empty($rs['current_location_country_name'])){ ?>
							<div class="col-sm-4 col-lg-3 font-weight-bold">Current Location</div>
							<div class="col-sm-8 col-lg-9 mb-1"><?= $WP->printLocation($rs, 'current_') ?></div>
<?php } if(isset($rs['education_level']) && !empty($rs['education_level'])){ ?>
							<div class="col-sm-4 col-lg-3 font-weight-bold">Education Level</div>
							<div class="col-sm-8 col-lg-9 mb-1"><?= $CONF['education_levels'][$rs['education_level']-1] ?></div>
<?php } if(isset($rs['career_level']) && !empty($rs['career_level'])){ ?>
							<div class="col-sm-4 col-lg-3 font-weight-bold">Career Level</div>
							<div class="col-sm-8 col-lg-9 mb-1"><?= $CONF['career_levels'][$rs['career_level']-1] ?></div>
<?php } if(isset($rs['language_eng']) && !empty($rs['language_eng'])){ ?>
							<div class="col-sm-4 col-lg-3 font-weight-bold d-lg-none">English</div>
							<div class="col-sm-8 col-lg-9 mb-1 d-lg-none"><?= $CONF['language_levels'][$rs['language_eng']-1] ?></div>
<?php } if(isset($rs['language_kor']) && !empty($rs['language_kor'])){ ?>
							<div class="col-sm-4 col-lg-3 font-weight-bold d-lg-none">Korean</div>
							<div class="col-sm-8 col-lg-9 mb-1 d-lg-none"><?= $CONF['language_levels'][$rs['language_kor']-1] ?></div>
<?php } if(isset($rs['language_others']) && !empty($rs['language_others'])){ foreach(explode(',', $rs['language_others']) as $language_others){ ?>
							<div class="col-sm-4 col-lg-3 font-weight-bold d-lg-none"><?= explode(';', $language_others)[0] ?></div>
							<div class="col-sm-8 col-lg-9 mb-1 d-lg-none"><?= $CONF['language_levels'][explode(';', $language_others)[1]-1] ?></div>
<?php }} if(isset($rs['language_eng']) && !empty($rs['language_eng'])){ ?>
							<div class="col-sm-4 col-lg-3 font-weight-bold d-none d-lg-block">Language</div>
							<div class="col-sm-8 col-lg-9 mb-1 d-none d-lg-block">
								<span>English: <?= $CONF['language_levels'][$rs['language_eng']-1] ?></span>
<?php if(isset($rs['language_kor']) && !empty($rs['language_kor'])){ ?>
								<span> / Korean: <?= $CONF['language_levels'][$rs['language_kor']-1] ?></span>
<?php } if(isset($rs['language_others']) && !empty($rs['language_others'])){ foreach(explode(',', $rs['language_others']) as $language_others){ ?>
								<span> / <?= explode(';', $language_others)[0] ?>: <?= $CONF['language_levels'][explode(';', $language_others)[1]-1] ?></span>
<?php }} ?>
							</div>
<?php } ?>
							</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /.card -->

				</div>
				<div class="col-lg-3"></div>
				<div class="col-lg-9 mt-n3 mb-2">

<?php if($_SESSION['ID'] && $_SESSION['ID']==$rs['member']){ ?>
					<a class="btn btn-light d-print-none d-preview-none d-none d-lg-inline-block" href="/Work/Edit/Resume/<?= $rs['no'] ?>">Edit</a>
<?php } if($USER['work_credit_res_day']){ ?>
					<button type="button" class="btn btn-<?= $saved?'light':'primary' ?> d-print-none" data-toggle="modal" data-target="#modalFormSaveResume"><?= $saved?'Saved Resume':'Add to resume folder' ?></button>
<?php } ?>
					<button type="button" class="btn btn-light d-print-none d-preview-none d-none d-lg-inline-block" data-toggle="print">Print</button>

				</div>
			</div>
			<!-- /.row -->

		</section>
		<!-- /section -->

		<!-- section -->
		<section class="col-lg-12 bg-white mt-3 pt-3">
			<div class="row">

		<!-- section -->
		<section class="col-lg-9">

<?php if(isset($application['cover_letter']) && !empty($application['cover_letter'])){ ?>
			<!-- section.card : Cover Letter -->
			<section class="card mb-5">
				<div class="card-header">
					<h4 class="mb-0">Cover Letter <a data-toggle="collapse" data-target="#coverLetter" class="font-weight-normal float-right" style="font-size:1rem;line-height:1.8rem;">Fold</a></h4>
				</div>
				<div class="collapse show" id="coverLetter">
					<div class="card-body p-3"><?= nl2br($application['cover_letter']) ?></div>
				</div>
				<script defer>
					$('#coverLetter').on('show.bs.collapse', function(){
						$('[data-toggle="collapse"][data-target="#coverLetter"]').text('Fold');
					});
					$('#coverLetter').on('hide.bs.collapse', function(){
						$('[data-toggle="collapse"][data-target="#coverLetter"]').text('Unfold');
					});
				</script>
			</section>
			<!-- /section.card : Cover Letter -->

<?php } ?>
<?php if(isset($application['questions']) && !empty($application['questions']) && isset($application['answers']) && !empty($application['answers'])){
	$questions = explode('|', $application['questions']);
	$answers = explode('|', $application['answers']);
?>
			<!-- section.card : Questions -->
			<section class="card mb-5">
				<div class="card-header">
					<h4 class="mb-0">Questions <a data-toggle="collapse" data-target="#questions" class="font-weight-normal float-right" style="font-size:1rem;line-height:1.8rem;">Fold</a></h4>
				</div>
				<div class="collapse show" id="questions">
					<div class="card-body p-3">
<?php for($i=0; $i<count($questions); $i++){ ?>
						<h6 class="mb-0"><?= $i+1 ?>. <?= $questions[$i] ?></h6>
						<p class="mb-0"><?= nl2br($answers[$i]) ?></p>
<?php if($i<count($questions)-1){ ?>
						<hr />
<?php } ?>
<?php } ?>
					</div>
				</div>
			</section>
			<!-- /section.card : Questions -->

<?php } ?>
<?php if(isset($rs['desc']) && !empty($rs['desc'])){ ?>
			<!-- section.card : Professional Summary -->
			<section class="card mb-5">
				<div class="card-header">
					<h4 class="mb-0">Professional Summary</h4>
				</div>
				<div class="card-body p-3 cke_published"><?= strip_tags($rs['desc'])==$rs['desc']?nl2br($rs['desc']):$rs['desc'] ?></div>
			</section>
			<!-- /section.card : Professional Summary -->

<?php } ?>
			<style>
				.article-line {
					position: relative;
					padding-left: 2rem;
					padding-bottom: 1rem;
				}
				.article-line::before {
					content: "";
					background: var(--white);
					border: 2px solid var(--primary);
					border-radius: 50%;
					position: absolute;
					left: .6rem;
					top: .4rem;
					width: .8rem;
					height: .8rem;
				}
				.article-line::after {
					content: "";
					border: 1px solid var(--primary);
					position: absolute;
					left: calc(1rem - 1px);
					top: 1.2rem;
					height: calc(100% - .8rem);
				}
				.article-line:last-child {
					padding-bottom: 0;
				}
				.article-line:last-child::after {
					/* display: none; */
					height: calc(100% - 1.6rem);
				}
				.article-line h5 {
					font-size: 1.15rem;
				}
				.article-line h6 {
					font-size: 1.05rem;
					font-weight: normal;
				}
			</style>
<?php if(strpos($rs['education_desc'], '¶')){ ?>
			<!-- section.card : Education -->
			<section class="card border-0 mb-5">
				<div class="card-header border">
					<h4 class="mb-0">Education</h4>
				</div>
				<div class="card-body pt-3 pb-0 px-0">
<?php foreach(explode('§', $rs['education_desc']) as $education_desc){ $edu = explode('¶', $education_desc); ?>
					<article class="article-line">
<?php if(isset($edu[2]) && $edu[2]>0){ ?>
						<span class="float-right text-right">
							<span class="font-weight-bold"><?= date('M Y', strtotime($edu[2])) ?> ~ <?= isset($edu[3]) && $edu[3]>0 ? date('M Y', strtotime($edu[3])) : '' ?></span>
							<br />
							<span class="font-weight-normal"><?= isset($edu[5]) && !empty($edu[5]) ? $edu[5] : '' ?></span>
						</span>
<?php } ?>
						<h6 class="font-weight-bold"><?= $edu[0] ?></h6>
						<h6 class="mb-0"><?= $edu[1] ?></h6>
<?php if(isset($edu[6]) && !empty($edu[6])){ ?>
						<p><?= $edu[6] ?></p>
<?php } ?>
						<div><?= nl2br($edu[4]) ?></div>
					</article>
<?php } ?>
				</div>
			</section>
			<!-- /section.card : Education -->

<?php } ?>
<?php if(strpos($rs['career_desc'], '¶')){ ?>
			<!-- section.card : Work Experience -->
			<section class="card border-0 mb-5">
				<div class="card-header border">
					<h4 class="mb-0">Work Experience</h4>
				</div>
				<div class="card-body pt-3 pb-0 px-0">
<?php foreach(explode('§', $rs['career_desc']) as $career_desc){ $career = explode('¶', $career_desc); ?>
					<article class="article-line">
<?php if(isset($career[2]) && $career[2]>0){ ?>
						<span class="float-right text-right">
							<span class="font-weight-bold"><?= date('M Y', strtotime($career[2])) ?> ~ <?= isset($career[3]) && $career[3]>0 ? date('M Y', strtotime($career[3])) : '' ?></span>
							<br />
							<span class="font-weight-normal"><?= isset($career[5]) && !empty($career[5]) && $career[5]!='Termination' ? $career[5] : '' ?></span>
						</span>
<?php } if(!isset($career[7]) || empty($career[7])){ ?>
						<h6 class="font-weight-bold"><?= $career[0] ?></h6>
<?php } ?>
						<h6 class="mb-0"><?= $career[1] ?></h6>
<?php if(isset($career[6]) && !empty($career[6])){ ?>
						<p><?= $career[6] ?></p>
<?php } ?>
						<div><?= nl2br($career[4]) ?></div>
					</article>
<?php } ?>
				</div>
			</section>
			<!-- /section.card : Work Experience -->

<?php } ?>
			<!-- section.card : Job Preferences -->
			<section class="card border-0 mb-5">
				<div class="card-header border">
					<h4 class="mb-0">Job Preferences</h4>
				</div>
				<div class="card-body pt-3 pb-0 px-0">
					<div class="row mb-n3">
<?php if(isset($rs['job_type']) && !empty($rs['job_type'])){ ?>
						<div class="col-12 col-sm mb-3">
							<div class="card h-100">
								<div class="card-body text-center p-3">
							<span class="font-weight-bold">Job Type</span>
							<hr class="w-75 my-2" />
							<p class="text-break mb-0"><?= $WP->printJobType($rs) ?></p>
								</div>
							</div>
						</div>
<?php } if(isset($rs['period']) && !empty($rs['period'])/* && strtotime($rs['period'])>strtotime('now')*/){ ?>
						<div class="col-12 col-sm mb-3">
							<div class="card h-100">
								<div class="card-body text-center p-3">
							<span class="font-weight-bold">Start Date</span>
							<hr class="w-75 my-2" />
							<p class="text-break mb-0"><?= $WP->printPeriod($rs) ?></p>
								</div>
							</div>
						</div>
<?php } if(isset($rs['desired_location_parent_name']) && !empty($rs['desired_location_parent_name']) || isset($rs['desired_location_country_name']) && !empty($rs['desired_location_country_name'])){ ?>
						<div class="col-12 col-sm mb-3">
							<div class="card h-100">
								<div class="card-body text-center p-3">
							<span class="font-weight-bold">Desired Job Location</span>
							<hr class="w-75 my-2" />
							<p class="text-break mb-0"><?= $WP->printLocation($rs, 'desired_') ?></p>
								</div>
							</div>
						</div>
<?php } ?>
					</div>
				</div>
				<div class="card-body pt-3 pb-0 px-0">
<?php if (isset($rs['job_category_parent_name']) && !empty($rs['job_category_parent_name'])) { ?>
					<article class="article-line">
						<span class="font-weight-bold">Industry</span>
						<p class="mb-0"><?= $WP->printJobCategory($rs) ?></p>
						<?php if(isset($rs['job_category_tag']) && !empty($rs['job_category_tag'])){ ?>
						<p class="mb-0">
						<?php foreach(explode(',', $rs['job_category_tag']) as $category_tag){ ?>
						<span class="border rounded-pill d-inline-block mr-2 px-2"><?= $category_tag ?></span>
						<?php } ?>
						</p>
						<?php } ?>
					</article>
<?php } if(isset($rs['salary']) && !empty($rs['salary']) || isset($rs['benefits']) && !empty($rs['benefits'])){ ?>
					<article class="article-line mb-n3">
						<span class="font-weight-bold">Salary &amp; Benefits</span>
<?php if(isset($rs['salary']) && !empty($rs['salary'])) { ?>
						<p class="text-break mb-3"><?= nl2br($rs['salary']) ?></p>
<?php } if(isset($rs['benefits']) && !empty($rs['benefits'])) { ?>
						<p class="text-break mb-3"><?= nl2br($rs['benefits']) ?></p>
<?php } ?>
					</article>
<?php } if(isset($rs['desired_location']) && !empty($rs['desired_location'])){ ?>
					<article class="article-line mb-n3">
						<span class="font-weight-bold">Desired Location</span>
						<p class="text-break mb-3">
<?php foreach(explode('|', $rs['desired_location']) as $desired_location){ ?>
							<span class="comma-after"><?= $desired_location ?></span>
<?php } ?>
						</p>
						<p class="text-break mb-3"><?= $rs['desired_location_desc'] ?></p>
					</article>
<?php } if(isset($rs['teaching_level']) && !empty($rs['teaching_level'])){ ?>
					<article class="article-line mb-n3">
						<span class="font-weight-bold">Teaching Level</span>
						<p class="text-break mb-3">
<?php
	$teaching_levels = array();
	for($i=0; $i<count($CONF['teaching_levels']); $i++){
		$teaching_levels[$i+1] = $CONF['teaching_levels'][$i];
	}
	foreach(explode(',', $rs['teaching_level']) as $teaching_level){
?>
							<span class="comma-after"><?= $teaching_levels[$teaching_level] ?></span>
<?php
	}
?>
						</p>
					</article>
<?php } if(isset($rs['housing']) && !empty($rs['housing']) || isset($rs['housing_category']) && !empty($rs['housing_category'])){ ?>
					<article class="article-line mb-n3">
						<span class="font-weight-bold">Housing</span>
<?php if(isset($rs['housing_category']) && !empty($rs['housing_category'])) {
	$housing_category = array();
	if (isset($rs['housing_category'])) {
		$housing_category = explode(',', $rs['housing_category']);
	}
?>
						<ul class="row mb-3">
<?php for($i=0; $i<count($CONF['housing_category']); $i++){ if(in_array($i+1, $housing_category)){ ?>
							<li class="col-lg-4"><?= $CONF['housing_category'][$i] ?></li>
<?php }} ?>
						</ul>
<?php } if(isset($rs['housing']) && !empty($rs['housing'])) { ?>
						<p class="text-break mb-3"><?= nl2br($rs['housing']) ?></p>
<?php } ?>
					</article>
<?php } ?>
				</div>
			</section>
			<!-- /section.card : Job Preferences -->

<?php if(strpos($rs['descs2'], '¶') !== false){ ?>
			<!-- section : General Information (Self FAQ) -->
			<section class="card mb-5">
				<div class="card-header">
					<h4 class="mb-0">General Information (Self FAQ)</h4>
				</div>
<?php foreach(explode('§', $rs['descs2']) as $i => $descs2){ ?>
				<div class="card-body border-top p-3">
					<h6><?= explode('¶', $descs2)[0] ?></h6>
					<p class="mb-0"><?= explode('¶', $descs2)[1] ?></p>
				</div>
<?php } ?>
			</section>
			<!-- /section : General Information (Self FAQ) -->

<?php } ?>
<?php if(isset($rs['photos']) && !empty($rs['photos']) || isset($rs['videos']) && !empty($rs['videos'])){ ?>
			<!-- section.card : Photos & Videos -->
			<section class="card border-0 mb-5">
				<div class="card-header border">
					<h4 class="mb-0">Photos &amp; Videos</h4>
				</div>
				<div class="card-body pt-3 pb-0 px-0">
<?php include_once 'pages/common/Detail/photos&videos.php'; ?>
				</div>
			</section>
			<!-- /section.card : Photos & Videos -->

<?php } ?>
<?php if(strpos($rs['descs'], '¶') !== false){ ?>
			<!-- section : Other Information -->
			<section class="card mb-5">
				<div class="card-header">
					<h4 class="mb-0">Other Information</h4>
				</div>
<?php foreach(explode('§', $rs['descs']) as $i => $descs){ ?>
				<div class="card-body border-top p-3">
					<h6><?= explode('¶', $descs)[0] ?></h6>
					<p class="mb-0"><?= nl2br(explode('¶', $descs)[1]) ?></p>
				</div>
<?php } ?>
			</section>
			<!-- /section : Other Information -->

<?php } ?>
<?php if(isset($rs['attachment']) && !empty($rs['attachment'])){ ?>
			<!-- section.card : Photos & Videos -->
			<section class="card border-0 mb-5">
				<div class="card-header border">
					<h4 class="mb-0">Attachments</h4>
				</div>
				<div class="card-body pt-3 pb-0 px-0"><?= $WP->printAttachments($rs); ?></div>
			</section>
			<!-- /section.card : Attachments -->

<?php } ?>
		</section>
		<!-- /section -->

		<!-- aside -->
		<aside class="col-lg-3">

<?php if(!isset($rs['contact_private']) || empty($rs['contact_private'])){ ?>
			<!-- article.card -->
			<article class="card mb-5">
				<div class="card-header">
					<h5 class="card-title text-center mb-0"><?= $rs['fullname'] ?></h5>
				</div>
				<div class="card-body p-3">
					<h6>Contact Information</h6>
<?php if(isset($rs['contact_phone1']) && !empty($rs['contact_phone1'])){ ?>
					<p class="mb-0"><img src="/assets/icons/contact/phone.png" alt="Primary Phone Number:" title="Primary Phone Number" width="16" height="16" /> <?= $rs['contact_phone1'] ?></p>
<?php } if(isset($rs['contact_phone2']) && !empty($rs['contact_phone2'])){ ?>
					<p class="mb-0"><img src="/assets/icons/contact/phone.png" alt="Secondary Phone Number:" title="Secondary Phone Number" width="16" height="16" /> <?= $rs['contact_phone2'] ?></p>
<?php } if(isset($rs['contact_email']) && !empty($rs['contact_email'])){ ?>
					<p class="mb-0"><img src="/assets/icons/contact/mail.png" alt="Email:" title="Email" width="16" height="16" /> <?= $rs['contact_email'] ?></p>
<?php } if(isset($rs['contact_messengers']) && !empty($rs['contact_messengers'])){ ?>
					<div class="mb-0 mt-1">
						<span>Messengers:</span>
<?php foreach(explode(',', $rs['contact_messengers']) as $contact_messenger){ $messenger = explode(';', $contact_messenger); ?>
						<p class="mb-0"><img src="/assets/icons/messengers/<?= strtolower($messenger[0]) ?>.png" alt="<?= $messenger[0] ?>:" title="<?= $messenger[0] ?>" width="16" height="16" /> <?= $messenger[1] ?></p>
<?php } ?>
					</div>
<?php } ?>
				</div>
			</article>
			<!-- /article.card -->
<?php }else if($_SESSION['EMPLOYER']){ ?>
			<!-- acticle.card -->
			<article class="card mb-5">
				<div class="card-body p-3">
					<h5 class="card-title">Send a Message</h5>
					<form class="needs-validation d-print-none" id="formMessage">
						<div class="form-group">
							<input type="text" class="form-control" name="title" placeholder="Title*" maxlength="255" required />
						</div>
						<div class="form-group">
							<textarea class="form-control" name="content" rows="5" placeholder="Message*" required></textarea>
						</div>
						<div class="form-group mb-0">
							<input type="hidden" name="main" value="work" />
							<input type="hidden" name="table" value="work_resume" />
							<input type="hidden" name="pk" value="<?= $rs['no'] ?>" />
							<button type="submit" class="btn btn-primary" name="action" value="Message">Send Message</button>
						</div>
						<script defer>
							$('#formMessage').on('submit', function() {
								$.ajax({ type : 'post', url : '/actions/Message', data : 'action=Message&' + $(this).serialize(), success : function(result) {
									location.reload();
								} }); return false;
							});
						</script>
					</form>
				</div>
			</article>
			<!-- /acticle.card -->
<?php } if(isset($rs['contact_urls']) && !empty($rs['contact_urls'])){ ?>
					<div class="mb-0 mt-1">
						<span>URL(s):</span>
<?php
	foreach (explode(',', $rs['contact_urls']) as $url) {
		$url_type = explode(';', $url)[0];
		$url_href = explode(';', $url)[1];
?>
						<a class="text-dark" href="<?= $url_href ?>" target="_blank"><img src="/assets/icons/urls/<?= strtolower($url_type) ?>.png" alt="<?= $url_type ?>:" title="<?= $url_type ?>" width="20" height="20" /></a>
<?php } ?>
					</div>
<?php } ?>

		</aside>
		<!-- /aside -->

			</div>
		</section>
		<!-- /section -->

			</div>
		</div>
	</main>
	<!-- /main -->

<?php include_once 'pages/3000_Work/3200_Work_Detail_warning.php'; ?>

<?php

if ($USER['work_credit_res_day']) {
	include_once 'pages/modal/SaveResume.php';
	if (isset($rs['contact_private']) && !empty($rs['contact_private'])) {
		$modalFormMessage = array(
			'name' => $rs['fullname'],
			'table' => $application['no']?'work_job_application':'work_resume',
			'pk' => $application['no']?$application['no']:$rs['no']
		);
		include_once 'pages/modal/Message.php';
	}
}

?>