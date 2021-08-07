<?php

if (isset($_POST['action']) && $_POST['action'] == 'appr' && isset($_POST['no']) && !empty($_POST['no'])) {
	$query = "update work_credit set appr = (appr + 1) % 2 where no = :no";
	$stmt = $DB->conn->prepare($query);
	$stmt->bindParam(":no", $_POST['no']);
	$stmt->execute();
	$stmt->closeCursor();
	header('Location: /ADMIN/Work/Purchase?page=' . ($_GET['page'] ? $_GET['page'] : '1') . '&keyword=' . $_GET['keyword']);
	exit();
} else if (isset($_POST['action']) && $_POST['action'] == 'cancel' && isset($_POST['no']) && !empty($_POST['no'])) {
	$query = "update work_credit set appr = 2 where no = :no";
	$stmt = $DB->conn->prepare($query);
	$stmt->bindParam(":no", $_POST['no']);
	$stmt->execute();
	$stmt->closeCursor();
	header('Location: /ADMIN/Work/Purchase?page=' . ($_GET['page'] ? $_GET['page'] : '1') . '&keyword=' . $_GET['keyword']);
	exit();
} else if (isset($_POST['action']) && $_POST['action'] == 'credit' && isset($_POST['no']) && !empty($_POST['no'])) {
	$query = "update work_credit set credit = :credit where no = :no";
	$stmt = $DB->conn->prepare($query);
	$stmt->bindParam(":credit", $_POST['credit']);
	$stmt->bindParam(":no", $_POST['no']);
	$stmt->execute();
	$stmt->closeCursor();
	header('Location: /ADMIN/Work/Purchase?page=' . ($_GET['page'] ? $_GET['page'] : '1') . '&keyword=' . $_GET['keyword']);
	exit();
} else if (isset($_GET['keyword'])) {
	$query = "select work_credit.*, member.email from work_credit left join member on work_credit.member = member.no where work_credit.name like :keyword_name or work_credit.phone like :keyword_phone or member.email like :keyword_email order by work_credit.no desc";
	$stmt = $DB->conn->prepare($query);
	$stmt->bindValue(":keyword_name", '%' . $_GET['keyword'] . '%');
	$stmt->bindValue(":keyword_phone", '%' . $_GET['keyword'] . '%');
	$stmt->bindValue(":keyword_email", '%' . $_GET['keyword'] . '%');
	$stmt->execute();
	$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
} else {
	$articles = $DB->conn->query("select work_credit.*, member.email from work_credit left join member on work_credit.member = member.no order by work_credit.no desc")->fetchAll(PDO::FETCH_ASSOC);
}

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

		<a class="btn btn-link float-right collapse" href="javascript:window.open('https://www.inicis.com/Support_new/Demo_INIcancel.php','inicis','scrollbars=1,resizable=1,status=0,width=580, height=373, top=0, left=0');">카드 취소</a>

		<table class="table table-bordered table-hover table-sm dataTables_wrapper">
			<thead class="thead-light">
				<tr>
					<th width="60px" class="d-none d-md-table-cell">순번</th>
					<th width="180px">결제일</th>
					<th width="200px">계정</th>
					<th width="180px">결제금액</th>
					<th width="200px">결제방법</th>
					<th width="200px">이름</th>
					<th width="200px">연락처</th>
					<th width="60px">상태</th>
					<th width="80px">취소</th>
				</tr>
			</thead>
			<tbody>
<?php for($i=($_GET['page']-1)*$CONF['pagination_articles']; $i<$_GET['page']*$CONF['pagination_articles'] && $i<$CONF['pagination_total']; $i++){ $article = $articles[$i];
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
?>
				<tr class="<?= $article['appr']==2?'text-muted':'' ?>">
					<td class="d-none d-md-table-cell"><?= $article['no'] ?></td>
					<td><?= $article['date'] ?></td>
					<td><a class="btn-link" href="/ADMIN/Member?keyword=<?= $article['email'] ?>" target="_blank"><?= $article['email'] ?></a></td>
					<td><a class="btn-link" data-toggle="modal" data-target="#detail" title="<?= $title ?>" data-content="<?= $content ?>">&#8361; <?= number_format($article['price']) ?></a></td>
					<td><a class="btn-link" data-toggle="modal" data-target="#detail" title="<?= $title ?>" data-content="<?= $content ?>"><?= $article['paymethod'] ?></a></td>
					<td><a class="btn-link" data-toggle="modal" data-target="#detail" title="<?= $title ?>" data-content="<?= $content ?>"><?= $article['name'] ?></a></td>
					<td><a class="btn-link" data-toggle="modal" data-target="#detail" title="<?= $title ?>" data-content="<?= $content ?>"><?= $article['phone'] ?></a></td>
					<td>
						<form action="" method="post" onsubmit="if(!confirm('<?= $article['appr']==1?'결제 승인을 취소':'결제를 승인' ?> 하시겠습니까?')) return false;">
							<input type="hidden" name="no" value="<?= $article['no'] ?>" />
							<button type="submit" class="<?= $article['appr']==0?'btn-link':'text-muted' ?>" name="action" value="appr"><?= $article['appr']==1?'승인':'미승인' ?></button>
						</form>
					</td>
					<td>
<?php if(isset($article['appr']) && $article['appr']==2){ ?>
						<button type="submit" name="action" value="cancel" disabled>취소됨</button>
<?php }else{ ?>
						<form action="" method="post" onsubmit="if(!confirm('주문을 취소하시겠습니까?')) return false;">
							<input type="hidden" name="no" value="<?= $article['no'] ?>" />
							<button type="submit" class="<?= $article['appr']?'text-muted':'btn-link' ?>" name="action" value="cancel">취소</button>
						</form>
<?php } ?>
					</td>
				</tr>
<?php } ?>
			</tbody>
		</table>

<?php include_once 'pages/common/pagination.php'; ?>

	</section>