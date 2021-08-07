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
					<h3 class="mb-0">Employer Branding</h3>
						</div>
					</div>
					<p class="mb-0">When looking for jobs, one of the most important factors for job seekers is an employer’s brand and reputation. Your employer brand shows who you are and what you do.</p>
				</div>
			</div>

			<!-- .row -->
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-5">
					<img class="img-fluid" src="/assets/images/design/companybrand-01.jpg" alt="" />
				</div>
			</div>
			<!-- /.row -->

		</div>
	</section>
	<!-- /section -->

	<!-- section -->
	<section class="py-4 py-md-5 px-1 bg-light">
		<div class="container text-left">

			<h3 class="text-center mb-4 mb-md-5">Why You Should Build an Employer Brand</h3>

			<!-- .row -->
			<div class="row mb-n4">
				<div class="col-lg-4">
					<div class="row justify-content-center">
						<div class="col-12 col-sm-10 col-md-8 col-lg-12">
					<img class="img-fluid mb-4" src="/assets/images/design/companybrand-02.png" alt="" />
						</div>
					</div>
				</div>
				<div class="col-lg-8">
					<article class="mb-4">
						<p><strong>According to studies, more than 80% of job seekers reported that information about employers and job details are unavailable or unclear.</strong></p>
						<hr />
						<p>Job seekers who are seeking jobs abroad want a safe and stable life. Before making the big move abroad, they want to know more about their employers and the companies they will work for. By providing detailed information about your school or organization, you can help to make the transition abroad much easier.</p>
						
					</article>
				</div>
			</div>
			<!-- /.row -->

			<div class="row my-4"><div class="col"></div></div>

			<!-- .row -->
			<div class="row flex-sm-row-reverse mb-n4">
				<div class="col-lg-2">
					<div class="row justify-content-center">
						<div class="col-10 col-sm-8 col-md-6 col-lg-12">
					<img class="img-fluid mb-4" src="/assets/images/design/companybrand-03.png" alt="" />
						</div>
					</div>
				</div>
				<div class="col-lg-10">
					<article class="mb-4">

						<h6 class="font-weight-bold">The internet has changed the hiring process and increased competition. Recruiting and hiring has now become a means to promote and increase brand awareness.</h6>
						<hr />
						<h6 class="font-weight-bold">War for Talent</h6>
						<p>The time of job seekers looking for and impressing employers has passed, and the paradigm of hiring has changed to an era in which employers must compete to attract and hire qualified candidates.</p>
						<h6 class="font-weight-bold">Employment Stability</h6>
						<p>Happy employees are those who have joined organizations that fit their ideals and lifestyles. A positive experience at a workplace can encourage employees to tell customers and job seekers about the brand by word of mouth and provide testimonials.</p>
						<h6 class="font-weight-bold">Reduced Turnover and Hiring Costs</h6>
						<p>Detailed employer branding increases applications for qualified candidates and long-term employees, which leads to reduced hiring costs.</p>
					</article>
				</div>
			</div>
			<!-- /.row -->

			<!-- .row -->
			<div class="row justify-content-center mt-5">
				<div class="col-md-8">
					<div class="card bg-white">
						<div class="card-body px-5">
							<blockquote class="blockquote mb-0"><strong>Employer Branding</strong> is a hiring retention strategy that differentiates your school or organization from others and appeals to potential job seekers. By providing current employee testimonials, you can encourage more applicants to join your company.</blockquote>
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

			<div class="row justify-content-center mb-4 mb-md-5">
				<div class="col-md-9">
					<div class="row justify-content-center mb-3">
						<div class="col-md-10">
					<h3 class="mb-0">TheWorknPlay Employer Branding</h3>
						</div>
					</div>
					<p class="mb-0">Customize your employer branding profile and job post. By highlighting your organization’s values, mission, and work culture, you will attract qualified candidates who want to grow with your business.</p>
				</div>
			</div>

			<!-- .row -->
			<div class="row">
				<div class="col-lg-5">
					<article class="img-shadow border p-3 py-md-4 mb-5">
						<h4 class="border-bottom mb-3 pb-3">Customized Branding</h4>
						<div class="row justify-content-center">
							<div class="col-lg-10">
						<img class="img-fluid mb-3" src="/assets/images/design/companybrand-04.png" alt="" />
							</div>
						</div>
						<p class="font-italic mb-0">Establishing employer branding will encourage qualified job seekers to apply and develop with your company.</p>
					</article>
				</div>
				<div class="col-lg-7">

			<!-- .row -->
			<div class="row flex-row-reverse mb-n5">
				<div class="col-lg-6 mb-5">
					<article class="img-shadow border h-100 p-3 py-md-4 mb-0">
						<h5 class="border-bottom mb-3 pb-3">CEO, Mission, Culture</h5>
						<p class="font-italic mb-0">Give job seekers a better understanding of your organization</p>
					</article>
				</div>
				<div class="col-lg-6 mb-5">
					<article class="img-shadow border h-100 p-3 py-md-4 mb-0">
						<h5 class="border-bottom mb-3 pb-3">Employer Information</h5>
						<p class="font-italic mb-0">Provide job seekers with the information they want to know</p>
					</article>
				</div>
				<div class="col-lg-6 mb-5">
					<article class="img-shadow border h-100 p-3 py-md-4 mb-0">
						<h5 class="border-bottom mb-3 pb-3">Job Details</h5>
						<p class="font-italic mb-0">Let job seekers know what the job entails and what is expected of them</p>
					</article>
				</div>
				<div class="col-lg-6 mb-5">
					<article class="img-shadow border h-100 p-3 py-md-4 mb-0">
						<h5 class="border-bottom mb-3 pb-3">HR Interview</h5>
						<p class="font-italic mb-0">Give job seekers an overview of what it’s like to work at your organization</p>
					</article>
				</div>
				<div class="col-lg-6 mb-5">
					<article class="img-shadow border h-100 p-3 py-md-4 mb-0">
						<h5 class="border-bottom mb-3 pb-3">Employee Interview</h5>
						<p class="font-italic mb-0">Increase rapport with job seekers by providing positive testimonials</p>
					</article>
				</div>
				<div class="col-lg-6 mb-5">
					<article class="img-shadow border h-100 p-3 py-md-4 mb-0">
						<h5 class="border-bottom mb-3 pb-3">Photos and Videos</h5>
						<p class="font-italic mb-0">Job seekers rely on photos and videos to learn more about the organization.</p>
					</article>
				</div>
				<div class="col-lg-6 mb-5">
					<article class="img-shadow border h-100 p-3 py-md-4 mb-0">
						<h5 class="border-bottom mb-3 pb-3">Brand Visibility</h5>
						<p class="font-italic mb-0">Build your online presence and share your story (employer profile, products/services, hiring)</p>
					</article>
				</div>
			</div>
			<!-- /.row -->

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
						<img class="img-fluid img-shadow-sm w-100" src="/assets/images/design/companybrand-blogs-01.jpg" alt="" />
						<figcaption>
							<h6 class="mb-0">Why You Should Build a Company Brand</h6>
							<a class="font-weight-bold" href="/Blogs/Detail/Article/140">Read More</a>
						</figcaption>
					</figure>
				</div>
				<div class="col-md-4 mb-4">
					<figure class="mb-0">
						<img class="img-fluid img-shadow-sm w-100" src="/assets/images/design/companybrand-blogs-02.jpg" alt="" />
						<figcaption>
							<h6 class="mb-0">Hire Candidates with TheWorknPlay</h6>
							<a class="font-weight-bold" href="/Blogs/Detail/Article/131">Read More</a>
						</figcaption>
					</figure>
				</div>
				<div class="col-md-4 mb-4">
					<figure class="mb-0">
						<img class="img-fluid img-shadow-sm w-100" src="/assets/images/design/companybrand-blogs-03.jpg" alt="" />
						<figcaption>
							<h6 class="mb-0">Talent Acquisition with TheWorknPlay</h6>
							<a class="font-weight-bold" href="/Blogs/Detail/Article/139">Read More</a>
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

	<!-- section -->
	<section class="py-4 py-md-5 px-1 bg-white">
		<div class="container text-center">

			<!-- .row -->
			<div class="row justify-content-center">
				<div class="col-md-9">
					<div class="row justify-content-center mb-3">
						<div class="col-md-10">
					<h3 class="mb-0">Start Employer Branding</h3>
				
						</div>
					</div>
					<p class="my-4">Allow job seekers to learn more about your company by creating an informative company branding.</p>
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