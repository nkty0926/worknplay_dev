<?php

$articles = array_reverse($DB->selectWorkCompany(null, $_SESSION['ID'], null, $_GET['keyword']));

if (!$_SESSION['RECRUITER']) {
	header('Location: /Work/Detail/Company/' . $articles[0]['no']);
	exit();
}

if (!isset($_GET['page']) || empty($_GET['page'])) {
	$_GET['page'] = 1;
}

include_once 'pages/3000_Work/3000_Work_header.php';

?>
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

			<h4 class="border-bottom mb-4 pb-2">Company Profiles</h4>

			<!-- form -->
			<form method="get" action="/Work/Employer/ManageProfiles">
				<div class="form-row justify-content-end mb-2 mt-lg-n5 pt-lg-2">
					<div class="col-sm-6 col-lg-3 mt-lg-n3">
						<a class="btn btn-primary btn-sm float-right" href="/Work/Edit/Company/_NEW">New Company Profile</a>
					</div>
					<div class="col-sm-6 col-lg-3 mt-lg-n3">
						<div class="input-group input-group-sm">
							<input type="text" class="form-control form-control-lg border-right-0" name="keyword" value="<?= $_GET['keyword'] ?>" placeholder="Keyword">
							<label class="input-group-append mb-0">
								<button type="submit" class="input-group-text bg-white text-black-50 border-left-0"><i class="fa fa-fw fa-search"></i></button>
							</label>
						</div>
					</div>
				</div>
			</form>
			<!-- /form -->

			<!-- .row -->
			<div class="row mx-lg-n2">
<?php foreach($articles as $article){ ?>
				<div class="col-12 col-sm-6 col-lg-4 mb-3 mb-sm-4 mb-lg-3 px-lg-2">
<?php include 'pages/3000_Work/3000_Work_article_company.php'; ?>
				</div>
<?php } ?>
			</div>
			<!-- /.row -->

<?php include_once 'pages/common/pagination.php'; ?>

		</section>
		<!-- /section -->

			</div>
		</div>
	</main>
	<!-- /main -->