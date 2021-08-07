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

			<h3 class="mb-3">About TheWorknPlay</h3>

			<!-- .row -->
			<div class="row mb-n3">
				<div class="col-lg-9">
					<article class="mb-3">
						<p>Since 2003, TheWorknPlay has provided career opportunities around the world, and we specialize in teaching and linguistic positions. Throughout the years, we have assisted schools and organizations in hiring the right candidates to join their teams and helped job seekers find careers with great WLB (Work-Life Balance).</p>
						<p>While employers worldwide are competing to hire the best professionals and stay ahead of their competitors, job seekers are looking for exciting work environments where they can build their careers and experience something new.</p>
						<figure>
							<img class="img-fluid" src="/assets/images/design/aboutus-01.jpg" alt="" />
						</figure>
						<p>To fulfill our mission, we strive to offer optimal hiring and candidate management solutions by combining online recruitment, talent acquisition, and consultation services.</p>
						<p>We are committed to providing effective and efficient services to employers and job seekers through quality services and support, and we do this better than anyone else.</p>
						<hr />
						<h5>TheWorknPlay Social Networks</h5>
						<p>English Teacher Facebook: Facebook
						<br />International Students Facebook: Facebook</p>
						<h5>TheWorknPlay Global Network</h5>
						<hr />
						<img class="img-fluid mr-2" src="/assets/images/design/aboutus-02.png" alt="" width="100px" />
						<img class="img-fluid mr-2" src="/assets/images/design/aboutus-03.png" alt="" width="100px" />
						<img class="img-fluid mr-2" src="/assets/images/design/aboutus-04.png" alt="" width="100px" />
					</article>
				</div>
				<div class="col-lg-3">
					<a class="btn btn-primary btn-lg btn-block text-center mb-3" href="http://dev.theworknplay.com/design/CreateAResume">For Job Seekers &gt;&gt;</a>
					<a class="btn btn-primary btn-lg btn-block text-center mb-3" href="http://dev.theworknplay.com/design/Employers">For Employers &gt;&gt;</a>
					<a class="btn btn-primary btn-lg btn-block text-center mb-3" href="http://dev.theworknplay.com/design/TeflTesol#Tefl">TEFL/TESOL &gt;&gt;</a>
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
					<h3 class="mb-0">Got a Question?</h3>
						</div>
					</div>
					<div class="row justify-content-center">
						<div class="col-8 col-md-3">
					<a class="btn btn-primary btn-block" href="#formQuestionWrapper" role="button" data-toggle="collapse" aria-controls="formQuestionWrapper" aria-expanded="true">Get in Touch</a>
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