<?php

if ($_POST) {
	if ($_POST['pk'] && $DB->selectWorkJob($_POST['pk'])['member'] != $_SESSION['ID']) {
		blockMember();
	}
	if ($_POST['pk']) {
		$_POST['hot'] = $DB->selectWorkJob($_POST['pk'])['hot'];
	}
	$columns = array(
		'publ',
		'hot',
		'work_company',
		'title',
		'job_type',
		'employer_type',
		'visa_type',
		'job_category_parent',
		'job_category_child',
		'job_category_tag',
		'location_country',
		'location_parent',
		'location_child',
		'location_tag',
		'location_city',
		'addr',
		'addr2',
		'addr_desc',
		'addr_lat',
		'addr_lng',
		'language_kor',
		'language_eng',
		'language_others',
		'teaching_level',
		'period',
		'hashtag',
		'keyword',
		'keyword2',
		'salary',
		'benefits',
		'housing',
		'housing_category',
		'desc',
		'education_level',
		'career_level',
		'appl_type',
		'appl_text',
		'appl_questions',
		'appl_cover_letter',
		'attachment'
	);
	$values = array(
		':no' => $_POST['pk'],
		':publ' => $_POST['publ'] ? 1 : 0,
		':hot' => $_POST['hot'] ? 1 : 0,
		':work_company' => $_POST['fk'],
		':title' => htmlspecialchars(trim($_POST['title'])),
		':job_type' => join(',', $_POST['job_type']),
		':employer_type' => $_POST['employer_type'],
		':visa_type' => $_POST['visa_type'],
		':job_category_parent' => $_POST['job_category_parent']?$_POST['job_category_parent']:null,
		':job_category_child' => $_POST['job_category_child']?$_POST['job_category_child']:null,
		':job_category_tag' => join(',', $_POST['job_category_tag']),
		':location_country' => $_POST['location_country'],
		':location_parent' => $_POST['location_parent']?$_POST['location_parent']:null,
		':location_child' => $_POST['location_child']?$_POST['location_child']:null,
		':location_tag' => $_POST['location_tag'],
		':location_city' => $_POST['location_city'],
		':addr' => $_POST['addr'],
		':addr2' => $_POST['addr2'],
		':addr_desc' => $_POST['addr_desc'],
		':addr_lat' => $_POST['addr_lat'],
		':addr_lng' => $_POST['addr_lng'],
		':language_kor' => $_POST['language_kor'],
		':language_eng' => $_POST['language_eng'],
		':language_others' => $_POST['language_others'],
		':teaching_level' => join(',', $_POST['teaching_level']),
		':period' => $_POST['period_type'] == 1 ? ($_POST['period_end'] ? $_POST['period_start'] . ' ~ ' . $_POST['period_end'] : $_POST['period_start']) : $_POST['period_type'],
		':hashtag' => $_POST['hashtag'],
		':keyword' => $_POST['keyword'],
		':keyword2' => $_POST['keyword2'],
		':salary' => $_POST['salary'],
		':benefits' => $_POST['benefits'],
		':housing' => $_POST['housing'],
		':housing_category' => join(',', $_POST['housing_category']),
		':desc' => $_POST['desc'],
		':education_level' => $_POST['education_level'],
		':career_level' => $_POST['career_level'],
		':appl_type' => $_POST['appl_type'],
		':appl_text' => $_POST['appl_type'] ? $_POST['appl_url'] : $_POST['appl_email'],
		':appl_questions' => join('|', $_POST['appl_questions']),
		':appl_cover_letter' => $_POST['appl_cover_letter'],
		':attachment' => join('|', $_POST['attachment'])
	);
	$publ = 0;
	if (!empty($values[':no'])) {
		$rs = $DB->selectWorkJob($values[':no']);
		$publ = $rs['publ'];
	}
	if ($values[':publ'] && !$publ) {
		try {
			if ($values[':hot'])
				$query = "select no from work_credit where date > '2015-03-22 00:00:00' and used is null and appr = 1 and product = 1 and member = :member order by date asc limit 1";
			else
				$query = "select no from work_credit where date > '2015-03-22 00:00:00' and appr = 1 and product = 2 and member = :member and credit > ((select count(*) from work_job where work_credit = work_credit.no) + (select count(*) from work_credit_job where work_credit = work_credit.no)) order by date asc limit 1";
			$stmt = $DB->conn->prepare($query);
			$stmt->bindParam(":member", $_SESSION['ID']);
			$stmt->execute();
			$values[':work_credit'] = $stmt->fetchColumn();
			$stmt->closeCursor();
			if (empty($values[':work_credit'])) {
				if ($_SESSION['RECRUITER']) {
					unset($values[':work_credit']);
				} else {
					echo '<script>alert("Failed");history.back();</script>';
					exit();
				}
			} else {
				$DB->updateWorkCreditUsed($values[':work_credit'], $_SESSION['ID'], $values[':hot'] ? '1' : '2');
				array_push($columns, 'work_credit');
			}
		} catch (PDOException $e) {
			$WP->printStatus($e->getMessage());
			echo '<script>alert("Failed");history.back();</script>';
			exit();
		}
	}
	if ($_POST['pk'] = $DB->edit('work_job', $columns, $values)) {
		if ($_POST['submit_type'] == 'save') {
			echo $_POST['pk'];
		} else if ($_POST['submit_type'] == 'preview') {
			echo '<script>location.replace("/Work/Detail/Job/' . $_POST['pk'] . '#preview");</script>';
		} else {
			// post on facebook
			// $PK = $_POST['pk'];
			// echo '<script>window.open("https://www.facebook.com/sharer.php?u=https://www.worknplay.co.kr/Work/Detail/Job/' . $PK . '", "window_share", "width=640, height=480");</script>';
			// echo '<script src="/lib/Facebook.js"></script>\n';
			// echo '<script>
			// FB.api(
			// "/feed", "POST", {
			// //"message":"Hello%20World!",
			// "link":"https://www.worknplay.co.kr/Work/Detail/Job/' . $PK . '",
			// "id":"224295701605643",
			// "access_token":"EAADPcZBjVVM0BAHsuE12QDAtMfx5AvKDZBY6qbFBweSxOKgoY2DrjRCkphWeZAbBHTYURr3XwBbY4lUAhrZARTon4GZC8XEMPkooJ8zrhRX7GqGFooJxshpzE6GcsglPtJitCZCwgjoJoTOibiR2CPvwZBlzDanaxCjereVtAcb6dnuZA2VStz1YEHq6UWIsuZBBLQD8mVFjmCQZDZD"
			// },
			// function(response) { console.log(response); }
			// );
			// </script>';
			echo '<script>location.replace("/Work/Detail/Job/' . $_POST['pk'] . '");</script>';
		}
	} else
		echo '<script>alert("Failed");history.back();</script>';
	exit();
}

if ($_GET['PK'] && $_GET['PK'] != '_NEW') {
	$rs = $DB->selectWorkJob($_GET['PK']);
	if ($rs['member'] != $_SESSION['ID']) {
		echo '<script>location.replace("/Work/Employer");</script>';
		exit();
	} else {
		$company = $DB->selectWorkCompany($rs['work_company']);
	}
} else if (($_GET['hot'] && !$USER['work_credit_hot']) || (!$_GET['hot'] && !$USER['work_credit_job'])) {
	echo '<script>location.replace("/Work/Employer");</script>';
	exit();
} else if (!$_SESSION['CURRENT_COMPANY'] || !$DB->selectWorkCompany($_SESSION['CURRENT_COMPANY'])['publ']) {
	echo '<script>location.replace("/Work/Edit/Company/' . ($_SESSION['CURRENT_COMPANY'] ? $_SESSION['CURRENT_COMPANY'] : '_NEW') . '?next=_NEW' . ($_GET['hot'] ? '&hot=1' : '') . '");</script>';
	exit();
} else {
	$company = $DB->selectWorkCompany($_SESSION['CURRENT_COMPANY']);
}
$jobs = $DB->selectWorkJob(null, null, $_SESSION['ID']);
$firstTime = !isset($jobs) || empty($jobs) || !isset(array_reverse($jobs)[0]['publ']) || empty(array_reverse($jobs)[0]['publ']);
$_SESSION['work_company_next_hot'] = $_GET['hot'];

include_once 'pages/3000_Work/3000_Work_header.php';

?>
	<!-- form : Form-Job -->
	<form data-beforeunload="true" action="" method="post" class="needs-validation" id="Form-Job" name="work_job">

<?php $form_header_title = "Post a Job"; include_once 'pages/common/header-Edit.php'; ?>

		<div class="container">
			<div class="row">

		<!-- aside -->
		<aside class="col-lg-3">

			<!-- article.card -->
			<article class="card sticky-top mb-5" style="margin-top:1.5rem;top:5rem;z-index:999;">
				<div class="card-body text-center">
					<figure class="mb-0">
						<img class="img-fluid" src="<?= $company['logo_img'] ?>" alt="<?= $company['name'] ?>" title="<?= $company['name'] ?>" onerror="this.src='/assets/images/common-noimage.png'" style="width:10rem;" />
						<hr />
						<h4><?= $company['name'] ?></h4>
					</figure>
<?php if($firstTime){ ?>
					<a class="btn btn-primary" href="/Work/Edit/Company/<?= $_SESSION['CURRENT_COMPANY'] ?>?next=<?= $rs['no']?$rs['no']:'_NEW' ?><?= $rs['hot'] || $_GET['hot']?'&hot=1':'' ?>">Edit</a>
<?php } ?>
				</div>
			</article>
			<!-- /article.card -->

		</aside>
		<!-- /aside -->

		<!-- section -->
		<section class="col-lg-9">

			<h2 class="form-heading<?= $firstTime?' form-heading-2':'' ?>">Post a Job</h2>
			<p class="text-muted">Provide a detailed job description to help job seekers know what to expect and streamline the hiring process.</p>

			<!-- fieldset : Title -->
			<fieldset class="mb-5" id="fieldset-title">
				<legend class="required">Job Title<a class="far fa-question-circle text-decoration-none text-muted text-dark float-right my-1" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Highlight what makes your job stand out from others in your Job Title."></a></legend>
				<div class="form-group mb-0">
					<input type="text" class="form-control form-control-lg" name="title" value="<?= $rs['title'] ?>" placeholder="Job Title" maxlength="255" data-type="name" required />
					<p class="form-text text-muted mb-0">You cannot insert special symbols.</p>
				</div>
				<script defer>
					$('input[name="title"]').on('change blur keyup', function() {
						$(this).removeClass('is-invalid').next('.invalid-feedback').remove();
						var pattern = new RegExp('^([0-9|A-Z|a-z|ㄱ-ㅎ|ㅏ-ㅣ|가-힣])(.*)$');
						if ($(this).val() != '' && !pattern.test($(this).val())) {
							$(this).customInputFeedback();
						} else {
							var pattern2 = new RegExp('[0-9|A-Z|a-z|ㄱ-ㅎ|ㅏ-ㅣ|가-힣]');
							for (var i = 0; i < $(this).val().length; i++) {
								if (!pattern2.test($(this).val().substr(i, i + 1))) {
									if ($(this).val().substring(i + 1).indexOf($(this).val().substring(i, i + 1)) >= 0) {
										$(this).customInputFeedback();
										break;
									}
								}
							}
						}
					});
				</script>
			</fieldset>
			<!-- /fieldset : Title -->

			<div class="row">
				<div class="col-md-4">

			<!-- fieldset : Job Type -->
			<fieldset class="mb-5" id="fieldset-job-type">
				<legend class="required">Job Type</legend>
				<div class="form-group mb-0">
					<div class="dropdown">
						<a class="form-control custom-select custom-select-lg dropdown-toggle" data-toggle="dropdown" data-name="job_type[]" data-multiple-target="#job-type-target">Job Type</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="javascript:void(0);" data-value="">All</a>
<?php $job_types = array(); foreach($DB->selectCode('work_job_type') as $type){ $job_types[$type['no']] = $type['name']; ?>
							<a class="dropdown-item" href="javascript:void(0);" data-value="<?= $type['no'] ?>"><?= $type['name'] ?></a>
<?php } ?>
						</div>
					</div>
					<div id="job-type-target">
<?php if(isset($rs['job_type']) && !empty($rs['job_type'])){ foreach(explode(',', $rs['job_type']) as $type){ ?>
						<span class="mr-2"><input type="hidden" name="job_type[]" value="<?= $type ?>" /><?= $job_types[$type] ?> <a href="javascript:void(0);" data-toggle="remove">&times;</a></span>
<?php }} ?>
					</div>
				</div>
				<script defer>
					$('#fieldset-job-type').on('click', '[data-value=""]', function(){
						$('#job-type-target').empty();
						$('[data-name="job_type[]"]').text('All');
						$('[data-name="job_type[]"]').dropdown('hide');
						return false;
					});
					$('#fieldset-job-type').on('click', '[data-value!=""]', function(){
						$('[data-name="job_type[]"]').text('Job Type');
					});
				</script>
			</fieldset>
			<!-- /fieldset : Job Type -->

				</div>
				<div class="col-md-4">

			<!-- fieldset : Education Level -->
			<fieldset class="mb-5">
				<legend class="required">Education Level</legend>
				<select class="form-control custom-select custom-select-lg" name="education_level" required>
					<option value=""<?= $rs['education_level']?'':' selected' ?> disabled>Education Level</option>
<?php for($i=0; $i<count($CONF['education_levels']); $i++){ ?>
					<option value="<?= $i+1 ?>"<?= $rs['education_level']==$i+1?' selected':'' ?>><?= $CONF['education_levels'][$i] ?></option>
<?php } ?>
				</select>
			</fieldset>
			<!-- /fieldset : Education Level -->

				</div>
				<div class="col-md-4">

			<!-- fieldset : Career Level -->
			<fieldset class="mb-5">
				<legend class="required">Career Level</legend>
				<select class="form-control custom-select custom-select-lg" name="career_level" required>
					<option value=""<?= $rs['career_level']?'':' selected' ?> disabled>Career Level</option>
<?php for($i=0; $i<count($CONF['career_levels']); $i++){ ?>
					<option value="<?= $i+1 ?>"<?= $rs['career_level']==$i+1?' selected':'' ?>><?= $CONF['career_levels'][$i] ?></option>
<?php } ?>
				</select>
			</fieldset>
			<!-- /fieldset : Career Level -->

				</div>
			</div>

<?php include_once 'pages/common/Edit/industry.php'; ?>

<?php // include_once 'pages/common/Edit/keyword.php'; ?>
			<input type="hidden" name="keyword" value="" />

			<!-- fieldset : Teaching Level -->
			<fieldset class="mb-5" id="fieldset-teaching-level">
				<legend>Teaching Level</legend>
				<div class="form-group mb-0">
					<div class="dropdown">
						<a class="form-control custom-select custom-select-lg dropdown-toggle" data-toggle="dropdown" data-name="teaching_level[]" data-multiple-target="#teaching-level-target">Teaching Level</a>
						<div class="dropdown-menu">
<?php $teaching_levels = array(); for($i=0; $i<count($CONF['teaching_levels']); $i++){ $teaching_levels[$i+1] = $CONF['teaching_levels'][$i]; ?>
							<a class="dropdown-item" href="javascript:void(0);" data-value="<?= $i+1 ?>"><?= $CONF['teaching_levels'][$i] ?></a>
<?php } ?>
						</div>
					</div>
					<div id="teaching-level-target">
<?php if(isset($rs['teaching_level']) && !empty($rs['teaching_level'])){ foreach(explode(',', $rs['teaching_level']) as $teaching_level){ ?>
						<span class="mr-2"><input type="hidden" name="teaching_level[]" value="<?= $teaching_level ?>" /><?= $teaching_levels[$teaching_level] ?> <a href="javascript:void(0);" data-toggle="remove">&times;</a></span>
<?php }} ?>
					</div>
				</div>
			</fieldset>
			<!-- /fieldset : Teaching Level -->

			<!-- fieldset : Job Description -->
			<fieldset class="mb-5" id="fieldset-desc">
				<legend>Job Description</legend>
				<div class="form-group mb-0">
					<textarea class="cke_required" id="desc" name="desc" required><?= $rs['desc'] ?></textarea>
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
			<!-- /fieldset : Job Description -->

			<!-- fieldset : Specialized Requirements for Candidates -->
			<fieldset class="mb-5" id="fieldset-keyword2">
				<legend>Specialized Requirements for Candidates<a class="far fa-question-circle text-decoration-none text-muted text-dark float-right my-1" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Add extra requirements, qualifications, or experience that is needed for this position."></a></legend>
				<textarea class="form-control form-control-lg textarea-autosize" name="keyword2" placeholder="Specialized Requirements for Candidates"><?= htmlspecialchars(trim($rs['keyword2'])) ?></textarea>
			</fieldset>
			<!-- /fieldset : Specialized Requirements for Candidates -->

			<div class="card mb-5">
				<div class="card-body mb-n4">

			<!-- fieldset : Salary & Benefits -->
			<fieldset class="mb-4" id="fieldset-salary">
				<legend>Salary &amp; Benefits</legend>
				<div class="form-group">
					<input type="text" class="form-control" name="salary" value="<?= htmlspecialchars(trim($rs['salary'])) ?>" placeholder="Salary" />
				</div>
				<div class="form-group mb-0">
					<textarea class="form-control form-control-lg textarea-autosize" name="benefits" placeholder="Benefits"><?= htmlspecialchars(trim($rs['benefits'])) ?></textarea>
				</div>
			</fieldset>
			<!-- /fieldset : Salary & Benefits -->

			<!-- fieldset : Housing -->
			<fieldset class="mb-4" id="fieldset-housing">
<?php
	$housing_category = array();
	if (isset($rs['housing_category'])) {
		$housing_category = explode(',', $rs['housing_category']);
	}
?>
				<legend>Housing</legend>
				<div class="form-group mb-2">
<?php for($i=0; $i<count($CONF['housing_category']); $i++){ ?>
					<div class="form-check form-check-inline">
						<input type="checkbox" class="form-check-input" id="housing_category_<?= $i+1 ?>" name="housing_category[]" value="<?= $i+1 ?>"<?= in_array($i+1, $housing_category)?' checked':'' ?> />
						<label class="form-check-label" for="housing_category_<?= $i+1 ?>"><?= $CONF['housing_category'][$i] ?></label>
					</div>
<?php } ?>
				</div>
				<div class="form-group mb-0">
					<textarea class="form-control form-control-lg textarea-autosize" name="housing" placeholder="Housing"><?= htmlspecialchars(trim($rs['housing'])) ?></textarea>
				</div>
			</fieldset>
			<!-- /fieldset : Housing -->

				</div>
			</div>

<?php include_once 'pages/common/Edit/period.php'; ?>

<?php include_once 'pages/common/Edit/language.php'; ?>

			<!-- fieldset : Employer Type -->
			<fieldset class="mb-5" id="fieldset-employer-type">
				<legend>Employer Type</legend>
				<div class="form-group mb-0">
					<select class="form-control custom-select custom-select-lg" name="employer_type">
						<option value=""<?= isset($rs['employer_type'])?'':' selected' ?>>Employer Type</option>
						<option value="Direct Hire"<?= isset($rs['employer_type']) && $rs['employer_type']=='Direct Hire'?' selected':'' ?>>Direct Hire</option>
						<option value="Recruiter"<?= isset($rs['employer_type']) && $rs['employer_type']=='Recruiter'?' selected':'' ?>>Recruiter</option>
					</select>
				</div>
			</fieldset>
			<!-- /fieldset : Employer Type -->

			<!-- fieldset : Visa Sponsorship -->
			<fieldset class="mb-5" id="fieldset-visa-type">
				<legend>Visa Sponsorship</legend>
				<div class="form-group mb-0">
					<select class="form-control custom-select custom-select-lg" name="visa_type">
						<option value=""<?= isset($rs['visa_type'])?'':' selected' ?>>Visa Sponsorship</option>
						<option value="Yes"<?= isset($rs['visa_type']) && $rs['visa_type']=='Yes'?' selected':'' ?>>Yes</option>
						<option value="No"<?= isset($rs['visa_type']) && $rs['visa_type']=='No'?' selected':'' ?>>No</option>
					</select>
				</div>
			</fieldset>
			<!-- /fieldset : Visa Sponsorship -->

<?php include_once 'pages/common/Edit/address.php'; ?>

			<!-- fieldset : Choose how to receive applications -->
			<fieldset class="mb-5" id="fieldset-appl">
				<legend class="required">Choose how to receive applications</legend>
				<div class="row form-group">
					<div class="col-md-6 mb-3 mb-md-0">
						<label class="btn btn-light btn-block mb-0" style="height:auto;">
							<span class="h6 d-block">Via Theworknplay</span>
							<input type="radio" name="appl_type" value="0"<?= !$rs['appl_type']?' checked':'' ?> required />
						</label>
					</div>
					<div class="col-md-6">
						<label class="btn btn-light btn-block mb-0" style="height:auto;">
							<span class="h6 d-block">Via an external website</span>
							<input type="radio" name="appl_type" value="1"<?= $rs['appl_type']?' checked':'' ?> required />
						</label>
					</div>
				</div>
				<div class="form-group mb-0 collapse<?= $rs['appl_type']?'':' show' ?>" id="appl_email">
					<label class="btn-block required" for="appl_email_input">Notification Email</label>
					<input type="email" class="form-control" id="appl_email_input" name="appl_email" value="<?= $rs['appl_type']?'':$rs['appl_text'] ?>"<?= $rs['appl_type']?'':' required' ?> />
				</div>
				<div class="form-group mb-0 collapse<?= $rs['appl_type']?' show':'' ?>" id="appl_url">
					<label class="btn-block required" for="appl_url_input">Redirect the user to the following URL</label>
					<div class="input-group">
						<input type="url" class="form-control" id="appl_url_input" name="appl_url" value="<?= $rs['appl_type']?htmlspecialchars(trim($rs['appl_text'])):'' ?>" placeholder="http://"<?= $rs['appl_type']?' required':'' ?> />
						<div class="input-group-append">
							<button type="button" class="btn btn-light" onclick="window.open($(this).parent().prev().val())">Check</button>
						</div>
					</div>
				</div>
				<script defer>
					$('#fieldset-appl input[name="appl_type"]').on('change', function() {
						if ($('#fieldset-appl input[name="appl_type"]:checked').val() == 0) {
							$('#appl_email').addClass('show').find('input').prop('required', true);
							$('#appl_url').removeClass('show').find('input').prop('required', false);
						} else if ($('#fieldset-appl input[name="appl_type"]:checked').val() == 1) {
							$('#appl_email').removeClass('show').find('input').prop('required', false);
							$('#appl_url').addClass('show').find('input').prop('required', true);
						}
					});
				</script>
			</fieldset>
			<!-- /fieldset : Choose how to receive applications -->

			<!-- fieldset : Add Questions -->
			<fieldset class="mb-5" id="fieldset-appl-questions">
				<legend>Add Questions</legend>
				<p class="form-text text-muted mt-n2 mb-2">구직자에게 추가적인 궁금한 사항을 질문해라 ? 그러면 구직자가 지원할 때 이 질문에 대해 답을 한다.(10개까지)</p>
				<div class="card">
					<div class="card-body mb-n3">
						<div class="form-group">
							<div class="input-group">
								<input type="text" class="form-control" id="fieldset-appl-questions-input" placeholder="Question" data-name="appl_questions[]" data-multiple-target="#fieldset-appl-questions-serial" />
								<div class="input-group-append">
									<button type="button" class="btn btn-outline-secondary btn-block" id="fieldset-appl-questions-add">ADD</button>
								</div>
							</div>
							<div class="form-serial" id="fieldset-appl-questions-serial">
<?php if(isset($rs['appl_questions']) && !empty($rs['appl_questions'])){ foreach(explode('|', $rs['appl_questions']) as $appl_question_index => $appl_question){ ?>
								<span class="mr-2"><input type="hidden" name="appl_questions[]" value="<?= $appl_question ?>" /><?= $appl_question_index+1 ?>. <?= $appl_question ?> <a href="javascript:void(0);" data-toggle="remove">&times;</a></span>
<?php }} ?>
							</div>
							<style>#fieldset-appl-questions-serial>span{display:block;}</style>
						</div>
						<div class="form-group">
							<label class="mb-0">Cover Letter Request</label>
							<div class="form-group mb-0">
								<div class="form-check form-check-inline">
									<input type="radio" class="form-check-input" id="appl_cover_letter_1" name="appl_cover_letter" value="1"<?= $rs['appl_cover_letter']?' checked':'' ?> />
									<label class="form-check-label" for="appl_cover_letter_1">Yes</label>
								</div>
								<div class="form-check form-check-inline">
									<input type="radio" class="form-check-input" id="appl_cover_letter_0" name="appl_cover_letter" value="0"<?= !$rs['appl_cover_letter']?' checked':'' ?> />
									<label class="form-check-label" for="appl_cover_letter_0">No</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</fieldset>
			<!-- /fieldset : Add Questions -->

<?php include_once 'pages/common/Edit/attachment.php'; ?>

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
		<input type="hidden" name="fk" value="<?= $rs['work_company']?$rs['work_company']:$_SESSION['CURRENT_COMPANY'] ?>" />
		<input type="hidden" name="publ" value="<?= $rs['publ'] ?>" />
		<input type="hidden" name="hot" value="<?= $_GET['hot'] || ($rs['hot'] && $_GET['hot']!='0')?1:0 ?>" />

		<script defer>$(function(){$('body').addClass('position-relative').attr('data-spy','scroll').attr('data-target','#list-fieldset').attr('data-offset','95');});</script>

	</form>
	<!-- /form : Form-Job -->