<?php

if ($_GET['email'] && $_SESSION['ID']) {
	$jobalert = $DB->selectWorkJobalert($_GET['email']);
	if (isset($jobalert['member']) && $_SESSION['ID'] != $jobalert['member'] && isset($jobalert['email']) && $_SESSION['EMAIL'] != $jobalert['email']) {
		echo '<main></main><script defer>$(function(){ Alert("This email is already being used by another account.", function(){ history.back(); }); });</script>';
		exit();
	} else if (isset($_GET['action']) && $_GET['action'] == 'delete') {
		foreach ($paramnames as $param)
			unset($_GET[$param]);
		unset($_GET['keyword']);
	}
	$columns = array(
		'member',
		'email',
		'keyword',
		'job_type',
		'job_industry',
		'location_parent',
		'education_level',
		'career_level',
		'language_kor',
		'language_eng',
		'language_others'
	);
	$values = array(
		':no' => $_GET['pk'],
		':member' => $_SESSION['ID'],
		':email' => $_GET['email'],
		':keyword' => $_GET['keyword'],
		':job_type' => join('|', $_GET['job_type']),
		':job_industry' => join('|', $_GET['job_industry']),
		':location_parent' => join('|', $_GET['location_parent']),
		':education_level' => join('|', $_GET['education_level']),
		':career_level' => join('|', $_GET['career_level']),
		':language_eng' => join('|', $_GET['language_eng']),
		':language_kor' => join('|', $_GET['language_kor']),
		':language_others' => join('|', $_GET['language_others'])
	);
	$DB->edit('work_jobalert', $columns, $values);
	header('Location: /Work/Seeker/JobAlert');
}

$jobalert = $DB->selectWorkJobalert($_GET['email']);
$params = array();
foreach ($paramnames as $paramname) {
	if (isset($jobalert[$paramname]) && !empty($jobalert[$paramname]) && !empty($jobalert[$paramname][0])) {
		array_push($params, array(
			'name' => $paramname,
			'values' => $jobalert[$paramname]
		));
		$_GET[$paramname] = $jobalert[$paramname];
	} else {
		$_GET[$paramname] = array();
	}
}
$_GET['keyword'] = $jobalert['keyword'];
$articles = $DB->searchWorkJob(false, trim($jobalert['keyword']), $params);

include_once 'pages/3000_Work/3000_Work_header.php';

?>
	<!-- main -->
	<main class="py-3 py-lg-5">
		<div class="container">
			<div class="row">

		<!-- section -->
		<section class="col-lg-9">

			<!-- Set Job Alert -->
			<div class="<?= $_SESSION['ID']?'collapse':'' ?><?= $jobalert?'':' show' ?>" id="Set_Job_Alert">
				<h4>Tell Us What Kind Of Jobs You Want</h4>
				<p>You will only receive emails when relevant jobs become available. Just select the categories you want and any relevant job listing will be sent to your email! You can cancel job alerts anytime.</p>
				<fieldset class="mb-5">
					<div class="form-row">
						<div class="col-8 col-lg-6">
							<input type="email" class="form-control" form="Sidebar" name="email" value="<?= $jobalert['email']?$jobalert['email']:$_SESSION['EMAIL'] ?>" placeholder="Email" data-value="<?= $_SESSION['EMAIL'] ?>" disabled required />
						</div>
						<div class="col-4 col-lg-6">
							<input type="hidden" form="Sidebar" name="pk" value="<?= $jobalert['no'] ?>" />
							<button type="submit" class="btn btn-primary" form="Sidebar" name="action" value="jobalert" disabled><span class="d-none d-sm-inline">EMAIL ME JOBS LIKE THIS</span><span class="d-sm-none">SIGN UP</span></button>
						</div>
					</div>
				</fieldset>
			</div>
			<!-- /Set Job Alert -->

<?php if(isset($jobalert) && !empty($jobalert)){ ?>
<?php if($_SESSION['ID']){ ?>
			<a class="btn btn-light btn-sm float-right py-0 py-sm-1" data-toggle="collapse" data-target="#Set_Job_Alert">Change My Email</a>
<?php } ?>
			<h3 class="border-bottom pb-2 mb-3">Found <?= $CONF['pagination_total'] ?> Jobs</h3>

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

<?php } ?>
		</section>
		<!-- /section -->

		<!-- aside -->
		<aside class="col-lg-3">

<?php include_once 'pages/3000_Work/3100_Work_Search_sidebar.php'; ?>

<?php include 'pages/common/adsbygoogle-square.php'; ?>

<?php include 'pages/3000_Work/3000_Work_aside_hot.php'; ?>

		</aside>
		<!-- /aside -->

			</div>
		</div>
	</main>
	<!-- /main -->