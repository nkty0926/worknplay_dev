<?php

if (empty($_GET['PK']) || empty($rs = $DB->selectWorkJob($_GET['PK'])) || empty($rs['work_company'])) {
	echo '<script>location.replace("/Work");</script>';
	exit();
} else {
	$company = $DB->selectWorkCompany($rs['work_company']);
	$saved = $DB->selectSave('work_job', $rs['no']);
	$applied = $_SESSION['ID'] ? count($DB->selectWorkJobApplication(null, $rs['no'], $_SESSION['ID'])) : 0;
}

include_once 'pages/3000_Work/3000_Work_header.php';

?>
	<style>.navbar.sticky-top{position:relative;}</style>

	<!-- nav.navbar -->
	<nav class="navbar navbar-expand navbar-light bg-light border-bottom fixed-top py-0 shadow fade">
		<div class="container py-2 px-lg-3">
			<h3 class="navbar-brand mw-100 mb-0"><span class="line-clamp-1"><?= $rs['title'] ?></span><small class="line-clamp-1"><?= $company['name'] ?></small></h3>
			<ul class="navbar-nav ml-auto flex-column flex-lg-row text-right">
<?php if($_SESSION['ID'] && $_SESSION['ID']==$rs['member']){ ?>
				<li class="nav-item">
					<a class="nav-link d-print-none d-preview-none d-none d-lg-inline-block" href="/Work/Edit/Job/<?= $rs['no'] ?>">Edit</a>
				</li>
<?php } ?>
<?php if(isset($rs['appl_type']) && !empty($rs['appl_type'])){ ?>
				<li class="nav-item">
					<a class="nav-link" href="<?= $rs['appl_text'] ?>" target="_blank">Visit Website</a>
				</li>
				<span class="text-black-50 py-2 d-none d-lg-block">|</span>
<?php }else if($_SESSION['SEEKER']){ ?>
				<li class="nav-item">
					<a class="nav-link<?= $applied?' disabled':'' ?>" data-toggle="modal" data-target="#modalFormApplyJobWithResume"><?= $applied?'Applied Job':'Apply Now' ?></a>
				</li>
				<span class="text-black-50 py-2 d-none d-lg-block">|</span>
<?php }else if(!$_SESSION['EMPLOYER']){ ?>
				<li class="nav-item">
					<a class="nav-link" href="javascript:void(0);"
						onclick="Confirm(this.dataset.msg, function(){ window.open('/Work/Seeker'); });"
						data-msg="This feature requires a resume.&lt;br/&gt;Click &quot;Yes&quot; to create a resume."
					>Apply Now</a>
				</li>
				<span class="text-black-50 py-2 d-none d-lg-block">|</span>
				<li class="nav-item">
					<a class="nav-link" data-toggle="modal" data-target="#modalFormApplyJobWithFile">Apply without Registration</a>
				</li>
				<span class="text-black-50 py-2 d-none d-lg-block">|</span>
<?php } ?>
				<li class="nav-item">
<?php if($_SESSION['SEEKER']){ ?>
					<a class="nav-link save<?= $saved?' active':'' ?>" data-toggle="action" data-action="Save" data-table="work_job" data-pk="<?= $rs['no'] ?>"></a>
<?php }else if(!$_SESSION['EMPLOYER']){ ?>
					<a class="nav-link save"
						onclick="Confirm(this.dataset.msg, function(){ window.open('/Work/Seeker'); });"
						data-msg="This feature requires a resume.&lt;br/&gt;Click &quot;Yes&quot; to create a resume."
					></a>
<?php } ?>
				</li>
			</ul>
		</div>
	</nav>
	<!-- /nav.navbar -->

	<!-- main -->
	<main class="py-3 py-lg-5 bg-light">
		<div class="container">
			<div class="row">

		<!-- section -->
		<section class="col-lg-9">

			<!-- .card -->
			<div class="card">

				<!-- .card-header -->
				<div class="card-header p-3 p-lg-4">
					<h3 class="card-title font-weight-normal" style="color:var(--primary-dark)"><?= $rs['title'] ?></h3>
					<p class="mb-1 mb-lg-n3"><a class="text-dark" href="#companyProfile"><span class="font-weight-bold d-none d-lg-inline">Company Name:</span> <?= $company['name'] ?></a></p>
<?php if(isset($rs['employer_type']) && !empty($rs['employer_type'])){ ?>
					<p class="mb-1 mb-lg-n3 mt-lg-3"><span class="font-weight-bold d-none d-lg-inline">Employer Type:</span> <?= $rs['employer_type'] ?></p>
<?php } ?>
					<span class="text-muted d-lg-none"><?= substr($rs['date'], 0, 10)==substr($rs['mod'], 0, 10)?'Date Posted':'Last Modified' ?> : <time><?= date($CONF['date_format'], strtotime($rs['mod'])) ?></time></span>
					<div class="float-lg-right d-print-none mt-3 mt-lg-n3">
						<div class="sharethis-inline-share-buttons d-inline mr-n1"></div>
						<a class="btn btn-light btn-sm mr-1 rounded-sm" data-toggle="modal" href="#modalFormQuestion"><i class="far fa-flag"></i></a>
						<a class="btn btn-light btn-sm mr-1 rounded-sm d-print-none d-preview-none d-none d-lg-inline-block" data-toggle="print" href="javascript:void(0);">Print</a>
<?php if($_SESSION['ID'] && $rs['member']==$_SESSION['ID']){ ?>
						<a class="btn btn-light btn-sm mr-1 rounded-sm d-print-none d-preview-none d-none d-lg-inline-block" href="/Work/Edit/Job/<?= $rs['no'] ?>">Edit</a>
<?php } ?>
					</div>
				</div>
				<!-- /.card-header -->

				<!-- .card-body -->
				<div class="card-body p-3 p-lg-4">

					<span class="text-muted float-right d-none d-lg-inline"><?= substr($rs['date'], 0, 10)==substr($rs['mod'], 0, 10)?'Date Posted':'Last Modified' ?> : <time><?= date($CONF['date_format'], strtotime($rs['mod'])) ?></time></span>
					<h4 class="border-bottom pb-2 mb-3">Job Details</h4>

					<!-- .row -->
					<div class="row mb-n1">
<?php if(false && isset($company['job_industry']) && !empty($company['job_industry'])){ ?>
						<div class="col-sm-4 col-lg-3 font-weight-bold">Industry</div>
						<div class="col-sm-8 col-lg-9 mb-1"><?php foreach(explode(',', $company['job_industry']) as $industry){ ?><span class="comma-after"><?= $industry ?></span><?php } ?></div>
<?php } if(isset($rs['job_type']) || true){ ?>
						<div class="col-sm-4 col-lg-3 font-weight-bold">Job Type</div>
						<div class="col-sm-8 col-lg-9 mb-1"><?= $WP->printJobType($rs) ?></div>
<?php } if(isset($rs['job_category_parent_name']) && !empty($rs['job_category_parent_name'])){ ?>
						<div class="col-sm-4 col-lg-3 font-weight-bold">Industry</div>
						<div class="col-sm-8 col-lg-9 mb-1"><?= $WP->printJobCategory($rs) ?><?php if(isset($rs['job_category_tag']) && !empty($rs['job_category_tag'])){ ?><br /><?php foreach(explode(',', $rs['job_category_tag']) as $category_tag){ ?><span class="comma-after"><?= $category_tag ?></span><?php }} ?></div>
<?php } if(isset($rs['teaching_level']) && !empty($rs['teaching_level'])){ ?>
						<div class="col-sm-4 col-lg-3 font-weight-bold">Teaching Level</div>
						<div class="col-sm-8 col-lg-9 mb-1">
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
						</div>
<?php } if(isset($rs['education_level']) && !empty($rs['education_level'])){ ?>
						<div class="col-sm-4 col-lg-3 font-weight-bold">Education Level</div>
						<div class="col-sm-8 col-lg-9 mb-1"><?= $CONF['education_levels'][$rs['education_level']-1] ?></div>
<?php } if(isset($rs['career_level']) && !empty($rs['career_level'])){ ?>
						<div class="col-sm-4 col-lg-3 font-weight-bold">Career Level</div>
						<div class="col-sm-8 col-lg-9 mb-1"><?= $CONF['career_levels'][$rs['career_level']-1] ?></div>
<?php } if(isset($rs['visa_type']) && !empty($rs['visa_type'])){ ?>
						<div class="col-sm-4 col-lg-3 font-weight-bold">Visa Sponsorship</div>
						<div class="col-sm-8 col-lg-9 mb-1"><?= $rs['visa_type'] ?></div>
<?php } if(isset($rs['period']) && !empty($rs['period'])){ ?>
						<div class="col-sm-4 col-lg-3 font-weight-bold">Start Date</div>
						<div class="col-sm-8 col-lg-9 mb-1">
							<span><?= strlen($rs['period'])>1?date($CONF['date_format'], strtotime(explode(' ~ ', $rs['period'])[0])):($rs['period']==2?'ASAP':($rs['period']==3?'Open Until Filled':'')) ?></span>
<?php if(isset(explode(' ~ ', $rs['period'])[1]) && !empty(isset(explode(' ~ ', $rs['period'])[1]))){ ?>
							<span>(Deadline <?= date($CONF['date_format'], strtotime(explode(' ~ ', $rs['period'])[1])) ?>)</span>
<?php } ?>
						</div>
<?php } if(isset($rs['language_eng']) && !empty($rs['language_eng'])){ ?>
						<div class="col-sm-4 col-lg-3 mb-1 font-weight-bold d-lg-none">English</div>
						<div class="col-sm-8 col-lg-9 mb-1 d-lg-none"><?= $CONF['language_levels'][$rs['language_eng']-1] ?></div>
<?php } if(isset($rs['language_kor']) && !empty($rs['language_kor'])){ ?>
						<div class="col-sm-4 col-lg-3 mb-1 font-weight-bold d-lg-none">Korean</div>
						<div class="col-sm-8 col-lg-9 mb-1 d-lg-none"><?= $CONF['language_levels'][$rs['language_kor']-1] ?></div>
<?php } if(isset($rs['language_others']) && !empty($rs['language_others'])){ foreach(explode(',', $rs['language_others']) as $language_others){ ?>
						<div class="col-sm-4 col-lg-3 mb-1 font-weight-bold d-lg-none"><?= explode(';', $language_others)[0] ?></div>
						<div class="col-sm-8 col-lg-9 mb-1 d-lg-none"><?= $CONF['language_levels'][explode(';', $language_others)[1]-1] ?></div>
<?php }} if(isset($rs['language_eng']) && !empty($rs['language_eng'])){ ?>
						<div class="col-sm-4 col-lg-3 mb-1 font-weight-bold d-none d-lg-block">Language</div>
						<div class="col-sm-8 col-lg-9 mb-1 d-none d-lg-block">
							<span>English: <?= $CONF['language_levels'][$rs['language_eng']-1] ?></span>
<?php if(isset($rs['language_kor']) && !empty($rs['language_kor'])){ ?>
							<span> / Korean: <?= $CONF['language_levels'][$rs['language_kor']-1] ?></span>
<?php } if(isset($rs['language_others']) && !empty($rs['language_others'])){ foreach(explode(',', $rs['language_others']) as $language_others){ ?>
							<span> / <?= explode(';', $language_others)[0] ?>: <?= $CONF['language_levels'][explode(';', $language_others)[1]-1] ?></span>
<?php }} ?>
						</div>
<?php } if(isset($rs['location_parent_name']) && !empty($rs['location_parent_name']) || isset($rs['location_country_name']) && !empty($rs['location_country_name'])){ ?>
						<div class="col-sm-4 col-lg-3 font-weight-bold">Location</div>
						<div class="col-sm-8 col-lg-9 mb-1"><?= $WP->printLocation($rs) ?></div>
<?php } ?>
					</div>
					<!-- /.row -->

					<!-- .row -->
					<div class="row mt-3">
						<div class="col-12">
<?php if(isset($rs['appl_type']) && !empty($rs['appl_type'])){ ?>
							<a class="btn btn-primary d-block d-lg-inline-block mb-2 mb-lg-0" href="<?= $rs['appl_text'] ?>" target="_blank">Visit Website</a>
<?php }else if($_SESSION['SEEKER']){ ?>
							<button type="button" class="btn btn-primary d-block d-lg-inline-block mb-2 mb-lg-0<?= $applied?' disabled':'' ?>" data-toggle="modal" data-target="#modalFormApplyJobWithResume"><?= $applied?'Applied Job':'Apply Now' ?></button>
<?php }else if(!$_SESSION['EMPLOYER']){ ?>
							<button type="button" class="btn btn-primary d-block d-lg-inline-block mb-2 mb-lg-0"
								onclick="Confirm(this.dataset.msg, function(){ window.open('/Work/Seeker'); });"
								data-msg="This feature requires a resume.&lt;br/&gt;Click &quot;Yes&quot; to create a resume."
							>Apply Now</button>
							<button type="button" class="btn btn-primary d-block d-lg-inline-block mb-2 mb-lg-0" data-toggle="modal" data-target="#modalFormApplyJobWithFile">Apply without Registration</button>
<?php } if($_SESSION['SEEKER']){ ?>
							<button type="button" class="btn btn-primary save<?= $saved?' active':'' ?>" data-toggle="action" data-action="Save" data-table="work_job" data-pk="<?= $rs['no'] ?>"></button>
<?php }else if(!$_SESSION['EMPLOYER']){ ?>
							<button type="button" class="btn btn-primary"
								onclick="Confirm(this.dataset.msg, function(){ window.open('/Work/Seeker'); });"
								data-msg="This feature requires a resume.&lt;br/&gt;Click &quot;Yes&quot; to create a resume."
							>Save</button>
<?php } ?>
					<hr />
						</div>
					</div>
					<!-- /.row -->
<?php if(isset($rs['desc']) && !empty($rs['desc'])){ ?>

					<!-- .row -->
					<div class="row mb-4">
						<div class="col-12">
							<h4>Job Description</h4>
							<div class="cke_published"><?= $rs['desc'] ?></div>
						</div>
					</div>
					<!-- /.row -->
<?php } //description ?>
<?php if(isset($rs['keyword2']) && !empty($rs['keyword2'])){ ?>

					<!-- .row -->
					<div class="row mb-4">
						<div class="col-12">
							<h4>Specialized Requirements for Candidates</h4>
							<p class="mb-0"><?= nl2br($rs['keyword2']) ?></p>
						</div>
					</div>
					<!-- /.row -->
<?php } //keyword2 ?>
<?php if(isset($rs['salary']) && !empty($rs['salary']) || isset($rs['benefits']) && !empty($rs['benefits'])){ ?>

					<!-- .row -->
					<div class="row mb-4">
						<div class="col-12 mb-n3">
							<h4>Salary &amp; Benefits</h4>
<?php if(isset($rs['salary']) && !empty($rs['salary'])) { ?>
							<p class="mb-3"><?= nl2br($rs['salary']) ?></p>
<?php } if(isset($rs['benefits']) && !empty($rs['benefits'])) { ?>
							<p class="mb-3"><?= nl2br($rs['benefits']) ?></p>
<?php } ?>
						</div>
					</div>
					<!-- /.row -->
<?php } //salary ?>
<?php if(isset($rs['appl_questions']) && !empty($rs['appl_questions'])){ ?>

					<!-- .row -->
					<div class="row mb-4">
						<div class="col-12">
							<h5>Questions</h5>
							<p>고용주가 등록한 사전 질문이 있습니다.</p>
							<div class="card">
								<div class="card-body">
							<ol class="mb-0 pl-3">
<?php foreach(explode('|', $rs['appl_questions']) as $i => $appl_question){ ?>
								<li><?= $appl_question ?></li>
<?php } ?>
							</ol>
								</div>
							</div>
						</div>
					</div>
					<!-- /.row -->
<?php } // appl_questions ?>
<?php if(isset($rs['housing']) && !empty($rs['housing']) || isset($rs['housing_category']) && !empty($rs['housing_category'])){ ?>

					<!-- .row -->
					<div class="row mb-4">
						<div class="col-12 mb-n3">
							<h4>Housing</h4>
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
							<p class="mb-3"><?= nl2br($rs['housing']) ?></p>
<?php } ?>
						</div>
					</div>
					<!-- /.row -->
<?php } //housing ?>
<?php if(isset($rs['addr']) && !empty($rs['addr'])){ ?>
					<!-- .row -->
					<div class="row mb-4">
						<div class="col-12">
							<h4>Location</h4>
							<div class="mb-n2">
<?php include_once 'pages/common/Detail/address.php'; ?>
							</div>
						</div>
					</div>
					<!-- /.row -->
<?php } //addr ?>
<?php if(isset($rs['attachment']) && !empty($rs['attachment'])){ ?>
					<!-- .row -->
					<div class="row mb-4">
						<div class="col-12">
							<h4>Attachments</h4>
							<div><?= $WP->printAttachmentsAsCard($rs); ?></div>
						</div>
					</div>
					<!-- /.row -->
<?php } //attachment ?>
					<!-- .row -->
					<div class="mx-n3 mx-lg-n4 d-none d-lg-block bg-light">
						<div class="px-3 px-lg-4">
					<div class="row my-4 py-4">
						<div class="col-12">
<?php if(!$company['contact_private']){ ?>
							<h4>Contact Information</h4>
<?php if(isset($company['contact_phone1']) && !empty($company['contact_phone1'])){ ?>
							<p class="mb-0">Primary Phone Number: <?= $company['contact_phone1'] ?></p>
<?php } if(isset($company['contact_phone2']) && !empty($company['contact_phone2'])){ ?>
							<p class="mb-0">Secondary Phone Number: <?= $company['contact_phone2'] ?></p>
<?php } if(isset($company['contact_email']) && !empty($company['contact_email'])){ ?>
							<p class="mb-0">Email: <?= $company['contact_email'] ?></p>
<?php } if(isset($company['contact_person']) && !empty($company['contact_person'])){ ?>
							<p class="mb-0">Contact Person: <?= $company['contact_person'] ?></p>
<?php }}else if($_SESSION['ID'] && $company['contact_private']){ ?>
							<h4>Send Message to Company</h4>
							<p>If you have questions to company, please send me a message</p>
							<p class="mb-0 d-print-none"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalFormMessage">Send Message</button></p>
<?php }else{ ?>
							<h4>Send Message to Company</h4>
							<p>If you have questions to company, please send me a message</p>
							<p class="mb-0 d-print-none"><button type="button" class="btn btn-primary" onclick="Confirm('Please Log In', function(){ location.href = '/LogIn'; });">Send Message</button></p>
<?php } if(isset($company['contact_messengers']) && !empty($company['contact_messengers'])){ ?>
							<div class="mb-0">
								<span>Messengers:</span>
<?php foreach(explode(',', $company['contact_messengers']) as $contact_messenger){ $messenger = explode(';', $contact_messenger); ?>
								<p class="mb-0"><?= $messenger[0] ?> : <?= $messenger[1] ?></p>
<?php } ?>
							</div>
<?php } ?>
						</div>
					</div>
						</div>
					</div>
					<!-- /.row -->

					<!-- .row -->
					<div class="row" id="companyProfile">
						<div class="col-12">
							<h4><?= $company['name'] ?></h4>
							<p><?= substr($WP->stringFilter($company['desc']), 0, 270) ?>...</p>
							<a class="d-block mt-n3 mb-3" href="/Work/<?= $company['domain']?$company['domain']:'Detail/Company/' . $company['no'] ?>" target="_blank">See more</a>
							<div class="form-row">
<?php if(isset($company['logo_img']) && !empty($company['logo_img'])){ ?>
								<div class="col-5 col-sm-3 col-lg-2">
									<img class="img-fluid" src="<?= $company['logo_img'] ?>" alt="<?= $company['name'] ?>" title="<?= $company['name'] ?>" onerror="this.src='/assets/images/common-noimage.png'" />
								</div>
<?php } ?>
								<div class="col-12 col-sm">
									<div class="row mb-n1">
<?php if(isset($company['type_name']) && !empty($company['type_name'])){ ?>
										<div class="col-sm-4 col-lg-3 font-weight-bold">Company Type</div>
										<div class="col-sm-8 col-lg-9 mb-1"><?= $company['type_name'] ?></div>
<?php } if(false && $company['job_industry']){ ?>
										<div class="col-sm-4 col-lg-3 font-weight-bold">Industry</div>
										<div class="col-sm-8 col-lg-9 mb-1"><?php foreach(explode(',', $company['job_industry']) as $industry){ ?><span class="text-dark comma-after" href="/Work/Search/Job?job_industry%5B%5D=<?= urlencode($industry) ?>"><?= $industry ?></span><?php } ?></div>
<?php } if(isset($company['keyword2']) && !empty($company['keyword2'])){ ?>
										<div class="col-sm-4 col-lg-3 font-weight-bold">Business Area</div>
										<div class="col-sm-8 col-lg-9 mb-1"><?= str_replace(';', ', ', $company['keyword2']) ?></div>
<?php } if(isset($company['establishment']) && !empty($company['establishment'])){ ?>
										<div class="col-sm-4 col-lg-3 font-weight-bold">Founded</div>
										<div class="col-sm-8 col-lg-9 mb-1"><?= $company['establishment'] ?></div>
<?php } if(isset($company['employees']) && !empty($company['employees'])){ ?>
										<div class="col-sm-4 col-lg-3 font-weight-bold">Employees</div>
										<div class="col-sm-8 col-lg-9 mb-1"><?= $company['employees'] ?></div>
<?php } if(false && (isset($company['location_parent_name']) && !empty($company['location_parent_name']) || isset($company['location_country_name']) && !empty($company['location_country_name']))){ ?>
										<div class="col-sm-4 col-lg-3 font-weight-bold">Location</div>
										<div class="col-sm-8 col-lg-9 mb-1"><?= $WP->printLocation($company) ?></div>
<?php } if(isset($company['contact_urls']) && !empty($company['contact_urls'])){ ?>
										<div class="col-sm-4 col-lg-3 font-weight-bold">URL(s)</div>
										<div class="col-sm-8 col-lg-9 mb-1"><?= $WP->printUrls($company); ?></div>
<?php } ?>
										<div class="col-12"><a class="btn btn-outline-primary font-weight-bold d-print-none" href="/Work/<?= $company['domain']?$company['domain']:'Detail/Company/' . $company['no'] ?>">Company Profile</a></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /.row -->

				</div>
				<!-- /.card-body -->

			</div>
			<!-- /.card -->

		</section>
		<!-- /section -->

		<!-- aside -->
		<aside class="col-lg-3">

<?php include 'pages/3000_Work/3000_Work_aside_hot.php'; ?>

		</aside>
		<!-- /aside -->

			</div>
		</div>
	</main>
	<!-- /main -->

<?php include_once 'pages/3000_Work/3200_Work_Detail_warning.php'; ?>

<?php

include_once 'pages/modal/Question.php';

if ($_SESSION['ID'] && $company['contact_private']) {
	$modalFormMessage = array(
		'name' => $rs['company_name'],
		'table' => 'work_company',
		'pk' => $rs['work_company']
	);
	include_once 'pages/modal/Message.php';
}

if ($_SESSION['ID'] && $_SESSION['SEEKER'] && !$rs['appl_type'] && !$applied) {
	$resumes = $DB->selectWorkResume(null, $_SESSION['ID']);
	foreach ($resumes as $i => $resume) {
		if (empty($resume['title'])) {
			unset($resumes[$i]);
		}
	}
	include_once 'pages/modal/ApplyJobWithResume.php';
}

if (!$_SESSION['EMPLOYER']) {
	include_once 'pages/modal/ApplyJobWithFile.php';
}

?>