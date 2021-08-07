<?php

include_once 'pages/3000_Work/3000_Work_header.php';

if(!$WP->isMobileUser() && (!isset($_GET['html']) || $_GET['html']!='true')){
?>
	<!-- main -->
	<main class="pb-4 position-relative" id="mainJobSearch" style="max-height:calc(100vh - 44px - 59px);overflow-y:scroll;overflow-x:hidden;">
		<div class="container">
			<div class="row sticky-top bg-white" style="z-index:999;">

		<!-- section -->
		<section class="col-lg-12 pt-4">

			<!-- form#Filter -->
			<form class="form-inline border-bottom pb-2" id="Filter" method="get" action="">
				<input type="hidden" id="Filter-page" name="page" value="1" />
				<div class="form-group">
					<input type="text" class="form-control mb-3 mr-lg-3" name="keyword" value="<?= isset($_GET['keyword'])?$_GET['keyword']:'' ?>" placeholder="Keyword" style="max-width:300px;width:300px;" />
				</div>
				<div class="form-group">
					<select class="form-control custom-select mb-3 mr-lg-3" id="job-category-parent" name="job_category_parent[]" data-child="#job-category-child" onchange="if(this.value){$('#Filter .collapse').collapse('show');$('#Filter').addClass('expand');$('#job-category-child').show();}">
						<option value="">Industry</option>
<?php $code_work_job_category = $DB->selectCode('work_job_category'); foreach($code_work_job_category as $job_category_parent){ ?>
						<option value="<?= $job_category_parent['no'] ?>"<?= in_array($job_category_parent['no'], $_GET['job_category_parent'])?' selected':'' ?>><?= $job_category_parent['name'] ?></option>
<?php } ?>
					</select>
					<select class="form-control custom-select mb-3 mr-lg-3" id="job-category-child" name="job_category_child[]" data-parent="#job-category-parent" style="display:none;width:200px;">
						<option value="" data-parent-value="">Select</option>
<?php foreach($code_work_job_category as $job_category_parent){ ?>
						<option value="" data-parent-value="<?= $job_category_parent['no'] ?>">All</option>
<?php foreach($job_category_parent['children'] as $job_category_child){ ?>
						<option value="<?= $job_category_child['no'] ?>" data-parent-value="<?= $job_category_parent['no'] ?>"<?= in_array($job_category_child['no'], $_GET['job_category_child'])?' selected':'' ?>><?= $job_category_child['name'] ?></option>
<?php }} ?>
					</select>
				</div>
				<div class="form-group">
					<select class="form-control custom-select mb-3 mr-lg-3" id="location-country" name="location_country[]" data-child="#location-city">
						<option value="">Country</option>
<?php foreach($DB->selectCode('country') as $country){ ?>
						<option value="<?= $country['no'] ?>"<?= in_array($country['no'], $_GET['location_country'])?' selected':'' ?>><?= $country['name'] ?></option>
<?php } ?>
					</select>
					<select class="form-control custom-select mb-3 mr-lg-3" id="location-parent" name="location_parent[]" data-child="#location-child" style="<?= in_array('KR', $_GET['location_country'])?'':'display:none;' ?>">
						<option value="">Anywhere</option>
<?php foreach($DB->selectCode('location') as $location){ ?>
						<option value="<?= $location['no'] ?>"<?= in_array($location['no'], $_GET['location_parent'])?' selected':'' ?>><?= $location['name'] ?></option>
<?php } ?>
					</select>
					<select class="form-control custom-select mb-3 mr-lg-3" id="location-child" name="location_child[]" data-parent="#location-parent" style="<?= in_array('KR', $_GET['location_country'])?'':'display:none;' ?>">
						<option value="" data-parent-value="0">Anywhere</option>
<?php foreach($DB->selectCode('location') as $location_parent){ ?>
						<option value="0" data-parent-value="<?= $location_parent['no'] ?>">Anywhere</option>
<?php foreach($location_parent['children'] as $location_child){ ?>
						<option value="<?= $location_child['no'] ?>" data-parent-value="<?= $location_parent['no'] ?>"<?= $location_child['no']==$rs['location_child']?' selected':'' ?>><?= $location_child['name'] ?></option>
<?php }} ?>
					</select>
					<select class="form-control custom-select mb-3 mr-lg-3" id="location-city" name="location_city[]" data-parent="#location-country" style="<?= in_array('KR', $_GET['location_country']) || empty($_GET['location_country'])?'display:none;':'' ?>">
						<option value="">Anywhere</option>
<?php foreach($DB->selectCode('country_city') as $city){ ?>
						<option value="<?= $city['city_name'] ?>" data-parent-value="<?= $city['country_code'] ?>"<?= $city['city_name']==$rs['location_city']?' selected':'' ?>><?= $city['city_name'] ?></option>
<?php } ?>
					</select>
					<script defer>
						$('#Filter').on('change', '#location-country', function() {
							if ($(this).val()) {
								$('#Filter .collapse').collapse('show');
								$('#Filter').addClass('expand');
								if ($(this).val() == 'KR') {
									$('#location-parent').show();
									$('#location-city').hide().val('');
								} else {
									$('#location-parent, #location-child').hide().val('');
									if ($('#location-city>option[data-parent-value="' + $('#location-country').val() + '"]').length) {
										$('#location-city').show();
									} else {
										$('#location-city').hide().val('');
									}
								}
							}
						});
						$('#Filter').on('change', '#location-parent', function() {
							if ($(this).val() != '0' && $('#location-child>option[data-parent-value="' + $(this).val() + '"]').length) {
								$('#location-child').show();
							} else {
								$('#location-child').hide().val('');
							}
						});
					</script>
				</div>
				<div class="form-group" id="Filter-toggler">
					<button type="submit" class="btn btn-primary mb-3 mr-lg-3">SEARCH</button>
					<a class="text-primary mb-3 mr-lg-3" href="javascript:void(0);" data-toggle="collapse" data-target="#Filter .collapse" onclick="$('#Filter').addClass('expand');">More Filters</a>
				</div>
				<div class="form-group mb-0 collapse">
					<select class="form-control custom-select mb-3 mr-lg-3" name="job_type[]">
						<option value="">Job Type</option>
<?php foreach($DB->selectCode('work_job_type') as $type){ ?>
						<option value="<?= $type['no'] ?>"<?= in_array($type['no'], $_GET['job_type'])?' selected':'' ?>><?= $type['name'] ?></option>
<?php } ?>
					</select>
					<select class="form-control custom-select mb-3 mr-lg-3" name="education_level[]">
						<option value="">Education Level</option>
<?php foreach($CONF['education_levels'] as $i => $education_level){ ?>
						<option value="<?= $i+1 ?>"<?= in_array($i+1, $_GET['education_level'])?' selected':'' ?>><?= $education_level ?></option>
<?php } ?>
					</select>
					<select class="form-control custom-select mb-3 mr-lg-3" name="career_level[]">
						<option value="">Career Level</option>
<?php foreach($CONF['career_levels'] as $i => $career_level){ ?>
						<option value="<?= $i+1 ?>"<?= in_array($i+1, $_GET['career_level'])?' selected':'' ?>><?= $career_level ?></option>
<?php } ?>
					</select>
				</div>
				<div class="form-group mb-0 collapse">
					<select class="form-control custom-select mb-3 mr-lg-3" name="language_eng[]">
						<option value="">English</option>
<?php foreach($CONF['language_levels'] as $i => $language_level){ ?>
						<option value="<?= $i+1 ?>"<?= in_array($i+1, $_GET['language_eng'])?' selected':'' ?>><?= $language_level ?></option>
<?php } ?>
					</select>
<?php if(false){ ?>
					<select class="form-control custom-select mb-3 mr-lg-3" name="language_kor[]">
						<option value="">Korean</option>
<?php foreach($CONF['language_levels'] as $i => $language_level){ ?>
						<option value="<?= $i+1 ?>"<?= in_array($i+1, $_GET['language_kor'])?' selected':'' ?>><?= $language_level ?></option>
<?php } ?>
					</select>
<?php } ?>
					<select class="form-control custom-select mb-3 mr-lg-3" name="language_others[]">
						<option value="">Other Language</option>
<?php foreach($DB->selectCode('personal_language') as $language){ ?>
						<option value="<?= $language['name'] ?>"<?= in_array($language['name'], $_GET['language_others'])?' selected':'' ?>><?= $language['name'] ?></option>
<?php } ?>
					</select>
				</div>
				<div class="form-group mb-0 collapse">
					<select class="form-control custom-select mb-3 mr-lg-3" name="teaching_level[]">
						<option value="">Teaching Level</option>
<?php foreach($CONF['teaching_levels'] as $i => $teaching_level){ ?>
						<option value="<?= $i+1 ?>"<?= in_array($i+1, $_GET['teaching_level'])?' selected':'' ?>><?= $teaching_level ?></option>
<?php } ?>
					</select>
					<select class="form-control custom-select mb-3 mr-lg-3" name="visa_type[]">
						<option value="">Visa Sponsorship</option>
						<option value="Yes"<?= in_array('Yes', $_GET['visa_type'])?' selected':'' ?>>Yes</option>
						<option value="No"<?= in_array('No', $_GET['visa_type'])?' selected':'' ?>>No</option>
					</select>
				</div>
				<div class="form-group mb-3 collapse">
					<div class="form-check form-check-inline">
						<input type="radio" class="form-check-input" id="period_type_1" name="period_type" value="1"<?= isset($_GET['period_type']) && $_GET['period_type']==1?' checked':'' ?> />
						<label class="form-check-label" for="period_type_1">Start Date</label>
					</div>
					<div class="form-inline mr-3" style="<?= isset($_GET['period_type']) && $_GET['period_type']==1?'':'display:none;' ?>">
						<input type="text" class="form-control" id="period_from" name="period_from" value="<?= isset($_GET['period_from'])?$_GET['period_from']:'' ?>" autocomplete="off" />
						<script defer>$(function(){ $('#period_from').datepicker({ <?= $_SESSION['RECRUITER']?'':'minDate: 0, ' ?>dateFormat: 'yy-mm-dd' }); });</script>
						<strong>&nbsp;&nbsp;~&nbsp;&nbsp;</strong>
						<input type="text" class="form-control" id="period_to" name="period_to" value="<?= isset($_GET['period_to'])?$_GET['period_to']:'' ?>" autocomplete="off" />
						<script defer>$(function(){ $('#period_to').datepicker({ minDate: '<?= isset($_GET['period_from'])?$_GET['period_from']:0 ?>', dateFormat: 'yy-mm-dd' }); });</script>
					</div>
					<div class="form-check form-check-inline">
						<input type="radio" class="form-check-input" id="period_type_2" name="period_type" value="2"<?= isset($_GET['period_type']) && $_GET['period_type']==2?' checked':'' ?> />
						<label class="form-check-label" for="period_type_2">ASAP</label>
					</div>
					<div class="form-check form-check-inline">
						<input type="radio" class="form-check-input" id="period_type_3" name="period_type" value="3"<?= isset($_GET['period_type']) && $_GET['period_type']==3?' checked':'' ?> />
						<label class="form-check-label" for="period_type_3">Open Until Filled</label>
					</div>
					<script defer>
						$('#Filter input[type="radio"][name="period_type"]').on('change', function() {
							if ($('#Filter input[type="radio"][name="period_type"]:checked').val() == '1')
								$('#Filter .form-inline').show().find('input').prop('disabled', false);
							else $('#Filter .form-inline').hide().find('input').prop('disabled', true);
						});
						$('#period_from').on('change', function() {
							if ($('#period_from').val()) {
								$('#period_to').datepicker('option', 'minDate', $('#period_from').val());
							}
						});
					</script>
				</div>
				<div class="form-group mb-3 collapse">
					<button type="submit" class="btn btn-primary mb-3 mr-lg-3">SEARCH</button>
					<a class="btn btn-outline-secondary mb-3 mr-lg-3" href="javascript:void(0);" data-toggle="collapse" data-target="#Filter .collapse" onclick="$('#Filter').removeClass('expand');">More Filters</a>
					<button type="reset" class="btn btn-link mb-3 mr-lg-3 px-0" onclick="$('#location-parent, #location-child, #job-category-child').hide().val('');"><small>Clear Filters</small></button>
				</div>
				<style>@media(min-width:768px){#Filter .form-control{max-width:200px;background-color:var(--light);}#Filter .form-inline .form-control{max-width:120px;}}#Filter.expand .form-group{width:100%;}#Filter.expand #Filter-toggler, #Filter:not(.expand) #job-category-child{display:none;}.ui-datepicker{z-index:1001 !important;}</style>
			</form>
			<!-- /form#Filter -->

		</section>
		<!-- /section -->

			</div>
			<div class="row">

		<!-- section -->
		<section class="col-lg-5 pr-1">

			<!-- section -->
			<section>
				<article class="media py-3 border-bottom">
					<div class="media-body" id="paginationTotal"><?= $CONF['pagination_total'] ?> Results<?= trim($_GET['keyword'])?' for "' . trim($_GET['keyword']) . '"':'' ?></div>
				</article>
			</section>
			<!-- /section -->

			<!-- section#sectionJobList -->
			<section id="sectionJobList" style="/*max-height:calc(100vh - 44px - 59px - 2 * 24px - 63px - 57px);*//*overflow-y:scroll;*//*overflow-x:hidden;*/"></section>
			<!-- /section#sectionJobList -->

		</section>
		<!-- /section -->

		<!-- section -->
		<section class="col-lg-7">

			<!-- section#sectionJobDetail -->
			<section class="h-100 sticky-top bg-white" id="sectionJobDetail" style="z-index:998;top:calc(63px + 1.5rem);max-height:calc(100vh - 44px - 59px - 2 * 24px - 63px);overflow-y:scroll;overflow-x:hidden;"></section>
			<!-- /section#sectionJobDetail -->

		</section>
		<!-- /section -->

			</div>
		</div>
	</main>
	<!-- /main -->

	<style>
		#sectionJobDetail h5, .media-body>h5 {
			font-size: 1.15rem;
		}
		.media-body>p {
			/*font-size:1.05rem;*/
		}
		.media-body>p.small, #tabJobDetail p>.small {
			font-size: .85rem;
		}
		body>footer {
			display: none;
		}
	</style>

	<script defer>
		$(function() {
			if ($(window).width() < 992) {
				$('#Filter').prepend('<input type="hidden" name="html" value="true" />').submit();
			}
			if ($('#Filter select').not('[type="radio"]').not('[name="page"]').is(function(){ if ($(this).val()) return true; })
					|| $('#Filter input[type="radio"]').is(function(){ if ($(this).prop('checked')) return true; })) {
				$('#Filter .collapse').collapse('show');
				$('#Filter').addClass('expand');
			}
			showJobList();
		});
		$('#mainJobSearch').on('scroll', function() {
			if ($('#Filter').hasClass('expand')) {
				$('#Filter .collapse').collapse('hide');
				$('#Filter').removeClass('expand');
			}
			if (mainJobSearch.scrollHeight == mainJobSearch.scrollTop + mainJobSearch.offsetHeight) {
				showJobList();
			}
		});
		$('#sectionJobList').on('scroll', function() {
			if (sectionJobList.scrollHeight == sectionJobList.scrollTop + sectionJobList.offsetHeight) {
				showJobList();
			}
		});
		$('#Filter').on('reset', function(){
			$('#sectionJobList').empty();
			$('#Filter input, #Filter select').not('[type="radio"]').not('[name="page"]').val('');
			$('#Filter input[type="radio"]').prop('checked', false);
			$('#Filter-page').val(1);
			showJobList();
			return false;
		});
		$('#Filter input, #Filter select').not('[data-parent]').not('[data-child]').on('change', function(){
			$('#sectionJobList').empty();
			$('#Filter-page').val(1);
			showJobList();
		});
		function showJobList() {
			if (window.waitJobList) return false;
			else window.waitJobList = true;
<?php if($_SESSION['TEST_MODE']){ ?>
			console.log($('#Filter-page').val());
<?php } ?>
			$.ajax({
				type : 'get', url : '/actions/JobList', data : $('#Filter').serialize(), dataType : 'json',
				success : function(result) {
<?php if($_SESSION['DEBUG_MODE']){ ?>
					console.log(result, typeof result);
<?php } ?>
					result.forEach(function(article) {
						$('#sectionJobList').append(
							$('<article class="media py-2 pr-2 border-bottom position-relative"></article>').html([
								$('<img class="mr-3" src="' + article.company_logo_img + '" alt="' + article.company_name + '" title="' + article.company_name + '" onerror="this.src=\'/assets/images/common-noimage.png\'" width="64" />'),
								$('<div class="media-body"></div>').html([
									$(article.hot == '1' ? '<span class="float-right badge badge-danger">Hot</span>' : ''),
									$('<h5><a class="text-dark stretched-link" href="javascript:void(0);" onclick="showJobDetail(' + article.no + ');">' + article.title + '</a></h5>'),
									$('<p class="mb-0"><!-- by --><span class="text-primary">' + article.company_name + '</span></p>'),
									$(article.location == '' ? '' : ('<p class="mb-0"><!-- Location : --><span>' + article.location + '</span></p>')),
									$('<p class="mb-0 small text-muted">' + article.period + '</p>')
								])
							])
						);
						if ($('#sectionJobList>.media:last-child>.media-body>h5').height() > 46) {
							$('#sectionJobList>.media:last-child>.media-body>h5').addClass('line-clamp-2');
						}
					});
					if ($('#Filter-page').val() == 1) {
						if (result.length) {
							$('#paginationTotal').text(result[0].pagination_total + ' Results' + (Filter.keyword.value?(' for "' + Filter.keyword.value + '"'):''));
							showJobDetail(result[0].no);
						} else {
							$('#paginationTotal').text(0 + ' Results' + (Filter.keyword.value?(' for "' + Filter.keyword.value + '"'):''));
							$('#sectionJobDetail').html('<div class="row justify-content-center"><div class="col-lg-9"><h2 class="text-center text-primary font-weight-bold mt-5">We\'ve found <span style="color:var(--primary-vivid);">9273 jobs</span> that could be the right fit!<br /><small class="d-block mt-4">Your results are listed on the left.</small></h2></div></div>');
						}
					}
					$('#Filter-page').val(Number($('#Filter-page').val()) + 1);
				},
				complete : function(result) {
					window.waitJobList = false;
				}
			});
		}
		function showJobDetail(no) {
			if (window.waitJobDetail) return false;
			else window.waitJobDetail = true;
			$.ajax({
				type : 'post', url : '/actions/JobDetail', data : { no : no },
				success : function(result) {
					$('#sectionJobDetail').html(result).scrollTop(0); $('.modal input[name="pk"]').val(no);
					$('#modalFormApplyJobWithFileName, #modalFormApplyJobWithResumeName').text($('#companyName').text());
					if ($('#applCoverLetter').val() == '0') {
						$('#cover_letter').prop('disabled', true).prop('required', false);
						$('#modalFormApplyJobWithResumeCoverLetter').hide();
					} else {
						$('#cover_letter').prop('disabled', false).prop('required', true);
						$('#modalFormApplyJobWithResumeCoverLetter').show();
					}
					if ($('#applQuestions').val() != '') {
						$('#modalFormApplyJobWithResumeCoverLetter+.form-group').remove();
						$('#modalFormApplyJobWithResumeCoverLetter').after('<div class="form-group" id="modalFormApplyJobWithResumeQuestions"><strong>Questions</strong></div>');
						$('#applQuestions').val().split('|').forEach(function(question, idx){
							$('#modalFormApplyJobWithResumeQuestions').append('<div class="form-group"><label for="answer_' + idx + '">' + (idx + 1) + '. ' + question + '</label><input type="hidden" name="questions[]" value="qwerqwer"><textarea class="form-control" id="answer_' + idx + '" name="answers[]" rows="3" required=""></textarea></div>');
						});						
					}
				},
				complete : function(result) {
					window.waitJobDetail = false;
				}
			});
		}
	</script>
<?php

include_once 'pages/modal/Question.php';

if ($_SESSION['ID']) {
	$modalFormMessage = array(
		'name' => '',
		'table' => 'work_company',
		'pk' => ''
	);
	include_once 'pages/modal/Message.php';
}

if ($_SESSION['ID'] && $_SESSION['SEEKER']) {
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

}else{

$hots = $DB->searchWorkJob(true, trim($_GET['keyword']), $params);
$articles = $DB->searchWorkJob(false, trim($_GET['keyword']), $params);

?>
	<!-- main -->
	<main class="py-3 py-lg-5">
		<div class="container">
			<div class="row">

<?php if(isset($hots) && !empty($hots)){ ?>
		<!-- section -->
		<section class="col-lg-12 mb-5">

			<a class="float-right mt-1 mt-lg-2 d-none d-lg-inline" href="/Work/Employer/Intro">Products ▶</a>
			<h3 class="border-bottom pb-2 mb-3">Hot Jobs</h3>

			<!-- .row -->
			<div class="row mb-n3 mx-lg-n2">
<?php foreach($hots as $article){ ?>
				<div class="col-12 col-sm-6 col-lg-4 mb-3 mb-sm-4 mb-lg-3 px-lg-2">
<?php include 'pages/3000_Work/3000_Work_article_hot.php'; ?>
				</div>
<?php } ?>
			</div>
			<!-- /.row -->

		</section>
		<!-- /section -->

<?php } ?>
		<!-- section -->
		<section class="col-lg-12">

			<h3 class="border-bottom pb-2 mb-3" title="<?= $CONF['pagination_total'] ?> results"><?= $params || trim($_GET['keyword'])?'Found ' . $CONF['pagination_total']:(!isset($hots) || empty($hots)?'Find':'Standard') ?> Jobs</h3>

		</section>
		<!-- /section -->

		<!-- aside -->
		<aside class="col-lg-3">

<?php include_once 'pages/3000_Work/3100_Work_Search_sidebar.php'; ?>

<?php include 'pages/common/adsbygoogle-square.php' ?>

<?php // include 'pages/3000_Work/3000_Work_aside_hot.php'; ?>

		</aside>
		<!-- /aside -->

		<!-- section -->
		<section class="col-lg-9">

			<!-- .row -->
			<div class="row">
<?php foreach($articles as $article){ ?>
				<div class="col-12">
<?php include 'pages/3000_Work/3000_Work_article_job.php'; ?>
				</div>
<?php } ?>
			</div>
			<!-- /.row -->

<?php include_once 'pages/common/pagination.php'; ?>

<?php include 'pages/common/adsbygoogle-horizontal.php' ?>

		</section>
		<!-- /section -->

			</div>
		</div>
	</main>
	<!-- /main -->
<?php } ?>