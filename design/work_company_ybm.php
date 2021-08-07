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
		<div class="container">
	
			<div class="row">
				<div class="col-md-3 col-sm-6 mb-4">
					<img alt="" src="/assets/images/design/ybm/industry.jpg" />
				</div>
				<div class="col-md-3 col-sm-6 mb-4">
					<img alt="" src="/assets/images/design/ybm/sales.jpg" />
				</div>
				<div class="col-md-3 col-sm-6 mb-4">
					<img alt="" src="/assets/images/design/ybm/year-of-establishment.jpg" />
				</div>
				<div class="col-md-3 col-sm-6">
					<img alt="" src="/assets/images/design/ybm/no.-of-emplyees.jpg" />
				</div>
			</div>
			<!-- row end -->
			<hr />
			<div class="row flex-md-row-reverse">
				<div class="col-md-4">
					<img alt="" src="/assets/images/design/ybm/2020102309491394971.upload.jpg" />
				</div>
				<div class="col-md-8">
					<h3>Always at the forefront of English Education Market</h3>
					<p>Since its founding in 1961, YBM has been at the forefront of Korea&rsquo;s English language publication and education market. By focusing on research and innovation, we have capitalized on this head start to become the unrivaled trendsetter for the country&rsquo;s language study market more generally.</p>
					<p>Millions of Koreans striving to achieve professional and personal goals have reached a high level of English proficiency thanks to our renowned language institutes, premium publications, and widely respected test preparation and administration services.</p>
					<p class="mb-0"><strong>Sunshik Min</strong></p>
					<p>Chairman and CEO of YBM</p>
				</div>
			</div>
			<!-- row-end -->
			<hr />
			<div class="row">
				<div class="col-md-12 text-center mb-3">
					<h3>YBM Divisions &amp; Services</h3>
					<p>With its +50-year long history, YBM is representative of English education in South Korea in many fields. YBM has many departments and divisions that offer several services centered around language education. These services include Publishing, Testing Services, Education Services, Digital Content and E-learning Services, Cartoon Character Business, and Social Services.</p>
				</div>
				<div class="col-md-12">
					<div class="workybm-parallax" style="padding-top: 15px; padding-bottom: 15px; background: transparent url(/assets/images/design/ybm/20190412164416152.upload.jpg) center/cover no-repeat fixed">
						<h2 class="text-center text-white" style="margin: 15px 15px 30px; color: white; font-weight: bolder;">History</h2>
						<ul class="list-unstyled" style="margin: auto; padding: 0px; border-radius: 10px; width: 9px; height: 750px; position: relative; background-color: rgb(37, 83, 125);">
							<li style="left: 0px; top: 60px; position: absolute;"><div style="border-radius: 50%; left: -3px; width: 15px; height: 15px; position: absolute; background-color: white;">&nbsp;</div><p style="width: 320px; text-align: right; right: 15px; bottom: -50px; color: white; font-size: 15px; position: absolute;"><br /> &nbsp;</p></li>
							<li style="left: 0px; top: 60px; position: absolute;"><p style="width: 320px; text-align: right; right: 40px; bottom: -50px; color: white; font-size: 15px; position: absolute;"><br /> <br /> <br /> <strong><font color="#69a0d2"><span style="font-size: 30px;">2016</span></font><br /> YBM Training Center open</strong></p></li>
							<li style="left: 0px; top: 60px; position: absolute;">&nbsp;</li>
							<li style="top: 140px; right: 0px; position: absolute;"><div style="border-radius: 50%; width: 15px; height: 15px; right: -3px; position: absolute; background-color: white;">&nbsp;</div><p style="left: 15px; width: 320px; text-align: left; bottom: -50px; position: absolute;"><strong><font color="#69a0d2"><span style="font-size: 30px;">2015</span></font><br /> <font color="#ffffff">Osaka English Village open</font></strong></p></li>
							<li style="left: 0px; top: 220px; position: absolute;"><div style="border-radius: 50%; left: -3px; width: 15px; height: 15px; position: absolute; background-color: white;">&nbsp;</div><p style="width: 320px; text-align: right; right: 15px; bottom: -50px; color: white; font-size: 15px; position: absolute;"><strong style="color: rgb(105, 160, 210); font-size: 30px;">2000</strong><br /> <strong>YBM NET established</strong></p></li>
							<li style="top: 300px; right: 0px; position: absolute;"><div style="border-radius: 50%; width: 15px; height: 15px; right: -3px; position: absolute; background-color: white;">&nbsp;</div><p style="left: 15px; width: 320px; text-align: left; bottom: -50px; position: absolute;"><font color="#69a0d2"><span style="font-size: 30px;"><b>1991</b></span></font><br /> <strong><font color="#ffffff">ECC open</font></strong></p></li>
							<li style="left: 0px; top: 380px; position: absolute;"><div style="border-radius: 50%; left: -3px; width: 15px; height: 15px; position: absolute; background-color: white;">&nbsp;</div><p style="width: 320px; text-align: right; right: 15px; bottom: -50px; color: white; font-size: 15px; position: absolute;"><strong style="color: rgb(105, 160, 210); font-size: 30px;">1983</strong><br /> <strong>ELS open</strong></p></li>
							<li style="top: 460px; right: 0px; position: absolute;"><div style="border-radius: 50%; width: 15px; height: 15px; right: -3px; position: absolute; background-color: white;">&nbsp;</div><p style="left: 15px; width: 320px; text-align: left; bottom: -50px; color: white; font-size: 15px; position: absolute;"><strong style="color: rgb(105, 160, 210); font-size: 30px;">1982&nbsp;</strong><strong>TOEIC launched</strong></p></li>
							<li style="left: 0px; top: 540px; position: absolute;"><div style="border-radius: 50%; left: -3px; width: 15px; height: 15px; position: absolute; background-color: white;">&nbsp;</div><p style="width: 320px; text-align: right; right: 15px; bottom: -50px; color: white; font-size: 15px; position: absolute;"><strong style="color: rgb(105, 160, 210); font-size: 30px;">1971</strong><br /> <strong>English 900 launched</strong></p></li>
							<li style="top: 620px; right: 0px; position: absolute;"><div style="border-radius: 50%; width: 15px; height: 15px; right: -3px; position: absolute; background-color: white;">&nbsp;</div><p style="left: 15px; width: 320px; text-align: left; bottom: -50px; color: white; font-size: 15px; position: absolute;"><strong style="color: rgb(105, 160, 210); font-size: 30px;">1961</strong><br /> <strong>YBM Sisa established</strong></p></li>
							<li style="left: 0px; top: 380px; position: absolute;"><div style="border-radius: 50%; left: -3px; width: 15px; height: 15px; position: absolute; background-color: white;">&nbsp;</div><p style="left: 15px; width: 320px; text-align: left; bottom: -50px; color: white; font-size: 15px; position: absolute;">&nbsp;</p></li>
						</ul>
					</div>
					<!-- ybm -->
				</div>
			</div>
			<!-- row end -->
			<hr />
			<div class="row">
				<div class="col-md-3">
					<img alt="" src="/assets/images/design/ybm/2019102212160762629.upload.jpg" />
				</div>
				<div class="col-md-9">
					<h3>YBM Corporate Language Training</h3>
					<p>Developed especially for adults in professional fields, YBM Corporate Language Training program matches highly qualified English teachers with companies looking for business and conversational English language training for their employees. With our vast YBM network nationwide, we are equipped to send teachers to teach in companies all over Korea. We seek to motivate professionals to learn English by giving them the knowledge and confidence to become successful communicators. We also provide our own curriculum to help our students advance and grow in the workplace. Over the years, our teachers have had opportunities to work with top companies nationwide including LG, Lotte, and Samsung.</p>
				</div>
			</div>
			<!-- row-end -->
			<div class="row">
				<div class="col-md-12">
					<img alt="" src="/assets/images/design/ybm/2019102212224162629.upload.jpg" />
				</div>
			</div>
			<!-- row end -->
			<hr />
			<div class="tab-section-2">
				<h3 class="text-center">Our Programs</h3>
				<p>At YBM NET Corporate Division, we offer a variety of programs to provide the best possible education in professional English.</p>
				<div class="row">
					<div class="col-md-6">&nbsp;</div>
				</div>
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#corporate-education" role="tab">Corporate Education &amp; Intensive Courses</a></li>
					<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Job-Interview" role="tab">Job Interview &amp; Level Test</a></li>
					<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Online-Education" role="tab">Online &amp; Phone Education</a></li>
					<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Community-Center" role="tab">Community Center</a></li>
				</ul>
				<!-- Tab panes -->
				<div class="tab-content">
					<div class="tab-pane active" id="corporate-education" role="tabpanel">
						<div class="row">
							<div class="col-md-3">
								<img alt="" src="/assets/images/design/ybm/2019101111581662629.upload.jpg" />
							</div>
							<div class="col-md-9">
								<p><strong>Corporate Education &amp; Intensive Courses</strong></p>
								<p>Corporate Education and Intensive Courses include general conversation, business conversation, exam preparation, and foreign language proficiency. These courses focus on practical English language application for all business professionals looking to advance their career or work overseas. Through these courses, English learners not only learn about understanding other cultures but also gain confidence and global business skills.</p>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="Job-Interview" role="tabpanel">
						<div class="row">
							<div class="col-md-3">
								<img alt="" src="/assets/images/design/ybm/2019101111590962629.upload.jpg" />
							</div>
							<div class="col-md-9">
								<p><strong>Job Interview &amp; Level Test</strong></p>
								<p>Job Interview and Level Test Courses are specifically for employees who need a foreign language test score or an in-house test score for a promotion. These courses help adult language learners gain a desired score in a short period of time and help employees set clear goals for listening, reading, speaking, and writing.</p>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="Online-Education" role="tabpanel">
						<div class="row">
							<div class="col-md-3">
								<img alt="" src="/assets/images/design/ybm/2019101112001262629.upload.jpg" />
							</div>
							<div class="col-md-9">
								<p><strong>Online &amp; Phone Education</strong></p>
								<p>Online and Phone Education Courses are made for those who prefer a flexible learning schedule. No matter the time or day, these courses help learners improve their language skills by setting learning goals as well as the amount and duration of learning. Phone English Education Courses allow learners to learn 1-on-1 with a foreign teacher through a smartphone to improve speaking and conversation skills.</p>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="Community-Center" role="tabpanel">
						<div class="row">
							<div class="col-md-3">
								<img alt="" src="/assets/images/design/ybm/2019101112012262629.upload.jpg" />
							</div>
							<div class="col-md-9">
								<p><strong>Community Center</strong></p>
								<p>Community Center Courses are intended for those who live in apartment communities. These courses are provided to contractors who need education-specific program proposals for the welfare of apartment tenants or for a representative committee for residents who desire to provide professional foreign language programs for tenants. Young learning courses provide learning in phonics, story book, art, and several others. Adult learning is geared towards general conversation and pop songs.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- tab-section-end -->
			<!-- row end -->
			<hr />
			<div class="row">
				<div class="col-md-12 text-center mb-5">
					<h3>YBM NET Videos and Social Media</h3>
				</div>
			</div>
			<div class="row flex-md-row-reverse">
				<div class="col-md-6">
					<img alt="" src="/assets/images/design/ybm/2019101117241562629.upload.jpg" />
				</div>
				<div class="col-md-6">
					<h4>Corporate Teacher Training</h4>
					<p>In this video, one of our teachers covers the basics of becoming a YBM NET teacher and he also gives you some tips and tricks to help you get started on your journey with YBM NET.</p>
					<p>Connect with us on our social media accounts!</p>
					<ul class="social-media list-unstyled">
						<li class="d-inline-block mr-3"><a href="#"><img alt="" src="/assets/images/design/ybm/2019101117552662629.upload.jpg" width="30px" /></a></li>
						<li class="d-inline-block mr-3"><a href="#"><img alt="" src="/assets/images/design/ybm/2019101117554862629.upload.jpg" width="30px" /></a></li>
						<li class="d-inline-block mr-3"><a href="#"><img alt="" src="/assets/images/design/ybm/2019101117562162629.upload.jpg" width="30px" /></a></li>
					</ul>
				</div>
			</div>
			<!-- row-end -->
			<hr />
			<div class="row">
				<div class="col-md-12 mb-5">
					<h3 class="text-center">Our Teacher Testimonials</h3>
					<p>Our annual YBM Teacher of the Year Award Ceremony was held on Nov 7, 2018, at the YBM NET branch in Pangyo, Seoul. Two winners, Alicia Lee and Kam Sanasing, each received an award.</p>
				</div>
			</div>
			<div class="row mb-5">
				<div class="col-lg-2 col-md-3">
					<img alt="" src="/assets/images/design/ybm/2019101118133262629.upload.jpg" />
				</div>
				<div class="col-lg-10 col-md-9">
					<p>&quot;There is absolutely no doubt in my mind that if it wasn&#39;t for YBM, I would not have been able to make the jump into biz teaching. The classes I got through YBM made it possible for me to have something to build on. The structure was clear, logical and effective. YBM has obviously put a lot of thought and expertise into designing it. Through YBM I didn&#39;t just learn &quot;how&quot; to teach &quot;what&quot; and &quot;why&quot; also became much clearer.&quot;</p>
					<p><strong>- Alicia Lee, 2018 Teacher of the Year</strong></p>
				</div>
			</div>
			<div class="row flex-md-row-reverse mb-5">
				<div class="col-lg-2 col-md-3">
					<img alt="" src="/assets/images/design/ybm/2019101118184462629.upload.jpg" />
				</div>
				<div class="col-lg-10 col-md-9">
					<p>&quot;I&#39;ve been working with YBM NET for the past few years, and all of my experiences have been nothing but positive. I appreciate the honesty of staff members, swift responses to questions or concerns, professionalism, and pedagogical autonomy. The company just treats people the right way and gives teachers ample opportunities for growth.&quot;</p>
					<p><strong>- Kam Sanasing, 2018 Teacher of the Year </strong></p>
				</div>
			</div>
			<!-- row-end -->
			<hr />
			<div class="row">
				<div class="col-md-6">
					<img alt="" src="/assets/images/design/ybm/2019101118261562629.upload.jpg" />
				</div>
				<div class="col-md-6">
					<h3>Our Recruiters</h3>
					<h4 class="mt-3 mb-0 text-black">Kevin Lee | Recruiter at YBM NET since 2012</h4>
					<p>&quot;I believe our key to success lies in instructors. I am eager to meet new candidates so please feel free to contact me anytime. I look forward to meeting you all soon!&quot; <a class="d-block" href="#">-View My Jobs</a></p>
					<h4 class="mt-3 mb-0 text-black">Stacey Lee | Recruiter at YBM NET since 2009</h4>
					<p>&quot;I have met many great inspiring instructors over the years while I was working and would like to see more great and inspiring instructors in the future as well.&quot; <a class="d-block" href="#">-View My Jobs</a></p>
					<h4 class="mt-3 mb-0 text-black">Jenny Kim | Recruiter at YBM NET since 2020</h4>
					<p>&quot;Throughout my time here at YBM NET, I have met a lot of talented and qualified instructors who have inspired me to study and learn more!&quot; <a class="d-block" href="#">-View My Jobs</a></p>
				</div>
			</div>
			<!-- row-end -->
			<hr />
			<div class="row">
				<div class="col-md-12">
					<h3 class="text-center">Join the Team</h3>
					<p>If you are interested in teaching adults in a business setting with a flexible schedule, then join us at YBM NET Corporate Division. We appreciate and value all of our teachers and we&#39;d love to have you join our team and become a part of our company!</p>
				</div>
			</div>
			<!-- row-end -->
			<hr />
			<style type="text/css">img{max-width: 100%;}</style>

		</div>
	</section>
	<!-- /section -->

<?php include_once '../pages/common/footer.php'; ?>