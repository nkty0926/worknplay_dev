<?php include_once 'pages/common/header.php'; ?>
	<style>@media(min-width:992px){.navbar.bg-light{background-color:transparent !important;border:none !important;padding-top:3rem!important;padding-bottom:3rem!important;}}</style>
<?php $ads = $DB->selectAds('0000', 'header'); ?>
	<!-- header -->
	<header class="position-relative pt-3 pb-4 pt-lg-5">
		<a class="stretched-link" href="<?= $ads['href'] ?>" target="<?= $ads['target']?'_blank':'_self' ?>" title="<?= $ads['title'] ?>"></a>
		<div class="container pt-lg-5">

	<!-- .row -->
	<div class="row my-lg-5">
		<div class="col-lg-6 pt-lg-4">

			<h2 class="text-bold font-weight-bold mb-2">Find Teaching Jobs Abroad</h2>
			<h5 class="text-muted mb-3 mb-lg-5">Discover hundreds of teaching jobs abroad including opportunities with international</h5>

			<!-- form#headerSearch -->
			<form class="needs-validation" id="headerSearch" method="get" action="/Work/Search/Job">
				<ul class="nav nav-underline overflow-hidden mb-3">
					<li class="nav-item">
						<a class="nav-link lead active" href="javascript:void(0);" data-toggle="tab" data-action="/Work/Search/Job">Jobs</a>
					</li>
					<li class="nav-item">
						<a class="nav-link lead" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Coming Soon">Tefl/Tesol</a>
					</li>
					<!-- <li class="nav-item">
						<a class="nav-link lead" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Coming Soon">Language Courses</a>
					</li> -->
				</ul>
				<div class="form-group input-group">
					<label class="input-group-prepend mb-0" for="searchKeyword">
						<span class="input-group-text bg-white text-black-50 border-right-0" style="height:50px;"><i class="fa fa-fw fa-search"></i></span>
					</label>
					<input type="text" class="form-control form-control-lg border-left-0" id="searchKeyword" name="keyword" value="" placeholder="Keyword" style="height:50px;" />
				</div>
				<div class="form-group input-group">
					<label class="input-group-prepend mb-0" for="searchLocation">
						<span class="input-group-text bg-white text-black-50 border-right-0" style="height:50px;"><i class="fa fa-fw fa-map-marker-alt"></i></span>
					</label>
					<select class="form-control custom-select custom-select-lg border-left-0" id="searchLocation" name="location_country[]" style="height:50px;">
						<option value="">Location</option>
<?php foreach($DB->selectCode('country') as $country){ ?>
						<option value="<?= $country['no'] ?>"><?= $country['name'] ?></option>
<?php } ?>
					</select>
				</div>
				<div class="form-group mb-0">
					<button type="submit" class="btn btn-primary btn-lg px-4">Search</button>
				</div>
				<style>#headerSearch .input-group{box-shadow:0 .25rem .5rem rgba(0,0,0,.15);}#headerSearch .input-group:focus-within{box-shadow:0 0 0 0.1rem var(--primary);}</style>
				<script defer>$('#headerSearch [data-action]').on('click', function(){ $('#headerSearch').attr('action', $(this).data('action')); });</script>
			</form>
			<!-- /form#headerSearch -->

		</div>
		<div class="col-lg-6 d-none d-lg-block">
			<img class="img-fluid" src="/assets/images/0000-main-header-20200930-2.png" alt="Find Teaching Jobs Abroad" title="Find Teaching Jobs Abroad" />
		</div>
	</div>
	<!-- /.row -->

		</div>
		<style>@media(min-width:992px){ header.position-relative{margin-top:-138px;background-image:url(/assets/images/0000-main-header-20200930.png);} }</style>
	</header>
	<!-- /header -->

	<!-- section -->
	<section class="py-4 py-lg-5 bg-light">
		<div class="container py-lg-4">
			<div class="row mb-3">
				<div class="col-lg-12">
					<h3 class="text-left text-lg-center mb-0 mb-lg-4">Top Companies Currently Hiring at TheWorknPlay Now</h3>
				</div>
			</div>
			<div class="row mb-3">
				<div class="col-lg-6 mb-3">
					<figure class="embed-responsive embed-responsive-16by9 mb-0">
						<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/Hz-NAqq5tzo" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</figure>
				</div>
				<div class="col-lg-6 mb-3">
					<h4>Chungdahm Learning</h4>
					<h5 class="font-weight-normal">“April English Institute Teacher’s Vlog”</h5>
					<hr />
					<p>Ever wondered what it’s like to teach near a beach? Join Bailey, a teacher at Chungdahm, as she shared a day in her life in Korea!</p>
					<p class="mt-lg-4 mb-lg-3"><a class="btn btn-primary btn-lg px-4" href="javascript:void(0);">Learn More</a></p>
					<a class="text-dark" href="/design/CompanyBrand">Employers: Create Your Own company Profile »</a>
				</div>
			</div>
			<div class="row mb-0">
				<div class="col-lg-6">
					<p class="text-muted my-1">More Companies</p>
					<div class="form-row flex-nowrap" style="overflow-x:auto;overflow-y:hidden;">
						<article class="col-7 col-sm-5 col-lg-3" style="max-width:127.5px;">
							<figure class="embed-responsive embed-responsive-16by9 mb-0">
								<img class="embed-responsive-item" src="/assets/images/design/main-01.jpg" alt="Chungdahm Learning" title="Chungdahm Learning" />
							</figure>
							<a class="text-dark small d-block" href="javascript:void(0);">Chungdahm Learning</a>
						</article>
						<article class="col-7 col-sm-5 col-lg-3" style="max-width:127.5px;">
							<figure class="embed-responsive embed-responsive-16by9 mb-0">
								<img class="embed-responsive-item" src="/assets/images/design/main-02.jpg" alt="GIA Micro School" title="GIA Micro School" />
							</figure>
							<a class="text-dark small d-block" href="javascript:void(0);">GIA Micro School</a>
						</article>
						<article class="col-7 col-sm-5 col-lg-3" style="max-width:127.5px;">
							<figure class="embed-responsive embed-responsive-16by9 mb-0">
								<img class="embed-responsive-item" src="/assets/images/design/main-03.jpg" alt="MICA International Scholars" title="MICA International Scholars" />
							</figure>
							<a class="text-dark small d-block" href="javascript:void(0);">MICA International Scholars</a>
						</article>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /section -->

	<!-- section -->
	<section class="py-4 py-lg-5">
		<div class="container py-lg-4">

	<!-- .row -->
	<div class="row">
		<div class="col-lg-4">
			<article class="pr-lg-5 mb-4">
				<h3>Stand Out From the Crowd</h3>
				<p>At TheWorknPlay, find awesome career and learning opportunities at home or abroad.</p>
			</article>
		</div>
		<div class="col-lg-8">
			<div class="row mb-n3 mb-sm-n4 article-section-group">
				<div class="col-sm-6 mb-3 mb-sm-4">
					<article class="article-section position-relative h-100 p-3 p-lg-4">
						<i class="flaticon-job"></i>
						<a class="stretched-link text-dark text-decoration-none" href="/Work">
							<h5>Jump Start Your Career</h5>
						</a>
						<p class="text-muted">Gain experience and grow your skills at a new workplace.</p>
					</article>
				</div>
				<div class="col-sm-6 mb-3 mb-sm-4">
					<article class="article-section position-relative h-100 p-3 p-lg-4">
						<i class="flaticon-internet"></i>
						<a class="stretched-link text-dark text-decoration-none" href="/design/TeflTesol#Tefl">
							<h5>TEFL/TESOL Courses</h5>
						</a>
						<p class="text-muted">Become certified and get ahead.</p>
					</article>
				</div>
				<div class="col-sm-6 mb-3 mb-sm-4">
					<article class="article-section position-relative h-100 p-3 p-lg-4">
						<i class="flaticon-translate"></i>
						<a class="stretched-link text-dark text-decoration-none" href="#Lang">
							<h5>Discover New Languages</h5>
						</a>
						<p class="text-muted">Join workplaces who need multilingual professionals.</p>
					</article>
				</div>
				<div class="col-sm-6 mb-3 mb-sm-4">
					<article class="article-section position-relative h-100 p-3 p-lg-4">
						<i class="flaticon-network"></i>
						<a class="stretched-link text-dark text-decoration-none" href="/Blogs">
							<h5>Get Advice</h5>
						</a>
						<p class="text-muted">Learn all about living abroad, from how-tos to career advice.</p>
					</article>
				</div>
			</div>
		</div>
		<style>
			.article-section {
				background-color: #cceffc;
				transition: background-color .25s linear;
			}
			.article-section>i {
				color: var(--primary);
			}
			.article-section:hover, .article-section-group:not(:hover) :first-child .article-section {
				background-color: var(--primary);
			}
			.article-section:hover>i, .article-section:hover>a>h5, .article-section:hover .text-muted,
			.article-section-group:not(:hover) :first-child .article-section>i,
			.article-section-group:not(:hover) :first-child .article-section>a>h5,
			.article-section-group:not(:hover) :first-child .article-section .text-muted {
				color: white !important;
			}
		</style>
	</div>
	<!-- /.row -->

		</div>
	</section>
	<!-- /section -->

	<!-- section -->
	<section class="py-4 py-lg-5 bg-light">
		<div class="container">

	<!-- .row -->
	<div class="row">
		<div class="col-12">
			<h3 class="d-lg-none">
				<a class="text-dark" href="/Blogs">Blogs</a>
				<span>&gt;</span>
				<a class="text-dark" href="/Blogs">People</a>
			</h3>
		</div>
		<div class="col-lg-5 py-lg-3">
			<div class="img-card mt-1 mb-4">
				<img class="img-fluid" src="/assets/images/design/main-04.jpg" alt="We'll always match you up with opportunities that are the right fit" title="We'll always match you up with opportunities that are the right fit" />
			</div>
			<style>
				.img-card {
				    text-align: right;
				    display: block;
				    background: var(--primary);
				    width: calc(100% - 30px);
				    height: auto;
				    position: relative;
				    top: 30px;
				    left: -15px;
				    margin: auto;
				}
				.img-card img {
				    max-width: 100%;
				    position: relative;
				    bottom: 30px;
				    left: 30px;
				}
			</style>
		</div>
		<div class="col-lg-7 py-lg-3">
			<span class="lead d-none d-lg-inline-block mt-3 mt-lg-0">
				<a class="text-dark mb-2" href="/Blogs">Blogs</a>
				<span>&gt;</span>
				<a class="text-dark mb-2" href="/Blogs">People</a>
			</span>
			<h3 class="my-3 mt-lg-0 mb-lg-4">We'll always match you up with opportunities that are the right fit</h3>
			<p>thought I would never be able to find a good job. Anyhow I took a look at the jobs posted by. I was looking for a job after matriculation due to some personal and domestic issues. I found a job but they did not pay me well. I thought I would never be able to find a good job. Anyhow I took a look.<a href="/design/Teaching">… Show More</a></p>
			<p class="text-muted mb-0">Andrea</p>
		</div>
	</div>
	<!-- /.row -->

		</div>
	</section>
	<!-- /section -->

	<!-- section -->
	<section class="py-4 py-lg-5">
		<div class="container py-lg-4">

	<!-- .row -->
	<div class="row text-center justify-content-center">
		<div class="col-lg-8">
			<h3>Get the Word Out</h3>
			<p>Let the world know the awesome jobs, programs, or services you offer!</p>
			<div class="row text-center justify-content-center">
				<div class="col-7 col-sm-6 col-md-5 col-lg-4" style="min-width:210px;">
					<div class="card bg-primary" id="collapsePostingsWrapper">
						<div class="card-body text-center">
							<h5 class="card-title text-white mb-0">Post an Ad</h5>
							<div id="collapsePostings">
								<ul class="list-unstyled mb-0" style="margin-top:1rem;padding-top:1rem;border-top:1px dashed white;">
									<li><a class="text-white" href="/Work/Employer">Job Post</a></li>
									<li><a class="text-white" href="javascript:void(0);">TEFL/TESOL Course</a></li>
									<!-- <li><a class="text-white" href="javascript:void(0);">Language Course</a></li> -->
								</ul>
							</div>
							<style>#collapsePostings{height:0;overflow:hidden;transition:height .5s ease;}#collapsePostingsWrapper:hover #collapsePostings{height:81px;}</style>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.row -->

		</div>
	</section>
	<!-- /section -->

<?php include_once 'pages/common/footer.php'; ?>
