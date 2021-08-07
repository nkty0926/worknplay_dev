<?php

if (isset($_GET['keyword'])) {
	$query = "select * from common_question where content not like '' and name like :keyword_name or email like :keyword_email or title like :keyword_title order by no desc";
	$stmt = $DB->conn->prepare($query);
	$stmt->bindValue(":keyword_name", '%' . $_GET['keyword'] . '%');
	$stmt->bindValue(":keyword_email", '%' . $_GET['keyword'] . '%');
	$stmt->bindValue(":keyword_title", '%' . $_GET['keyword'] . '%');
	$stmt->execute();
	$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
} else $articles = $DB->conn->query("select * from common_question where content not like '' order by no desc")->fetchAll(PDO::FETCH_ASSOC);

if (!isset($_GET['page']) || empty($_GET['page'])) {
	$_GET['page'] = 1;
}

$CONF['pagination_total'] = count($articles);

include_once 'pages/9000_ADMIN/9000_ADMIN_header.php';

?>
	<section class="container-fluid">

		<div class="row">
			<div class="col-lg-4">
				<form action="" method="get" class="form-group input-group">
					<label class="input-group-prepend mb-0" for="searchKeyword">
						<span class="input-group-text bg-white text-black-50 border-right-0"><i class="fa fa-fw fa-search"></i></span>
					</label>
					<input type="text" class="form-control border-left-0" id="searchKeyword" name="keyword" value="<?= isset($_GET['keyword'])?$_GET['keyword']:'' ?>" placeholder="Keyword" />
					<div class="input-group-append">
						<button type="submit" class="btn btn-light">Search</button>
					</div>
				</form>
			</div>
		</div>

		<table class="table table-bordered table-hover table-sm dataTables_wrapper">
			<thead class="thead-light">
				<tr>
					<th width="60px" class="d-none d-md-table-cell">NO</th>
					<th width="180px" class="d-none d-md-table-cell">DATE</th>
					<th class="d-none d-md-table-cell">NAME</th>
					<th class="d-none d-md-table-cell">EMAIL</th>
					<th>TITLE</th>
					<th width="180px">PAGE</th>
				</tr>
			</thead>
			<tbody>
<?php for($i=($_GET['page']-1)*$CONF['pagination_articles']; $i<$_GET['page']*$CONF['pagination_articles'] && $i<$CONF['pagination_total']; $i++){ $article = $WP->xssFilter($articles[$i]);
	$title = $article['title'] . " (" . $page['title_kor'] . ")<br/><small>Name: " . $article['name'] . " / E-mail: " . $article['email'] . ($article['phone']?" / Tel: " . $article['phone']:"") . "</small>";
	if(empty($article['title'])) $article['title'] = '(empty)';
	$content = nl2br($article['content']);
	$page = $DB->selectPage($article['page']);
	if(!empty($article['pk'])){
		$page['url'] = preg_replace('/\[(.*)\]/', $article['pk'], $page['url']);
		if(!empty($page['url'])){
			$content .= "<br/><br/><a href='" . $page['url'] . "' target='_blank'>" . $page['url'] . "</a>";
		}
	}
 ?>
				<tr>
					<td class="d-none d-md-table-cell"><?= $article['no'] ?></td>
					<td class="d-none d-md-table-cell"><?= $article['date'] ?></td>
					<td class="d-none d-md-table-cell"><?= $article['name'] ?></td>
					<td class="d-none d-md-table-cell"><?= $article['email'] ?></td>
					<td><a class="btn-link" data-toggle="modal" data-target="#detail" title="<?= $title ?>" data-content="<?= $content ?>"><?= $article['title'] ?></a></td>
					<td><?= $page['title_kor'] ?></td>
				</tr>
<?php } ?>
			</tbody>
		</table>

<?php include_once 'pages/common/pagination.php'; ?>

	</section>