<?php

	$keys = array(
		'page',
		'MAIN',
		'PAGE',
		'MENU',
		'PK',
		'SUB'
	);
	$PAGEPATH = '/' . $_GET['MAIN'];
	foreach ($keys as $i => $key) {
		if ($i > 1 && $_GET[$key]) {
			$PAGEPATH .= '/' . $_GET[$key];
		}
	}
	$PARAMETER = '';
	foreach ($_GET as $key => $val) {
		if (!in_array($key, $keys)) {
			if (is_array($val)) {
				foreach ($val as $v) {
					$PARAMETER .= '&' . $key . '%5B%5D=' . urlencode($v);
				}
			} else {
				$PARAMETER .= '&' . $key . '=' . urlencode($val);
			}
		}
	}
	$page = $_GET['page'];
	$page_last = ceil($CONF['pagination_total'] / $CONF['pagination_articles']);
	$pagination_first = $page - ($CONF['pagination_pages'] / 2) < 1 ? 1 : $page - ($CONF['pagination_pages'] / 2);
	$pagination_last = $pagination_first + $CONF['pagination_pages'] > $page_last ? $page_last : $pagination_first + $CONF['pagination_pages'];
	if ($pagination_last == $page_last)
		$pagination_first = $page_last - $CONF['pagination_pages'] < 1 ? 1 : $page_last - $CONF['pagination_pages'];
	if ($page_last > 0 && $_GET['page'] > $page_last) {
?>
			<script>location.replace("<?= $PAGEPATH ?>?page=<?= $page_last ?><?= $PARAMETER ?>");</script>
<?php } else if ($page_last > 1) { ?>
			<!-- .pagination -->
			<ul class="pagination justify-content-start">
				<li class="page-item"><a class="page-link" href="<?= $PAGEPATH ?>?page=1<?= $PARAMETER ?>">&laquo;</a></li>
<?php for ($i = $pagination_first; $i <= $pagination_last; $i++) { ?>
				<li class="page-item<?= $i==$page?' active':'' ?>"><a class="page-link" href="<?= $PAGEPATH ?>?page=<?= $i ?><?= $PARAMETER ?>"><?= $i ?></a></li>
<?php } ?>
				<li class="page-item"><a class="page-link" href="<?= $PAGEPATH ?>?page=<?= $page_last ?><?= $PARAMETER ?>">&raquo;</a></li>
			</ul>
			<!-- .pagination -->
<?php } ?>
