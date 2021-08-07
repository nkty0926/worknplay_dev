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

			<h3 class="text-center mb-4 mb-md-5">The Ultimate Guide to Teaching English Abroad</h3>

			<!-- .row -->
			<div class="row">
				<div class="col-md-6 col-lg-3">
					<img class="img-fluid img-shadow-reverse" src="/assets/images/design/teaching-01.jpg" alt="" />
				</div>
				<div class="col-md-6 col-lg-9">
					<p class="mt-n1">By: Andrea Watson</p>
					<p>Did you know that English is the official language of 53 countries and spoken by more than 400 million people around the world? As the most common second language in the world, English is a global language that is used to break down the barriers of communication.</p>
					<p>In many countries, English language skills open doors to new information and opportunities around the world and can change lives.</p>
					<ul class="list-unstyled font-weight-bold mb-0">
						<li class="mb-1">Part 1. Why Should I Teach English Abroad?</li>
						<li class="mb-1">Part 2. Am I Qualified?</li>
						<li class="mb-1">Part 3. Popular Teaching Destinations</li>
						<li class="mb-1">Part 4. Finding a Teaching Job</li>
						<li class="mb-1">Part 5. Setting Off on a Teaching Adventure</li>
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
			<p>“I’ve always loved working with kids and I knew I wanted to make a career out of teaching. I am currently working at an international school and I’ve enjoyed getting to know my students. Korea has allowed me to live independently and there are so many fun things to do here every weekend! I plan to continue to work in Korea and look forward to what’s in the future.”</p>
			<p class="mb-0"><strong>- Jenna L., ESL Teacher in Gyeonggi-do</strong></p>

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
							<a class="nav-link" href="#part-1" onclick="$($(this).attr('href')).customScrollAnimate()">1: Why</a>
						</li>
						<li class="nav-item mr-3 mb-3">
							<a class="nav-link" href="#part-2" onclick="$($(this).attr('href')).customScrollAnimate()">2: Qualifications</a>
						</li>
						<li class="nav-item mr-3 mb-3">
							<a class="nav-link" href="#part-3" onclick="$($(this).attr('href')).customScrollAnimate()">3: Destinations</a>
						</li>
						<li class="nav-item mr-3 mb-3">
							<a class="nav-link" href="#part-4" onclick="$($(this).attr('href')).customScrollAnimate()">4: Job Search</a>
						</li>
						<li class="nav-item mr-3 mb-3">
							<a class="nav-link" href="#part-5" onclick="$($(this).attr('href')).customScrollAnimate()">5: Setting Off</a>
						</li>
					</ul>
				</div>
			</div>
			<!-- /.row -->

			<!-- .row -->
			<div class="row">
				<div class="col-12 mb-n3">
					<h4>Part 1. Why Should I Teach English Abroad?</h4>
					<p>Teaching English abroad is a great way to gain experience, travel, and make money!</p>
					<h6>1. Experience</h6>
					<p>Not only will you gain international work experience to boost your career, but you’ll also be immersed in a new culture, learn new traditions, eat new food, and make new friends! After living abroad, you will gain a whole new worldview and appreciation for different cultures. You can also learn a new language! How cool is that?</p>
					<h6>2. Travel</h6>
					<p>Who doesn’t want to travel the world?! You have the chance to explore new places and make memories. Don’t wait to travel and just go! There’s a world to discover! Not everyone can say that they’ve been to see The Great Wall of China or the Taj Mahal.</p>
					<h6>3. Get Paid</h6>
					<p>While you may think that teaching English salaries are low, you will probably save more money teaching English abroad than in an entry-level position in your native country. In some countries, language institutions pay for flights, housing, and insurance to make your move across the world easier. Also, food in other countries is cheap and delicious, so you’ll be able to save a large chunk of money to take home (or travel more)!</p>
					<p>There is always a need for English teachers around the world and there are also a variety of settings in which you may work. You may choose to work at an international school, an academy, a boarding school, a kindergarten, a university, or even at companies teaching business English or interview prep courses. Just like around the globe, not all schools and institutions are the same. While all schools strive to provide the best English education, each school’s approach to teaching and learning is different. Some schools teach a variety of ages while others only teach a certain age range. If you’re an early-riser or a late-riser, don’t worry! There are schools that open early and schools that open late.</p>
					<p>If you have a teacher’s certificate, you may have a chance to teach math, science, world history, politics, art, or other subjects in English!</p>
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
				<div class="col-md-6 col-lg-3">
					<img class="img-fluid img-shadow" src="/assets/images/design/teaching-02.jpg" alt="" />
				</div>
				<div class="col-md-6 col-lg-9 mb-n3">
					<h4>Part 2. Am I Qualified?</h4>
					<ul class="list-checkmark">
						<li>Fluent in English</li>
						<li>Bachelor’s Degree</li>
					</ul>
					<p class="mt-3">You don’t need to be a native English speaker to be able to teach English! In fact, as long as you’re fluent, you can teach almost anywhere in the world. While some countries require a bachelor’s degree (in any field), there are many countries that prefer, but do not require a higher education degree, such as Cambodia, Argentina, Spain, and Egypt to name a few.</p>
					<p class="mt-3">If you would like to teach English abroad, having a TESOL/TEFL certification will qualify you for better jobs. In some countries, TESOL/TEFL certification is required, but you can become certified through an online course at your own pace or take an in-class certification course at locations across the globe. You can find out more about TESOL/TEFL certification <a href="/design/TeflTesol#Tefl">here</a>.</p>
				</div>
			</div>
			<!-- /.row -->

		</div>
	</section>
	<!-- /section -->

	<!-- section -->
	<section class="py-4 py-md-5 px-1 bg-white" id="part-3">
		<div class="container text-center">

			<h4 class="mb-3 mb-md-4">Part 3. Popular Teaching Destinations</h4>

			<!-- .row -->
			<div class="row">
				<div class="col-12 col-md">
					<img class="img-fluid" src="/assets/images/design/teaching-03.png" alt="" />
					<h6>China</h6>
				</div>
				<div class="col-12 col-md">
					<img class="img-fluid" src="/assets/images/design/teaching-04.png" alt="" />
					<h6>South Korea</h6>
				</div>
				<div class="col-12 col-md">
					<img class="img-fluid" src="/assets/images/design/teaching-05.png" alt="" />
					<h6>Taiwan</h6>
				</div>
				<div class="col-12 col-md">
					<img class="img-fluid" src="/assets/images/design/teaching-06.png" alt="" />
					<h6>Japan</h6>
				</div>
				<div class="col-12 col-md">
					<img class="img-fluid" src="/assets/images/design/teaching-07.png" alt="" />
					<h6>Vietnam</h6>
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
					<h4 class="mb-3">Part 4. Finding a Teaching Job</h4>
					<h6>The Search</h6>
					<p>If you would like assistance with your teaching journey, recruiters are a great resource and they are ready to help you find the right placement. Once you’ve applied to a recruiting service that will fit your needs, you will be put in contact with someone who can guide and suggest placements that you may be interested in. Your recruiter will find jobs that align with your desires and career-path as well as help you through the visa process and provide any assistance you may need. Recruitment agencies are free, as they receive commissions from their partner schools and institutions after placing teachers. Let us help you out!</p>
					<p>Whether or not you use a recruiting agency, always do your own research to better understand the job market for English teachers in the target country you would like to work in. A simple online search can help you know what positions are available and the average salary that is offered for the positions you are interested in. Connecting with people who have previous experience teaching English in your target country is also a great way to make contacts and gain resources.</p>
					<p>Once you have a target country in mind, start gathering information about the peak hiring times, the salary, the work-life balance, locations, and job boards. Don’t forget to thoroughly research the visa processes of that country, as some visas can take months to receive, so apply early!</p>
					<p>Finding a job on your own isn’t nearly as daunting as you may think! At TheWorknPlay, we’re here to help you make the right decision and we not only offer jobs, but recruitment and blogs wrtten by real teachers.</p>
					<h6>Securing a Position</h6>
					<p>Once you’ve heard back from an employer or a recruiter, it’s time to begin the interview stage. Before your interview, write down a list of questions you have about the job or the area for the employer. In most cases, you will have a video interview with the school, so it’s always a good idea to dress up.</p>
					<p>After the interview, if you decide that the school or the position isn’t for you, then don’t hesitate to decline and move onto other opportunities. However, if you decide that the position is a great fit for you, then take it! Read over the contract carefully, sign it, and then begin booking your flight.</p>
				</div>
			</div>
			<!-- /.row -->

		</div>
	</section>
	<!-- /section -->

	<!-- section -->
	<section class="py-4 py-md-5 px-1 bg-white" id="part-5">
		<div class="container text-left">

			<!-- .row -->
			<div class="row">
				<div class="col-md-6 col-lg-3">
					<img class="img-fluid img-shadow-reverse" src="/assets/images/design/teaching-08.jpg" alt="" />
				</div>
				<div class="col-md-6 col-lg-9 mb-n3">
					<h4 class="mb-3">Part 5. Seting Off on a Teaching Adventure</h4>
					<p>Wahoo! You’ve made it!</p>
					<p>It’s been a long journey, but you’re on your way to teach English abroad. Even as you set off on your journey, don’t forget to stay in touch with those you love and care about at home. Teaching won’t be easy, but it will be rewarding. Not only will you gain life-skills, but you’ll also have lasting memories of beautiful places and people. Maybe you’ll end up loving teaching and the excitement of living in another country. Or perhaps you’ll decide to continue teaching in the same country or move abroad again!</p>
					<p>Even if you decide to return home to your native country, the adventures and memories you’ve made will last a lifetime. Not only will you have quite a bit of money saved up but you’ll also become a top candidate for new career opportunities with your international experience.</p>
				</div>
			</div>
			<!-- /.row -->

		</div>
	</section>
	<!-- /section -->

<?php include_once '../pages/common/footer.php'; ?>