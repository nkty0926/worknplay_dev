<?php

$pagination_total = $CONF['pagination_total'];
if (!isset($_SESSION['work_aside_hots']) || empty($_SESSION['work_aside_hots'])) {
	$hots = $DB->searchWorkJob(true);
	shuffle($hots);
	$hots = array_slice($hots, 0, 5);
	foreach ($hots as $i => $article)
		foreach ($article as $key => $val)
			$hots[$i][$key] = $WP->stringFilter($val);
	$_SESSION['work_aside_hots'] = $hots;
	$CONF['pagination_total'] = $pagination_total;
}

if (count($_SESSION['work_aside_hots'])) {
?>
			<!-- section -->
			<section class="mb-4">

				<h5 class="border-bottom pb-2 mb-2">Hot Jobs</h5>

<?php foreach($_SESSION['work_aside_hots'] as $article){ ?>
				<article class="position-relative border-bottom pb-2 mb-2">
					<h6 class="line-clamp-1"><a class="text-dark stretched-link" href="/Work/Detail/Job/<?= $article['no'] ?>"><?= $article['title'] ?></a></h6>
					<p class="line-clamp-1 small mb-0"><?= $article['company_name'] ?></p>
				</article>

<?php } ?>
			</section>
			<!-- /section -->
<?php } ?>