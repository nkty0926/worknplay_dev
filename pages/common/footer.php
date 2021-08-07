

<?php if($_GET['MAIN']=='About'){ ?>
<?php include_once 'pages/1000_About/1000_About_footer.php'; ?>
<?php }else if($_GET['MAIN']=='ADMIN'){ ?>
	</section>
	<!-- /section -->

</main>
<!-- /main -->
<?php }else{ ?>
	<!-- footer -->
	<footer class="py-3 py-lg-5 border-top bg-light d-print-none">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 d-none d-lg-block">
					<ul class="list-unstyled mb-4">
						<li class="mb-2"><h5>TheWorknPlay</h5></li>
						<li class="mb-2"><a class="text-dark" href="/design/AboutUs">About Us</a></li>
						<li class="mb-2"><a class="text-dark" href="/design/Careers">Careers</a></li>
						<li class="mb-2"><a class="text-dark" href="/design/Partner">Partner with us</a></li>
					</ul>
					<ul class="list-unstyled mb-4">
						<li class="mb-2"><h5>Get in Touch:</h5></li>
						<!-- <li class="mb-2"><a class="text-dark" href="tel:<?= $CONF['phone_hr'] ?>">P: <?= $CONF['phone_hr'] ?></a></li> -->
						<li class="mb-2"><a class="text-dark" href="mailto:<?= $CONF['email_hr'] ?>">E: <?= $CONF['email_hr'] ?></a></li>
					</ul>
					<ul class="list-unstyled">
						<li class="mb-2">
                            <a href="javascript:void(0);"><img class="mr-1" width="24" height="24" src="/assets/icons/footer/whatsapp.png" alt="whatsapp" title="whatsapp" /></a>
                            <a href="javascript:void(0);"><img class="mr-1" width="24" height="24" src="/assets/icons/footer/wechat.png" alt="wechat" title="wechat" /></a>
                            <a href="javascript:void(0);"><img class="mr-1" width="24" height="24" src="/assets/icons/footer/kakao-talk.png" alt="kakao-talk" title="kakao-talk" /></a>
                            <a href="https://www.facebook.com/TheWorknPlay" target="_blank"><img class="mr-1" width="24" height="24" src="/assets/icons/footer/facebook.png" alt="facebook" title="facebook" /></a>
                            <a href="https://www.instagram.com/theworknplay_intl/" target="_blank"><img class="mr-1" width="24" height="24" src="/assets/icons/footer/instagram.png" alt="instagram" title="instagram" /></a>
                            <a href="https://www.linkedin.com/company/theworknplay" target="_blank"><img class="mr-1" width="24" height="24" src="/assets/icons/footer/linkedin.png" alt="linkedin" title="linkedin" /></a>
						</li>
					</ul>
					<style>footer [class^="flaticon-"]:before{margin-left:0;margin-right:.5rem;font-size:1.5rem;}</style>
				</div>
				<div class="col-sm-6 col-lg-3">
					<ul class="list-unstyled">
						<li class="mb-2"><h5>For Job Seekers:</h5></li>
						<li class="mb-2"><a class="text-dark" href="/Work/Search/Job">Browse Jobs</a></li>
						<li class="mb-2"><a class="text-dark" href="/Work/Search/Company">Browse Companies</a></li>
						<li class="mb-2"><a class="text-dark" href="/design/CreateAResume">Create a Resume</a></li>
						<li class="mb-2"><a class="text-dark" href="/design/ActiveCandidateDirectory">Active Candidate Directory</a></li>
						<li class="mb-2"><a class="text-dark" href="/design/JobFinder">Pro-Matching</a></li>
						<li class="mb-2"><a class="text-dark" href="/design/HowToPostAGreatJob">Apply as Job Seeker</a></li>
					</ul>
				</div>
				<div class="col-sm-6 col-lg-3">
					<ul class="list-unstyled">
						<li class="mb-2"><h5>For Employers:</h5></li>
						<li class="mb-2"><a class="text-dark" href="/design/Employers">Products</a></li>
						<li class="mb-2"><a class="text-dark" href="/design/JobsAndResume">Post a Job</a></li>
						<li class="mb-2"><a class="text-dark" href="/design/JobsAndResume">Search Resumes</a></li>
						<li class="mb-2"><a class="text-dark" href="/design/TalentAcquisition">Talent Acquisition</a></li>
						<li class="mb-2"><a class="text-dark" href="/design/CompanyBrand">Employer Branding</a></li>	
						<li class="mb-2"><a class="text-dark" href="/design/Apply as Employer">Apply as Employer</a></li>
					</ul>
				</div>
				<div class="col-sm-6 col-lg-3">
					<ul class="list-unstyled">
						<li class="mb-2"><h5>Get Started</h5></li>
						<li class="mb-2"><a class="text-dark" href="/design/Navigating">Navigating TheWorknPlay</a></li>
						<li class="mb-2"><a class="text-dark" href="/design/Teaching">Teaching English Abroad</a></li>
						<li class="mb-2"><a class="text-dark" href="/design/TeacherCertification">Teacher Certification</a></li>
						<li class="mb-2"><a class="text-dark" href="/Blogs">Blog</a></li>
					</ul>
				</div>
				<div class="col-sm-6 d-lg-none">
					<ul class="list-unstyled">
						<li class="mb-2"><h5>TheWorknPlay</h5></li>
						<li class="mb-2"><a class="text-dark" href="/design/AboutUs">About Us</a></li>
						<li class="mb-2"><a class="text-dark" href="/design/Careers">Careers</a></li>
						<li class="mb-2"><a class="text-dark" href="/design/Partner">Partner with us</a></li>
					</ul>
					<ul class="list-unstyled">
						<li class="mb-2"><h5>Get in Touch:</h5></li>
						<!-- <li class="mb-2"><a class="text-dark" href="tel:<?= $CONF['phone_hr'] ?>">P: <?= $CONF['phone_hr'] ?></a></li> -->
						<li class="mb-2"><a class="text-dark" href="mailto:<?= $CONF['email_hr'] ?>">E: <?= $CONF['email_hr'] ?></a></li>
					</ul>
					<ul class="list-unstyled">
						<li class="mb-2">
                            <a href="javascript:void(0);"><img class="mr-1" width="24" height="24" src="/assets/icons/footer/whatsapp.png" alt="whatsapp" title="whatsapp" /></a>
                            <a href="javascript:void(0);"><img class="mr-1" width="24" height="24" src="/assets/icons/footer/wechat.png" alt="wechat" title="wechat" /></a>
                            <a href="javascript:void(0);"><img class="mr-1" width="24" height="24" src="/assets/icons/footer/kakao-talk.png" alt="kakao-talk" title="kakao-talk" /></a>
                            <a href="https://www.facebook.com/TheWorknPlay" target="_blank"><img class="mr-1" width="24" height="24" src="/assets/icons/footer/facebook.png" alt="facebook" title="facebook" /></a>
                            <a href="https://www.instagram.com/theworknplay_intl/" target="_blank"><img class="mr-1" width="24" height="24" src="/assets/icons/footer/instagram.png" alt="instagram" title="instagram" /></a>
                            <a href="https://www.linkedin.com/company/theworknplay" target="_blank"><img class="mr-1" width="24" height="24" src="/assets/icons/footer/linkedin.png" alt="linkedin" title="linkedin" /></a>
						</li>
					</ul>
					<style>footer [class^="flaticon-"]:before{margin-left:0;margin-right:.5rem;font-size:1.5rem;}</style>
				</div>
				<div class="col-sm-12">
					<hr class="my-3" />
				</div>
				<div class="col-sm-12">
					<p class="text-muted float-lg-left mb-0">© 2020 TheWorknPlay All Rights Reserved.</p>
                    <a class="text-muted float-lg-right" href="javascript:void(0);">Privacy and Terms of Service</a>
				</div>
			</div>
		</div>
	</footer>
	<!-- /footer -->
<?php } ?>

	<a class="btn btn-primary d-print-none" id="bottomToTop" style="position:fixed;bottom:30px;right:30px;z-index:999;" href="javascript:$(document).scrollTop(0);"><i class="fa fa-chevron-up"></i></a>
	<a class="btn btn-primary d-print-none" id="topToBottom" style="position:fixed;bottom:30px;right:30px;z-index:999;" href="javascript:$(document).scrollTop($(document).height());"><i class="fa fa-chevron-down"></i></a>

<?php if($_SESSION['PROD_MODE']){ ?><script>console.log("WorknPlay:Prod");</script><?php } ?>
<?php if($_SESSION['TEST_MODE']){ $WP->printExcutionTime(); } ?>

</body>
</html>
