<?php

include_once 'pages/4000_Blogs/4000_Blogs_header.php';

$articles = $DB->selectStoryArticle(null, null, null, !isset($_GET['category']) || empty($_GET['category']) || $_GET['category'] == 'All' ? null : $_GET['category'], $_GET['keyword']);

if (!isset($_GET['page']) || empty($_GET['page'])) {
	$_GET['page'] = 1;
}

if (!isset($_GET['list'])) {
	$_GET['list'] = 1;
}

?>
	<!-- main -->
	<main class="py-3 py-lg-5">
		<div class="container">
			<div class="row">

		<!-- section -->
		<section class="col-lg-12 mb-5">
			<div class="row text-center border-bottom border-right mx-0">
				<div class="border-top border-left p-0 col d-none d-lg-flex">
					<a class="d-block w-100 h-100 p-2 text-dark category<?= $_GET['category']=='All'?' active':'' ?>" href="/Blogs?category=All&list=<?= $_GET['list']?1:0 ?>">All</a>
				</div>
<?php foreach($CONF['story_category'] as $category_idx => $category){ ?>
				<div class="border-top border-left p-0 col">
					<a class="d-block w-100 h-100 p-2 text-dark category<?= $_GET['category']==$category?' active':'' ?>" href="/Blogs?category=<?= $category ?>&list=<?= $_GET['list']?1:0 ?>"><?= str_replace('_', ' ', $category) ?></a>
				</div>
<?php if($category_idx%3==2){ ?>
				<div class="w-100 d-block d-lg-none"></div>
<?php } if($category_idx==3){ ?>
				<div class="w-100 d-none d-lg-block"></div>
<?php }} ?>
				<!-- <div class="border-top border-left p-0 col d-none d-lg-flex">
					<a class="d-block w-100 h-100 p-2 text-dark category<?= $_GET['category']=='Others'?' active':'' ?>" href="/Blogs?category=Others&list=<?= $_GET['list']?1:0 ?>">Others</a>
				</div> -->
			</div>
			<style>.category.active{background-color:var(--gray-light);font-weight:bold;}.category:hover{background-color:var(--gray-lighter);text-decoration:none;}@media(max-width:374.98px){.category{font-size:80%;}}</style>
		</section>
		<!-- /section -->

		<!-- section -->
		<section class="col-lg-9">

			<a class="float-right text-dark mt-1" href="/Blogs/?category=<?= $_GET['category'] ?>&list=<?= $_GET['list']?0:1 ?>&page=<?= $_GET['page'] ?>"><i class="fa fa-th-<?= $_GET['list']?'large':'list' ?>"></i></a>
			<h4 class="border-bottom pb-2 mb-3" title="<?= $CONF['pagination_total'] ?> results"><?= !isset($_GET['category']) || empty($_GET['category'])?'All':str_replace('_', ' ', $_GET['category']) ?></h4>

			<!-- .row -->
			<div class="row">
<?php foreach($articles as $article){ ?>
				<div class="<?= $_GET['list']?'col-12':'col-6 col-lg-4' ?>">
<?php include 'pages/4000_Blogs/4000_Blogs_article.php'; ?>
				</div>
<?php } ?>
			</div>
			<!-- /.row -->

<?php include_once 'pages/common/pagination.php'; ?>

		</section>
		<!-- /section -->

		<!-- aside -->
		<aside class="col-lg-3 col-sm-6">

			<!-- form -->
			<form method="get" action="/Blogs">
				<input type="hidden" name="list" value="<?= $_GET['list'] ?>" />
				<input type="hidden" name="category" value="<?= $_GET['category'] ?>" />
				<div class="form-group input-group">
					<input type="text" class="form-control form-control-lg border-right-0" name="keyword" value="<?= $_GET['keyword'] ?>" placeholder="Keyword" />
					<label class="input-group-append mb-0">
						<button type="submit" class="input-group-text bg-white text-black-50 border-left-0"><i class="fa fa-fw fa-search"></i></button>
					</label>
				</div>
			</form>
			<!-- /form -->

			<a class="float-right text-dark small" href="/Blogs/Search/Profile">More ▶</a>
			<h6 class="mb-2">Author</h6>

			<!-- .card -->
			<div class="card">
				<div class="card-body p-3">
					<style>article.border-bottom.pb-3.mb-3:last-child{border-bottom:0 !important;padding-bottom:0 !important;margin-bottom:0 !important;}</style>
<?php $_GET['page'] = 1; $profiles = $DB->selectStoryProfile(); for($i=0; $i<8 && $i<count($profiles); $i++){ ?>
					<article class="media position-relative border-bottom pb-3 mb-3">
						<!-- <figure class="float-left mr-2 mb-0">
							<img class="mw-100 mh-100 rounded-circle" src="<?= $profiles[$i]['logo_img'] ?>" alt="<?= $profiles[$i]['profile_title'] ?>" title="<?= $profiles[$i]['profile_title'] ?>" onerror="this.src='/assets/images/common-profile.png'" width="60" height="60" />
						</figure> -->
						<img class="float-left mr-2" src="<?= $profiles[$i]['logo_img'] ?>" alt="<?= $profiles[$i]['profile_title'] ?>" title="<?= $profiles[$i]['profile_title'] ?>" onerror="this.src='/assets/images/common-profile.png'" width="64">
						<div class="media-body">
							<a class="stretched-link text-dark" href="/Blogs/Detail/Profile/<?= $profiles[$i]['no'] ?>" title="<?= $profiles[$i]['nickname'] ?>">
								<h6 class="font-weight-bold line-clamp-1 small"><?= $profiles[$i]['nickname'] ?></h6>
							</a>
							<p class="mb-0 line-clamp-2 small"><?= $profiles[$i]['profile_title'] ?></p>
						</div>
					</article>
<?php } ?>
				</div>
			</div>
			<!-- /.card -->

		</aside>
		<!-- /aside -->

			</div>
		</div>
	</main>
	<!-- /main -->
