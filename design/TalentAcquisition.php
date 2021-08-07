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
		<div class="container text-center">

			<div class="row justify-content-center mb-4 mb-md-5">
				<div class="col-md-8">
					<div class="row justify-content-center mb-3">
						<div class="col-md-11">
					<h3 class="mb-0">Global Talent Acquisition with TheWorknPlay</h3>
						</div>
					</div>
					<p class="mb-0">We help you focus on your business by providing you with qualified candidates that are looking for a long-term employment.</p>
				</div>
			</div>

			<!-- .row -->
			<div class="row mb-n4 mb-md-0">
				<div class="col-md-4 mb-5 mb-md-4">
					<article class="img-shadow border h-100 px-2 py-3 py-md-4 mb-0">
						<img class="img-fluid mb-3" src="/assets/images/design/talentacquisition-01.png" alt="" style="width:128px;" />
						<h4>Candidate Management</h4>
						<p class="mb-0">Choose from a global talent pool filled with potential candidates who understand your school or organization.</p>
					</article>
				</div>
				<div class="col-md-4 mb-5 mb-md-4">
					<article class="img-shadow border h-100 px-2 py-3 py-md-4 mb-0">
						<img class="img-fluid mb-3" src="/assets/images/design/talentacquisition-02.png" alt="" style="width:128px;" />
						<h4>Qualified Candidates</h4>
						<p class="mb-0">We screen and interview qualified candidates and only recommend professionals that fit your school or organization.</p>
					</article>
				</div>
				<div class="col-md-4 mb-5 mb-md-4">
					<article class="img-shadow border h-100 px-2 py-3 py-md-4 mb-0">
						<img class="img-fluid mb-3" src="/assets/images/design/talentacquisition-03.png" alt="" style="width:128px;" />
						<h4>Long-term Hiring</h4>
						<p class="mb-0">We provide customized branding services and solutions to help you attract candidates who are looking for long-term employment.</p>
					</article>
				</div>
			</div>
			<!-- /.row -->

		</div>
	</section>
	<!-- /section -->

	<!-- section -->
	<section class="py-4 py-md-5 px-1 bg-light">
		<div class="container text-left">

			<h3 class="text-center mb-4 mb-md-5">TheWorknPlay Talent Acquisition</h3>

			<!-- .row -->
			<div class="row flex-sm-row-reverse mb-n4">
				<div class="col-lg-4">
					<img class="img-fluid mb-4" src="/assets/images/design/talentacquisition-04.jpg" alt="" />
				</div>
				<div class="col-lg-8">
					<article class="mb-4">
						<h6 class="font-weight-bold mb-3">Talent Acquisition Overview</h6>
						<p>Our talent acquisition services save you time and effort and overcome language barriers that make it difficult to hire global professionals.</p>
						<h6 class="font-weight-bold mb-3">Short-term and Long-term Hiring</h6>
						<p>We create a talent acquisition process based on your school or organization’s needs and values.</p>
						<ul>
							<li>Receive consultation regarding a short-term or annual recruitment strategy, a customized company profile, and marketing plan</li>
							<li>We help you create a company profile (branding)</li>
							<li>Job posts will be uploaded to global job sites and marketed on SNS platforms</li>
							<li>Choose candidates from a global talent pool</li>
							<li>We screen, interview, and recommend qualified candidates that fit the position requirements</li>
							<li>We support candidates within our community for long-term growth at your school or organization.</li>
						</ul>
						<h6 class="font-weight-bold mb-3">Successful Talent Acquisition Placement Fee</h6>
						<p>We only charge a flat-rate, low fee once a candidate has been successfully hired.</p>
						
						<p>Our rates differs <strong> depending on the consultation process.</strong> </p>
						<a class="btn btn-primary" href="#talentacquisition" role="button" data-toggle="collapse" aria-controls="talentacquisition" aria-expanded="true">Begin Talent Acquisition</a>
					</article>
				</div>
			</div>
			<!-- /.row -->

			<!-- .row -->
			<div class="row collapse" id="talentacquisition">
				<div class="col-lg-12">
					<hr class="my-4" />
				</div>
				<div class="col-lg-4">
					<img class="img-fluid mb-4 mb-lg-0" src="/assets/images/design/talentacquisition-05.jpg" alt="" />
				</div>
				<div class="col-lg-8">
					<article class="mb-0">
						<h6 class="font-weight-bold mb-3">Why You Should Choose TheWorknPlay Talent Acquisition Service</h6>
						<p>We strive to meet the needs of schools and organizations as they continue to grow. Invest in talent acquisition for long-term growth. Let our experienced consultants help you find the right candidates!</p>
						<ul class="mb-0">
							<li>WnP candidates are more prepared and qualified</li>
							<li>WnP candidates are looking for long-term careers</li>
						</ul>
					</article>
				</div>
			</div>
			<!-- /.row -->

		</div>
	</section>
	<!-- /section -->

	<!-- section -->
	<section class="py-4 py-md-5 px-1 bg-white">
		<div class="container text-center">

			<h3 class="text-center mb-3 mb-md-4">Client Testimonials</h3>

			<!-- .row -->
			<div class="row justify-content-center">
				<div class="col-md-8 col-lg-6">
					<!-- .carousel -->
					<div class="carousel slide" id="testimonialsCarousel" data-ride="carousel">
						<div class="carousel-inner">
							<div class="carousel-item active">
								<div class="row justify-content-center">
									<div class="col-md-10 col-lg-8">
								<img class="img-fluid img-shadow" src="/assets/images/design/talentacquisition-06.jpg" alt="" />
									</div>
								</div>
								<p>“TheWorknPlay helped us hire qualified teachers and we were able to develop our business more quickly because we saved time and money.”</p>
								<h6 class="mb-0">Tristan Kim<br />Mentor21 CEO</h6>
							</div>
							<div class="carousel-item">
								<div class="row justify-content-center">
									<div class="col-md-10 col-lg-8">
								<img class="img-fluid img-shadow" src="/assets/images/design/talentacquisition-07.jpg" alt="" />
									</div>
								</div>
								<p>“Finding translators who can convey messages correctly is difficult, but through TheWorknPlay we were able to find several bilingual translators who translated text effectively.”</p>
								<h6 class="mb-0">Song Mun Heon<br />QMC Vice President</h6>
							</div>
						</div>
					</div>
					<!-- /.carousel -->
				</div>
			</div>
			<!-- /.row -->

		</div>
	</section>
	<!-- /section -->

	<!-- section -->
	<section class="py-4 py-md-5 px-1 bg-light">
		<div class="container text-center">

			<!-- .row -->
			<div class="row justify-content-center">
				<div class="col-md-9">
					<div class="row justify-content-center mb-3">
						<div class="col-md-10">
					<h3 class="mb-0">Ready to begin Talent Acquisition?</h3>
						</div>
					</div>
					<div class="row justify-content-center">
						<div class="col-8 col-md-3">
					<a class="btn btn-primary btn-block" href="javascript:void(0);">Get Started</a>
						</div>
					</div>
				</div>
			</div>
			<!-- /.row -->

		</div>
	</section>
	<!-- /section -->

<?php include_once '../pages/common/footer.php'; ?>