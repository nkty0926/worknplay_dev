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
				<div class="col-md-9">
					<div class="row justify-content-center mb-3">
						<div class="col-md-10">
					<h3 class="mb-0">The Best Recruitment Platform for Foreign and Native Professionals and Multilingual Talent</h3>
						</div>
					</div>
					<p class="mb-0">Find native speakers, certified teachers, and professionals with bilingual and multilingual skills through TheWorknPlay. Our hiring solutions include job posts, resume searches, and talent acquisition services.</p>
				</div>
			</div>

			<!-- .row -->
			<div class="row mb-n4 mb-md-0">
				<div class="col-md-4 mb-5 mb-md-4">
					<article class="img-shadow border h-100 px-2 py-3 py-md-4 mb-0">
						<img class="img-fluid mb-3" src="/assets/images/design/employers-01.png" alt="" style="width:128px;" />
						<h4>Job Posts</h4>
						<p class="mb-4">Find potential global candidates by posting jobs and creating a customized company profile</p>
						<div class="row justify-content-center">
							<div class="col-8">
						<a class="btn btn-light btn-block bg-white" href="/design/JobsAndResume">Post a Job</a>
							</div>
						</div>
					</article>
				</div>
				<div class="col-md-4 mb-5 mb-md-4">
					<article class="img-shadow border h-100 px-2 py-3 py-md-4 mb-0">
						<img class="img-fluid mb-3" src="/assets/images/design/employers-02.png" alt="" style="width:128px;" />
						<h4>Search Resumes</h4>
						<p class="mb-4">Search our resume database and quickly hire candidates who fit your position and company.</p>
						<div class="row justify-content-center">
							<div class="col-8">
						<a class="btn btn-light btn-block bg-white" href="/Work/Search/Resume">Search Resumes</a>
							</div>
						</div>
					</article>
				</div>
				<div class="col-md-4 mb-5 mb-md-4">
					<article class="img-shadow border h-100 px-2 py-3 py-md-4 mb-0">
						<img class="img-fluid mb-3" src="/assets/images/design/employers-03.png" alt="" style="width:128px;" />
						<h4>Talent Acquisition</h4>
						<p class="mb-4">We provide comprehensive talent acquisition services so you can focus on your business.</p>
						<div class="row justify-content-center">
							<div class="col-8">
						<a class="btn btn-light btn-block bg-white" href="/design/TalentAcquisition">Learn More</a>
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
	<section class="py-4 py-md-5 px-1 bg-light">
		<div class="container text-left">

			<h3 class="text-center mb-4 mb-md-5">TheWorknPlay’s Global Recruitment Platform</h3>

			<!-- .row -->
			<div class="row flex-sm-row-reverse mb-n4">
				<div class="col-lg-4">
					<img class="img-fluid mb-4" src="/assets/images/design/employers-04.png" alt="" />
				</div>
				<div class="col-lg-8">
					<article class="mb-4">
						<h6 class="font-weight-bold mb-3">Smart Recruitment</h6>
						<p>Connect with job seekers easily from anywhere on any device. Our online platform allows you to access more candidates than anywhere else!</p>
						<ul class="list-check">
							<li>Hire qualified candidates quickly and easily at a low cost</li>
							<li>Conveniently manage everything from your dashboard and join Job Talent Acquisition</li>
							<li>Create a customized employer profile and job posts</li>
							<li>Advertise your company on TheWorknPlay and SNS sites</li>
						</ul>
						
						<h6 class="font-weight-bold mb-3">Employer Branding</h6>
						<p>Build relationships with job seekers and increase brand awareness by emphasizing your school or organization’s values, philosophy, and work environment.</p>
						<a class="btn btn-primary" href="/design/CompanyBrand">Learn More</a>
					</article>
					<article class="mb-4">
						<h6 class="font-weight-bold mb-3">Employer Recommendation Service</h6>
						<p>We actively search for applicants who are right for your school or organization and forward our recommendations to you.</p>
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

			<h3 class="text-center mb-4 mb-md-5">Searching for Qualified Professionals in These Fields</h3>

			<!-- .row -->
			<div class="row mb-n4 mb-md-0">
				<div class="col-md-4 mb-5 mb-md-4">
					<article class="img-shadow border h-100 px-2 py-3 py-md-4 mb-0">
						<h4 style="min-height:2em;">Qualified Teachers</h4>
						<p class="mb-0">Native English teachers, bilingual and multilingual professionals from various backgrounds</p>
						<div class="row justify-content-center">
							<div class="col-8">
						<hr />
							</div>
						</div>
						<div class="mb-0" style="min-height:24px;">
							<div class="collapse" id="qualified-1">
								<h5>Educational Industries</h5>
								<p class="mb-0">College Prep Centers 
									<br />Corporate Language Training 
									<br />International Schools 
									<br />Language Centers 
									<br />Online Teaching 
									<br />Public Schools 
									<br />Private Schools   
									<br />Special Education Schools 
									<br />TEFL/TESOL/CELTA Centers 
									<br />Tutoring 
									<br />Universities
									<br />Other
								</p>
								<a class="font-weight-bold" href="#qualified-1" role="button" data-toggle="collapse" aria-controls="qualified-1" aria-expanded="true"><br />Reduce</a>
							</div>
							<a class="font-weight-bold" href="#qualified-1" role="button" data-toggle="collapse" aria-controls="qualified-1" aria-expanded="false"><br />Learn More</a>
						</div>
					</article>
				</div>
				
				<div class="col-md-4 mb-5 mb-md-4">
					<article class="img-shadow border h-100 px-2 py-3 py-md-4 mb-0">
					
						<h4 style="min-height:2em;">Academic Leadership</h4>
						<p class="mb-0">Directors, supervisors, principals, academic counselors, and general administrative staff</p>
						<div class="row justify-content-center">
							<div class="col-8">
						<br />
						<hr />
							</div>
						</div>
						<div class="mb-0" style="min-height:24px;">
							<div class="collapse" id="qualified-2">
								<h5>Related Positions</h5>
								<p class="mb-0">Academic Affairs and Counseling
									<br />Admissions
									<br />Administration
									<br />Director
									<br />Executive
									<br />Global Affairs
									<br />Manager
									<br />R&amp;D and Curriculum Development
									<br />Other
								</p>
								<a class="font-weight-bold" href="#qualified-2" role="button" data-toggle="collapse" aria-controls="qualified-2" aria-expanded="true"><br />Reduce</a>
							</div>
							<a class="font-weight-bold" href="#qualified-2" role="button" data-toggle="collapse" aria-controls="qualified-2" aria-expanded="false"><br />Learn More</a>
						</div>
					</article>
				</div>
				<div class="col-md-4 mb-5 mb-md-4">
					<article class="img-shadow border h-100 px-2 py-3 py-md-4 mb-0">
						<h4 style="min-height:2em;">Interpreters and Translators</h4>
						<p class="mb-0">Experts in translation, publication, editing, and proofreading for various multimedia platforms</p>
						<div class="row justify-content-center">
							<div class="col-8">
						<hr />
							</div>
						</div>
						<div class="mb-0" style="min-height:24px;">
							<div class="collapse" id="qualified-3">
								<h5>Related Fields</h5>
								<p class="mb-0">Copywriting
									<br />Interpretation
									<br />Linguistic Testing
									<br />Proofreading and Editing
									<br />Transcription and Subtitling
									<br />Translation
									<br />Other
								</p>
								<a class="font-weight-bold" href="#qualified-3" role="button" data-toggle="collapse" aria-controls="qualified-3" aria-expanded="true"><br />Reduce</a>
							</div>
							<a class="font-weight-bold" href="#qualified-3" role="button" data-toggle="collapse" aria-controls="qualified-3" aria-expanded="false"><br />Learn More</a>
						</div>
					</article>
				</div>
				<style>.collapsing+[data-toggle="collapse"],.collapse.show+[data-toggle="collapse"]{display:none;}</style>
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
					<h3 class="mb-0">Pressed for time and resources?</h3>
						</div>
					</div>
					<p class="my-4">Our differentiated Talent Acquisition services provide you with innovative global recruitment solutions to allow you to focus on your business.</p>
					<div class="row justify-content-center">
						<div class="col-8 col-md-3">
					<a class="btn btn-primary btn-block" href="/design/TalentAcquisition">Get Started</a>
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

			<h3 class="text-center mb-4 mb-md-5">Our Clients</h3>

			<!-- .row -->
			<div class="row justify-content-center mb-4">
				<div class="col-md-6">
					<div class="row justify-content-center mb-n4">
						<div class="col-6 col-md-3 mb-4">
							<img class="img-fluid" src="/assets/images/design/employers-clients-01.jpg" alt="" style="width:100px;height:100px;" />
						</div>
						<div class="col-6 col-md-3 mb-4">
							<img class="img-fluid" src="/assets/images/design/employers-clients-02.jpg" alt="" style="width:100px;height:100px;" />
						</div>
						<div class="col-6 col-md-3 mb-4">
							<img class="img-fluid" src="/assets/images/design/employers-clients-03.jpg" alt="" style="width:100px;height:100px;" />
						</div>
						<div class="col-6 col-md-3 mb-4">
							<img class="img-fluid" src="/assets/images/design/employers-clients-04.png" alt="" style="width:100px;height:100px;" />
						</div>
					</div>
				</div>
			</div>
			<!-- /.row -->

			<!-- .row -->
			<div class="row justify-content-center mb-4">
				<div class="col-md-6">
					<div class="row justify-content-center mb-n4">
						<div class="col-6 col-md-3 mb-4">
							<img class="img-fluid" src="/assets/images/design/employers-clients-05.png" alt="" style="width:100px;height:100px;" />
						</div>
						<div class="col-6 col-md-3 mb-4">
							<img class="img-fluid" src="/assets/images/design/employers-clients-06.png" alt="" style="width:100px;height:100px;" />
						</div>
						<div class="col-6 col-md-3 mb-4">
							<img class="img-fluid" src="/assets/images/design/employers-clients-07.jpg" alt="" style="width:100px;height:100px;" />
						</div>
					</div>
				</div>
			</div>
			<!-- /.row -->

			<!-- .row -->
			<div class="row justify-content-center">
				<div class="col-md-9">
					<div class="row justify-content-center">
						<div class="col-8 col-md-3">
					<a class="btn btn-light btn-block bg-white" href="/Work/Search/Company">View More</a>
						</div>
					</div>
				</div>
			</div>
			<!-- /.row -->

		</div>
	</section>
	<!-- /section -->

<?php include_once '../pages/common/footer.php'; ?>