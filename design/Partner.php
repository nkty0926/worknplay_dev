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

			<h3 class="mb-3">Partner with TheWorknPlay</h3>

			<!-- .row -->
			<div class="row justify-content-center">
				<div class="col-md-9">
					<img class="img-fluid img-shadow" src="/assets/images/design/partner-01.jpg" alt="" />
					<div class="row justify-content-center">
						<div class="col-md-9">
					<h4>Provide new opportunities for professionals.</h4>
						</div>
					</div>
					<p class="mb-0">In today’s competitive job world, job seekers are always looking for ways to learn new skills and grow their careers. To learn more about how you can partner with us, send us an email!</p>
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
				<div class="col-md-6">
			<h3 class="mb-3">Change lives through teacher certification and language acquisition</h3>
				</div>
			</div>

			<!-- .row -->
			<div class="row mb-4 mb-md-5">
				<div class="col-12">
					<ul class="nav nav-pills flex-wrap flex-md-nowrap justify-content-center mb-n3">
						<li class="nav-item mr-3 mb-3">
							<a class="nav-link active disabled" href="javascript:void(0);">TEFL/TESOL</a>
						</li>
						<li class="nav-item mr-3 mb-3">
							<a class="nav-link disabled" href="javascript:void(0);">Language Courses</a>
						</li>
					</ul>
				</div>
			</div>
			<!-- /.row -->

			<!-- article.card -->
			<article class="card">
				<div class="card-body text-left p-md-5 mb-n4">
					<article class="mb-4">
						<h4 class="mb-3">TEFL/TESOL Certification</h4>
						<p>We’re here to help job seekers find the right match and also meet the needs of educational institutes around the world.</p>
						<p>We believe that you should not have to pay to help your students find great jobs. That’s why all of our TEFL/TESOL center profiles and program advertisements are free.</p>
					</article>
					<article class="mb-4">
						<p class="font-weight-bold">What's the catch?</p>
						<p>Our mission is to provide qualified teachers around the globe. We simply request that your graduates upload their resumes to our site and we’ll help them find verified positions that matches their qualifications and career paths.</p>
					</article>
					<br />
					<div class="row">
						<div class="col-lg-8">
					<article class="mb-4">
						<h4 class="mb-3">Creating a TEFL/TESOL Center</h4>
						<p>1. Sign up and log in.</p>
						<p>2. Go to your employer dashboard and click the tab “My TEFL/TESOL Center.”</p>
						<p>3. Build your center profile. Once you publish your center, it will go live.</p>
					</article>
					<br />
					<article class="mb-4">
						<h4 class="mb-3">Adding Certification Programs</h4>
						<p>1. Log in. Go to your employer dashboard and click the tab “Add a Program.”</p>
						<p>2. Fill out the information regarding your program.</p>
						<p>3. Publish your programs and start receiving students!</p>
					</article>
						</div>
						<div class="col-lg-4 d-none d-lg-block">
					<img class="img-fluid mt-5" src="/assets/images/design/partner-02.png" alt="" />
						</div>
					</div>
				</div>
			</article>
			<!-- /article.card -->

		</div>
	</section>
	<!-- /section -->

	<!-- section -->
	<section class="py-4 py-md-5 px-1 bg-white">
		<div class="container text-left">

			<!-- .row -->
			<div class="row">
				<div class="col-md-6">
					<h3 class="mb-3">Ready to Partner up?</h3>
				</div>
				<div class="col-md-6">
					<p class="font-weight-bold">Email us at <a href="mailto:theworknplay@gmail.com">theworknplay@gmail.com</a></p>
					<form class="needs-validation" id="formQuestion" autocomplete="off">
						<div class="form-row">
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" name="name" placeholder="Your Name*" maxlength="64" required />
							</div>
							<div class="col-md-12 form-group">
								<input type="email" class="form-control" name="email" placeholder="Email Address*" maxlength="64" required />
							</div>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="title" placeholder="Subject*" maxlength="255" required />
						</div>
						<div class="form-group">
							<textarea class="form-control" name="content" placeholder="How would you like to partner with us?*" required></textarea>
						</div>
						<div class="text-left">
				<input type="hidden" name="page" value="0000" />
				<input type="hidden" name="pk" value="" />
							<button type="submit" class="btn btn-primary">Send</button>
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
	</section>
	<!-- /section -->

<?php include_once '../pages/common/footer.php'; ?>