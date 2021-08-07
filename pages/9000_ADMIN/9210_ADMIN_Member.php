<?php

if (isset($_POST['action']) && $_POST['action'] == 'appr' && isset($_POST['no']) && !empty($_POST['no'])) {
	$query = "update member set appr = (appr + 1) % 2 where no = :no";
	$stmt = $DB->conn->prepare($query);
	$stmt->bindParam(":no", $_POST['no']);
	$stmt->execute();
	$stmt->closeCursor();
	header('Location: /ADMIN/Member?page=' . ($_GET['page'] ? $_GET['page'] : '1') . '&keyword=' . $_GET['keyword']);
	exit();
} else if (isset($_POST['action']) && $_POST['action'] == 'recruiter' && isset($_POST['no']) && !empty($_POST['no'])) {
	$query = "update member set recruiter = (recruiter + 1) % 2 where no = :no";
	$stmt = $DB->conn->prepare($query);
	$stmt->bindParam(":no", $_POST['no']);
	$stmt->execute();
	$stmt->closeCursor();
	header('Location: /ADMIN/Member?page=' . ($_GET['page'] ? $_GET['page'] : '1') . '&keyword=' . $_GET['keyword']);
	exit();
} else if ($_POST['action'] == 'login' && isset($_POST['no']) && !empty($_POST['no'])) {
	$member = $DB->selectMember($_POST['no']);
	$USER = $DB->selectUser($member['no']);
	session_destroy();
	session_start();
	$_SESSION['ID'] = $member['no'];
	$_SESSION['EMAIL'] = $member['email'];
	$_SESSION['ADMIN'] = 1;
	$_SESSION['RECRUITER'] = $member['recruiter'];
	$_SESSION['EMPLOYER'] = $USER['work_credit'];
	$_SESSION['CURRENT_COMPANY'] = $USER['work_company'];
	$_SESSION['CURRENT_COMPANY_NAME'] = $USER['work_company_name'];
	$_SESSION['EMPLOYER_TEFL'] = 1;
	$_SESSION['SEEKER'] = $USER['work_resume'];
	header('Location: /');
	exit();
} else if (isset($_POST['action']) && $_POST['action'] == 'detail' && isset($_POST['no']) && !empty($_POST['no'])) {
	$query = "";
	$query .= "select member.*";
	$query .= "     , (select count(*) from work_credit where member = member.no) as work_credit";
	$query .= "     , (select count(*) from work_company where member = member.no) as work_company";
	$query .= "     , (select count(*) from work_job left join work_company on work_job.work_company = work_company.no where member = member.no) as work_job";
	$query .= "     , (select count(*) from work_event left join work_company on work_event.work_company = work_company.no where member = member.no) as work_event";
	$query .= "     , (select count(*) from work_resume where member = member.no) as work_resume";
	$query .= "     , (select count(*) from work_job_application where member = member.no) as work_job_application";
	$query .= "     , (select count(*) from work_message where member_send = member.no or member_receive = member.no) as work_message";
	$query .= "     , (select count(*) from story_profile where member = member.no) as story_profile";
	$query .= "     , (select count(*) from story_series where member = member.no) as story_series";
	$query .= "     , (select count(*) from story_article left join story_profile on story_article.story_profile = story_profile.no where member = member.no) as story_article";
	$query .= "  from member";
	$query .= " where member.no = " . $_POST['no'];
	$stmt = $DB->conn->prepare($query);
	$stmt->bindParam(":no", $_POST['no']);
	$stmt->execute();
	$member = $stmt->fetch(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
?>
<table class="table table-bordered table-sm text-center">
	<thead class="thead-light">
		<tr>
			<td colspan="4" class="text-bold">Work</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td width="25%">Purchases</td>
			<td width="25%">Companies</td>
			<td width="25%">Jobs</td>
			<td width="25%">Events</td>
		</tr>
		<tr>
			<td><a href="/ADMIN/Work/Purchase?keyword=<?= urlencode($member['email']) ?>" target="_blank"><?= $member['work_credit'] ?></a></td>
			<td><a href="/ADMIN/Work/Company#<?= urlencode($member['email']) ?>" target="_blank"><?= $member['work_company'] ?></a></td>
			<td><a href="/ADMIN/Work/Job#<?= urlencode($member['email']) ?>" target="_blank"><?= $member['work_job'] ?></a></td>
			<td><a href="/ADMIN/Work/Event#<?= urlencode($member['email']) ?>" target="_blank"><?= $member['work_event'] ?></a></td>
		</tr>
		<tr>
			<td rowspan="2"></td>
			<td>Resumes</td>
			<td>Applications</td>
			<td>Messages</td>
		</tr>
		<tr>
			<td><a href="/ADMIN/Work/Resume#<?= urlencode($member['email']) ?>" target="_blank"><?= $member['work_resume'] ?></a></td>
			<td><a class="disabled"><?= $member['work_job_application'] ?></a></td>
			<td><a class="disabled"><?= $member['work_message'] ?></a></td>
		</tr>
	</tbody>
</table>
<table class="table table-bordered table-sm text-center">
	<thead class="thead-light">
		<tr>
			<td colspan="3" class="text-bold">Blogs</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td width="33.33333333%">Profiles</td>
			<td width="33.33333333%">Series</td>
			<td width="33.33333333%">Articles</td>
		</tr>
		<tr>
			<td><a href="/ADMIN/Blogs/Profile#<?= urlencode($member['email']) ?>" target="_blank"><?= $member['story_profile'] ?></a></td>
			<td><a class="disabled"><?= $member['story_series'] ?></a></td>
			<td><a href="/ADMIN/Blogs/Article#<?= urlencode($member['email']) ?>" target="_blank"><?= $member['story_article'] ?></a></td>
		</tr>
	</tbody>
</table>
<?php if(isset($member['email_log']) && !empty($member['email_log'])){ ?>
<table class="table table-bordered table-sm text-center">
	<thead class="thead-light">
		<tr>
			<td class="text-bold">Email Log</td>
		</tr>
	</thead>
	<tbody>
<?php foreach(explode(';', $member['email_log']) as $email_log){ ?>
		<tr>
			<td><?= $email_log ?></td>
		</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>
<form action="" method="post" target="_blank">
	<input type="hidden" name="no" value="<?= $_POST['no'] ?>" />
	<button type="submit" class="btn-link" name="action" value="login" style="padding: 0; border: 0; font-style: italic; font-size: 14px;">이 계정으로 로그인</button>
</form>
<?php
	exit();
}else if (isset($_GET['keyword'])) {
	$query = "select no, date, email, appr, type, recruiter from member where email like :keyword order by no desc";
	$stmt = $DB->conn->prepare($query);
	$stmt->bindValue(":keyword", '%' . $_GET['keyword'] . '%');
	$stmt->execute();
	$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
} else {
	$articles = $DB->conn->query("select no, date, email, appr, type, recruiter from member order by no desc")->fetchAll(PDO::FETCH_ASSOC);
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

		<table class="table table-bordered table-hover table-sm dataTables_wrapper">
			<thead class="thead-light">
				<tr>
					<th width="80px" class="d-none d-md-table-cell">순번</th>
					<th width="180px" class="d-none d-md-table-cell">가입일</th>
					<th>이메일</th>
					<th width="80px">인증메일</th>
					<th width="80px">상태</th>
					<th width="80px">리크루터</th>
				</tr>
			</thead>
			<tbody>
<?php for($i=($_GET['page']-1)*$CONF['pagination_articles']; $i<$_GET['page']*$CONF['pagination_articles'] && $i<$CONF['pagination_total']; $i++){ $article = $articles[$i]; ?>
				<tr>
					<td class="d-none d-md-table-cell"><?= $article['no'] ?></td>
					<td class="d-none d-md-table-cell"><?= $article['date'] ?></td>
					<td><a class="btn-link" data-toggle="modal" data-target="#detail" title="<?= $article['email'] ?>" data-pk="<?= $article['no'] ?>"><?= $article['email'] ?></a></td>
<?php if(isset($article['job_type']) && !empty($article['job_type'])){ ?>
					<td class="text-muted">페이스북</td>
<?php }else{ ?>
					<td><a class="<?= $article['appr']?'text-muted':'btn-link' ?>" href="/MailAuth?email=<?= $article['email'] ?>" target="_blank" onclick="if(!confirm('인증메일을 재전송하시겠습니까?')) return false;">재전송</a></td>
<?php } ?>
					<td>
						<form action="" method="post" onsubmit="if(!confirm('<?= $article['appr']=='2'?'차단을 해제':($article['appr']?'인증을 취소':'인증') ?>하시겠습니까?')) return false;">
							<input type="hidden" name="no" value="<?= $article['no'] ?>" />
							<button type="submit" class="<?= $article['appr']==2?'text-danger':($article['appr']?'text-muted':'btn-link') ?>" name="action" value="appr"><?= $article['appr']==2?'차단':($article['appr']?'인증':'미인증') ?></button>
						</form>
					</td>
					<td>
						<form action="" method="post" onsubmit="if(!confirm('리크루터<?= $article['recruiter']?' 지정을 취소':'로 지정' ?>하시겠습니까?')) return false;">
							<input type="hidden" name="no" value="<?= $article['no'] ?>" />
							<button type="submit" class="<?= $article['recruiter']?'text-muted':'btn-link' ?>" name="action" value="recruiter"><?= $article['recruiter']?'O':'X' ?></button>
						</form>
					</td>
				</tr>
<?php } ?>
			</tbody>
		</table>

<?php include_once 'pages/common/pagination.php'; ?>

	</section>

	<script>
$(document).on('click', '[data-toggle="modal"][data-target="#detail"]', function(){
	$.ajax({ type: 'post', url: '/ADMIN/Member', data: 'action=detail&no=' + $(this).attr('data-pk'), success: function(result){
		$('#detail .modal-body').html(result);
	} });
});
	</script>
<?php include_once 'pages/common/footer.php'; ?>