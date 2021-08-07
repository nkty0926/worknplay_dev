<?php

include_once 'pages/4000_Blogs/4000_Blogs_header.php';

if (empty($USER['story_profile'])) {
	echo '<script>location.replace("/Blogs");</script>';
	exit();
} else {
	$serieses = $DB->selectStorySeries(null, $_SESSION['ID']);
	$articles = $DB->selectStoryArticle(null, $USER['story_profile'], $_GET['series']);
}

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

			<h4 class="border-bottom pb-2 mb-3" title="<?= $CONF['pagination_total'] ?> results">My Series</h4>

<?php foreach($serieses as $series){ $series_header_img = $DB->selectStoryArticle(null, $USER['story_profile'], $series['no'])[0]['header_img']; ?>
			<article class="card mb-4">
				<div class="card-body py-0 pl-0">
					<div class="form-row">
						<div class="col-lg-4 col-6">
							<a class="embed-responsive embed-responsive-16by9" href="/Blogs/MyPage?series=<?= $series['no'] ?>" title="<?= $series['series_title'] ?>" onerror="this.src='/assets/images/common-noimage.png'">
								<figure class="embed-responsive-item d-flex align-items-center">
									<img class="mw-100" src="<?= $series_header_img ?>" alt="<?= $series['series_title'] ?>" title="<?= $series['series_title'] ?>" onerror="this.src='/assets/images/common-noimage.png'" style="min-height:100%;" />
								</figure>
							</a>
						</div>
						<div class="col-lg-8 col-6 pt-2">
							<h5><?= $series['series_title'] ?></h5>
							<p>Posts : <?= count($DB->selectStoryArticle(null, $USER['story_profile'], $series['no'])) ?></p>
							<footer><?= date($CONF['date_format'], strtotime($series['date'])) ?></footer>
							<div class="form-group mb-0 dropdown">
								<button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle float-right" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" data-toggle="modal" data-target="#modalFormEditSeries" data-pk="<?= $series['no'] ?>">Edit</a>
									<a class="dropdown-item" data-toggle="action" data-action="delete" data-table="story_series" data-pk="<?= $series['no'] ?>">Delete</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</article>

<?php } ?>
		</section>
		<!-- /section -->

			</div>
		</div>
	</main>
	<!-- /main -->

	<!-- .modal#modalFormEditSeries -->
	<form class="modal" id="modalFormEditSeries" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-md" role="document">
	<div class="modal-content">
		<div class="modal-body">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<div class="form-group">
				<h4 class="modal-title">Edit Series Name</h4>
			</div>
			<div class="form-row" id="Form-Series">
				<div class="col-lg-8">
					<input type="text" class="form-control" name="series_title" placeholder="Series Title" maxlength="255" />
					<input type="hidden" name="series_no" value="" />
				</div>
				<div class="col-lg-2">
					<button type="button" class="btn btn-block btn-secondary" data-type="publish">Submit</button>
				</div>
				<div class="col-lg-2">
					<button type="button" class="btn btn-block btn-light" data-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div>
		</div>
		<script defer>
			$('#Form-Series [data-type="publish"]').on('click', function(e){
				var series_no = $('input[name="series_no"]').val();
				var series_title = $('input[name="series_title"]').val();
				if(series_title){
					$.ajax({
						type: 'post', url: '/actions/EditSeries', data: 'action=EditSeries&pk=' + series_no + '&series_title=' + series_title,
						success: function(result){
							if (!isNaN(parseInt(result))) { 
								location.reload();
							} else {
								Alert("This name already exists.");
							}
						}
					});
				}
			});
		</script>
	</form>
	<!-- /.modal#modalFormEditSeries -->

	<script defer>
		$('a[data-target="#modalFormEditSeries"]').on('click', function(){
			$('#modalFormEditSeries').find('input[name="series_no"]').val($(this).attr('data-pk'));
			$('#modalFormEditSeries').find('input[name="series_title"]').val($(this).parents('article').find('h5').text());
		});
	</script>