<?php

if ($_POST) {
	if ($_POST['pk'] && $DB->selectWorkResume($_POST['pk'])['member'] != $_SESSION['ID']) {
		blockMember();
	}
	$columns = array(
		'publ',
		'member',
		'title',
		'job_type',
		'job_category_parent',
		'job_category_child',
		'job_category_tag',
		'current_location_country',
		'current_location_parent',
		'current_location_child',
		'current_location_city',
		'desired_location_country',
		'desired_location_parent',
		'desired_location_child',
		'desired_location_city',
		'desired_location',
		'desired_location_desc',
		'language_kor',
		'language_eng',
		'language_others',
		'teaching_level',
		'period',
		'salary',
		'benefits',
		'housing',
		'housing_category',
		'desc',
		'descs',
		'descs2',
		'education_level',
		'education_desc',
		'career_level',
		'career_desc',
		'photos',
		'videos',
		'attachment'
	);
	$values = array(
		':no' => $_POST['pk'],
		':publ' => ($_POST['submit_type']!='save') && $_POST['publ'] && htmlspecialchars(trim($_POST['title'])) ? $_POST['publ'] : 0,
		':member' => $_SESSION['ID'],
		':title' => htmlspecialchars(trim($_POST['title'])),
		':job_type' => join(',', $_POST['job_type']),
		':job_category_parent' => $_POST['job_category_parent']?$_POST['job_category_parent']:null,
		':job_category_child' => $_POST['job_category_child']?$_POST['job_category_child']:null,
		':job_category_tag' => join(',', $_POST['job_category_tag']),
		':current_location_country' => $_POST['current_location_country']?$_POST['current_location_country']:null,
		':current_location_parent' => $_POST['current_location_parent']?$_POST['current_location_parent']:null,
		':current_location_child' => $_POST['current_location_child']?$_POST['current_location_child']:null,
		':current_location_city' => $_POST['current_location_city']?$_POST['current_location_city']:null,
		':desired_location_country' => $_POST['desired_location_country']?$_POST['desired_location_country']:null,
		':desired_location_parent' => $_POST['desired_location_parent']?$_POST['desired_location_parent']:null,
		':desired_location_child' => $_POST['desired_location_child']?$_POST['desired_location_child']:null,
		':desired_location_city' => $_POST['desired_location_city']?$_POST['desired_location_city']:null,
		':desired_location' => join('|', $_POST['desired_location']),
		':desired_location_desc' => $_POST['desired_location_desc'],
		':language_kor' => $_POST['language_kor'],
		':language_eng' => $_POST['language_eng'],
		':language_others' => $_POST['language_others'],
		':teaching_level' => join(',', $_POST['teaching_level']),
		':period' => $_POST['period_type'] == 1 ? $_POST['period_date'] : $_POST['period_type'],
		':salary' => $_POST['salary'],
		':benefits' => $_POST['benefits'],
		':housing' => $_POST['housing'],
		':housing_category' => join(',', $_POST['housing_category']),
		':desc' => $_POST['desc'],
		':descs' => $_POST['descs'],
		':descs2' => $_POST['descs2'],
		':education_level' => $_POST['education_level'],
		':education_desc' => $_POST['education_desc'],
		':career_level' => $_POST['career_level'],
		':career_desc' => $_POST['career_desc'],
		':photos' => $_POST['photos'],
		':videos' => $_POST['videos'],
		':attachment' => join('|', $_POST['attachment'])
	);
	if ($_POST['pk'] = $DB->edit('work_resume', $columns, $values)) {
		if ($_POST['submit_type'] == 'save') {
			echo $_POST['pk'];
		} else if ($_POST['submit_type'] == 'preview') {
			echo '<script>location.replace("/Work/Detail/Resume/' . $_POST['pk'] . '#preview");</script>';
		} else {
			echo '<script>location.replace("/Work/Seeker/ManageResumes");</script>';
		}
	} else
		echo '<script>alert("Failed");</script>';
	exit();
}

$resume_profile = $DB->selectWorkResumeProfile();
$resumes = array_reverse($DB->selectWorkResume(null, $_SESSION['ID']));
if ($_GET['PK'] && $_GET['PK'] != '_NEW') {
	$rs = $DB->selectWorkResume($_GET['PK']);
	if ($rs['member'] != $_SESSION['ID']) {
		echo '<script>location.replace("/Work/Seeker");</script>';
	}
} else if ($resumes[0]['no'] && !$resumes[0]['publ']) {
	echo '<script>location.replace("/Work/Edit/Resume/' . $resumes[0]['no'] . '");</script>';
	exit();
} else if (count($resumes) >= 3) {
	echo '<script>location.replace("/Work/Seeker/ManageResumes");</script>';
	exit();
} else if (!$resume_profile['no'] || !$resume_profile['publ']) {
	echo '<script>location.replace("/Work/Edit/ResumeProfile?next=_NEW");</script>';
	exit();
} else {
	unset($resume_profile['no']);
	unset($resume_profile['publ']);
	$rs = $resume_profile;
}

include_once 'pages/3000_Work/3000_Work_header.php';

?>
	<!-- form : Form-Resume -->
	<form data-beforeunload="true" action="" method="post" class="needs-validation" id="Form-Resume" name="work_resume">

<?php $form_header_title = "Create a Resume"; include_once 'pages/common/header-Edit.php'; ?>

		<div class="container">
			<div class="row">

		<!-- aside -->
		<aside class="col-lg-3">

			<!-- article.card -->
			<article class="card sticky-top mb-5" style="margin-top:1.5rem;top:5rem;z-index:999;">
				<div class="card-body text-center">
					<figure class="mb-0">
						<img class="img-fluid" src="<?= $rs['logo_img'] ?>" alt="<?= $rs['fullname']?$rs['fullname']:'Create a Resume' ?>" title="<?= $rs['fullname']?$rs['fullname']:'Create a Resume' ?>" onerror="this.src='/assets/images/common-noimage.png'" style="width:10rem;" />
						<hr class="mt-4" />
						<h4 class="font-weight-normal"><?= $rs['fullname']?$rs['fullname']:'Create a Resume' ?></h4>
					</figure>
<?php if(!$resumes[0]['no'] || !$resumes[0]['publ']){ ?>
					<a class="btn btn-primary" href="/Work/Edit/ResumeProfile?next=<?= $rs['no']?$rs['no']:'_NEW' ?>">Back</a>
<?php }else{ ?>
					<a class="btn btn-primary" href="/Work/Edit/ResumeProfile">Edit My Profile</a>
<?php } ?>
				</div>
			</article>
			<!-- /article.card -->

		</aside>
		<!-- /aside -->

		<!-- section -->
		<section class="col-lg-9">

			<h2 class="form-heading">Resume</h2>
			<p class="text-muted">By creating an online resume, you will receive more offers from employers. The more fields you fill out, the more employers will be interested in connecting with you!</p>

			<!-- fieldset : Resume Title -->
			<fieldset class="mb-5" id="fieldset-title">
				<legend class="required">Resume Title<a class="far fa-question-circle text-decoration-none text-muted text-dark float-right my-1" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Highlight your qualifications by creating a resume title. For example, “Certified K-12 Teacher” or “Marketing Manager”."></a></legend>
				<div class="form-group mb-0">
					<input type="text" class="form-control form-control-lg" name="title" value="<?= isset($rs['title'])?$rs['title']:'' ?>" placeholder="Title" maxlength="255" data-type="title" required />
					<p class="form-text text-muted mb-0">You cannot insert special symbols.</p>
				</div>
				<script defer>
					$('input[name="title"]').on('change blur', function() {
						if (/[0-9]{5}/.test($(this).val())) {
							if (!$(this).hasClass('is-invalid') && $(this).hasClass('form-control')) {
								$(this).addClass('is-invalid');
								if ($(this).next('.invalid-feedback').length == 0 && !$(this).parent().hasClass('form-inline')) {
									$(this).after($('<div class="invalid-feedback">No more than 5 numbers can be used in a resume title.</div>'));
								}
							}
						} else {
							$(this).removeClass('is-invalid').next('.invalid-feedback').remove();
						}
					});
				</script>
			</fieldset>
			<!-- /fieldset : Resume Title -->

			<!-- fieldset : Education -->
			<fieldset class="mb-5" id="fieldset-education">
				<legend class="required">Education</legend>
				<div class="form-group">
					<select class="form-control custom-select custom-select-lg" name="education_level" required>
						<option value=""<?= isset($rs['education_level'])?'':' selected' ?> disabled>Education Level</option>
<?php for($i=0; $i<count($CONF['education_levels']); $i++){ ?>
						<option value="<?= $i+1 ?>" <?= isset($rs['education_level']) && $rs['education_level']==$i+1?' selected':'' ?>><?= $CONF['education_levels'][$i] ?></option>
<?php } ?>
					</select>
					<p class="form-text text-muted mb-0">Select the highest level of education you have completed.</p>
				</div>
				<div class="card">
					<div class="card-body">
						<button type="button" class="btn btn-secondary" id="fieldset-education-add"><i class="fa fa-plus"></i> Add an Institution</button>
					</div>
				</div>
				<input type="hidden" name="education_desc" value="<?= str_replace('"', '&quot;', $rs['education_desc']) ?>" />
				<script defer>
					function strip_joiner(str){ if(str) return str.replace(/¶/g, '&para;').replace(/§/g, '&sect;'); else return ''; };
					function printEducationForm(data) {
						var educationForm = $('<div class="form-row form-group border-bottom position-relative mb-3"></div>').html([
							$('<a class="btn btn-sm btn-light position-absolute mt-n2 py-0" href="javascript:void(0);" data-toggle="remove" style="z-index:1;right:0;">Delete</a>'),
							$('<div class="col-md-6 mb-2"><label class="required mb-0">School Name</label> <input type="text" class="form-control" value="" placeholder="School Name" data-name="name" required /></div>'),
							$('<div class="col-md-6 mb-2"><label class="required mb-0">Major (Concentration)</label> <input type="text" class="form-control" value="" placeholder="Major (Concentration)" data-name="title" required /></div>'),
							$('<div class="col-md-12 mb-2"></div>').html([
								$('<label class="required mb-0">Dates Attended</label>'),
								$('<div class="form-inline"></div>').html([
									$('<div class="input-group"><select class="form-control custom-select" data-name="fromMonth" required><option value="">Month</option><option value="1">Jan</option><option value="2">Feb</option><option value="3">Mar</option><option value="4">Apr</option><option value="5">May</option><option value="6">Jun</option><option value="7">Jul</option><option value="8">Aug</option><option value="9">Sep</option><option value="10">Oct</option><option value="11">Nov</option><option value="12">Dec</option></select><input type="text" class="form-control" value="" placeholder="Year" size="4" maxlength="4" data-type="year" data-name="fromYear" required /></div><strong class="mx-2">~</strong><div class="input-group"><select class="form-control custom-select" data-name="toMonth" required><option value="">Month</option><option value="1">Jan</option><option value="2">Feb</option><option value="3">Mar</option><option value="4">Apr</option><option value="5">May</option><option value="6">Jun</option><option value="7">Jul</option><option value="8">Aug</option><option value="9">Sep</option><option value="10">Oct</option><option value="11">Nov</option><option value="12">Dec</option></select><input type="text" class="form-control" value="" placeholder="Year" size="4" maxlength="4" data-type="year" data-name="toYear" required /></div>'),
									$('<select class="form-control custom-select ml-2" data-name="dateType" required></select>').html([
										$('<option value="">Progress</option>'),
										$('<option value="In Progress">In Progress</option>'),
										$('<option value="Withdraw">Withdraw</option>'),
										$('<option value="Expected to Complete">Expected to Complete</option>'),
										$('<option value="Completed">Completed</option>')
									])
								])
							]),
							$('<div class="col-md-12 mb-2"><label class="required mb-0">Country of issue</label> <select class="form-control custom-select" data-name="country"><option value="0">Country</option><?php foreach($DB->selectCode('country') as $country){ ?><option value="<?= str_replace('\'','\\\'', $country['name']) ?>"><?= str_replace('\'','\\\'', $country['name']) ?></option><?php } ?></select></div>'),
							$('<div class="col-md-12 mb-3"><label class="mb-0">Summary</label><textarea class="form-control textarea-autosize" data-name="summary"></textarea></div>')
						]);
						if (data) {
							if (data.name) $(educationForm).find('[data-name="name"]').val(data.name);
							if (data.title) $(educationForm).find('[data-name="title"]').val(data.title);
							if (data.fromMonth) $(educationForm).find('[data-name="fromMonth"]').val(data.fromMonth);
							if (data.fromYear) $(educationForm).find('[data-name="fromYear"]').val(data.fromYear);
							if (data.toMonth) $(educationForm).find('[data-name="toMonth"]').val(data.toMonth);
							if (data.toYear) $(educationForm).find('[data-name="toYear"]').val(data.toYear);
							if (data.summary) $(educationForm).find('[data-name="summary"]').val(data.summary);
							if (data.dateType) $(educationForm).find('[data-name="dateType"]').val(data.dateType);
							if (data.country) $(educationForm).find('[data-name="country"]').val(data.country);
						}
						$('#fieldset-education-add').before(educationForm);
						$('#fieldset-education').find('textarea.textarea-autosize').each(function(){ $(this).customTextareaAutosize(); });
						$('#fieldset-education').find('input[data-type="year"]').customInputPattern('0-9');
						$('#fieldset-education').find('input[data-type="year"]').customInputInvalid('^[0-9]{4}$');
					}
					$(function(){
						$('input[type="hidden"][name="education_desc"]').val().split('§').forEach(function(element){
							var data = element.split('¶');
							if (data.length > 4) {
								data.name = data[0];
								data.title = data[1];
								data.fromYear = data[2].split('-')[0];
								data.fromMonth = data[2].split('-')[1];
								data.toYear = data[3].split('-')[0];
								data.toMonth = data[3].split('-')[1];
								data.summary = data[4];
								if (data.length > 5) {
									data.dateType = data[5];
									if (data.length > 6) {
										data.country = data[6];
									}
								}
							}
							printEducationForm(data);
						});
						$('#fieldset-education').find('textarea.textarea-autosize').each(function(){ $(this).customTextareaAutosize(); });
					});
					$('#fieldset-education-add').on('click', function(){
						printEducationForm();
					});
					$('#fieldset-education').parents('form').on('click', 'button[type="submit"]', function() {
						var arr = [];
						$('#fieldset-education>.card>.card-body>.form-row').each(function(){
							if ($(this).find('input, select').is(function(){ return $(this).val() })) {
								var arr2 = [];
								arr2.push(strip_joiner($(this).find('[data-name="name"]').val()));
								arr2.push(strip_joiner($(this).find('[data-name="title"]').val()));
								arr2.push(strip_joiner($(this).find('[data-name="fromYear"]').val() + '-' + $(this).find('[data-name="fromMonth"]').val()));
								arr2.push(strip_joiner($(this).find('[data-name="toYear"]').val() + '-' + $(this).find('[data-name="toMonth"]').val()));
								arr2.push(strip_joiner($(this).find('[data-name="summary"]').val()));
								arr2.push(strip_joiner($(this).find('[data-name="dateType"]').val()));
								arr2.push(strip_joiner($(this).find('[data-name="country"]').val()));
								arr.push(arr2.join('¶'));
							}
						});
						$('input[type="hidden"][name="education_desc"]').val(arr.join('§'));
					});
				</script>
			</fieldset>
			<!-- /fieldset : Education -->

			<!-- fieldset : Work Experience -->
			<fieldset class="mb-5" id="fieldset-career">
				<legend class="required">Work Experience</legend>
				<div class="form-group">
					<select class="form-control custom-select custom-select-lg" name="career_level" required>
						<option value=""<?= isset($rs['career_level'])?'':' selected' ?> disabled>Career Level</option>
<?php for($i=0; $i<count($CONF['career_levels']); $i++){ ?>
						<option value="<?= $i+1 ?>" <?= isset($rs['career_level']) && $rs['career_level']==$i+1?' selected':'' ?>><?= $CONF['career_levels'][$i] ?></option>
<?php } ?>
					</select>
				</div>
				<div class="card">
					<div class="card-body">
						<p class="text-muted mb-2">경력을 추가하세요</p>
						<button type="button" class="btn btn-secondary" id="fieldset-career-add"><i class="fa fa-plus"></i> Add a Workplace</button>
					</div>
				</div>
				<input type="hidden" name="career_desc" value="<?= str_replace('"', '&quot;', $rs['career_desc']) ?>" />
				<script defer>
					function strip_joiner(str){ if(str) return str.replace(/¶/g, '&para;').replace(/§/g, '&sect;'); else return ''; };
					function printCareerForm(data) {
						var careerForm = $('<div class="form-row form-group border-bottom position-relative mb-3"></div>').html([
							$('<a class="btn btn-sm btn-light position-absolute mt-n2 py-0" href="javascript:void(0);" data-toggle="remove" style="z-index:1;right:0;">Delete</a>'),
							$('<div class="col-md-6 mb-2"><div class="form-check form-check-inline float-right"><label class="form-check-label"><input type="checkbox" class="form-check-input" data-name="nameHidden">Company Name 숨기기</label></div><label class="required mb-0">Company Name</label> <input type="text" class="form-control" value="" placeholder="Company Name" data-name="name" required /></div>'),
							$('<div class="col-md-6 mb-2"><label class="required mb-0">Position Title</label> <input type="text" class="form-control" value="" placeholder="Position Title" data-name="title" required /></div>'),
							$('<div class="col-md-12 mb-2"></div>').html([
								$('<label class="required mb-0">Time Period</label>'),
								$('<div class="form-inline"></div>').html([
									$('<div class="input-group"><select class="form-control custom-select" data-name="fromMonth" required><option value="">Month</option><option value="1">Jan</option><option value="2">Feb</option><option value="3">Mar</option><option value="4">Apr</option><option value="5">May</option><option value="6">Jun</option><option value="7">Jul</option><option value="8">Aug</option><option value="9">Sep</option><option value="10">Oct</option><option value="11">Nov</option><option value="12">Dec</option></select><input type="text" class="form-control" value="" placeholder="Year" size="4" maxlength="4" data-type="year" data-name="fromYear" required /></div><strong class="mx-2">~</strong><div class="input-group"><select class="form-control custom-select" data-name="toMonth" required><option value="">Month</option><option value="1">Jan</option><option value="2">Feb</option><option value="3">Mar</option><option value="4">Apr</option><option value="5">May</option><option value="6">Jun</option><option value="7">Jul</option><option value="8">Aug</option><option value="9">Sep</option><option value="10">Oct</option><option value="11">Nov</option><option value="12">Dec</option></select><input type="text" class="form-control" value="" placeholder="Year" size="4" maxlength="4" data-type="year" data-name="toYear" required /></div>'),
									$('<select class="form-control custom-select ml-2" data-name="dateType" required></select>').html([
										$('<option value="">Working Status</option>'),
										$('<option value="Present">Present</option>'),
										$('<option value="Expected to resign">Expected to resign</option>'),
										$('<option value="Termination">Termination</option>')
									])
								])
							]),
							$('<div class="col-md-12 mb-2"><label class="required mb-0">Country of issue</label> <select class="form-control custom-select" data-name="country"><option value="">Country</option><?php foreach($DB->selectCode('country') as $country){ ?><option value="<?= str_replace('\'','\\\'', $country['name']) ?>"><?= str_replace('\'','\\\'', $country['name']) ?></option><?php } ?></select></div>'),
							$('<div class="col-md-12 mb-3"><label class="mb-0">Summary</label><textarea class="form-control textarea-autosize" data-name="summary"></textarea></div>')
						]);
						if (data) {
							if (data.name) $(careerForm).find('[data-name="name"]').val(data.name);
							if (data.title) $(careerForm).find('[data-name="title"]').val(data.title);
							if (data.fromMonth) $(careerForm).find('[data-name="fromMonth"]').val(data.fromMonth);
							if (data.fromYear) $(careerForm).find('[data-name="fromYear"]').val(data.fromYear);
							if (data.toMonth) $(careerForm).find('[data-name="toMonth"]').val(data.toMonth);
							if (data.toYear) $(careerForm).find('[data-name="toYear"]').val(data.toYear);
							if (data.summary) $(careerForm).find('[data-name="summary"]').val(data.summary);
							if (data.dateType) $(careerForm).find('[data-name="dateType"]').val(data.dateType);
							if (data.country) $(careerForm).find('[data-name="country"]').val(data.country);
							if (data.nameHidden) $(careerForm).find('[data-name="nameHidden"]').prop('checked',true);
						}
						$('#fieldset-career-add').before(careerForm);
						$('#fieldset-career').find('textarea.textarea-autosize').each(function(){ $(this).customTextareaAutosize(); });
						$('#fieldset-career').find('input[data-type="year"]').customInputPattern('0-9');
						$('#fieldset-career').find('input[data-type="year"]').customInputInvalid('^[0-9]{4}$');
						$('#fieldset-career-add').siblings('p').remove();
					}
					$(function(){
						if ($('input[type="hidden"][name="career_desc"]').val()) {
							$('input[type="hidden"][name="career_desc"]').val().split('§').forEach(function(element){
								var data = element.split('¶');
								if (data.length > 4) {
									data.name = data[0];
									data.title = data[1];
									data.fromYear = data[2].split('-')[0];
									data.fromMonth = data[2].split('-')[1];
									data.toYear = data[3].split('-')[0];
									data.toMonth = data[3].split('-')[1];
									data.summary = data[4];
									if (data.length > 5) {
										data.dateType = data[5];
										if (data.length > 6) {
											data.country = data[6];
											if (data.length > 7) {
												data.nameHidden = data[7];
											}
										}
									}
								}
								printCareerForm(data);
							});
							$('#fieldset-career').find('textarea.textarea-autosize').each(function(){ $(this).customTextareaAutosize(); });
						}
					});
					$('#fieldset-career-add').on('click', function(){
						printCareerForm();
					});
					$('#fieldset-career').on('change', 'input[type="checkbox"][data-name="present"]', function(){
						if ($(this).prop('checked')) {
							$(this).parents('.form-group').find('[data-name="toMonth"], [data-name="toYear"]').val('').prop('disabled', true);
						} else {
							$(this).parents('.form-group').find('[data-name="toMonth"], [data-name="toYear"]').prop('disabled', false);
						}
					});
					$('#fieldset-career').parents('form').on('click', 'button[type="submit"]', function() {
						var arr = [];
						$('#fieldset-career>.card>.card-body>.form-row').each(function(){
							if ($(this).find('input, select').is(function(){ return $(this).val() })) {
								var arr2 = [];
								arr2.push(strip_joiner($(this).find('[data-name="name"]').val()));
								arr2.push(strip_joiner($(this).find('[data-name="title"]').val()));
								arr2.push(strip_joiner($(this).find('[data-name="fromYear"]').val() + '-' + $(this).find('[data-name="fromMonth"]').val()));
								arr2.push(strip_joiner($(this).find('[data-name="toYear"]').val() + '-' + $(this).find('[data-name="toMonth"]').val()));
								arr2.push(strip_joiner($(this).find('[data-name="summary"]').val()));
								arr2.push(strip_joiner($(this).find('[data-name="dateType"]').val()));
								arr2.push(strip_joiner($(this).find('[data-name="country"]').val()));
								arr2.push(strip_joiner($(this).find('[data-name="nameHidden"]').prop('checked')?'1':''));
								arr.push(arr2.join('¶'));
							} else {
								$(this).remove();
							}
						});
						$('input[type="hidden"][name="career_desc"]').val(arr.join('§'));
					});
				</script>
			</fieldset>
			<!-- /fieldset : Work Experience -->

<?php $location_prefix = 'current'; include 'pages/common/Edit/location.php'; ?>

<?php include_once 'pages/common/Edit/language.php'; ?>

			<h5 class="font-weight-normal">Job Preference</h5>

			<!-- .card -->
			<div class="card mb-5">
				<div class="card-body mb-n5">

			<!-- fieldset : Desired Location -->
			<fieldset class="mb-5" id="fieldset-desired-location-multiple">
				<legend class="required">Desired Location</legend>
				<div class="form-row">
					<div class="col-md-10 form-group">
						<div class="mb-n3">
<?php $location_prefix = 'desired'; include 'pages/common/Edit/location.php'; ?>
						</div>
					</div>
					<div class="col-md-2 form-group">
						<button type="button" class="btn btn-light btn-block" id="fieldset-desired-location-add">ADD</button>
					</div>
					<div class="col-md-12 form-group">
						<textarea class="form-control textarea-autosize" name="desired_location_desc" placeholder="Explain why you choose this area"><?= isset($rs['desired_location_desc']) && !empty($rs['desired_location_desc'])?$rs['desired_location_desc']:'' ?></textarea>
					</div>
				</div>
				<div class="form-serial" id="fieldset-desired-location-serial" data-serial="<?= isset($rs['desired_location']) && !empty($rs['desired_location'])?$rs['desired_location']:'' ?>"></div>
				<style>#fieldset-desired-location-multiple fieldset>legend{display:none;}</style>
				<script defer>
					$(function() {
						if ($('#fieldset-desired-location-serial').data('serial')) {
							var name = 'desired_location[]';
							var target = '#fieldset-desired-location-serial';
							$('#fieldset-desired-location-serial').data('serial').split('|').forEach(function(value) {
								var text = value;
								$(target).append('<span class="mr-2"><input type="hidden" name="' + name + '" value="' + value + '"/>' + text + ' <a href="javascript:void(0);" data-toggle="remove">&times;</a></span>');
							});
						}
					});
					$('#fieldset-desired-location-add').on('click', function(){
						var name = 'desired_location[]';
						var target = '#fieldset-desired-location-serial';
						var max = '3';
						var value = $('#desired-location-country>option:selected').text();
						if ($('#desired-location-parent').is(':visible') && $('#desired-location-parent').val() != '0') {
							value += ' > ' + $('#desired-location-parent>option:selected').text();
						}
						if ($('#desired-location-child').is(':visible') && $('#desired-location-child').val() != '0') {
							value += ' > ' + $('#desired-location-child>option:selected').text();
						}
						if ($('#desired-location-city').is(':visible') && $('#desired-location-city').val() != '0') {
							value += ' > ' + $('#desired-location-city>option:selected').text();
						}
						var text = value;
						if ($(target).length && value) {
							if (!$(target).find('input').is(function() {
								return $(this).val() == value;
							})) {
								if (max && $(target).children('span').length >= parseInt(max))
									Alert("Maximum " + max + " options allowed.");
								else $(target).append('<span class="mr-2"><input type="hidden" name="' + name + '" value="' + value + '"/>' + text + ' <a href="javascript:void(0);" data-toggle="remove">&times;</a></span>');
							}
						}
					});
				</script>
			</fieldset>
			<!-- /fieldset : Desired Location -->

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

<?php include_once 'pages/common/Edit/period.php'; ?>

<?php include_once 'pages/common/Edit/industry.php'; ?>

			<!-- fieldset : Teaching Level -->
			<fieldset class="mb-5" id="fieldset-teaching-level">
				<legend>Teaching Level</legend>
				<div class="form-group mb-0">
					<div class="dropdown">
						<a class="form-control custom-select custom-select-lg dropdown-toggle" data-toggle="dropdown" data-name="teaching_level[]" data-multiple-target="#teaching-level-target">Teaching Level</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="javascript:void(0);" data-value="">All</a>
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
				<script defer>
					$('#fieldset-teaching-level').on('click', '[data-value=""]', function(){
						$('#teaching-level-target').empty();
						$('[data-name="teaching_level[]"]').text('All');
						$('[data-name="teaching_level[]"]').dropdown('hide');
						return false;
					});
					$('#teaching-level-type').on('click', '[data-value!=""]', function(){
						$('[data-name="teaching_level[]"]').text('Teaching Level');
					});
				</script>
			</fieldset>
			<!-- /fieldset : Teaching Level -->

				</div>
			</div>
			<!-- /.card -->

			<!-- .card -->
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
			<!-- /.card -->

			<!-- fieldset : Professional Summary -->
			<fieldset class="mb-5" id="fieldset-desc">
				<legend>Professional Summary<a class="far fa-question-circle text-decoration-none text-muted text-dark float-right my-1" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Write a short summary about yourself and your experience. Professional summaries help employers get to know you better."></a></legend>
				<div class="form-group mb-0">
					<textarea class="form-control form-control-lg textarea-autosize" id="desc" name="desc" rows="10"><?= strip_tags($rs['desc']) ?></textarea>
					<!-- script defer>$(function(){ CKEDITOR.replace('desc'); });</script -->
				</div>
			</fieldset>
			<!-- /fieldset : Professional Summary -->

			<!-- fieldset : General Information (Self FAQ) -->
			<fieldset class="mb-5" id="">
				<legend>General Information (Self FAQ)</legend>
				<p>Employers are also curious about your general situation, and if you register this information, you can be offered a very suitable position or save time for interviews.</p>
<?php $descs2_labels = array('If you have a visa, what is its type, and when is the visa\'s expiration date?', 'Where were you born and raised?'); include_once 'pages/common/Edit/descs2.php'; ?>
			</fieldset>
			<!-- /fieldset : General Information (Self FAQ) -->

<?php include_once 'pages/common/Edit/photos&videos.php'; ?>

			<!-- fieldset : Other Information -->
			<fieldset class="mb-5" id="">
				<legend>Other Information</legend>
<?php $descs_labels = array('Certifications & Skills', 'References'); include_once 'pages/common/Edit/descs.php'; ?>
			</fieldset>
			<!-- /fieldset : Other Information -->

			<!-- fieldset : Visibility Status -->
			<fieldset class="mb-5" id="fieldset-publ">
				<legend class="required">Visibility Status</legend>
				<div class="form-group mb-0">
					<div class="row">
						<div class="col-md-6">
							<label class="btn btn-light btn-block mb-0" style="height:auto;">
								<span class="d-block">Allow employers to see <br />my resume and attached files.</span>
								<input type="radio" name="publ" value="1" <?= isset($rs['publ']) && $rs['publ']==1?' checked':'' ?> required />
							</label>
						</div>
						<div class="col-md-6">
							<label class="btn btn-light btn-block mb-0" style="height:auto;">
								<span class="d-block">Make my resume and <br />attached files private.</span>
								<input type="radio" name="publ" value="2" <?= isset($rs['publ']) && $rs['publ']==2?' checked':'' ?> required />
							</label>
						</div>
					</div>
				</div>
			</fieldset>
			<!-- /fieldset : Visibility Status -->

<?php include_once 'pages/common/Edit/attachment.php'; ?>

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

		<input type="hidden" name="pk" value="<?= isset($rs['no'])?$rs['no']:'' ?>" />

		<script defer>$(function(){$('body').addClass('position-relative').attr('data-spy','scroll').attr('data-target','#list-fieldset').attr('data-offset','95');});</script>

	</form>
	<!-- /form : Form-Resume -->