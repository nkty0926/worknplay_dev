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
					<h3 class="mb-0">TheWorknPlay’s Online Hiring Products</h3>
						</div>
					</div>
					<p class="mb-0">Our hiring solutions and packages help you find the right candidates for your school or organization.</p>
				</div>
			</div>

			<!-- .row -->
			<div class="row mb-n4 mb-md-0">
				<div class="col-md-4 mb-5 mb-md-4">
					<article class="img-shadow border h-100 px-2 py-3 py-md-4 mb-0">
						<h4>Standard Job</h4>
						<img class="img-fluid mb-3" src="/assets/images/design/jobsandresume-01.jpg" alt="" style="max-width:256px;" />
						<p class="font-weight-bold mb-0">55,000 ~ 165,000 <br/>[1/3/5 Job Posts]</p>
						<div class="row justify-content-center">
							<div class="col-8">
						<hr />
							</div>
						</div>
						<p>Best value for small and large organizations</p>
						<div class="mb-3" style="min-height:24px;">
							<div class="collapse" id="product-1">
								<strong>Product Overview</strong>
								<ul class="list-check">
									<li>1, 3, or 5 job posts</li>
									<li>90-day visibility</li>
									<li>Unlimited applicants</li>
									<li>Repost your job to bring it back to the top of the list (1 credit/post)</li>
									<li>As more positions are added, your job post will move down the list in the order that it was posted.</li>
								</ul>
								<a class="font-weight-bold" href="#product-1" role="button" data-toggle="collapse" aria-controls="product-1" aria-expanded="true">Reduce</a>
							</div>
							<a class="font-weight-bold" href="#product-1" role="button" data-toggle="collapse" aria-controls="product-1" aria-expanded="false">Learn More</a>
						</div>
						<div class="row justify-content-center">
							<div class="col-8">
						<a class="btn btn-light btn-block bg-white" href="/Work/Product/Select">Buy Now</a>
							</div>
						</div>
					</article>
				</div>
				<div class="col-md-4 mb-5 mb-md-4">
					<article class="img-shadow border h-100 px-2 py-3 py-md-4 mb-0">
						<h4>Hot Job</h4>
						<img class="img-fluid mb-3" src="/assets/images/design/jobsandresume-02.jpg" alt="" style="max-width:256px;" />
						<p class="font-weight-bold mb-0">275,000~<br />[7 Days Job Post]</p>
						<div class="row justify-content-center">
							<div class="col-8">
						<hr />
							</div>
						</div>
						<p>Need to hire immediately? Increase your post visibility by 50%</p>
						<div class="mb-3" style="min-height:24px;">
							<div class="collapse" id="product-2">
								<strong>Product Overview</strong>
								<ul class="list-check">
									<li>Add extra days of visibility</li>
									<li>90-day visibility as standard post included</li>
									<li>Job post remains at the top of the jobs list</li>
									<li>Unlimited applicants</li>
									<li>Unlimited resume search for the duration of your hot job</li>
									<li>Weekly candidate suggestions</li>
								</ul>
								<a class="font-weight-bold" href="#product-2" role="button" data-toggle="collapse" aria-controls="product-2" aria-expanded="true">Reduce</a>
							</div>
							<a class="font-weight-bold" href="#product-2" role="button" data-toggle="collapse" aria-controls="product-2" aria-expanded="false">Learn More</a>
						</div>
						<div class="row justify-content-center">
							<div class="col-8">
						<a class="btn btn-light btn-block bg-white" href="/Work/Product/Select">Buy Now</a>
							</div>
						</div>
					</article>
				</div>
				<div class="col-md-4 mb-5 mb-md-4">
					<article class="img-shadow border h-100 px-2 py-3 py-md-4 mb-0">
						<h4>Resume Search</h4>
						<img class="img-fluid mb-3" src="/assets/images/design/jobsandresume-03.jpg" alt="" style="max-width:256px;" />
						<p class="font-weight-bold mb-0">60,000 ~ 80,000<br />[14/28 Days Resume Search]</p>
						<div class="row justify-content-center">
							<div class="col-8">
						<hr />
							</div>
						</div>
						<p>Access our extensive resume database and find candidates</p>
						<div class="mb-3" style="min-height:24px;">
							<div class="collapse" id="product-3">
								<strong>Product Overview</strong>
								<ul class="list-check">
									<li>Unlimited searches for 14 or 28 days</li>
									<li>Save resumes for later review</li>
									<li>Contact candidates directly or via our online  messenger</li>
								</ul>
								<a class="font-weight-bold" href="#product-3" role="button" data-toggle="collapse" aria-controls="product-3" aria-expanded="true">Reduce</a>
							</div>
							<a class="font-weight-bold" href="#product-3" role="button" data-toggle="collapse" aria-controls="product-3" aria-expanded="false">Learn More</a>
						</div>
						<div class="row justify-content-center">
							<div class="col-8">
						<a class="btn btn-light btn-block bg-white" href="/Work/Product/Select">Buy Now</a>
							</div>
						</div>
					</article>
				</div>
				<style>.collapsing+[data-toggle="collapse"],.collapse.show+[data-toggle="collapse"]{display:none;}</style>
			</div>
			<!-- /.row -->

			<h4 class="mb-3 mt-5">Compare Our Hiring Products</h4>

			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th class="text-left" style="min-width:260px;">Overview</th>
							<th>Standard</th>
							<th>Hot</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="text-left">Job post stays at the top of the jobs list</td>
							<td></td>
							<td>&radic;</td>
						</tr>
						<tr>
							<td class="text-left">90-day job post visibility</td>
							<td>&radic;</td>
							<td>&radic;</td>
						</tr>
						<tr>
							<td class="text-left">Job post goes live immediately upon publishing</td>
							<td>&radic;</td>
							<td>&radic;</td>
						</tr>
						<tr>
							<td class="text-left">Unlimited applicants</td>
							<td>&radic;</td>
							<td>&radic;</td>
						</tr>
						<tr>
							<td class="text-left">Unlimited resume searches during hot job period</td>
							<td></td>
							<td>&radic;</td>
						</tr>
						<tr>
							<td class="text-left">Edit, repost (purchase credits), or close a job post at any time</td>
							<td>&radic;</td>
							<td>&radic;</td>
						</tr>
						<tr>
							<td class="text-left">Manage jobs and applicants easily from your dashboard</td>
							<td>&radic;</td>
							<td>&radic;</td>
						</tr>
						<tr>
							<td class="text-left">Customizable employer profile</td>
							<td>&radic;</td>
							<td>&radic;</td>
						</tr>
						<tr>
							<td class="text-left">Employer branding support and guidance</td>
							<td></td>
							<td>&radic;</td>
						</tr>
						<tr>
							<td class="text-left">Employer recommendation service</td>
							<td></td>
							<td>&radic;</td>
						</tr>
						<tr>
							<td class="text-left">Jobs simultaneously posted on global job boards</td>
							<td>&radic;</td>
							<td>&radic;</td>
						</tr>
						<tr>
							<td class="text-left">SNS marketing and email newsletters</td>
							<td></td>
							<td>&radic;</td>
						</tr>
					</tbody>
				</table>
			</div>

		</div>
	</section>
	<!-- /section -->

	<!-- section -->
	<section class="py-4 py-md-5 px-1 bg-light">
		<div class="container text-left">

			<h3 class="text-center mb-4 mb-md-5">How to Get Started</h3>

			<!-- .row -->
			<div class="row flex-sm-row-reverse mb-n4">
				<div class="col-lg-4">
					<img class="img-fluid mb-4" src="/assets/images/design/jobsandresume-04.jpg" alt="" />
				</div>
				<div class="col-lg-8">
					<article class="mb-4">
						<h6 class="font-weight-bold mb-3">Post a Job</h6>
						<p>Select package with the product you would like to purchase and continue to checkout page. You can purchase one package per product.</p>
						<ol class="pl-3" style="list-style-type:decimal;">
							<li>Create an account and log in.</li>
							<li>Choose the job package that fits your needs. Upon purchase, you can immediately publish your job post or use it later.</li>
							<li>After the purchase, go to your dashboard and click “Post a Job” under the product you purchased.</li>
							<li>Once you’ve filled out the necessary fields on the Employer Profile, you can post your job right away.</li>
						</ol>
						<p><a href="javascript:void(0);">How to post a great job</a></p>
						<a class="btn btn-primary" href="/Work/Product/Select">Purchase a Package</a>
					</article>
					<article class="mb-4">
						<h6 class="font-weight-bold mb-3">Resume Search</h6>
						<p>Finding the right candidates is made easy by using our custom filters to find qualified professionals based on location, industry, and more.</p>
						<ol class="pl-3" style="list-style-type:decimal;">
							<li>Create an account and log in.</li>
							<li>Purchase the search resume package that meets your needs. We offer a 14-day package and a 28-day package.</li>
							<li>Upon purchase, you can immediately access our resume database. You can contact candidates directly or via our online messenger. You can also save resumes to your dashboard for reviewing later.</li>
							<p>You can contact candidates directly or via our online messenger. You can also save resumes to your dashboard for reviewing later. </p>
						</ol>
						<p><a href="javascript:void(0);">How to search resumes</a></p>
						<a class="btn btn-primary" href="/Work/Product/Select">Purchase a Resume Package</a>
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
						<p class="mb-2"><a class="text-dark" href="#faq-1" role="button" data-toggle="collapse" data-parent="#faq-group" aria-controls="faq-1" aria-expanded="true">Is there a separate registration for employers?</a></p>
						<div class="collapse show" id="faq-1">
							<div class="card card-body bg-light p-3 mb-3">Yes. Create an account with TheWorknPlay and sign in. Click on Jobs in the upper right corner and identify your account as job seeker or employer.</div>
						</div>
						<p class="mb-2"><a class="text-dark" href="#faq-2" role="button" data-toggle="collapse" data-parent="#faq-group" aria-controls="faq-2" aria-expanded="true">How can I edit a job?</a></p>
						<div class="collapse" id="faq-2">
							<div class="card card-body bg-light p-3 mb-3">Go to your account. On your dashboard, click Manage Jobs under Work. Change Action to Edit.</div>
						</div>
						<p class="mb-2"><a class="text-dark" href="#faq-3" role="button" data-toggle="collapse" data-parent="#faq-group" aria-controls="faq-3" aria-expanded="true">What are the differences between the Standard and Hot jobs?</a></p>
						<div class="collapse" id="faq-3">
							<div class="card card-body bg-light p-3 mb-3">Standard jobs are visible for 90 days and goes down the list of job directory based on when it was published. Hot jobs are visible at the top of the job directory starting from 7 days and are posted as standard post for 90 days visibility. </div>
						</div>
						<p class="mb-2"><a class="text-dark" href="#faq-4" role="button" data-toggle="collapse" data-parent="#faq-group" aria-controls="faq-4" aria-expanded="true">How can I extend my 90-day Standard Job post?</a></p>
						<div class="collapse" id="faq-4">
							<div class="card card-body bg-light p-3 mb-3">Use a Standard Job credit to repost Standard Job. Go to your account. On your dashboard, click Manage Jobs under Work. Change Action to Repost. If there is no credit, you will not be able to repost. </div>
						</div>
						<p class="mb-2"><a class="text-dark" href="#faq-5" role="button" data-toggle="collapse" data-parent="#faq-group" aria-controls="faq-5" aria-expanded="true">How can I extend my 7-day Hot Job post?</a></p>
						<div class="collapse" id="faq-5">
							<div class="card card-body bg-light p-3 mb-3">Use a Hot Job credit to repost Hot Job. Go to your account. On your dashboard, click Manage Jobs under Work. Change Action to Repost. If there is no credit, you will not be able to repost.</div>
						</div>
						<p class="mb-2"><a class="text-dark" href="#faq-6" role="button" data-toggle="collapse" data-parent="#faq-group" aria-controls="faq-6" aria-expanded="true">How can I contact candidates?</a></p>
						<div class="collapse" id="faq-6">
							<div class="card card-body bg-light p-3 mb-3">You can contact them through our build in messenger or contact information provided on their resume. </div>
						</div>
						<p class="mb-2"><a class="text-dark" href="#faq-7" role="button" data-toggle="collapse" data-parent="#faq-group" aria-controls="faq-7" aria-expanded="true">How can I search for resumes?</a></p>
						<div class="collapse" id="faq-7">
							<div class="card card-body bg-light p-3 mb-3">Purchase a Resume Search package among our two options. Go to your dashboard, click on Search For Resume under Work to start resume search.</div>
						</div>
						<p class="mb-2"><a class="text-dark" href="#faq-8" role="button" data-toggle="collapse" data-parent="#faq-group" aria-controls="faq-8" aria-expanded="true">How many resumes can I see and review?</a></p>
						<div class="collapse" id="faq-8">
							<div class="card card-body bg-light p-3 mb-3">There is no limit on how many resumes you can view with each package. Must be viewed within the time frame of the Resume Search package purchased. We have a 14-days package and a 28-days package.</div>
						</div>
						<p class="mb-2"><a class="text-dark" href="#faq-9" role="button" data-toggle="collapse" data-parent="#faq-group" aria-controls="faq-9" aria-expanded="true">What is a resume folder and how can I use it?</a></p>
						<div class="collapse" id="faq-9">
							<div class="card card-body bg-light p-3 mb-3">Resume folder is where you store potential applicant’s resume into a file to view later. On a resume, click Saved Resume to open a pop-up box. You can create a folder and store the resume in that folder. Go to your account. On your dashboard, click Saved Resumes under Work to locate your resume folders. </div>
						</div>
						<p class="mb-2"><a class="text-dark" href="#faq-10" role="button" data-toggle="collapse" data-parent="#faq-group" aria-controls="faq-10" aria-expanded="true">How many resumes can I save in a resume folder?</a></p>
						<div class="collapse" id="faq-10">
							<div class="card card-body bg-light p-3 mb-3">There is no limit. You can save how many you want in each folder. After the Resume Search package that you had purchased expires,  the resume disappears from the folder. </div>
						</div>
						<p class="mb-0"><a class="font-weight-bold" href="javascript:void(0);" role="button">See More</a></p>
					</article>
				</div>
				<div class="col-lg-4">
					<img class="img-fluid mb-4" src="/assets/images/design/jobsandresume-05.jpg" alt="" />
				</div>
			</div>
			<!-- /.row -->

		</div>
	</section>
	<!-- /section -->

	<!-- section -->
	<section class="py-4 py-md-5 px-1 bg-light">
		<div class="container text-center">

			<div class="row justify-content-center">
				<div class="col-md-9">
					<div class="row justify-content-center mb-3">
						<div class="col-md-10">
					<h3 class="mb-0">Questions about our products?</h3>
						</div>
					</div>
					<p class="mb-0">Contact us regarding our products or other hiring services.</p>
					<div class="row justify-content-center mt-3">
						<div class="col-8 col-md-3">
					<a class="btn btn-primary btn-block" href="#formQuestionWrapper" role="button" data-toggle="collapse" aria-controls="formQuestionWrapper" aria-expanded="true">Product Inquiry</a>
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

		</div>
	</section>
	<!-- /section -->

<?php include_once '../pages/common/footer.php'; ?>