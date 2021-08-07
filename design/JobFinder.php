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
					<h3 class="mb-0">TheWorknPlay Pro-Matching</h3>
						</div>
					</div>
					<p class="mb-0">TheWorknPlay Pro-Matching is a free service where our consultants personally suggest jobs based on your interests and career goals. Not only do we have a large database of jobs, but we also have access to hidden jobs, which are positions that are not advertised on the job boards. 
</p>
				</div>
			</div>

			<div class="row justify-content-center">
				<div class="col-md-9">
					<div class="row justify-content-center mb-3">
						<div class="col-md-10 col-lg-8">
					<img class="img-fluid" src="/assets/images/design/jobfinder-01.jpg" alt="" />
						</div>
					</div>
					<div class="row justify-content-center">
						<div class="col-8 col-md-3">
					<a class="btn btn-primary btn-block" href="javascript:void(0);">Join Pro-Matching</a>
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

			<h3 class="text-center mb-4 mb-md-5">Why Pro-Matching</h3>

			<!-- .row -->
			<div class="row justify-content-center">
				<div class="col-md-10">
			<div class="row mb-n4">
				<div class="col-md-6 mb-4">
					<article class="card bg-white h-100 mb-0">
						<div class="card-body p-3 p-md-4">
							<h4>Employers</h4>
							<div class="row justify-content-center">
								<div class="col-8">
							<hr />
								</div>
							</div>
							<ul class="list-check mb-0">
								<li>Use a variety of methods to recruit and hire employees, not just job posts</li>
								<li>Actively scout for qualified candidates</li>
								<li>Want to invest in long-term employees</li>
							</ul>
						</div>
					</article>
				</div>
				<div class="col-md-6 mb-4">
					<article class="card bg-white h-100 mb-0">
						<div class="card-body p-3 p-md-4">
							<h4>Job Seekers</h4>
							<div class="row justify-content-center">
								<div class="col-8">
							<hr />
								</div>
							</div>
							<ul class="list-check mb-0">
								<li>Struggle to find a suitable position among hundreds of job posts</li>
								<li>Seek jobs that meets their requirements</li>
								<li>Increase a chance of finding a company they want to work for</li>
							</ul>
						</div>
					</article>
				</div>
			</div>
				</div>
			</div>
			<!-- /.row -->

		</div>
	</section>
	<!-- /section -->

	<!-- section -->
	<section class="py-4 py-md-5 px-1 bg-white">
		<div class="container text-center">

			<h3 class="text-center mb-4 mb-md-5">Who should join Pro-Matching</h3>

			<!-- .row -->
			<div class="row mb-n4 mb-md-0">
				<div class="col-md-12" style="margin-top:35px;"></div>
				<div class="col-md-3 mb-5 mb-md-4">
					<article class="img-shadow border h-100 px-2 py-3 py-md-4 mb-0">
						<img class="img-fluid mb-3" src="/assets/images/design/jobfinder-02t.png" alt="" style="width:96px;margin-top:-70px;padding:0 16px;background:white;" />
						<p class="mb-0">A recent or soon-to-be college graduate who is looking for adventures abroad</p>
					</article>
				</div>
				<div class="col-md-3 mb-5 mb-md-4">
					<article class="img-shadow border h-100 px-2 py-3 py-md-4 mb-0">
						<img class="img-fluid mb-3" src="/assets/images/design/jobfinder-03t.png" alt="" style="width:96px;margin-top:-70px;padding:0 16px;background:white;" />
						<p class="mb-0">Those who want to experience something new, but don’t know how or where to start</p>
					</article>
				</div>
				<div class="col-md-3 mb-5 mb-md-4">
					<article class="img-shadow border h-100 px-2 py-3 py-md-4 mb-0">
						<img class="img-fluid mb-3" src="/assets/images/design/jobfinder-04t.png" alt="" style="width:96px;margin-top:-70px;padding:0 16px;background:white;" />
						<p class="mb-0">Career changers who want to travel and gain experience in a new field</p>
					</article>
				</div>
				<div class="col-md-3 mb-5 mb-md-4">
					<article class="img-shadow border h-100 px-2 py-3 py-md-4 mb-0">
						<img class="img-fluid mb-3" src="/assets/images/design/jobfinder-02t.png" alt="" style="width:96px;margin-top:-70px;padding:0 16px;background:white;" />
						<p class="mb-0">Qualified and skilled professionals in specific fields in which jobs are hard to find</p>
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

			<h3 class="text-center mb-4 mb-md-5">The Pro-Matching Process</h3>

			<!-- .row -->
			<div class="row justify-content-center">
				<div class="col-md-5 mb-n4">
					<span style="position:absolute;width:1px;height:calc(100% - 1.5rem);background:var(--primary-dark);"></span>
					<article class="position-relative bg-white p-3 mb-4">
						<h4 class="mb-0">Join Pro-Matching</h4>
					</article>
					<article class="position-relative bg-white p-3 mb-4">
						<h4 class="mb-0">Consultant Review Your Resume </h4>
					</article>
					<article class="position-relative bg-white p-3 mb-4">
						<h4 class="mb-0"><a href="#process-3" role="button" data-toggle="collapse" aria-controls="process-3" aria-expanded="true">Consultants Get in Touch</a></h4>
						<div class="collapse" id="process-3">
							<div class="row justify-content-center">
								<div class="col-8">
							<hr />
								</div>
							</div>
							<ul class="text-left mb-0">
								<li>Discuss your job preferences, career goals, and how to improve your online resume</li>
								<li>Receive guideline and feedback on short self-introductory video that makes you stand out (optional)</li>
							</ul>
						</div>
					</article>
					<article class="position-relative bg-white p-3 mb-4">
						<h4 class="mb-0"><a href="#process-4" role="button" data-toggle="collapse" aria-controls="process-4" aria-expanded="true">Submit Your Application</a></h4>
						<div class="collapse" id="process-4">
							<div class="row justify-content-center">
								<div class="col-8">
							<hr />
								</div>
							</div>
							<ul class="text-left mb-0">
								<li>Receive information about interested employers and work environments</li>
							</ul>
						</div>
					</article>
					<article class="position-relative bg-white p-3 mb-4">
						<h4 class="mb-0"><a href="#process-5" role="button" data-toggle="collapse" aria-controls="process-5" aria-expanded="true">Proceed with interested employers</a></h4>
						<div class="collapse" id="process-5">
							<div class="row justify-content-center">
								<div class="col-8">
							<hr />
								</div>
							</div>
							<ol class="text-left mb-0">
								<li>Have an interview</li>
								<li>Review and accept a contract</li>
								<li>Receive visa and arrival support</li>
							</ol>
						</div>
					</article>
					<article class="position-relative bg-white p-3 mb-4">
						<h4 class="mb-0"><a href="http://dev.theworknplay.com/Blogs">Join TheWorknPlay Community to learn about places to travel and other events!</a></h4>
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

			<h3 class="text-center mb-4 mb-md-5">FAQ</h3>

			<!-- .row -->
			<div class="row mb-n4">
				<div class="col-lg-8">
					<article class="mb-4" id="faq-group">
	
						<p class="mb-2"><a class="text-dark" href="#faq-1" role="button" data-toggle="collapse" data-parent="#faq-group" aria-controls="faq-1" aria-expanded="true">How can I join Pro-Matching?</a></p>
						<div class="collapse" id="faq-1">
							<div class="card card-body bg-light p-3 mb-3">Click Join Pro-Matching to submit your resume. After a consultant reviews your resume, they will contact through your contact information provided.</div>
						</div>
						<p class="mb-2"><a class="text-dark" href="#faq-2" role="button" data-toggle="collapse" data-parent="#faq-group" aria-controls="faq-2" aria-expanded="true">Can I join Pro-Matching and search for jobs at the same time?</a></p>
						<div class="collapse" id="faq-2">
							<div class="card card-body bg-light p-3 mb-3">Yes, you can still search for jobs. We’re here to make the process easier by using our network to help you find the right job that is fit for you.</div>
						</div>
						<p class="mb-2"><a class="text-dark" href="#faq-3" role="button" data-toggle="collapse" data-parent="#faq-group" aria-controls="faq-3" aria-expanded="true">Can I apply with a friend for Pro-Matching?</a></p>
						<div class="collapse" id="faq-3">
							<div class="card card-body bg-light p-3 mb-3">Yes. Send us an email at worknplayhr@gmail.com and let us know the name of the person you are applying with. Make sure they are also registered with us with an online resume ready to submit.</div>
						</div>
						<p class="mb-2"><a class="text-dark" href="#faq-4" role="button" data-toggle="collapse" data-parent="#faq-group" aria-controls="faq-4" aria-expanded="true">How is my contact information used for Pro-Matching?</a></p>
						<div class="collapse" id="faq-4">
							<div class="card card-body bg-light p-3 mb-3">We only use the contact information that you have provided, which may include your email address, your phone number, and/or your Skype ID. We never provide contact information to the organizations until an interview has been set up.</div>
						</div>
						<p class="mb-2"><a class="text-dark" href="#faq-5" role="button" data-toggle="collapse" data-parent="#faq-group" aria-controls="faq-5" aria-expanded="true">Do I have to pay for Pro-Matching at any time?</a></p>
						<div class="collapse" id="faq-5">
							<div class="card card-body bg-light p-3 mb-3">No, Pro-Matching is a completely free service with no fees or hidden payments.</div>
						</div>
						<p class="mb-0"><a class="font-weight-bold" href="javascript:void(0);" role="button">See More</a></p>
					</article>
				</div>
				<div class="col-lg-4">
					<img class="img-fluid mb-4" src="/assets/images/design/jobfinder-06.jpg" alt="" />
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
					<h3 class="mb-0">Questions about Pro-Matching?</h3>
						</div>
					</div>
					<p class="my-4">Let us answer your questions!</p>
					<div class="row justify-content-center">
						<div class="col-8 col-md-3">
					<a class="btn btn-primary btn-block" href="#formQuestionWrapper" role="button" data-toggle="collapse" aria-controls="formQuestionWrapper" aria-expanded="true">Send a Message</a>
						</div>
					</div>
				</div>
				<div class="col-md-12 collapse" id="formQuestionWrapper">

			<!-- .row -->
			<div class="row justify-content-center mt-4 mt-md-5">
				<div class="col-md-6">
					<form class="needs-validation" id="formQuestion" autocomplete="off">
						<div class="form-row">
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" name="name" placeholder="Name*" maxlength="64" required />
							</div>
							<div class="col-md-12 form-group">
								<input type="email" class="form-control" name="email" placeholder="Email*" maxlength="64" required />
							</div>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="title" placeholder="Subject*" maxlength="255" required />
						</div>
						<div class="form-group">
							<textarea class="form-control" name="content" placeholder="Got a question? Let us know!*" required></textarea>
						</div>
						<div class="row justify-content-center mt-3">
							<div class="col-8 col-md-5">
						<input type="hidden" name="page" value="0000" />
						<input type="hidden" name="pk" value="" />
						<button type="submit" class="btn btn-primary btn-block">Send Message</button>
							</div>
						</div>
					</form>
					<script defer>
						$('#formQuestion').on('submit', function(){
							$.ajax({ type: 'post', url: '/actions/Question', data: 'action=Question&' + $(this).serialize(), success: function(result){
								Dialog(result); $('#formQuestion').find('input[type!="hidden"], textarea').val('');
							} }); return false;
						});
					</script>
				</div>
			</div>
			<!-- /.row -->

				</div>
			</div>
			<!-- /.row -->

		</div>
	</section>
	<!-- /section -->

<?php include_once '../pages/common/footer.php'; ?>