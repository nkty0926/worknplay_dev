<?php

if ($_POST) {
	if ($_POST['pk'] && $DB->selectWorkCompany($_POST['pk'])['member'] != $_SESSION['ID']) {
		blockMember();
	}
	$columns = array(
		'publ',
		'brand',
		'member',
		'domain',
		'name',
		'name_kor',
		'company_type',
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
		'contact_private',
		'contact_phone1',
		'contact_phone2',
		'contact_email',
		'contact_person',
		'contact_messengers',
		'contact_urls',
		'keyword',
		'keyword2',
		'establishment',
		'employees',
		'desc',
		'desc_pages',
		'logo_img',
		'header_img',
		'header_href',
		'header_target',
		'header_size',
		'header_text'
	);
	$values = array(
		':no' => $_POST['pk'],
		':publ' => $_POST['publ'] ? 1 : 0,
		':brand' => $_POST['brand'] ? 1 : 0,
		':member' => $_SESSION['ID'],
		':domain' => htmlspecialchars(trim($_POST['domain'])),
		':name' => htmlspecialchars(trim($_POST['name'])),
		':name_kor' => htmlspecialchars(trim($_POST['name_kor'])),
		':company_type' => $_POST['company_type'],
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
		':contact_private' => $_POST['contact_private'] ? 1 : 0,
		':contact_phone1' => (isset($_POST['contact_phone1_code']) && !empty($_POST['contact_phone1_code']) ? $_POST['contact_phone1_code'] : '') . $_POST['contact_phone1'],
		':contact_phone2' => (isset($_POST['contact_phone2_code']) && !empty($_POST['contact_phone2_code']) ? $_POST['contact_phone2_code'] : '') . $_POST['contact_phone2'],
		':contact_email' => $_POST['contact_email'],
		':contact_person' => $_POST['contact_person'],
		':contact_messengers' => join(',', $_POST['contact_messengers']),
		':contact_urls' => join(',', $_POST['contact_urls']),
		':keyword' => $_POST['keyword'],
		':keyword2' => $_POST['keyword2'],
		':establishment' => $_POST['establishment'],
		':employees' => $_POST['employees'],
		':desc' => $_POST['desc'],
		':desc_pages' => $_POST['desc_pages'],
		':logo_img' => $_POST['logo_img'],
		':header_img' => $_POST['header_img'],
		':header_href' => $_POST['header_href'],
		':header_target' => $_POST['header_target'],
		':header_size' => $_POST['brand'] ? '0' : $_POST['header_size'],
		':header_text' => $_POST['header_text']
	);
	if ($_POST['pk'] = $DB->edit('work_company', $columns, $values)) {
		$_SESSION['CURRENT_COMPANY'] = $_POST['pk'];
		$_SESSION['CURRENT_COMPANY_NAME'] = htmlspecialchars(trim($_POST['name']));
		if ($_POST['submit_type'] == 'save') {
			echo $_POST['pk'];
		} else if ($_POST['submit_type'] == 'preview') {
			echo '<script>location.replace("/Work/Detail/Company/' . $_POST['pk'] . '#preview");</script>';
		} else if ($_GET['next']) {
			echo '<script>location.replace("/Work/Edit/Job/' . $_GET['next'] . ($_GET['hot'] ? '?hot=1' : '') . '");</script>';
		} else {
			echo '<script>location.replace("/Work/Detail/Company/' . $_POST['pk'] . '");</script>';
		}
	} else
		echo '<script>alert("Failed");history.back();</script>';
	exit();
}

if ($_GET['PK'] && $_GET['PK'] != '_NEW') {
	$rs = $DB->selectWorkCompany($_GET['PK']);
	if ($rs['member'] != $_SESSION['ID']) {
		if ($_SESSION['CURRENT_COMPANY'] && !$_SESSION['RECRUITER']) {
			echo '<script>location.replace("/Work/Edit/Company/' . $_SESSION['CURRENT_COMPANY'] . '");</script>';
			exit();
		} else {
			echo '<script>location.replace("/Work/Employer");</script>';
		}
	}
} else if ($_SESSION['CURRENT_COMPANY'] && !$_SESSION['RECRUITER']) {
	echo '<script>location.replace("/Work/Edit/Company/' . $_SESSION['CURRENT_COMPANY'] . '");</script>';
	exit();
} else if (!$_SESSION['EMPLOYER']) {
	echo '<script>location.replace("/Work/Employer/Intro");</script>';
	exit();
}
$_SESSION['work_company_next_hot'] = $_GET['hot'];

include_once 'pages/3000_Work/3000_Work_header.php';

?>
	<!-- form : Form-Company -->
	<form data-beforeunload="true" action="" method="post" class="needs-validation" id="Form-Company" name="work_company">

<?php $form_header_title = "Create a Company Profile"; include_once 'pages/common/header-Edit.php'; ?>

		<div class="container">
			<div class="row">

		<!-- aside -->
		<aside class="col-lg-3">

			<!-- article.card -->
			<article class="card sticky-top mb-5" style="margin-top:1.5rem;top:5rem;z-index:999;">
				<h5 class="card-header"><?= $_GET['next']?'1. ':'' ?>Company Profile</h5>
				<div class="list-group list-group-flush" id="list-fieldset">
					<a class="list-group-item list-group-item-action py-2" href="#fieldset-companyinformation">Company Information</a>
					<a class="list-group-item list-group-item-action py-2" href="#fieldset-contact">Contact Information</a>
					<a class="list-group-item list-group-item-action py-2" href="#fieldset-header">Header Image</a>
					<a class="list-group-item list-group-item-action py-2" href="#fieldset-addr">Location</a>
					<a class="list-group-item list-group-item-action py-2" href="#fieldset-desc">About Us</a>
<?php if($_GET['next']){ ?>
					<a class="list-group-item list-group-item-action py-2" href="javascript:void(0);" onclick="$('.btn-outline-primary').focus();">Post a Job</a>
<?php } ?>
				</div>
			</article>
			<!-- /article.card -->

		</aside>
		<!-- /aside -->

		<!-- section -->
		<section class="col-lg-9">

			<h2 class="form-heading<?= $_GET['next']?' form-heading-1':'' ?>">Company Profile</h2>
			<p class="text-muted">Give prospective employees basic information about your company. By introducing your company to job-seekers, you can influence their choice and give an idea about what your business and expectations are.</p>

			<!-- fieldset : Company Information -->
			<fieldset class="mb-5" id="fieldset-companyinformation">
				<legend>Company Information</legend>
				<div class="card">
					<div class="card-body mb-n3">

			<div class="form-group">
				<div class="row mb-n3">
					<div class="col-md-9">

			<!-- fieldset : Company Name -->
			<fieldset class="form-group mb-5" id="fieldset-name">
				<legend class="required">Company Name</legend>
				<div class="form-group mb-0">
					<div class="dropdown">
						<input type="text" class="form-control dropdown-toggle" name="name" value="<?= $rs['name'] ?>" placeholder="Company Name" maxlength="255" autocomplete="off" data-toggle="dropdown" data-type="name" required />
						<div class="dropdown-menu">
<?php foreach($DB->searchWorkCompany(true) as $company){ ?>
							<a class="dropdown-item" href="javascript:void(0);" style="display:none;"><?= $company['name'] ?></a>
<?php } foreach($DB->searchWorkCompany(false) as $company){ ?>
							<a class="dropdown-item" href="javascript:void(0);" style="display:none;"><?= $company['name'] ?></a>
<?php }?>
						</div>
					</div>
					<a href="javascript:void(0);" onclick="$('#nameKor').collapse('toggle');">+ Local Name</a>
					<div class="form-group mb-0 collapse<?= $rs['name_kor']?' show':'' ?>" id="nameKor">
						<input type="text" class="form-control" name="name_kor" value="<?= $rs['name_kor'] ?>" placeholder="Local Name" maxlength="255" autocomplete="off" />
					</div>
				</div>
			</fieldset>
			<!-- /fieldset : Company Name -->

					</div>
					<div class="col-md-3">

<?php include_once 'pages/common/Edit/logo.php'; ?>

					</div>
				</div>
			</div>

			<!-- fieldset : Company Type -->
			<fieldset class="form-group" id="fieldset-type">
				<legend class="required">Company Type</legend>
				<select class="form-control custom-select" name="company_type" required>
					<option value=""<?= $rs['company_type']?'':' selected' ?> disabled>Company Type</option>
<?php foreach($DB->selectCode('work_company_type') as $type){ ?>
					<option value="<?= $type['no'] ?>"<?= $rs['company_type']==$type['no']?' selected':'' ?>><?= $type['name'] ?></option>
<?php } ?>
				</select>
			</fieldset>
			<!-- /fieldset : Company Type -->

<?php // include_once 'pages/common/Edit/industry.php'; ?>

			<!-- fieldset : Business Area -->
			<fieldset class="form-group" id="fieldset-keyword2">
				<legend>Business Area</legend>
				<input type="text" class="form-control" name="keyword2" value="<?= htmlspecialchars(trim($rs['keyword2'])) ?>" placeholder="Separate by &quot;;&quot;" />
			</fieldset>
			<!-- /fieldset : Business Area -->

			<div class="row">
				<div class="col-md-6">

			<!-- fieldset : Year Established -->
			<fieldset class="form-group" id="fieldset-establishment">
				<legend>Year Established</legend>
				<input type="text" class="form-control" name="establishment" value="<?= $rs['establishment'] ?>" placeholder="Year Established (E.G. 1988)" title="(E.G. 1988)" maxlength="4" data-type="year" />
			</fieldset>
			<!-- /fieldset : Year Established -->

				</div>
				<div class="col-md-6">

			<!-- fieldset : Employees -->
			<fieldset class="form-group" id="fieldset-employees">
				<legend>Company Size</legend>
				<select class="form-control custom-select" name="employees">
					<option value=""<?= $rs['employees']?'':' selected' ?>>Employees</option>
<?php $employees_labels = array('1 - 10', '11 - 50', '51-100', '101 - 500', '501 - 1,000', '1,001+'); foreach($employees_labels as $employees){ ?>
					<option value="<?= $employees ?>"<?= $rs['employees']==$employees?' selected':'' ?>><?= $employees ?></option>
<?php } ?>
				</select>
			</fieldset>
			<!-- /fieldset : Employees -->

				</div>
			</div>

			<!-- fieldset : Short URL -->
			<fieldset class="form-group" id="fieldset-domain">
				<legend>Short URL</legend>
				<div class="form-group mb-0">
					<div class="input-group">
						<div class="input-group-prepend">
							<label class="input-group-text bg-white" for="domain"><?= $WP->getCurrentHost() ?>/Work/</label>
						</div>
						<input type="text" class="form-control" id="domain" name="domain" value="<?= $rs['domain'] ?>" data-type="domain" required />
					</div>
					<small class="invalid-feedback">Incorrect or duplicate domain</small>
				</div>
			</fieldset>
			<!-- /fieldset : Short URL -->

			<div class="row form-group">
				<div class="col mb-n3">
<?php include_once 'pages/common/Edit/keyword.php'; ?>
				</div>
			</div>

					</div>
				</div>
			</fieldset>
			<!-- /fieldset : Company Information -->

<?php include_once 'pages/common/Edit/contact.php'; ?>

<?php include_once 'pages/common/Edit/header.php'; ?>

<?php include_once 'pages/common/Edit/address.php'; ?>

			<!-- fieldset : About Us -->
			<fieldset class="mb-5" id="fieldset-desc">
				<legend class="required">About Us</legend>
				<div class="card form-group">
					<div class="card-body text-center p-3">
						<div class="form-check form-check-inline mx-3">
							<input type="radio" class="form-check-input" id="brand_0" name="brand" value="0"<?= !$rs['brand']?' checked':'' ?> />
							<label class="form-check-label" for="brand_0">General</label>
						</div>
						<div class="form-check form-check-inline mx-3">
							<input type="radio" class="form-check-input" id="brand_1" name="brand" value="1"<?= $rs['brand']?' checked':'' ?> />
							<label class="form-check-label" for="brand_1">Branding Company</label>
						</div>
					</div>
					<div class="card-footer p-3 brand_desc fade<?= !$rs['brand']?' show':'' ?>" id="brand_desc_0">
						<p class="text-muted mb-0">Add more detailed information about your company. It can include your history, mission and goals, working culture, and ethics. This information will help find a better match when searching for employees.</p>
					</div>
					<div class="card-footer p-3 brand_desc fade<?= $rs['brand']?' show':'' ?>" id="brand_desc_1">
						<p class="text-muted mb-0">Add more detailed information about your company. It can include your history, mission and goals, working culture, and ethics. This information will help find a better match when searching for employees.<a href="javascript:void(0);">… Show More</a></p>
					</div>
					<style>.brand_desc.fade:not(.show){display:none;}</style>
					<script defer>
						$('input[name="brand"]').on('click', function(){
							$('.brand_desc').removeClass('show');
							$('#brand_desc_' + $(this).val()).addClass('show');
						});
					</script>
				</div>
				<div class="form-group mb-0">
					<textarea class="ckeditor" id="desc" name="desc"><?= $rs['desc'] ?></textarea>
					<!-- script defer>$(function(){ CKEDITOR.replace('desc'); });</script -->
				</div>
			</fieldset>
			<!-- /fieldset : About Us -->

<?php if($_SESSION['RECRUITER']){ ?>
			<!-- fieldset : Additional Pages -->
			<fieldset class="mb-5 mt-n4" id="fieldset-pages">
				<!-- <legend>Additional Pages</legend> -->
				<div class="form-group mb-n3">
					<ul class="nav nav-pills nav-pills-gray mb-3">
<?php if(isset($rs['desc_pages']) && !empty($rs['desc_pages'])){ foreach(explode('§', $rs['desc_pages']) as $i => $desc_pages){ $page = explode('¶', $desc_pages); ?>
						<li class="nav-item">
							<a class="nav-link" href="#pages-<?= $i+1 ?>" data-toggle="tab">
								<span><?= $page[0] ?></span>
								<i class="fa fa-minus-square fieldset-pages-del"></i>
							</a>
						</li>
<?php }} ?>
						<li class="nav-item">
							<a class="nav-link" id="fieldset-pages-add">
								<span>Add a Page</span>
								<i class="fa fa-plus-square"></i>
							</a>
						</li>
					</ul>
					<div class="tab-content mb-3">
<?php if(isset($rs['desc_pages']) && !empty($rs['desc_pages'])){ foreach(explode('§', $rs['desc_pages']) as $i => $desc_pages){ $page = explode('¶', $desc_pages); ?>
						<div class="tab-pane" id="pages-<?= $i+1 ?>">
							<div class="form-group">
								<input type="text" class="form-control" value="<?= htmlspecialchars(trim($page[0])) ?>" placeholder="Page Heading" />
							</div>
							<div class="form-group" style="min-height:285px;">
								<textarea class="ckeditor" id="pages-<?= $i+1 ?>-desc"><?= $page[1] ?></textarea>
								<!-- script defer>$(function(){ CKEDITOR.replace('pages-<?= $i+1 ?>-desc'); });</script -->
							</div>
						</div>
<?php }} ?>
					</div>
				</div>
				<input type="hidden" name="desc_pages" />
				<style>#fieldset-pages .nav .ui-sortable-placeholder{width:126px;height:42px;margin-right:.5rem;border-radius:.5rem;}#fieldset-pages .nav .ui-sortable-helper{min-width:126px;}</style>
				<script defer>$(function(){ $('#fieldset-pages .nav').sortable({ items: 'li:not(:last-child)', placeholder: 'ui-state-highlight' }); });</script>
				<script defer>
				function strip_joiner(str){ if(str) return str.replace(/¶/g, '&para;').replace(/§/g, '&sect;'); else return ''; };
					function ckeditorsInTab(nav) {
						$(nav).find('[data-toggle="tab"]').each(function() {
							if ($($(this).attr('href')).find('.ckeditor').length) {
								if ($(this).is('.active')) {
									if (!CKEDITOR.instances[$($(this).attr('href')).find('.ckeditor').attr('id')])
										CKEDITOR.replace($($(this).attr('href')).find('.ckeditor').attr('id'));
								} else {
									if (CKEDITOR.instances[$($(this).attr('href')).find('.ckeditor').attr('id')])
										CKEDITOR.instances[$($(this).attr('href')).find('.ckeditor').attr('id')].destroy();
								}
							}
						});
					}
					$('#fieldset-pages').on('shown.bs.tab', '[data-toggle="tab"]', function() {
						ckeditorsInTab($(this).parents('.nav'));
					});
					$('#fieldset-pages').on('blur keyup', 'input[type="text"]', function() {
						$('#fieldset-pages .nav>li>a[href="#' + $(this).parents('.tab-pane').attr('id') + '"]>span').text($(this).val());
					});
					$('#fieldset-pages').on('dblclick', '.nav-link.active', function() {
						$('#fieldset-pages .nav-link, #fieldset-pages .tab-pane').removeClass('active');
					});
					$('#fieldset-pages').on('click', '.fieldset-pages-del', function() {
						var nav = $(this).parent().parent();
						var tab = $(nav).find('[data-toggle="tab"]').attr('href');
						Confirm("Are you sure you want to delete it?", function() {
							$(nav).remove();
							$(tab).remove();
							$('#fieldset-pages .nav-link, #fieldset-pages .tab-pane').removeClass('active');
						});
						return false;
					});
					$('#fieldset-pages').on('click', '#fieldset-pages-add', function() {
						var idx = $('#fieldset-pages .tab-content>.tab-pane').length + 1;
						while ($('#pages-' + idx).length) idx++;
						$('#fieldset-pages .nav-link, #fieldset-pages .tab-pane').removeClass('active');
						$(this).parent().before('<li class="nav-item"><a class="nav-link active" href="#pages-' + idx + '" data-toggle="tab"><span>New Page</span> <i class="fa fa-minus-square fieldset-pages-del"></i></a></li>');
						$('<div class="tab-pane active" id="pages-' + idx + '"></div>').html([
							$('<div class="form-group"></div>').html([
								$('<input type="text" class="form-control" value="New Page" placeholder="Page Heading" />')
							]),
							$('<div class="form-group" style="min-height:285px;"></div>').html([
								$('<textarea class="ckeditor" id="pages-' + idx + '-desc"></textarea>')
							])
						]).appendTo('#fieldset-pages .tab-content');
						ckeditorsInTab('#fieldset-pages .nav');
					});
					$('#fieldset-pages').parents('form').on('click', 'button[type="submit"]', function() {
						$('#fieldset-pages .nav-link, #fieldset-pages .tab-pane').removeClass('active');
						ckeditorsInTab('#fieldset-pages .nav');
						var arr = [];
						$('#fieldset-pages [data-toggle="tab"]').each(function() {
							var page = $(this).attr('href');
							if ($(page).find('input[type="text"]').val()) {
								var arr2 = [];
								arr2.push(strip_joiner($(page).find('input[type="text"]').val()));
								arr2.push(strip_joiner($(page).find('.ckeditor').val()));
								arr.push(arr2.join('¶'));
							}
						});
						$('input[type="hidden"][name="desc_pages"]').val(arr.join('§'));
					});
				</script>
			</fieldset>
			<!-- /fieldset : Additional Pages -->
<?php }else{ ?>
				<input type="hidden" name="desc_pages" value="<?= $rs['desc_pages'] ?>" />
<?php } ?>

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
		<input type="hidden" name="publ" value="<?= $rs['publ'] ?>" />

		<script defer>$(function(){$('body').addClass('position-relative').attr('data-spy','scroll').attr('data-target','#list-fieldset').attr('data-offset','95');});</script>

	</form>
	<!-- /form : Form-Company -->