<?php $htmlHead = $WP->getHtmlHead(); ?>
<!DOCTYPE html>
<html lang="en">
<head>

	<!-- HTML Meta -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="author" content="WorknPlay" />
	<meta name="keywords" content="<?= htmlspecialchars(trim($htmlHead['keywords'])) ?>" />
	<meta name="description" content="<?= htmlspecialchars(trim($htmlHead['description'])) ?>" />

	<!-- Open Graph -->
	<meta property="og:site_name" content="WorknPlay" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?= $WP->getCurrentUrl() ?>" />
	<meta property="og:title" content="<?= htmlspecialchars(trim($htmlHead['title'])) ?>" />
	<meta property="og:description" content="<?= htmlspecialchars(trim($htmlHead['description'])) ?>" />
	<meta property="og:image" content="<?= htmlspecialchars(trim($htmlHead['image'])) ?>" />

	<!-- HTML Title -->
	<title><?= htmlspecialchars(trim($htmlHead['title'])) ?></title>

	<!-- Website Indexing -->
	<link rel="canonical" href="<?= $WP->getCurrentUrl() ?>" />

	<!-- Website Icon -->
	<link rel="icon" href="/assets/images/WorknPlay-icon.png" />

	<!-- Style Sheets -->
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.color.css?date=<?= date('ymdHis', strtotime('now+9hours')) ?>" />
	<link rel="stylesheet" type="text/css" href="/assets/css/fontawesome-all.min.css" />
	<link rel="stylesheet" type="text/css" href="/assets/css/design2020-flaticon.css" />
	<link rel="stylesheet" type="text/css" href="/assets/css/jquery-ui.min.css" />
	<link rel="stylesheet" type="text/css" href="/assets/css/jquery-ui.multidatespicker.css" />
	<link rel="stylesheet" type="text/css" href="/assets/css/custom.css?date=<?= date('ymdHis', strtotime('now+9hours')) ?>" />
	<link rel="stylesheet" type="text/css" href="/assets/css/worknplay.css?date=<?= date('ymdHis', strtotime('now+9hours')) ?>" />
<?php if($_GET['MAIN']=='About'){ ?>
	<link rel="stylesheet" type="text/css" href="/assets/css/worknplay.about.css?date=<?= date('ymdHis', strtotime('now+9hours')) ?>" />
<?php } ?>
<?php if($_GET['MAIN']=='ADMIN' || $PAGE['no']=='3550'){ ?>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
<?php } ?>
	<link rel="preconnect" href="https://fonts.gstatic.com" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" />

	<!-- JavaScripts -->
	<script src="/assets/js/jquery.min.js"></script>
	<script src="/assets/js/jquery-ui.min.js" defer></script>
	<script src="/assets/js/jquery-ui.multidatespicker.js" defer></script>
<?php if($_GET['MAIN']=='Blogs'){ ?>
	<script src="/assets/js/jquery-jcarousellite.min.js" defer></script>
	<script src="/assets/js/jquery-jparticle.min.js" defer></script>
<?php } ?>
	<script src="/assets/js/bootstrap.bundle.min.js" defer></script>
	<script src="/assets/js/custom.js?date=<?= date('ymdHis', strtotime('now+9hours')) ?>" defer></script>
	<script src="/assets/js/custom.form.js?date=<?= date('ymdHis', strtotime('now+9hours')) ?>" defer></script>
	<script src="/assets/js/worknplay.js?date=<?= date('ymdHis', strtotime('now+9hours')) ?>" defer></script>
	<script src="/assets/js/worknplay.form.js?date=<?= date('ymdHis', strtotime('now+9hours')) ?>" defer></script>
	<script src="/assets/js/GoogleMap.js" defer></script>
<?php if($_GET['MAIN']=='ADMIN' || $_GET['PAGE']=='Edit'){ ?>
	<script src="/libraries/ckeditor/ckeditor.js" defer></script>
<?php } if($_GET['MAIN']=='ADMIN' || $PAGE['no']=='3550'){ ?>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js" defer></script>
	<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" defer></script>
<?php } ?>
	<script src="//platform-api.sharethis.com/js/sharethis.js#property=5b1df05ee9c37c00114cb775&product=inline-share-buttons" defer></script>
	<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyAUJRxzehHOTBJD3Hi0r5YAqDVBXIbskrA&libraries=places&callback=initAutocomplete&language=en&region=ko" defer></script>
<?php if($_SESSION['PROD_MODE'] && $_GET['MAIN']!='ADMIN'){ ?>
	<script src="//www.googletagmanager.com/gtag/js?id=UA-116950909-1" async defer></script>
	<script async defer>window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'UA-116950909-1');</script>
<?php } ?>

</head>
<body style="font-family: 'Open Sans', sans-serif;">
<?php if($_SESSION['ADMIN'] && $_SESSION['EMAIL']){ ?>
	<div class="text-center text-ins text-danger small"><?= $_SESSION['EMAIL'] ?></div>
<?php } // $WP->printStatus($PAGE); ?>
<?php if(isset($_SESSION['script'])){ ?>
	<script defer>$(function(){ <?= $_SESSION['script'] ?> });</script>
<?php unset($_SESSION['script']); } ?>
<?php if(isset($_SESSION['dialog'])){ ?>
	<script defer>$(function(){ Dialog("<?= $_SESSION['dialog'] ?>"); });</script>
<?php unset($_SESSION['dialog']); } ?>

	<!-- nav.navbar -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom py-lg-0" style="z-index:1021;">
		<div class="container">
			<a class="navbar-brand" href="/" style="font-weight:700;color:var(--primary);"><span class="bg-primary mr-1 rounded text-white" style="padding:.15rem .25rem;">The</span>WorknPlay</a>
			<div class="navbar-expand d-lg-none">
				<div class="navbar-nav dropdown no-arrow ml-auto">
<?php if(false && $_GET['MAIN'] && $_GET['MAIN']!='Account'){ ?>
					<a class="nav-link btn-light border border-secondary rounded-lg align-middle" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
						<span class="text-uppercase align-middle"><?= $_GET['MAIN']=='Work'?'Jobs':$_GET['MAIN'] ?></span>
					</a>
<?php } ?>
					<a class="nav-link dropdown-toggle" id="navbarDropdownMobile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="navbar-toggler-icon"></span></a>
					<div class="dropdown-menu dropdown-menu-right position-absolute" aria-labelledby="navbarDropdownMobile">
					</div>
				</div>
				<script defer>
					$(function() {
						$('#navbarDropdownMobile+.dropdown-menu').append($('#navbarDropdownUser+.dropdown-menu').html());
						if ($('.navbar.sticky-top .navbar-nav.mr-auto .nav-link').length) {
							$('#navbarDropdownMobile+.dropdown-menu').prepend('<div class="dropdown-divider" id="dropdown-divider-mobile"></div>');
							$('.navbar.sticky-top .navbar-nav.mr-auto .nav-link').each(function() {
								$('#dropdown-divider-mobile').before('<a class="dropdown-item text-uppercase" href="' + $(this).attr('href') + '">' + $(this).text() + '</a>');
							});
						}
					});
				</script>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item ml-lg-2<?= $_GET['MAIN']=='Work'?' active':'' ?>">
						<a class="nav-link" href="/Work">JOBS</a>
					</li>
					<li class="nav-item ml-lg-2<?= $_GET['MAIN']=='Tefl'?' active':'' ?>">
						<a class="nav-link" href="/design/TeflTesol#Tefl">TEFL/TESOL</a>
					</li>
					<!-- <li class="nav-item ml-lg-2<?= $_GET['MAIN']=='Lang'?' active':'' ?>">
						<a class="nav-link" href="#Lang">LANGUAGE</a>
					</li> -->
					<li class="nav-item ml-lg-2<?= $_GET['MAIN']=='Blogs'?' active':'' ?>">
						<a class="nav-link" href="/Blogs">BLOGS</a>
					</li>
<?php if($PAGE['no']=='0000'){ ?>
<?php if(empty($_SESSION['ID'])){ ?>
					<li class="nav-item ml-lg-2">
						<span class="nav-link">
							<a href="/LogIn" style="color:inherit;text-decoration:none;">LOG IN</a>
							<span style="pointer-events:none;">|</span>
							<a href="/Register" style="color:inherit;text-decoration:none;">REGISTER</a>
						</span>
					</li>
<?php } if($_SESSION['EMPLOYER']){ ?>
					<li class="nav-item mb-2 mb-lg-0 ml-lg-3">
						<a class="nav-link btn btn-light border p-2 px-lg-3" href="/Work/Employer"><?= $_SESSION['CURRENT_COMPANY_NAME']?$_SESSION['CURRENT_COMPANY_NAME']:'FOR EMPLOYERS' ?></a>
					</li>
<?php }else if($_SESSION['SEEKER']){ ?>
					<li class="nav-item mb-2 mb-lg-0 ml-lg-3">
						<a class="nav-link btn btn-light border p-2 px-lg-3" href="/Work/Seeker"><?= $USER['work_resume_name']?$USER['work_resume_name']:'FOR JOBSEEKERS' ?></a>
					</li>
<?php } ?>
<?php }else if(empty($_SESSION['ID'])){ ?>
					<li class="nav-item ml-lg-2<?= $_GET['PAGE']=='LogIn'?' active':'' ?>">
						<a class="nav-link" href="/LogIn">LOG IN</a>
					</li>
					<li class="nav-item ml-lg-2<?= $_GET['PAGE']=='Register'?' active':'' ?>">
						<a class="nav-link" href="/Register">REGISTER</a>
					</li>
<?php } ?>
					<li class="nav-item ml-lg-2 dropdown no-arrow<?= $PAGE['no']=='0000' || empty($_SESSION['ID'])?' d-none':'' ?>">
<?php if(empty($_SESSION['ID'])){ ?>
						<a class="nav-link dropdown-toggle" id="navbarDropdownUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i></a>
<?php }else if($_SESSION['CURRENT_COMPANY_NAME']){ ?>
						<a class="nav-link dropdown-toggle" id="navbarDropdownUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $_SESSION['CURRENT_COMPANY_NAME'] ?></a>
<?php }else if($USER['work_resume_name']){ ?>
						<a class="nav-link dropdown-toggle" id="navbarDropdownUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $USER['work_resume_name'] ?></a>
<?php }else if($USER['story_profile_nickname']){ ?>
						<a class="nav-link dropdown-toggle" id="navbarDropdownUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $USER['story_profile_nickname'] ?></a>
<?php }else if($USER['nickname']){ ?>
						<a class="nav-link dropdown-toggle" id="navbarDropdownUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $USER['nickname'] ?></a>
<?php }else{ ?>
						<a class="nav-link dropdown-toggle" id="navbarDropdownUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= substr($_SESSION['EMAIL'], 0, strpos($_SESSION['EMAIL'], '@')) . '**' ?></a>
<?php } ?>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownUser">
							<a class="dropdown-item" href="/Work">JOBS</a>
							<a class="dropdown-item" href="/design/TeflTesol#Tefl">TEFL/TESOL</a>
							<!-- <a class="dropdown-item" href="#Lang">LANGUAGE</a> -->
							<a class="dropdown-item" href="/Blogs">BLOGS</a>
							<div class="dropdown-divider"></div>
<?php if($_SESSION['ID']){ ?>
<?php if($_SESSION['EMPLOYER']){ ?>
							<a class="dropdown-item" href="/Work/Employer" title="<?= $_SESSION['EMAIL'] ?>"><?= $_SESSION['CURRENT_COMPANY_NAME']?$_SESSION['CURRENT_COMPANY_NAME']:'FOR EMPLOYERS' ?></a>
<?php }else if($_SESSION['SEEKER']){ ?>
							<a class="dropdown-item" href="/Work/Seeker" title="<?= $_SESSION['EMAIL'] ?>"><?= $USER['work_resume_name']?$USER['work_resume_name']:'FOR JOBSEEKERS' ?></a>
<?php }else{ ?>
							<a class="dropdown-item" href="/Account" title="<?= $_SESSION['EMAIL'] ?>">Account Settings</a>
<?php } ?>
							<a class="dropdown-item" href="/LogOut">LOG OUT</a>
<?php }else{ ?>
							<a class="dropdown-item" href="/Work/Seeker/Intro">FOR JOBSEEKERS</a>
							<a class="dropdown-item" href="/Work/Employer/Intro">FOR EMPLOYERS</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="/LogIn">LOG IN</a>
							<a class="dropdown-item" href="/Register">REGISTER</a>
<?php } ?>
						</div>
					</li>
<?php if($PAGE['no']!='0000' && $_SESSION['ID']){ ?>
					<li class="nav-item ml-lg-2 dropdown no-arrow">
						<a class="nav-link dropdown-toggle" id="navbarDropdownAlert" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bell"></i></a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownAlert">
<?php if($_SESSION['EMPLOYER']){ ?>
							<a class="dropdown-item" href="/Work/Employer/MessageBox">
								<span>Messages</span>
								<span class="badge badge-danger"><?= $USER['work_message'] ?></span>
							</a>
<?php }else if($_SESSION['SEEKER']){ ?>
							<a class="dropdown-item" href="/Work/Seeker/MessageBox">
								<span>Messages</span>
								<span class="badge badge-danger"><?= $USER['work_message'] ?></span>
							</a>
<?php }else{ ?>
							<a class="dropdown-item disabled" href="javascript:void(0);">
								<span>Messages</span>
								<span class="badge badge-danger">0</span>
							</a>
<?php } if(!$_SESSION['EMPLOYER']){ ?>
							<a class="dropdown-item disabled" href="/Work/Seeker/JobAlert">
								<span>Job Alerts</span>
								<span class="badge badge-danger">0</span>
							</a>
<?php } ?>
						</div>
					</li>
<?php } ?>
					<!-- <li class="nav-item ml-lg-2 dropdown no-arrow">
						<a class="nav-link dropdown-toggle" id="navbarDropdownSearch" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-search"></i></a>
						<div class="dropdown-menu dropdown-menu-right py-0" aria-labelledby="navbarDropdownSearch">
							<gcse:search></gcse:search>
							<script async defer>
							(function(){
								var cx = '017014187168293250940:xyyrtykm_sc';
								var gcse = document.createElement('script');
								gcse.type = 'text/javascript';
								gcse.async = true;
								gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
								var s = document.getElementsByTagName('script')[0];
								s.parentNode.insertBefore(gcse, s);
							})();
							$(document).on('hide.bs.dropdown', function(){ if($('.gsc-results-wrapper-visible').length) return false; });
							</script>
							<style>.gsc-control-cse{width:400px;padding:10px;}.gsc-search-box{margin:0 !important;}.gsc-search-button-v2{background-color:var(--primary) !important;}</style>
						</div>
					</li> -->
					<li class="nav-item ml-lg-2 dropdown no-arrow<?= $_GET['MAIN']=='About'?' active':'' ?>">
						<a class="nav-link dropdown-toggle" id="navbarDropdownLanguage" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Language</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownLanguage">
							<a class="dropdown-item" href="javascript:void(0);">English</a>
							<a class="dropdown-item" href="<?= $PAGE['no']=='3510'?'/Work/Employer/Intro/Korean':'/About/Korean/Intro' ?>">한국어</a>
							<a class="dropdown-item" href="javascript:void(0);">简体中文</a>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- /nav.navbar -->

