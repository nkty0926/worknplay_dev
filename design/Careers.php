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

			<h3 class="mb-3">Careers at TheWorknPlay</h3>

			<!-- .row -->
			<div class="row mb-n3">
				<div class="col-lg-12">
					<article class="mb-3">
						<p>Our vision is to become a language-based global recruiting platform, starting in South Korea and expanding throughout Asia to connect professionals with great careers.</p>
						<p>We are currently looking for talented people who will work with us to share our passion and vision.</p>
						<figure class="mb-0">
							<img class="img-fluid" src="/assets/images/design/aboutus-01.jpg" alt="" />
						</figure>
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

			<h3 class="mb-4">Our Positions</h3>

			<!-- .row -->
			<div class="row mb-n4">
				<div class="col-lg-5 mb-4">
					<article class="card bg-white h-100 mb-0">
						<div class="card-body p-3 p-md-4">
							<h4>Volunteer Editor - Remote</h4>
							<p>If you enjoy creating content and copywriting, then this is perfect for you! Help us build company profiles on our site, write blogs, and suggest marketing ideas to promote TheWorknPlay website.</p>
							<a class="btn btn-light bg-white" href="javascript:void(0);">Learn More</a>
						</div>
					</article>
				</div>
				<div class="col-lg-5 mb-4">
					<article class="card bg-white h-100 mb-0">
						<div class="card-body p-3 p-md-4">
							<h4>China - Remote Intern</h4>
							<p>We are looking for a candidate who can translate written Simplified Chinese and spoken Mandarin to English and build B2B connections with schools and organizations in Mainland China.</p>
							<a class="btn btn-light bg-white" href="javascript:void(0);">Learn More</a>
						</div>
					</article>
				</div>
				<div class="col-lg-5 mb-4">
					<article class="card bg-white h-100 mb-0">
						<div class="card-body p-3 p-md-4">
							<h4>Vietnam - Remote Intern</h4>
							<p>We are looking for a candidate who can translate written and spoken Vietnamese to English and build B2B connections with schools and organizations in Vietnam.</p>
							<a class="btn btn-light bg-white" href="javascript:void(0);">Learn More</a>
						</div>
					</article>
				</div>
			</div>

		</div>
	</section>
	<!-- /section -->

	<!-- section -->
	<section class="py-4 py-md-5 px-1 bg-white">
		<div class="container text-left">

			<!-- .row -->
			<div class="row mb-n3">
				<div class="col-lg-12">
					<article class="mb-3">
						<p>Have questions or want to learn more?
						<br />Get in touch!</p>
						<strong>Email: </strong>
						<a href="mailto:theworknplay@gmail.com">theworknplay@gmail.com</a>
					</article>
				</div>
			</div>
			<!-- /.row -->

		</div>
	</section>
	<!-- /section -->

<?php include_once '../pages/common/footer.php'; ?>