<?php

require_once '../classes/Worknplay.php';
$WP = new Worknplay();
$PAGE['title'] = str_replace('.php', '', str_replace('/design/', '', $_SERVER['PHP_SELF']));
$CONF['email_hr'] = 'worknplayhr@gmail.com';
include_once '../pages/common/header.php';
include_once '../pages/3000_Work/3000_Work_header.php';

?>
    <link rel="stylesheet" type="text/css" href="/assets/css/worknplay.design.css?date=<?= date('ymdHis', strtotime('now+9hours')) ?>" />

	<!-- section -->
	<section class="py-4 py-md-5 px-1 bg-white">
		<div class="container text-left">

			<!-- .row -->
			<div class="row">
				<div class="col-md-5 pt-md-5 mb-4 mb-md-0">

			<h3>TEFL/TESOL and CELTA</h3>
			<p>Become a certified teacher to teach English at home or abroad.</p>

			<!-- form#headerSearch -->
			<form class="needs-validation" id="headerSearch" method="get" action="">
				<div class="form-group input-group">
					<label class="input-group-prepend mb-0" for="searchKeyword">
						<span class="input-group-text bg-white text-black-50 border-right-0"><i class="fa fa-fw fa-search"></i></span>
					</label>
					<input type="text" class="form-control border-left-0 bg-white" id="searchKeyword" name="keyword" value="" placeholder="Keyword" disabled />
				</div>
				<div class="form-group input-group">
					<label class="input-group-prepend mb-0" for="searchLocation">
						<span class="input-group-text bg-white text-black-50 border-right-0"><i class="fa fa-fw fa-map-marker-alt"></i></span>
					</label>
					<select class="form-control custom-select border-left-0 bg-white" id="searchLocation" name="location_country[]" disabled>
						<option value="">Location</option>

					</select>
				</div>
				<div class="form-group mb-0">
					<a class="btn btn-primary px-4" href="javascript:void(0);">Search</a>
				</div>
				<style>#headerSearch .input-group{box-shadow:0 .25rem .5rem rgba(0,0,0,.15);}#headerSearch .input-group:focus-within{box-shadow:0 0 0 0.1rem var(--primary);}</style>
				<script defer>$('#headerSearch [data-action]').on('click', function(){ $('#headerSearch').attr('action', $(this).data('action')); });</script>
			</form>
			<!-- /form#headerSearch -->

				</div>
				<div class="col-md-1"></div>
				<div class="col-md-6">
					<img class="img-fluid img-shadow" src="/assets/images/design/tefltesol/girlteachingchild.jpg" alt="" />
				</div>
			</div>
			<!-- /.row -->

		</div>
	</section>
	<!-- /section -->

	<!-- section -->
	<section class="py-4 py-md-5 px-1 bg-light">
		<div class="container text-center">

			<h3 class="mb-4 mb-md-5">Browse Teacher Certification Courses</h3>

			<!-- .row -->
			<div class="row mb-n4 mb-md-0">
				<div class="col-md-4 mb-5 mb-md-4">
					<article class="img-shadow border bg-white h-100 p-3 p-md-4 mb-0">
						<img class="img-fluid mb-3" src="/assets/images/design/tefltesol/diploma.png" alt="" style="padding:7.5px 0;" />
						<div class="row justify-content-center">
							<div class="col-md-9">
						<h4>TEFL/TESOL</h4>
						<p>Get certified to teach ESL/EFL at home or abroad</p>
						<a class="btn btn-primary" href="javascript:void(0);">Browse</a>
							</div>
						</div>
					</article>
				</div>
				<div class="col-md-4 mb-5 mb-md-4">
					<article class="img-shadow border bg-white h-100 p-3 p-md-4 mb-0">
						<img class="img-fluid mb-3" src="/assets/images/design/tefltesol/certificate.png" alt="" />
						<div class="row justify-content-center">
							<div class="col-md-9">
						<h4>CELTA</h4>
						<p>Become certified to teach English to adults</p>
						<a class="btn btn-primary" href="javascript:void(0);">Browse</a>
							</div>
						</div>
					</article>
				</div>
				<div class="col-md-4 mb-5 mb-md-4">
					<article class="img-shadow border bg-white h-100 p-3 p-md-4 mb-0">
						<img class="img-fluid mb-3" src="/assets/images/design/tefltesol/online-learning.png" alt="" style="padding:5px 0;" />
						<div class="row justify-content-center">
							<div class="col-md-9">
						<h4>Online Courses</h4>
						<p>Earn your certification at your convenience</p>
						<a class="btn btn-primary" href="javascript:void(0);">Browse</a>
							</div>
						</div>
					</article>
				</div>
			</div>
			<!-- /.row -->

		</div>
	</section>
	<!-- /section -->

	<!-- section -->
	<section class="py-4 py-md-5 px-1 bg-white">
		<div class="container text-left">

			<!-- .row -->
			<div class="row">
				<div class="col-md-6 col-lg-3">
					<img class="img-fluid img-shadow-reverse" src="/assets/images/design/tefltesol/workingonlaptop.jpg" alt="" />
				</div>
				<div class="col-md-6 col-lg-9">
					<h4 style="color:var(--primary-dark);">Teacher Certification Guide</h4>
					<p>“Want to teach English but don’t know where to start? Learn more about TEFL, TESOL, and CELTA and how you can get started and become a certified teacher to teach English to students of all ages at home or abroad.”</p>
					<p>-Lindsey Byars</p>
					<a class="btn btn-primary" href="/design/TeacherCertification">Read More!</a>
				</div>
			</div>
			<!-- /.row -->

		</div>
	</section>
	<!-- /section -->

	<!-- section -->
	<section class="py-4 py-md-5 px-1 bg-light">
		<div class="container text-center">

			<h3 class="mb-4 mb-md-5">Our Certification Partners</h3>

			<!-- .row -->
			<div class="row mb-n4">
				<div class="col-md-3 mb-4">
					<img class="img-fluid img-shadow" src="/assets/images/design/tefltesol/ittt.png" alt="" />
				</div>
				<div class="col-md-3 mb-4">
					<img class="img-fluid img-shadow" src="/assets/images/design/tefltesol/itoi.png" alt="" />
				</div>
				<div class="col-md-3 mb-4">
					<img class="img-fluid img-shadow" src="/assets/images/design/tefltesol/bridge.png" alt="" />
				</div>
				<div class="col-md-3 mb-4">
					<img class="img-fluid img-shadow" src="/assets/images/design/tefltesol/tta.png" alt="" />
				</div>
			</div>
			<!-- /.row -->

		</div>
	</section>
	<!-- /section -->

	<!-- section -->
	<section class="py-4 py-md-5 px-1 bg-white">
		<div class="container text-center">

			<h3 class="mb-3">Course Accreditation</h3>

			<div class="row justify-content-center mb-4 mb-md-5">
				<div class="col-md-9">
					<p class="mb-0">All of our certification partners are accredited, so you will be able to apply for positions anywhere!</p>
				</div>
			</div>

			<!-- .row -->
			<div class="row justify-content-center">
				<div class="col-md-10">
			<div class="row mb-n4">
				<div class="col-12 col-md mb-4">
					<img class="img-fluid" src="/assets/images/design/tefltesol/ace.png" alt="" />
				</div>
				<div class="col-12 col-md mb-4">
					<img class="img-fluid" src="/assets/images/design/tefltesol/aqc-logo.png" alt="" />
				</div>
				<div class="col-12 col-md mb-4">
					<img class="img-fluid" src="/assets/images/design/tefltesol/aqueduto-logo.png" alt="" />
				</div>
				<div class="col-12 col-md mb-4">
					<img class="img-fluid" src="/assets/images/design/tefltesol/qualifi-logo.png" alt="" />
				</div>
				<div class="col-12 col-md mb-4">
					<img class="img-fluid" src="/assets/images/design/tefltesol/deac.png" alt="" />
				</div>
			</div>
				</div>
			</div>
			<!-- /.row -->

		</div>
	</section>
	<!-- /section -->

	<!-- section -->
	<section class="py-4 py-md-5 px-1 bg-light">
		<div class="container text-center">

			<h3 class="mb-3">Get Certified Abroad</h3>

			<div class="row justify-content-center mb-4 mb-md-5">
				<div class="col-md-5">
					<p class="mb-0">Why take an online course when you can instead get certified abroad and experience hands-on teaching?</p>
				</div>
			</div>

			<!-- .row -->
			<div class="row justify-content-center">
				<div class="col-md-10">
			<div class="row mb-n4">
				<div class="col-12 col-md mb-4">
					<img class="img-fluid" src="/assets/images/design/tefltesol/Thailand.png" alt="" />
					<h4 class="mb-0" style="color:var(--primary-dark);">Thailand</h4>
				</div>
				<div class="col-12 col-md mb-4">
					<img class="img-fluid" src="/assets/images/design/tefltesol/Vietnam.png" alt="" />
					<h4 class="mb-0" style="color:var(--primary-dark);">Vietnam</h4>
				</div>
				<div class="col-12 col-md mb-4">
					<img class="img-fluid" src="/assets/images/design/tefltesol/South Korea.png" alt="" />
					<h4 class="mb-0" style="color:var(--primary-dark);">South Korea</h4>
				</div>
			</div>
				</div>
			</div>
			<!-- /.row -->

		</div>
	</section>
	<!-- /section -->

<?php include_once '../pages/common/footer.php'; ?>