<?php

if (isset($_POST['action']) && $_POST['action'] == 'credit' && isset($_POST['no']) && !empty($_POST['no'])) {
	$query = "update work_credit set credit = :credit where no = :no";
	$stmt = $DB->conn->prepare($query);
	$stmt->bindParam(":credit", $_POST['credit']);
	$stmt->bindParam(":no", $_POST['no']);
	$stmt->execute();
	$stmt->closeCursor();
	header('Location: /ADMIN/Work/Purchase?page=' . ($_GET['page'] ? $_GET['page'] : '1') . '&keyword=' . $_GET['keyword']);
	exit();
} else if (isset($_POST['action']) && $_POST['action'] == 'appr' && isset($_POST['no']) && !empty($_POST['no'])) {
	$query = "update work_job set appr = (appr + 1) % 2 where no = :no";
	$stmt = $DB->conn->prepare($query);
	$stmt->bindParam(":no", $_POST['no']);
	$stmt->execute();
	$stmt->closeCursor();
	exit();
} else if (isset($_POST['action']) && $_POST['action'] == 'date' && isset($_POST['no']) && !empty($_POST['no'])) {
	$query = "update work_job set date = now() where no = :no";
	$stmt = $DB->conn->prepare($query);
	$stmt->bindParam(":no", $_POST['no']);
	$stmt->execute();
	$stmt->closeCursor();
	exit();
} else {
	$query = "select work_job.no, work_job.date, work_job.mod, work_job.publ, work_job.appr, work_job.hot, work_job.hits, work_job.work_credit, work_job.title, member.email from work_job left join work_company on work_job.work_company = work_company.no left join member on work_company.member = member.no where left(date_add(work_job.date, interval :day day), 10) > left(now(), 10)" . (isset($_GET['hot']) ? " and hot = 1" : "");
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
	$.ajax({ type: 'post', url: '/ADMIN/Work/Job', data: 'action=' + $(this).attr('name') + '&no=' + $(this).val() });
	if($(this).prop('checked')) $(this).next('span').text('승인'); else $(this).next('span').text('미승인');
});
$(document).on('click', '[name="date"]', function(){
	Confirm("Are you sure you want to boost it?", function(){
		$.ajax({ type: 'post', url: '/ADMIN/Work/Job', data: 'action=' + $(this).attr('name') + '&no=' + $(this).val() });
		location.reload();
	});
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
					<th width="60px">핫잡</th>
					<th width="60px">조회수</th>
					<th width="60px">삭제</th>
				</tr>
			</thead>
			<tbody>
<?php foreach($articles as $article){
	if ($article['work_credit']) {
		$job = $article;
		$article = $DB->conn->query("select work_credit.*, member.email from work_credit left join member on work_credit.member = member.no where work_credit.no = '" . $job['work_credit'] . "'")->fetch(PDO::FETCH_ASSOC);
		$title = $article['product']==1?'Hot Job Posting':($article['product']==2?'Standard Job Posting':($article['product']==3?'Resume Search':''));
		$title .= " (" . $article['credit'] . ' ' . ($article['product']==1 || $article['product']==3?'Days':($article['product']==2?'Credits':'')) . ")";
		$content = "이름: " . $article['name'];
		$content .= "<br />연락처: " . $article['phone'];
		$content .= "<br />결제일: " . $article['date'];
		$content .= "<br />사용일: " . ($article['used']?$article['used']:'미사용');
		$content .= "<br />결제금액: " . $article['price'];
		$content .= "<br />결제방법: " . $article['paymethod'];
		if(isset($article['approval_no']) && !empty($article['approval_no']))
			$content .= "<br />승인번호: " . $article['approval_no'];
		if(isset($article['transaction_no']) && !empty($article['transaction_no']))
			$content .= "<br />거래번호: <small>" . $article['transaction_no'] . "</small>";
		$content .= "<form action='' method='post' class='form-inline input-group' style='width:156px;'><input type='number' class='form-control' name='credit' value='" . $article['credit'] . "'><input type='hidden' name='no' value='" . $article['no'] . "' /><div class='input-group-append'><button type='submit' class='btn btn-light' name='action' value='credit'>수정하기</button></div></form>";
		$article = $job;
	}
?>
				<tr>
					<td><?= $article['no'] ?></td>
					<td><?= date('Y-m-d', strtotime($article['date'])) ?></td>
					<td><?= date('Y-m-d', strtotime($article['mod'])) ?></td>
					<td><a class="btn-link" href="/Work/Detail/Job/<?= $article['no'] ?>" target="_blank"><?= $article['title'] ?></a></td>
					<td><a class="btn-link" href="/ADMIN/Member?keyword=<?= $article['email'] ?>" target="_blank"><?= $article['email'] ?></a></td>
					<td><?= $article['publ']==1?'완성':($article['publ']==2?'삭제':($article['publ']==3?'-':'미완')) ?></td>
					<td>
						<label class="checkbox-inline">
							<input type="checkbox" name="appr" value="<?= $article['no'] ?>"<?= $article['appr']?' checked':'' ?> />
							<span><?= $article['appr']?'승인':'미승인' ?></span>
						</label>
					</td>
					<td>
						<?php if($article['work_credit']){ ?>
						<a class="btn-link" data-toggle="modal" data-target="#detail" title="<?= $title ?>" data-content="<?= $content ?>" title="<?= $article['work_credit'] ?>">핫잡</a>
						<?php }else{ ?>
						<button type="button" class="btn-link" name="date" value="<?= $article['no'] ?>"><?= $article['hot']?'핫잡':'X' ?></button>
						<?php } ?>
					</td>
					<td><?= $article['hits'] ?></td>
					<td><a class="btn-link" data-toggle="action" data-action="delete" data-table="work_job" data-pk="<?= $article['no'] ?>">삭제</a></td>
				</tr>
<?php } ?>
			</tbody>
		</table>
		<div class="float-right mt-3">
			<form action="" method="get" class="form-group input-group">
				<label class="input-group-prepend mb-0"><span class="input-group-text form-check-inline mr-0"><input type="checkbox" class="form-check-input" name="hot" value="true"<?= isset($_GET['hot'])?' checked':'' ?> /> hot job</span></label>
				<input type="text" class="form-control text-right" name="day" value="<?= isset($_GET['day']) && !empty($_GET['day'])?$_GET['day']:'90' ?>" _input_type="number" _onenter="submit" style="width:60px;" />
				<span class="input-group-append">
					<button type="submit" class="btn btn-light">일 이내의 포스팅</button>
				</span>
			</form>
		</div>
	</section>