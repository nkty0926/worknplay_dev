<?php

include_once 'pages/4000_Blogs/4000_Blogs_header.php';

$articles = $DB->selectStoryProfile();

if (!isset($_GET['page']) || empty($_GET['page'])) {
	$_GET['page'] = 1;
}

if (!isset($_GET['list'])) {
	$_GET['list'] = 0;
}

?>
	<!-- main -->
	<main class="py-3 py-lg-5">
		<div class="container">
			<div class="row">

		<!-- section -->
		<section class="col-lg-9">

			<h4 class="mb-4" title="<?= $CONF['pagination_total'] ?> results">Author List</h4>

			<!-- .row -->
			<div class="row mx-lg-n2">
<?php foreach($articles as $article){ ?>
				<div class="col-12 col-sm-6 col-lg-4 mb-3 px-lg-2">
					<article class="card border-secondary shadow-sm h-100">
						<div class="card-body position-relative">
							<figure class="" style="height:60px;line-height:60px;">
								<img class="mw-100 mh-100" src="<?= $article['logo_img'] ?>" alt="<?= $article['profile_title'] ?>" title="<?= $article['profile_title'] ?>" onerror="this.src='/assets/images/common-noimage.png'" />
							</figure>
							<hr />
							<h6 class="card-title line-clamp-1"><a class="text-dark stretched-link" href="/Blogs/Detail/Profile/<?= $article['no'] ?>" title="<?= $article['profile_title'] ?>"><?= $article['nickname'] ?></a></h6>
							<p class="card-text text-muted line-clamp-2"><?= $WP->stringFilter($article['profile_title']) ?></p>
						</div>
					</article>
				</div>
<?php } ?>
			</div>
			<!-- /.row -->

<?php include_once 'pages/common/pagination.php'; ?>

<?php include 'pages/common/adsbygoogle-horizontal.php'; ?>

		</section>
		<!-- /section -->

		<!-- aside -->
		<aside class="col-lg-3">

<?php include 'pages/common/adsbygoogle-square.php'; ?>

		</aside>
		<!-- /aside -->

			</div>
		</div>
	</main>
	<!-- /main -->