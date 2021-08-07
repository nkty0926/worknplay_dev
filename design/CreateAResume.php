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

			<div class="row justify-content-center mb-4 mb-md-5">
				<div class="col-md-9">
					<div class="row justify-content-center mb-3">
						<div class="col-md-10">
					<h3 class="mb-0">Find a Job at Home or Abroad</h3>
						</div>
					</div>
					<p class="mb-0">Your resume is the first thing that employers see and can be the determining factor to invite you to an interview or offer you a job.</p>
				</div>
			</div>

			<div class="row justify-content-center">
				<div class="col-md-9">
					<div class="row justify-content-center mb-3">
						<div class="col-md-10 col-lg-8">
					<img class="img-fluid" src="/assets/images/design/createaresume-01.png" alt="" />
						</div>
					</div>
					<div class="row justify-content-center">
						<div class="col-8 col-md-3">
					<a class="btn btn-primary btn-block" href="/Work/Edit/<?= isset($resume_profile['publ']) && !empty($resume_profile['publ'])?'Resume/_NEW':'ResumeProfile?next=_NEW' ?>">Upload a Resume</a>
						</div>
					</div>
				</div>
			</div>

		</div>
	</section>
	<!-- /section -->

	<!-- section -->
	<section class="py-4 py-md-5 px-1 bg-light">
		<div class="container text-center">

			<h3 class="text-center mb-4 mb-md-5">TheWorknPlay Job Seeker Services</h3>

			<!-- .row -->
			<div class="row mb-n4">
				<div class="col-md-4 mb-4">
					<article class="card bg-white h-100 mb-0">
						<div class="card-body p-3 p-md-4">
							<h4 style="min-height:2em;">Search &amp; Apply for Jobs</h4>
							<img class="img-fluid mb-3" src="/assets/images/design/createaresume-02.png" alt="" style="width:128px;" />
							<p class="mb-4">Find and filter jobs and apply directly with one click.</p>
							<div class="row justify-content-center">
								<div class="col-8">
							<a class="btn btn-light btn-block bg-white" href="/Work/Search/Job">Search Jobs</a>
								</div>
							</div>
						</div>
					</article>
				</div>
				<div class="col-md-4 mb-4">
					<article class="card bg-white h-100 mb-0">
						<div class="card-body p-3 p-md-4">
							<h4 style="min-height:2em;">Pro-Matching</h4>
							<img class="img-fluid mb-3" src="/assets/images/design/createaresume-03.png" alt="" style="width:128px;" />
							<p class="mb-4">WnP consultants recommend jobs based on your desires</p>
							<div class="row justify-content-center">
								<div class="col-8">
							<a class="btn btn-light btn-block bg-white" href="/design/JobFinder">Learn More</a>
								</div>
							</div>
						</div>
					</article>
				</div>
				<div class="col-md-4 mb-4">
					<article class="card bg-white h-100 mb-0">
						<div class="card-body p-3 p-md-4">
							<h4 style="min-height:2em;">Active Candidate Directory (ACD)</h4>
							<img class="img-fluid mb-3" src="/assets/images/design/createaresume-04.png" alt="" style="width:128px;" />
							<p class="mb-4">Employers and recruiters reach out to you with offers</p>
							<div class="row justify-content-center">
							<div class="col-8">
							<a class="btn btn-light btn-block bg-white" href="/design/ActiveCandidateDirectory">Learn More</a>
								</div>
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

			<h3 class="text-center mb-4 mb-md-5">TheWorknPlay’s Online Resumes</h3>

			<!-- .row -->
			<div class="row flex-sm-row-reverse mb-n4">
				<div class="col-lg-4">
					<img class="img-fluid mb-4" src="/assets/images/design/createaresume-05.jpg" alt="" />
				</div>
				<div class="col-lg-8">
					<article class="mb-4">
						<h6 class="font-weight-bold mb-3">Manage Your Resumes</h6>
						<p>Creating an online resume only takes 5 minutes and allows you to apply to jobs easier and faster.</p>
						<ul class="list-check">
							<li>Create a free resume which can be edited or deleted anytime or anywhere</li>
							<li>Make up to three free resumes. When applying to jobs, simply choose the corresponding resume</li>
							<li>Manage everything from your dashboard including job applications, saved companies, resume updates, and job alerts</li>
							<li>Choose to hide or show your contact information. You can also use our built-in messenger to connect with employers</li>
						</ul>
					</article>
					<article class="mb-4">
						<h6 class="font-weight-bold mb-3">Boost Your Resume</h6>
						<p>Improve your chances of getting hired by building a detailed online resume to highlight your qualifications and skills!</p>
						<a class="btn btn-primary" href="javascript:void(0);">Boost My Resume</a>
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

			<h3 class="text-center mb-4 mb-md-5">TheWorknPlay Pro-Matching</h3>

			<!-- .row -->
			<div class="row mb-n4">
				<div class="col-lg-4">
					<img class="img-fluid mb-4" src="/assets/images/design/createaresume-06.jpg" alt="" />
				</div>
				<div class="col-lg-8">
					<article class="mb-4">
						<p>Uncertain about your next career move? Struggling to find the right job that meets your expectations? Let TheWorknPlay’s experienced consultants help you find the right workplace for you.</p>
						<ul class="list-check">
							<li>Pro-Matching is free for life!</li>
						</ul>
						<a class="btn btn-primary" href="/design/JobFinder">Learn More</a>
					</article>
					<article class="mb-4">
						<ul class="list-check">
							<li>Tell us your job expectations and desires</li>
							<li>We provide detailed and accurate information about employers so you can make a well-informed decision</li>
							<li>We make you stand out and get more interviews by helping you boost your resume</li>
							<li>We negotiate with employers on your behalf</li>
						</ul>
						<a class="btn btn-primary" href="javascript:void(0);">Join Pro-Matching</a>
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

			<h3 class="text-center mb-4 mb-md-5">Active Candidate Directory (ACD)</h3>

			<!-- .row -->
			<div class="row flex-sm-row-reverse mb-n4">
				<div class="col-lg-4">
					<img class="img-fluid mb-4" src="/assets/images/design/createaresume-07.jpg" alt="" />
				</div>
				<div class="col-lg-8">
					<article class="mb-4">
						<p>Searching for jobs is time consuming. By creating an online resume, you will be added to our Active Candidate Directory (ACD), employers and recruiters will contact you directly regarding positions</p>
						<ul class="list-check">
							<li>Although you may not be actively searching for a job, employers and recruiters are always looking for qualified candidates.</li> 
							<li>Hide or show your contact information. Chat with employers via our built-in messenger at anytime.</li>
							<li>We send weekly emails to employers with resumes to get your application seen and get you hired!</li>
						</ul>
						<a class="btn btn-primary" href="/Work/Edit/<?= isset($resume_profile['publ']) && !empty($resume_profile['publ'])?'Resume/_NEW':'ResumeProfile?next=_NEW' ?>">Create an Online Resume</a>
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

			<h3 class="text-center mb-4 mb-md-5">Your Contact Information is Safe with Us</h3>

			<!-- .row -->
			<div class="row mb-n4">
				<div class="col-md-4 mb-4">
					<article class="card bg-white h-100 mb-0">
						<div class="card-body p-3 p-md-4">
							<img class="img-fluid mb-3" src="/assets/images/design/createaresume-08.png" alt="" style="width:128px;" />
							<h4>Account Security</h4>
							<p class="mb-0">Have complete control over who sees your resume and contact information</p>
						</div>
					</article>
				</div>
				<div class="col-md-4 mb-4">
					<article class="card bg-white h-100 mb-0">
						<div class="card-body p-3 p-md-4">
							<img class="img-fluid mb-3" src="/assets/images/design/createaresume-09.png" alt="" style="width:128px;" />
							<h4>Hide Your Information</h4>
							<p class="mb-0">Choose to show or hide your contact information on your online resume</p>
						</div>
					</article>
				</div>
				<div class="col-md-4 mb-4">
					<article class="card bg-white h-100 mb-0">
						<div class="card-body p-3 p-md-4">
							<img class="img-fluid mb-3" src="/assets/images/design/createaresume-10.png" alt="" style="width:128px;" />
							<h4>Built-in Messenger</h4>
							<p class="mb-0">Connect with employers and recruiters without showing your contact info</p>
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
		<div class="container text-center">

			<!-- .row -->
			<div class="row justify-content-center">
				<div class="col-md-9">
					<div class="row justify-content-center mb-3">
						<div class="col-md-10">
					<h3 class="mb-0">Upload Your Resume Today</h3>
						</div>
					</div>
					<div class="row justify-content-center">
						<div class="col-8 col-md-3">
					<a class="btn btn-primary btn-block" href="/Work/Edit/<?= isset($resume_profile['publ']) && !empty($resume_profile['publ'])?'Resume/_NEW':'ResumeProfile?next=_NEW' ?>">Create a Resume</a>
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
		<div class="container text-left">

			<div class="card bg-white">
				<div class="card-body">

			<!-- .row -->
			<div class="row mb-n4">
				<div class="col-md-4 mb-4">
					<figure class="mb-0">
						<img class="img-fluid img-shadow-sm w-100" src="/assets/images/design/createaresume-11.jpg" alt="" />
						<figcaption>
							<h6 class="mb-0">Build Your Online Resume</h6>
							<a class="font-weight-bold" href="/Blogs/Detail/Article/133">Read More</a>
						</figcaption>
					</figure>
				</div>
				<div class="col-md-4 mb-4">
					<figure class="mb-0">
						<img class="img-fluid img-shadow-sm w-100" src="/assets/images/design/createaresume-12.jpg" alt="" />
						<figcaption>
							<h6 class="mb-0">Active Candidate Directory</h6>
							<a class="font-weight-bold" href="/Blogs/Detail/Article/134">Read More</a>
						</figcaption>
					</figure>
				</div>
				<div class="col-md-4 mb-4">
					<figure class="mb-0">
						<img class="img-fluid img-shadow-sm w-100" src="/assets/images/design/createaresume-13.jpg" alt="" />
						<figcaption>
							<h6 class="mb-0">What is Pro-Matching?</h6>
							<a class="font-weight-bold" href="/Blogs/Detail/Article/132">Read More</a>
						</figcaption>
					</figure>
				</div>
			</div>
			<!-- /.row -->

				</div>
			</div>

		</div>
	</section>
	<!-- /section -->

<?php include_once '../pages/common/footer.php'; ?>