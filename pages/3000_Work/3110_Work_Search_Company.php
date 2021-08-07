<?php

if (!isset($_GET['company_type'])) {
	$_GET['company_type'] = array();
}
if (!isset($_GET['char'])) {
	$_GET['char'] = '';
}

$CONF['pagination_articles'] = 24;

$companies = $DB->searchWorkCompany(true);
$articles = $DB->searchWorkCompany(false, trim($_GET['keyword']), $_GET['company_type'], $_GET['char']);

include_once 'pages/3000_Work/3000_Work_header.php';

?>
	<!-- main -->
	<main class="py-3 py-lg-5">
		<div class="container">
			<div class="row">

<?php if(isset($companies) && !empty($companies)){ ?>
		<!-- section -->
		<section class="col-lg-12 mb-5">

			<h3 class="border-bottom pb-2 mb-3">Featured Companies</h3>

			<!-- .row -->
			<div class="row mx-lg-n2">
<?php foreach($companies as $article){ ?>
				<div class="col-12 col-sm-6 col-lg-3 mb-3 mb-sm-4 mb-lg-3 px-lg-2">
<?php include 'pages/3000_Work/3000_Work_article_company.php'; ?>
				</div>
<?php } ?>
			</div>
			<!-- /.row -->

<?php include 'pages/common/adsbygoogle-horizontal.php'; ?>

		</section>
		<!-- /section -->

<?php } ?>
		<!-- section -->
		<section class="col-lg-12">

			<h3 class="border-bottom pb-2 mb-3" title="<?= $CONF['pagination_total'] ?> results"><?= trim($_GET['keyword']) || $_GET['industry'] || $_GET['location'] || $_GET['char']?'Found ' . $CONF['pagination_total']:'' ?> Companies</h3>

		</section>
		<!-- /section -->

		<!-- section -->
		<section class="col-lg-9">

			<!-- #char -->
			<div class="border-bottom pb-2 mb-3 mt-n2" id="char">
				<a class="btn-link comma-after<?= $_GET['char']?'':' font-weight-bold' ?>" data-value="">All</a>
<?php foreach(range('A', 'Z') as $char){ ?>
				<a class="btn-link comma-after<?= $_GET['char']==$char?' font-weight-bold':'' ?>" data-value="<?= $char ?>"><?= $char ?></a>
<?php } ?>
				<a class="btn-link comma-after<?= $_GET['char']=='Etc'?' font-weight-bold':'' ?>" data-value="Etc">Etc.</a>
				<script defer>$('#char>a').on('click', function(){ $('input[type=hidden][name=char]').val($(this).data('value')); $('#Sidebar').submit(); });</script>
			</div>
			<!-- /#char -->

			<!-- .row -->
			<div class="row">
<?php foreach($articles as $article){ $job_count = count($DB->selectWorkJob(null, $article['no'])); ?>
				<div class="col-12 col-sm-6 col-lg-4 mb-3">
					<h6 class="card-title line-clamp-1">
						<a class="text-dark stretched-link" href="/Work/Detail/Company/<?= $article['no'] ?>"><?= $article['name'] ?></a>
					</h6>
<?php if($job_count){ ?>
					<p class="mt-n2 mb-2 text-primary">(Job opening <?= $job_count ?>)</p>
<?php } ?>
				</div>
<?php } ?>
			</div>
			<!-- /.row -->

<?php include_once 'pages/common/pagination.php'; ?>

<?php // include 'pages/common/adsbygoogle-horizontal.php' ?>

		</section>
		<!-- /section -->

		<!-- aside -->
		<aside class="col-lg-3">

			<!-- form#Sidebar -->
			<form class="card bg-light p-3 mb-4" id="Sidebar" method="get" action="">

				<div class="form-group mb-2">
					<input type="text" class="form-control" name="keyword" value="<?= isset($_GET['keyword'])?$_GET['keyword']:'' ?>" placeholder="Keyword" />
				</div>

				<label class="border-bottom w-100 mb-1 pb-1" data-toggle="collapse" data-target="#Sidebar-type">Company Type<span class="badge badge-primary ml-1"></span><span class="float-right"><i class="fa fa-angle-down"></i></span></label>
				<ul class="list-group border-bottom mb-2 collapse" id="Sidebar-type">
<?php foreach($DB->selectCode('work_company_type') as $type){ ?>
					<li class="list-group-item form-check mb-1 py-0 pr-0 border-0 bg-transparent small">
						<input type="checkbox" class="form-check-input" id="type-<?= $type['no'] ?>" name="company_type[]" value="<?= $type['no'] ?>"<?= in_array($type['no'], $_GET['company_type'])?' checked':'' ?> />
						<label class="form-check-label" for="type-<?= $type['no'] ?>"><?= $type['name'] ?></label>
					</li>
<?php } ?>
				</ul>

				<label class="border-bottom w-100 mb-1 pb-1" data-toggle="collapse" data-target="#Sidebar-country">Country<span class="badge badge-primary ml-1"></span><span class="float-right"><i class="fa fa-angle-down"></i></span></label>
				<ul class="list-group border-bottom mb-2 collapse" id="Sidebar-country">
<?php foreach($DB->selectCode('country') as $country){ ?>
					<li class="list-group-item form-check mb-1 py-0 pr-0 border-0 bg-transparent small">
						<input type="checkbox" class="form-check-input" id="country-<?= $country['no'] ?>" name="location_country[]" value="<?= $country['no'] ?>"<?= in_array($country['no'], $_GET['location_country'])?' checked':'' ?> />
						<label class="form-check-label" for="country-<?= $country['no'] ?>"><?= $country['name'] ?></label>
					</li>
<?php } ?>
				</ul>

				<label class="border-bottom mb-1 pb-1 collapse" data-toggle="collapse" data-target="#Sidebar-location">Location<span class="badge badge-primary ml-1"></span><span class="float-right"><i class="fa fa-angle-down"></i></span></label>
				<ul class="list-group border-bottom mb-2 collapse" id="Sidebar-location">
<?php foreach($DB->selectCode('location') as $location){ ?>
					<li class="list-group-item form-check mb-1 py-0 pr-0 border-0 bg-transparent small">
						<input type="checkbox" class="form-check-input" id="location-<?= $location['no'] ?>" name="location_parent[]" value="<?= $location['no'] ?>"<?= in_array($location['no'], $_GET['location_parent'])?' checked':'' ?> />
						<label class="form-check-label" for="location-<?= $location['no'] ?>"><?= $location['name'] ?></label>
					</li>
<?php } ?>
				</ul>

				<label class="border-bottom mb-1 pb-1 collapse" data-toggle="collapse" data-target="#Sidebar-city">City<span class="badge badge-primary ml-1"></span><span class="float-right"><i class="fa fa-angle-down"></i></span></label>
				<ul class="list-group border-bottom mb-2 collapse" id="Sidebar-city">
<?php foreach($DB->selectCode('country_city') as $i => $city){ ?>
					<li class="list-group-item form-check mb-1 py-0 pr-0 border-0 bg-transparent small">
						<input type="checkbox" class="form-check-input" id="city-<?= $i+1 ?>" name="location_city[]" value="<?= $city['city_name'] ?>" data-parent-value="<?= $city['country_code'] ?>"<?= in_array($city['city_name'], $_GET['location_city'])?' checked':'' ?> />
						<label class="form-check-label" for="city-<?= $i+1 ?>"><?= $city['city_name'] ?></label>
					</li>
<?php } ?>
				</ul>

				<div class="text-center">
					<button type="submit" class="btn btn-primary">SEARCH</button>
				</div>

				<input type="hidden" name="char" value="<?= $_GET['char'] ?>" />

			</form>
			<!-- /form#Sidebar -->

<?php // include 'pages/common/adsbygoogle-square.php' ?>

<?php include 'pages/3000_Work/3000_Work_aside_hot.php'; ?>

		</aside>
		<!-- /aside -->

			</div>
		</div>
	</main>
	<!-- /main -->