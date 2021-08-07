<?php include_once 'pages/common/header.php'; ?>
	<!-- nav.navbar -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary border-bottom border-primary sticky-top py-0 py-lg-2">
		<div class="container">
			<div class="navbar-collapse collapse" id="navbarResponsive">
				<ul class="navbar-nav nav-underline mr-auto text-uppercase">
					<!-- <li class="nav-item">
						<a class="nav-link<?= $_GET['PAGE']==''?' active':'' ?>" href="/Work">Home</a>
					</li> -->
					<li class="nav-item">
						<a class="nav-link<?= $_GET['PAGE']!='Edit' && $_GET['MENU']=='Job'?' active':'' ?>" href="/Work/Search/Job">Jobs</a>
					</li>
					<li class="nav-item">
						<a class="nav-link<?= $_GET['PAGE']!='Edit' && $_GET['MENU']=='Company'?' active':'' ?>" href="/Work/Search/Company">Companies</a>
					</li>
					<li class="nav-item">
						<a class="nav-link<?= $_GET['PAGE']!='Edit' && $_GET['MENU']=='Resume'?' active':'' ?>" href="/Work/Search/Resume">Search Resumes</a>
					</li>
<?php if(!$_SESSION['SEEKER']){ ?>
					<li class="nav-item">
						<a class="nav-link" href="/design/TalentAcquisition">Talent Acquisition</a>
					</li>
<?php } ?>
				</ul>
				<ul class="navbar-nav ml-auto d-none d-lg-flex">
<?php if(false && empty($_SESSION['ID'])){ ?>
					<li class="nav-item mb-2 mb-lg-0 ml-lg-3">
						<span class="nav-link btn btn-light border p-2 px-lg-3">
							<a href="/LogIn" style="color:inherit;text-decoration:none;">LOG IN</a>
							<span style="pointer-events:none;">|</span>
							<a href="/Register" style="color:inherit;text-decoration:none;">REGISTER</a>
						</span>
					</li>
<?php } if(!$_SESSION['EMPLOYER'] && !$_SESSION['SEEKER']){ ?>
					<li class="nav-item mb-2 mb-lg-0 ml-lg-3">
						<a class="nav-link btn btn-light border p-2 px-lg-3" href="/Work/Seeker/Intro">FOR JOBSEEKERS</a>
					</li>
<?php } if($_SESSION['EMPLOYER']){ ?>
					<li class="nav-item mb-2 mb-lg-0 ml-lg-3">
						<a class="nav-link btn btn-light border p-2 px-lg-3" href="/Work/Employer"><?= $_SESSION['CURRENT_COMPANY_NAME']?$_SESSION['CURRENT_COMPANY_NAME']:'MY PAGE' ?></a>
					</li>
<?php }else if($_SESSION['SEEKER']){ ?>
					<li class="nav-item mb-2 mb-lg-0 ml-lg-3">
						<a class="nav-link btn btn-light border p-2 px-lg-3" href="/Work/Seeker"><?= $USER['work_resume_name']?$USER['work_resume_name']:'MY PAGE' ?></a>
					</li>
<?php }else{ ?>
					<li class="nav-item mb-2 mb-lg-0 ml-lg-3">
						<a class="nav-link btn btn-light border p-2 px-lg-3" href="/Work/Employer/Intro">FOR EMPLOYERS</a>
					</li>
<?php } ?>
				</ul>
			</div>
		</div>
	</nav>
	<!-- /nav.navbar -->

