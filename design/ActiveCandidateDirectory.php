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
		<div class="container text-center">

			<h3 class="mb-3">TheWorknPlay Active Candidate Directory</h3>

			<!-- .row -->
			<div class="row justify-content-center">
				<div class="col-md-9">
					<img class="img-fluid img-shadow" src="/assets/images/design/activecandidatedirectory-01.jpg" alt="" />
					<div class="row justify-content-center">
						<div class="col-md-9">
					<h4>Get offers, even when you aren’t actively searching.</h4>
						</div>
					</div>
					<p class="mb-0">We understand that life can get very busy, and you might not always have extra time to search for a job. When you create online resume on our website, you will automatically add your resume to our active candidate directory. Employers and recruiters have access to this database, and they can search through the resumes of those who applied through our site.</p>
				</div>
			</div>
			<!-- /.row -->

		</div>
	</section>
	<!-- /section -->

	<!-- section -->
	<section class="py-4 py-md-5 px-1 bg-light">
		<div class="container text-center">

			<h3 class="mb-3">How the Active Candidate Directory Works</h3>

			<!-- .row -->
			<div class="row mb-n3 mb-md-n4">
				<div class="col-md-4 mb-3 mb-md-4">
					<article class="h-100 p-3 p-md-4">
						<img class="img-fluid mb-3" src="/assets/images/design/activecandidatedirectory-02.png" alt="" style="padding:5px 0;" />
						<h4>Upload Your Resume</h4>
						<p class="mb-0">Once you publish your online resume, it will be uploaded to our active candidate directory</p>
					</article>
				</div>
				<div class="col-md-4 mb-3 mb-md-4">
					<article class="h-100 p-3 p-md-4">
						<img class="img-fluid mb-3" src="/assets/images/design/activecandidatedirectory-03.png" alt="" style="padding:2px 0;" />
						<h4>Weekly Updates</h4>
						<p class="mb-0">Our team will send out weekly updates with new resumes to companies</p>
					</article>
				</div>
				<div class="col-md-4 mb-3 mb-md-4">
					<article class="h-100 p-3 p-md-4">
						<img class="img-fluid mb-3" src="/assets/images/design/activecandidatedirectory-04.png" alt="" />
						<h4>Companies Contact You</h4>
						<p class="mb-0">Companies can contact you through your information listed or through our Message Box</p>
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

			<h3 class="mb-4 mb-md-5">Why the Active Candidate Directory Works</h3>

			<!-- .row -->
			<div class="row justify-content-center mb-n5">
				<div class="col-md-5 col-lg-4 text-left mb-5">
					<article class="px-4 pr-lg-5 mb-n4">
						<p class="mb-4">You don’t always have time to be searching for a job.</p>
						<p class="mb-4">Messaging company after company can get tiresome.</p>
						<p class="mb-4">Your resume ends up at the bottom of the list over time.</p>
						<p class="mb-4">Companies that you are not interested in contact you.</p>
					</article>
				</div>
				<div class="col-md-5 col-lg-4 text-right mb-5">
					<article class="px-4 pl-lg-5 mb-n4">
						<p class="mb-4">Receive offers even when you’re not actively searching.</p>
						<p class="mb-4">Companies and recruiters can contact you directly.</p>
						<p class="mb-4">We send your resume in weekly emails to employers.</p>
						<p class="mb-4">Hide your contact info and receive messages via our site.</p>
					</article>
				</div>
			</div>
			<!-- /.row -->

		</div>
	</section>
	<!-- /section -->

	<!-- section -->
	<section class="py-4 py-md-5 px-1 bg-light">
		<div class="container text-center">

			<h3 class="mb-4 mb-md-5">The Active Candidate Directory FAQ</h3>

			<!-- .row -->
			<div class="row text-left mb-n4" id="faq-group">
				<div class="col-md-6">
					<article class="px-3 pb-4">
						<h6 class="position-relative p-3 pr-5 mb-3">
							<a class="stretched-link" data-toggle="collapse" data-target="#faq-1" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle faq-1">
								<i class="fas fa-plus float-right"></i>
								<span>Can I join the Active Candidate Directory and search for jobs at the same time?</span>
							</a>
						</h6>
						<p class="px-3 mb-0 collapse" id="faq-1">Yes, you can still search and apply for jobs. We simply help you get seen by employers as we send out your resume to our partner companies.</p>
					</article>
				</div>
				<div class="col-md-6">
					<article class="px-3 pb-4">
						<h6 class="position-relative p-3 pr-5 mb-3">
							<a class="stretched-link" data-toggle="collapse" data-target="#faq-2" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle faq-2">
								<i class="fas fa-plus float-right"></i>
								<span>When can I expect to hear from companies regarding interviews?</span>
							</a>
						</h6>
						<p class="px-3 mb-0 collapse" id="faq-2">Depending on the hiring timeline of the company, you may start receiving offers immediately or within a few weeks. For candidates who are abroad, companies may contact you months before the start date so you can get your visa documents in order.</p>
					</article>
				</div>
				<div class="col-md-6">
					<article class="px-3 pb-4">
						<h6 class="position-relative p-3 pr-5 mb-3">
							<a class="stretched-link" data-toggle="collapse" data-target="#faq-3" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle faq-3">
								<i class="fas fa-plus float-right"></i>
								<span>How is my contact information used for the Active Candidate Directory?</span>
							</a>
						</h6>
						<p class="px-3 mb-0 collapse" id="faq-3">Only the contact information that you have provided in your profile will be visible to employers. You can change these settings at any time by logging into your account.</p>
					</article>
				</div>
				<div class="col-md-6">
					<article class="px-3 pb-4">
						<h6 class="position-relative p-3 pr-5 mb-3">
							<a class="stretched-link" data-toggle="collapse" data-target="#faq-4" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle faq-4">
								<i class="fas fa-plus float-right"></i>
								<span>Do I have to pay for the Active Candidate Directory?</span>
							</a>
						</h6>
						<p class="px-3 mb-0 collapse" id="faq-4">No, the Active Candidate Directory is a completely free service with no fees or hidden payments.</p>
					</article>
				</div>
				<style>#faq-group h6{border-bottom:2px solid var(--primary-dark);}#faq-group h6>a>i{margin-right:-2rem;color:var(--primary-dark);}</style>
			</div>
			<!-- /.row -->

		</div>
	</section>
	<!-- /section -->

	<!-- section -->
	<section class="py-4 py-md-5 px-1 bg-white">
		<div class="container text-center">

			<!-- .row -->
			<div class="row justify-content-center">
				<div class="col-md-9">
					<div class="row justify-content-center">
						<div class="col-md-9">
					<h4>Ready to get started?</h4>
						</div>
					</div>
					<br />
					<a class="btn btn-primary" href="/Work/Edit/<?= isset($resume_profile['publ']) && !empty($resume_profile['publ'])?'Resume/_NEW':'ResumeProfile?next=_NEW' ?>">Upload a Resume</a>
				</div>
			</div>
			<!-- /.row -->

		</div>
	</section>
	<!-- /section -->

<?php include_once '../pages/common/footer.php'; ?>