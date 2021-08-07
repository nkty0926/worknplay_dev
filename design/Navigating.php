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

			<h3 class="text-center mb-4 mb-md-5">Navigating TheWorknPlay</h3>

			<!-- .row -->
			<div class="row flex-md-row-reverse">
				<div class="col-md-6 col-lg-3">
					<img class="img-fluid img-shadow" src="/assets/images/design/navigating-01.jpg" alt="" />
				</div>
				<div class="col-md-6 col-lg-9">
					<p>Looking for your next career or teacher certification course? While we specialize mainly in ESL teaching jobs, we also provide job seekers with employment opportunities in other industries. With hundreds of teaching and learning opportunities, you’re sure to find the right one for you!</p>
					<p>When you’re looking for that teaching position in Seoul, TEFL certification in Vietnam, or guides on your career or living abroad, come visit us because we’ve got you covered. Through TheWorknPlay, you will be able to seek employment in any country and any industry!</p>
					<ul class="list-unstyled font-weight-bold mb-0">
						<li class="mb-1">Part 1: Opportunities</li>
						<li class="mb-1">Part 2: Uplaoding a Resume</li>
						<li class="mb-1">Part 3: Applying for Jobs</li>
						<li class="mb-1">Part 4: Resources and Guides</li>
					</ul>
				</div>
			</div>
			<!-- /.row -->

		</div>
	</section>
	<!-- /section -->

	<!-- section -->
	<section class="py-4 py-md-5 px-1 bg-light">
		<div class="container text-center">

			<h4 class="mb-3 mb-md-4">A Teacher’s Perspective</h4>
			<p>“When I first considered moving to Korea to teach English, I found the prospect of working long hours surrounded by young children a little daunting. I wasn’t sure what to expect, and I was worried that my work and life balance whilst here would be unsustainable. Since arriving, however, I have been taken aback by how much I have enjoyed living in Korea. The work is enjoyable and I have found many things to do in my free time which have made my experience extremely worthwhile.”</p>
			<p class="mb-0"><strong>- Thomas Fairbrother, Kindergarten Teacher in Seoul</strong></p>

		</div>
	</section>
	<!-- /section -->

	<!-- section -->
	<section class="py-4 py-md-5 px-1 bg-white" id="part-1">
		<div class="container text-left">

			<!-- .row -->
			<div class="row mb-5">
				<div class="col-12">
					<ul class="nav nav-pills flex-wrap flex-md-nowrap justify-content-center mb-n3">
						<li class="nav-item mr-3 mb-3">
							<a class="nav-link" href="#part-1" onclick="$($(this).attr('href')).customScrollAnimate()">1: Opportunities</a>
						</li>
						<li class="nav-item mr-3 mb-3">
							<a class="nav-link" href="#part-2" onclick="$($(this).attr('href')).customScrollAnimate()">2: Uploading a Resume</a>
						</li>
						<li class="nav-item mr-3 mb-3">
							<a class="nav-link" href="#part-3" onclick="$($(this).attr('href')).customScrollAnimate()">3: Applying for Jobs</a>
						</li>
						<li class="nav-item mr-3 mb-3">
							<a class="nav-link" href="#part-4" onclick="$($(this).attr('href')).customScrollAnimate()">4: Resources and Guides</a>
						</li>
					</ul>
				</div>
			</div>
			<!-- /.row -->

			<!-- .row -->
			<div class="row">
				<div class="col-md-6 col-lg-3">
					<img class="img-fluid img-shadow-reverse" src="/assets/images/design/navigating-02.jpg" alt="" />
				</div>
				<div class="col-md-6 col-lg-9 mb-n3">
					<h4>Part 1. Opportunities</h4>
					<p>TheWorknPlay offers a variety of career opportunities including teaching positions at academies, international schools, and universities. No matter your experience or whether you’re looking for positions at home or abroad, we’ve got them all!</p>
					<p>If you’re looking for teacher certification, check out our TEFL/TESOL programs. Complete your course online or choose an immersive certification program in stunning cities like Barcelona, Spain or Hanoi, Vietnam.</p>
					<p>To get started, simply click Browse Jobs or TEFL/TESOL. Filter jobs and programs using keywords and/or locations. By creating an account, you can easily save your favorite job posts and TEFL/TESOL programs to compare, apply to, or review later.</p>
				</div>
			</div>
			<!-- /.row -->

		</div>
	</section>
	<!-- /section -->

	<!-- section -->
	<section class="py-4 py-md-5 px-1 bg-light" id="part-2">
		<div class="container text-left">

			<!-- .row -->
			<div class="row flex-md-row-reverse">
				<div class="col-12 mb-n3">
					<h4>Part 2. Uploading a Resume</h4>
					<p>Looking for that perfect job? The one that offers the most benefits in your desired location with an amazing work-life balance?</p>
					<p>We’re here to help you get it! The early bird gets the worm. Whether you’re looking for a job ASAP or 6 months down the road, the sooner you upload your resume, the better chance you have of landing the right job fit. Sign up, upload your resume, and let employers know what you’re looking for. By adding keywords about what you’re looking for, your exact start date, and your desired location, our smart matching program can find positions that align with all of your criteria.</p>
					<p>You’re already halfway to finding the right position! Since you’ve created your online resume, you can choose “Easy Apply” and send in your application with just a click or you can opt in to our free <a href="/design/JobFinder">Job Finder</a> service where we personally get to know you and recommend positions that align with your desires.</p>
				</div>
			</div>
			<!-- /.row -->

		</div>
	</section>
	<!-- /section -->

	<!-- section -->
	<section class="py-4 py-md-5 px-1 bg-white" id="part-3">
		<div class="container text-left">

			<!-- .row -->
			<div class="row flex-md-row-reverse">
				<div class="col-md-6 col-lg-3">
					<img class="img-fluid img-shadow" src="/assets/images/design/navigating-03.jpg" alt="" />
				</div>
				<div class="col-md-6 col-lg-9 mb-n3">
					<h4>Part 3. Applying for Jobs</h4>
					<p>If you’ve already made an account and added an online resume, you can apply for jobs using “Easy Apply.” Simply choose the resume you’d like to submit, add a cover letter, and press submit!</p>
					<p>If you haven’t made an account, simply choose “Apply Without Registration.” Fill out all of the fields, choose a file to upload, insert a cover letter, and submit.</p>
					<p>You can message employers directly using our built-in messenger service, and you can keep track of all your chats from your dashboard. If you want some help finding the right job, opt in to our <a href="/design/JobFinder">Job Finder</a> service!</p>
				</div>
			</div>
			<!-- /.row -->

		</div>
	</section>
	<!-- /section -->

	<!-- section -->
	<section class="py-4 py-md-5 px-1 bg-light" id="part-4">
		<div class="container text-left">

			<!-- .row -->
			<div class="row">
				<div class="col-12 mb-n3">
					<h4>Part 4. Resources and Guides</h4>
					<p>We’re here to support you throughout your journey at home or abroad. We seek to provide helpful and innovative resources for new and seasoned teachers, including lesson plans, worksheets, flashcards, and PowerPoints. We also offer accurate and up-to-date guides and articles on career growth, living abroad, and travel. Our in-house specialists are experienced in teaching and living abroad and are able to provide comprehensive and detailed information for teachers and travelers alike. Check out our latest articles <a href="/Blogs">here</a>.</p>
					<p>For first-time teachers interested in teaching abroad, it’s hard to find credible schools. We’re here to bridge the gap through blogs based on real-life interviews with current and previous teachers as well as school directors. Find your next school <a href="/Work/Search/Job">here</a>.</p>
				</div>
			</div>
			<!-- /.row -->

		</div>
	</section>
	<!-- /section -->

<?php include_once '../pages/common/footer.php'; ?>
