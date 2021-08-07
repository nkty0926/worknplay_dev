<?php

if (isset($_POST['action']) && $_POST['action'] == 'edit' && isset($_POST['no']) && !empty($_POST['no'])) {
	$stmt = $DB->conn->prepare("update common_page set `title` = :title, `description` = :description, `image` = :image, `keywords` = :keywords where no = :no");
	$values = array(
		':no' => $_POST['no'],
		':title' => $_POST['title'],
		':description' => $_POST['description'],
		':image' => $_POST['image'],
		':keywords' => $_POST['keywords']
	);
	$stmt->execute($values);
	$stmt->closeCursor();
	header('Location: /ADMIN/Common/Page');
} else if (isset($_POST['action']) && $_POST['action'] == 'detail' && isset($_POST['no']) && !empty($_POST['no'])) {
	$page = $DB->selectPage($_POST['no']);
?>
<form action="" method="post">
	<table class="table table-bordered table-sm text-center">
		<thead class="thead-light">
			<tr>
				<th width="40%">URL</th>
				<td width="60%">
					<a href="<?= $page['url'] ?>" target="_blank"><?= $page['url'] ?></a>
					<input type="hidden" name="no" value="<?= $page['no'] ?>" />
				</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th>name</th>
				<td class="has-input" style="height:32px;">
					<input type="text" value="<?= $page['title_kor'] ?>" disabled />
				</td>
			</tr>
			<tr>
				<th>title</th>
				<td class="has-input" style="height:32px;">
					<input type="text" name="title" value="<?= $page['title'] ?>" />
				</td>
			</tr>
			<tr>
				<th>description</th>
				<td class="has-input" style="height:32px;">
					<textarea class="form-control textarea-autoheight" name="description" rows="2"><?= $page['description'] ?></textarea>
				</td>
			</tr>
			<tr>
				<th>image</th>
				<td class="has-input" style="height:32px;">
					<textarea class="form-control textarea-autoheight" name="image" rows="2"><?= $page['image'] ?></textarea>
				</td>
			</tr>
			<tr>
				<th>keywords</th>
				<td class="has-input" style="height:32px;">
					<textarea class="form-control textarea-autoheight" name="keywords" rows="2"><?= $page['keywords'] ?></textarea>
				</td>
			</tr>
			<tr>
				<td colspan="2" class="text-right" style="padding:10px;">
					<button type="submit" class="btn btn-light" name="action" value="edit">저장</button>
					<button type="button" class="btn btn-light" data-dismiss="modal">닫기</button>
				</td>
			</tr>
		</tbody>
	</table>
</form>
<?php
	exit;
}

$articles = $DB->conn->query("select * from common_page_view where no not like '9%' order by no")->fetchAll(PDO::FETCH_ASSOC);

include_once 'pages/9000_ADMIN/9000_ADMIN_header.php';

?>
	<style>#detail .modal-body{padding:0;}#detail .modal-footer{display:none;}</style>
	<section class="container-fluid">

		<table class="table table-bordered table-hover table-sm" id="dataTable">
			<thead class="thead-light">
				<tr>
					<th width="60px">NO</th>
					<th width="60px">LOGIN</th>
					<th width="400px">URL</th>
					<th width="400px">FILE</th>
					<th width="200px">TITLE</th>
				</tr>
			</thead>
			<tbody>
<?php foreach($articles as $article){ ?>
				<tr>
					<td><?= $article['no'] ?></td>
					<td><?= $article['login']?'required':'' ?></td>
					<td><?= $article['url'] ?></td>
					<td><?= $article['file'] ?></td>
					<td><a class="btn-link" data-toggle="modal" data-target="#detail" title="<?= $article['title'] ?>" data-pk="<?= $article['no'] ?>"><?= $article['title'] ?></a></td>
				</tr>
<?php } ?>
			</tbody>
		</table>
	</section>

	<script>
$(document).on('click', '[data-toggle="modal"][data-target="#detail"]', function(){
	$.ajax({ type: 'post', url: '/ADMIN/Common/Page', data: 'action=detail&no=' + $(this).attr('data-pk'), success: function(result){
		$('#detail .modal-body').html(result);
	} });
});
	</script>