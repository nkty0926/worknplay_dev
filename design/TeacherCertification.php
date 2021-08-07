<?php

require_once '../classes/Worknplay.php';
$WP = new Worknplay();
require_once '../classes/Database.php';
$DB = new Database();
$PAGE['title'] = str_replace('.php', '', str_replace('/design/', '', $_SERVER['PHP_SELF']));
$CONF['email_hr'] = 'worknplayhr@gmail.com';
include_once '../pages/common/header.php';
include_once '../pages/3000_Work/3000_Work_header.php';

$resume_profile = $DB->selectWorkResumeProfile();

?>
    <link rel="stylesheet" type="text/css" href="/assets/css/worknplay.design.css?date=<?= date('ymdHis', strtotime('now+9hours')) ?>" />

	<!-- section -->
	<section class="py-4 py-md-5 px-1 bg-white">
		<div class="container text-left">

			<h3 class="text-center mb-4 mb-md-5">Teacher Certification Guide</h3>

			<!-- .row -->
			<div class="row">
				<div class="col-md-6 col-lg-3">
					<img class="img-fluid img-shadow-reverse" src="/assets/images/design/teachercertification-01.jpg" alt="" />
				</div>
				<div class="col-md-6 col-lg-9">
					<p class="mt-n1">By: Lindsey Byars</p>
					<p>To teach English abroad, you only need to be from one of the seven native English-speaking countries: the U.S., Canada, the U.K., Ireland, New Zealand, Australia, or South Africa, have a bachelor’s degree from an accredited university, and a clear federal-level background check. Learn more about teaching English abroad <a href="/Blogs/Detail/Article/129">here</a>.</p>
					<p>An English teaching certification can help you secure a better position and higher pay. TEFL, TESOL, and CELTA are three certifications that can help you boost your teaching career.</p>
					<ul class="list-unstyled font-weight-bold mb-0">
						<li class="mb-1">Part 1. Why Should I Get Certified?</li>
						<li class="mb-1">Part 2. Teaching Certification Qualifications</li>
						<li class="mb-1">Part 3. Getting English Teacher Certification Abroad</li>
						<li class="mb-1">Part 4. Teaching Certification Overview</li>
						<li class="mb-1">Part 5. Finding the Right Teaching Certification Program</li>
						<li class="mb-1">Part 6. Finding a Teaching Job</li>
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
			<p>“Although I majored in English in university, I decided to get TEFL/TESOL-C (children) certification to be prepared to teach English abroad. While a TEFL/TESOL certification was not necessary, I qualified for better positions with higher pay. TEFL/TESOL taught me how to plan and how to teach young learners and taking those skills with me into the classroom helped me adjust to teaching quickly.”</p>
			<p class="mb-0"><strong>- April D., English Teacher in Gyeonggi-do</strong></p>

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
							<a class="nav-link" href="#part-3" onclick="$($(this).attr('href')).customScrollAnimate()">3: Abroad</a>
						</li>
						<li class="nav-item mr-3 mb-3">
							<a class="nav-link" href="#part-4" onclick="$($(this).attr('href')).customScrollAnimate()">4: Overview</a>
						</li>
						<li class="nav-item mr-3 mb-3">
							<a class="nav-link" href="#part-5" onclick="$($(this).attr('href')).customScrollAnimate()">5: The Right Program</a>
						</li>
						<li class="nav-item mr-3 mb-3">
							<a class="nav-link" href="#part-6" onclick="$($(this).attr('href')).customScrollAnimate()">6: Finding a Job</a>
						</li>
					</ul>
				</div>
			</div>
			<!-- /.row -->

			<!-- .row -->
			<div class="row">
				<div class="col-12 mb-n3">
					<h4>Part 1. Why Should I Get Certified?</h4>
					<p>Although you have the basic qualifications to teach English abroad, a teaching certification will help prepare you to teach English as a foreign language and help you stand out from the competition. Depending on the country you’d like to teach in, some require teacher certification. There are three main English teaching certifications that are recognized worldwide: TEFL, TESOL, and CELTA.</p>
					<p>TEFL is an acronym for Teaching English as a Foreign Language and is suggested for teachers who would like to teach English abroad.</p>
					<p>TESOL stands for Teaching English to Speakers of Other Languages and is recommended for teachers who wish to teach English in native and non-native English-speaking countries.</p>
					<p>TESOL also includes TESL, which refers to Teaching English as a Second Language, and is more beneficial for teachers who are interested in teaching English in native English-speaking countries.</p>
					<p>Overall, TEFL and TESOL can be used interchangeably and several institutions offer combined TEFL/TESOL certification. There are very slight differences in TEFL and TESOL certifications, and certification in either one is sufficient to secure a great teaching job abroad.</p>
					<p>CELTA stands for Certificate in English Language Teaching to Adults and was awarded by the Cambridge English Assessment. CELTA focuses on adult English-teaching strategies (hence, the name). However, unlike TEFL/TESOL courses that can be completed fully online, CELTA requires in-class ESL student teaching (practicum).</p>
					<p>Takeaway: TEFL/TESOL is the most common certification (and affordable) and makes you a valid teaching candidate around the world. While CELTA is a well-known and reputable certification, in reality, many English teaching positions abroad do not require a CELTA certificate unless specifically stated.</p>
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
					<img class="img-fluid img-shadow" src="/assets/images/design/teachercertification-02.jpg" alt="" />
				</div>
				<div class="col-md-6 col-lg-9 mb-n3">
					<h4>Part 2. Teaching Certification Requirements</h4>
					<p>Before you can begin your English teaching certification, there are only two requirements you must meet:</p>
					<ul class="list-checkmark">
						<li>You must be fluent in English.</li>
						<li>You must be over 18 years of age.</li>
					</ul>
					<p>You do not need to meet any other qualifications to begin your English teaching certification journey and it’s quite easy to begin.</p>
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
			<div class="row">
				<div class="col-12 mb-n3">
					<h4>Part 3. Getting English Teacher Certification Abroad</h4>
					<p>Why not get certified while immersed in another country and culture? If you’re looking for real hands-on English teaching practice, you should check out getting certified in other countries such as Thailand, Vietnam, or South Korea! These programs are usually around two to four weeks and students finish the course with an English teaching certification as well as hands-on teaching experience.</p>
					<p>Should you choose to get certified abroad, these programs also include visa and pre-arrival assistance, accommodation, meals, and local activities. You may also get the chance to take some language and cultural training classes with other students. Some programs also include help with making resumes, finding teaching positions, and providing interview practice. Check out getting certified abroad <a href="/design/TeflTesol#Tefl">here</a>.</p>
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
				<div class="col-md-6 col-lg-3">
					<img class="img-fluid img-shadow-reverse" src="/assets/images/design/teachercertification-03.jpg" alt="" />
				</div>
				<div class="col-md-6 col-lg-9 mb-n3">
					<h4>Part 4. Teaching Certification Overview</h4>
					<p>No matter what course you take, you will be completing modules which usually include reading, videos, and module tests. Near the end of the course, you will be asked to submit lesson plans for review and complete one final test that covers everything you’ve learned. Depending on the program you have chosen, you may receive feedback regarding the lesson plans you have made and suggested revisions. Those who choose in-class teaching certification courses may also be required to teach mock classes or actual ESL students.</p>
					<p>Overall, a general 120-hour English teaching certification course may take anywhere from a couple of weeks to a few months depending on how often and how much you work on it. Some online programs only allow access to the course materials for up to six months, so before you get started, be sure to look for courses that match your timeline.</p>
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
				<div class="col-12 mb-n3">
					<h4>Part 5. Finding the Right Teaching Certification Program</h4>
					<p>Finding the right program for you is not difficult. Here are some things you should consider when you begin your online English certification search.</p>
					<h6>1. Online or in-person</h6>
					<p>There is an abundance of courses offered online and in-person, but online classes are most common since they are affordable and flexible. Some programs offer a mix of both online and offline, so you can find the right one that meets your needs and timeline.</p>
					<h6>2. Course length</h6>
					<p>While course lengths vary, the standard English certification length is 120 hours. Those who are looking to teach English abroad should keep in mind that most English teaching positions require a minimum of 120 hours. You can also choose to take longer, more in-depth courses with teaching concentrations, such as young learner certification or business English.</p>
					<h6>3. Course accreditation</h6>
					<p>False advertising of ‘internationally recognized’ certifications may cost you time and money. Exercise caution and look for accreditation by one of the major accreditation bodies: Cambridge University, Trinity College London, IATQUO, OTTSA, TQUK, ODLQC, ALTE, English Profile, QuiTE, NCFE, ACCET, IATEFL, and ACTDEC. At TheWorknPlay, we make sure that all of our certification programs are accredited, so you don’t have to worry. Take a look at them here. </p>
					<h6>4. Timing</h6>
					<p>Depending on your course length and if you choose to take an online or in-person class, it can take anywhere from one to six months to complete, so plan accordingly if you are looking to move abroad.</p>
				</div>
			</div>
			<!-- /.row -->

		</div>
	</section>
	<!-- /section -->

	<!-- section -->
	<section class="py-4 py-md-5 px-1 bg-light" id="part-6">
		<div class="container text-left">

			<!-- .row -->
			<div class="row">
				<div class="col-md-6 col-lg-3">
					<img class="img-fluid img-shadow-reverse" src="/assets/images/design/teachercertification-04.jpg" alt="" />
				</div>
				<div class="col-md-6 col-lg-9 mb-n3">
					<h4>Part 6. Finding a Teaching Job</h4>
					<p>Once you have completed your teacher training certification, you will receive an online PDF or a physical copy of the certificate. It will never expire and you can begin your teaching journey, whether it be in your own country or abroad!</p>
					<p>Check out our <a href="/Work/Search/Job">job board</a> where you can find a variety of teaching positions abroad. You can apply directly to jobs or you can upload your resume so employers and recruiters can contact you directly. Learn more about uploading your resume <a href="/Work/Edit/<?= isset($resume_profile['publ']) && !empty($resume_profile['publ'])?'Resume/_NEW':'ResumeProfile?next=_NEW' ?>">here</a>.</p>
					<p>Finally, join our free Match-Up service, where we match you to positions and schools for free based on your preferences. <a href="/design/JobFinder">Start finding matching positions today!</a></p>
				</div>
			</div>
			<!-- /.row -->

		</div>
	</section>
	<!-- /section -->

<?php include_once '../pages/common/footer.php'; ?>