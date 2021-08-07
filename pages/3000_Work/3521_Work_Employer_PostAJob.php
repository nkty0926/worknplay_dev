<?php


if ($_SESSION['CURRENT_COMPANY']) {
	$employer = $DB->selectWorkCompany($_SESSION['CURRENT_COMPANY']);
}
$purchase = $DB->selectWorkPurchase();
$jobs = $DB->selectWorkJob(null, null, $_SESSION['ID']);

include_once 'pages/3000_Work/3000_Work_header.php';

?>
<?php if($_GET['MENU']!='Home'){ ?>
	<!-- main -->
	<main class="py-3 py-lg-5">
		<div class="container">
			<div class="row">

		<!-- section -->
		<section class="col-lg-12">

			<h3 class="mb-4">My Page</h3>

		</section>
		<!-- /section -->

		<!-- aside -->
		<aside class="col-lg-3">

<?php include_once 'pages/2000_Account/2000_Account_sidebar.php'; ?>

		</aside>
		<!-- /aside -->

		<!-- section -->
		<section class="col-lg-9">
<?php } ?>

<?php if(isset($purchase[0]['no']) && empty($purchase[0]['appr'])){ ?>
			<div class="alert alert-dark text-center" role="alert">
				<a class="alert-link" href="/Work/Employer/OrderHistory">Your order is still pending <span class="float-right">>>>Go</span></a>
			</div>
<?php }else if(isset($employer['no']) && empty($employer['publ'])){ ?>
			<div class="alert alert-dark text-center" role="alert">
				<a class="alert-link" href="/Work/Edit/Company/<?= $employer['no']?$employer['no']:'_NEW' ?>?next=_NEW<?= !$USER['work_credit_hot'] || !$_SESSION['work_company_next_hot']?'':'&hot=1' ?>">Profile incomplete. Please complete your profile to post a <ins><?= !$USER['work_credit_hot'] || !$_SESSION['work_company_next_hot']?'standard':'hot' ?></ins> job. <span class="float-right">>>>Go</span></a>
			</div>
<?php }else if(isset($employer['no']) && !isset($jobs[0]['no'])){ ?>
			<div class="alert alert-dark text-center" role="alert">
				<a class="alert-link" href="/Work/Edit/Job/_NEW<?= !$USER['work_credit_hot'] || !$_SESSION['work_company_next_hot']?'':'?hot=1' ?>">Continue to post a <ins><?= !$USER['work_credit_hot'] || !$_SESSION['work_company_next_hot']?'standard':'hot' ?></ins> Job. <span class="float-right">>>>Go</span></a>
			</div>
<?php } if(isset($jobs[0]['no']) && empty($jobs[0]['publ'])){ ?>
			<div class="alert alert-dark text-center" role="alert">
				<a class="alert-link" href="/Work/Edit/Job/<?= $jobs[0]['no'] ?><?= $jobs[0]['hot']?'?hot=1':'' ?>">Posting incomplete. Please complete to post <?= $jobs[0]['hot']?'hot':'standard' ?> job. <span class="float-right">>>>Go</span></a>
			</div>
<?php } if(isset($jobs[1]['no']) && empty($jobs[1]['publ'])){ ?>
			<div class="alert alert-dark text-center" role="alert">
				<a class="alert-link" href="/Work/Edit/Job/<?= $jobs[1]['no'] ?><?= $jobs[1]['hot']?'?hot=1':'' ?>">Posting incomplete. Please complete to post <?= $jobs[1]['hot']?'hot':'standard' ?> job. <span class="float-right">>>>Go</span></a>
			</div>
<?php } ?>

			<a class="float-right mt-2" href="/Work/Employer/Intro">Products</a>
			<h4 class="border-bottom mb-4 pb-2">Hiring Solutions</h4>

			<div class="row text-center mb-n4">
				<div class="col-lg-4 mb-4">
					<article class="card bg-light h-100">
						<div class="card-header bg-gray">
							<h4 class="font-weight-bold mb-0">Hot Job</h4>
						</div>
						<div class="card-body">
							<p class="mb-0">Remaining Credits</p>
							<p class=""><?= $USER['work_credit_hot'] ?> EA</p>
<?php if(isset($jobs[0]['no']) && isset($jobs[0]['hot']) && !empty($jobs[0]['hot']) && (!isset($jobs[0]['publ']) || empty($jobs[0]['publ']))){ ?>
							<a class="btn btn-light font-weight-bold mt-lg-1" style="font-size:.8rem;" href="/Work/Edit/Job/<?= $jobs[0]['no'] ?>?hot=1">POST A JOB</a>
<?php }else if(isset($jobs[1]['no']) && isset($jobs[1]['hot']) && !empty($jobs[1]['hot']) && (!isset($jobs[1]['publ']) || empty($jobs[1]['publ']))){ ?>
							<a class="btn btn-light font-weight-bold mt-lg-1" style="font-size:.8rem;" href="/Work/Edit/Job/<?= $jobs[1]['no'] ?>?hot=1">POST A JOB</a>
<?php }else if($USER['work_credit_hot'] && (!isset($employer['publ']) || empty($employer['publ']))){ ?>
							<a class="btn btn-light font-weight-bold mt-lg-1" style="font-size:.8rem;" href="/Work/Edit/Company/<?= $employer['no']?$employer['no']:'_NEW' ?>?next=_NEW&hot=1">POST A JOB</a>
<?php }else if($USER['work_credit_hot']){ ?>
							<a class="btn btn-light font-weight-bold mt-lg-1" style="font-size:.8rem;" href="/Work/Edit/Job/_NEW?hot=1">POST A JOB</a>
<?php } ?>
							<a class="btn btn-light font-weight-bold mt-lg-1" style="font-size:.8rem;" href="/Work/Product/Select">BUY NOW</a>
						</div>
					</article>
				</div>
				<div class="col-lg-4 mb-4">
					<article class="card bg-light h-100">
						<div class="card-header bg-gray">
							<h4 class="font-weight-bold mb-0">Standard Job</h4>
						</div>
						<div class="card-body">
							<p class="mb-0">Remaining Credits</p>
							<p class=""><?= $USER['work_credit_job'] ?> EA</p>
<?php if(isset($jobs[0]['no']) && (!isset($jobs[0]['hot']) || empty($jobs[0]['hot'])) && (!isset($jobs[0]['publ']) || empty($jobs[0]['publ']))){ ?>
							<a class="btn btn-light font-weight-bold mt-lg-1" style="font-size:.8rem;" href="/Work/Edit/Job/<?= $jobs[0]['no'] ?>">POST A JOB</a>
<?php }else if(isset($jobs[1]['no']) && (!isset($jobs[1]['hot']) || empty($jobs[1]['hot'])) && (!isset($jobs[1]['publ']) || empty($jobs[1]['publ']))){ ?>
							<a class="btn btn-light font-weight-bold mt-lg-1" style="font-size:.8rem;" href="/Work/Edit/Job/<?= $jobs[1]['no'] ?>">POST A JOB</a>
<?php }else if($USER['work_credit_job'] && !$employer['publ']){ ?>
							<a class="btn btn-light font-weight-bold mt-lg-1" style="font-size:.8rem;" href="/Work/Edit/Company/<?= isset($employer['no'])?$employer['no']:'_NEW' ?>?next=_NEW">POST A JOB</a>
<?php }else if($USER['work_credit_job']){ ?>
							<a class="btn btn-light font-weight-bold mt-lg-1" style="font-size:.8rem;" href="/Work/Edit/Job/_NEW">POST A JOB</a>
<?php } ?>
							<a class="btn btn-light font-weight-bold mt-lg-1" style="font-size:.8rem;" href="/Work/Product/Select">BUY NOW</a>
						</div>
					</article>
				</div>
				<div class="col-lg-4 mb-4">
					<article class="card bg-light h-100">
						<div class="card-header bg-gray">
							<h4 class="font-weight-bold mb-0">Resume Search</h4>
						</div>
						<div class="card-body">
							<p class="mb-0">Remaining Days <small>(Credits)</small></p>
							<p class=""><?= $USER['work_credit_res_day'] ?> Day<?= $USER['work_credit_res_day']>1?'s':'' ?> <small>(<?= count($USER['work_credit_res']) ?> EA)</small></p>
<?php if($USER['work_credit_res_day'] || count($USER['work_credit_res'])){ ?>
							<a class="btn btn-light font-weight-bold mt-lg-1" style="font-size:.8rem;" href="/Work/Search/Resume">SEARCH</a>
<?php } ?>
							<a class="btn btn-light font-weight-bold mt-lg-1" style="font-size:.8rem;" href="/Work/Product/Select">BUY NOW</a>
						</div>
					</article>
				</div>
			</div>
<?php if($_GET['MENU']!='Home'){ ?>

		</section>
		<!-- /section -->

			</div>
		</div>
	</main>
	<!-- /main -->
<?php } ?>