<?php

include_once 'pages/3000_Work/3200_Work_Detail_header.php';

if (!isset($_GET['page']) || empty($_GET['page'])) {
	$_GET['page'] = 1;
}
if (!isset($_GET['list']) || empty($_GET['list'])) {
	$_GET['list'] = 0;
}

$CONF['pagination_total'] = count($events);

?>
	<!-- main -->
	<main class="py-3">
		<div class="container">
			<div class="row">

		<!-- section -->
		<section class="col-lg-9">

<?php if($_SESSION['ID'] && $rs['member']==$_SESSION['ID']){ ?>
			<a class="btn btn-primary btn-sm float-right" href="/Work/Edit/Event/_NEW?profile=<?= $rs['no'] ?>">Post an Event</a>
<?php } ?>
			<h5 class="border-bottom pb-2 mb-3">News &amp; Events</h5>

			<div class="row mx-lg-n2">
<?php for($i=($_GET['page']-1)*$CONF['pagination_articles']; $i<$_GET['page']*$CONF['pagination_articles'] && $i<$CONF['pagination_total']; $i++){ $article = $events[$i]; ?>
				<div class="col-12 col-sm-6 col-lg-4 mb-3 mb-sm-4 mb-lg-3 px-lg-2">
<?php include 'pages/3000_Work/3000_Work_article_event.php'; ?>
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