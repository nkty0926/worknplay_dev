<?php

include_once 'pages/3000_Work/3200_Work_Detail_header.php';

if (!isset($_GET['page']) || empty($_GET['page'])) {
	$_GET['page'] = 1;
}
if (!isset($_GET['list']) || empty($_GET['list'])) {
	$_GET['list'] = 0;
}

$CONF['pagination_total'] = count($stories);

?>
	<!-- main -->
	<main class="py-3">
		<div class="container">
			<div class="row">

		<!-- section -->
		<section class="col-lg-9">

<?php if($_SESSION['ID'] && $rs['member']==$_SESSION['ID']){ ?>
			<a class="btn btn-primary btn-sm float-right" href="/Blogs/Edit/Article/_NEW?category=<?= 'Work_and_Business&company=' . $rs['no'] ?>#<?= $rs['name'] ?>">Post a Blog</a>
<?php } ?>
			<h5 class="border-bottom pb-2 mb-3">Blogs</h5>

			<div class="row">
<?php for($i=($_GET['page']-1)*$CONF['pagination_articles']; $i<$_GET['page']*$CONF['pagination_articles'] && $i<$CONF['pagination_total']; $i++){ $article = $stories[$i]; ?>
				<div class="col-12 col-sm-6 col-lg-4 mb-3">
<?php include 'pages/4000_Blogs/4000_Blogs_article.php'; ?>
				</div>
<?php } ?>
			</div>

<?php include_once 'pages/common/pagination.php'; ?>

		</section>
		<!-- /section -->

		<!-- aside -->
		<aside class="col-lg-3">

<?php include_once 'pages/3000_Work/3210_Work_Detail_aside.php'; ?>

		</aside>
		<!-- /aside -->

			</div>
		</div>
	</main>
	<!-- /main -->