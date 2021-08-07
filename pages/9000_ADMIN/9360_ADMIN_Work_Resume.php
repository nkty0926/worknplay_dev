<?php

if (isset($_POST['action']) && $_POST['action'] == 'appr' && isset($_POST['no'])) {
	$query = "update work_resume set appr = (appr + 1) % 2 where no = :no";
	$stmt = $DB->conn->prepare($query);
	$stmt->bindParam(":no", $_POST['no']);
	$stmt->execute();
	$stmt->closeCursor();
	exit();
} else {
	$query = "select work_resume.no, work_resume.date, work_resume.mod, work_resume.publ, work_resume.appr, work_resume.hits, work_resume.title, member.email from work_resume_view work_resume left join member on work_resume.member = member.no where left(date_add(work_resume.date, interval :day day), 10) > left(now(), 10)";
	$stmt = $DB->conn->prepare($query);
	$stmt->bindValue(":day", isset($_GET['day']) && !empty($_GET['day']) ? $_GET['day'] : "90");
	$stmt->execute();
	$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
}

include_once 'pages/9000_ADMIN/9000_ADMIN_header.php';

?>
	<script>
$(document).on('change', 'input[type="checkbox"][name="appr"]', function(){
	$.ajax({ type: 'post', url: '/ADMIN/Work/Resume', data: 'action=' + $(this).attr('name') + '&no=' + $(this).val() });
	if($(this).prop('checked')) $(this).next('span').text('승인'); else $(this).next('span').text('미승인');
});
	</script>

	<section class="container-fluid">

		<table class="table table-bordered table-hover table-sm" id="dataTable">
			<thead class="thead-light">
				<tr>
					<th width="60px">순번</th>
					<th width="100px">등록일</th>
					<th width="100px">수정일</th>
					<th>제목</th>
					<th width="200px">계정</th>
					<th width="60px">상태</th>
					<th width="80px">승인</th>
					<th width="60px">조회수</th>
					<th width="60px">삭제</th>
				</tr>
			</thead>
			<tbody>
<?php foreach($articles as $article){ ?>
				<tr>
					<td><?= $article['no'] ?></td>
					<td><?= date('Y-m-d', strtotime($article['date'])) ?></td>
					<td><?= date('Y-m-d', strtotime($article['mod'])) ?></td>
					<td><a class="btn-link" href="/Work/Detail/Resume/<?= $article['no'] ?>" target="_blank"><?= $article['title'] ?></a></td>
					<td><a class="btn-link" href="/ADMIN/Member?keyword=<?= $article['email'] ?>" target="_blank"><?= $article['email'] ?></a></td>
					<td><?= $article['publ']==1?'완성':($article['publ']==2?'비공개':($article['publ']==3?'-':'미완')) ?></td>
					<td>
						<label class="checkbox-inline">
							<input type="checkbox" name="appr" value="<?= $article['no'] ?>"<?= $article['appr']?' checked':'' ?> />
							<span><?= $article['appr']?'승인':'미승인' ?></span>
						</label>
					</td>
					<td><?= $article['hits'] ?></td>
					<td><a class="btn-link" data-toggle="action" data-action="delete" data-table="work_resume" data-pk="<?= $article['no'] ?>">삭제</a></td>
				</tr>
<?php } ?>
			</tbody>
		</table>
		<div class="float-right mt-3">
			<form action="" method="get" class="form-group input-group">
				<input type="text" class="form-control text-right" name="day" value="<?= isset($_GET['day']) && !empty($_GET['day'])?$_GET['day']:'90' ?>" _input_type="number" _onenter="submit" style="width:60px;" />
				<span class="input-group-append">
					<button type="submit" class="btn btn-light">일 이내의 포스팅</button>
				</span>
			</form>
		</div>
	</section>