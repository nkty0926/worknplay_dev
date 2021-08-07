<?php

if (isset($_POST['action']) && $_POST['action'] == 'appr' && isset($_POST['no']) && !empty($_POST['no'])) {
	$query = "update story_article set appr = (appr + 1) % 2 where no = :no";
	$stmt = $DB->conn->prepare($query);
	$stmt->bindParam(":no", $_POST['no']);
	$stmt->execute();
	$stmt->closeCursor();
	exit();
} else if (isset($_POST['action']) && $_POST['action'] == 'top' && isset($_POST['no']) && !empty($_POST['no'])) {
	$query = "update story_article set top = (top + 1) % 2 where no = :no";
	$stmt = $DB->conn->prepare($query);
	$stmt->bindParam(":no", $_POST['no']);
	$stmt->execute();
	$stmt->closeCursor();
	exit();
} else {
	$articles = $DB->conn->query("select story_article.no, story_article.date, story_article.mod, story_article.publ, story_article.appr, story_article.top, story_article.hits, story_article.title, story_article.story_profile, story_profile.nickname, member.email from story_article left join story_profile on story_article.story_profile = story_profile.no left join member on story_profile.member = member.no" . (isset($_GET['top'])?" where story_article.top = 1":""))->fetchAll(PDO::FETCH_ASSOC);
}

include_once 'pages/9000_ADMIN/9000_ADMIN_header.php';

?>
	<script>
$(document).on('change', 'input[type="checkbox"][name="appr"]', function(){
	$.ajax({ type: 'post', url: '/ADMIN/Blogs/Article', data: 'action=' + $(this).attr('name') + '&no=' + $(this).val() });
	if($(this).prop('checked')) $(this).next('span').text('승인'); else $(this).next('span').text('미승인');
});
$(document).on('change', 'input[type="checkbox"][name="top"]', function(){
	$.ajax({ type: 'post', url: '/ADMIN/Blogs/Article', data: 'action=' + $(this).attr('name') + '&no=' + $(this).val() });
	if($(this).prop('checked')) $(this).next('span').text('상단노출'); else $(this).next('span').text('X');
});
	</script>

	<section class="container-fluid">
		<table class="table table-bordered table-hover table-sm" id="dataTable">
			<thead class="thead-light">
				<tr>
					<th width="60px">순번</th>
					<th width="100px">등록일</th>
					<th width="100px">수정일</th>
					<th>이름(한글이름)</th>
					<th width="200px">프로필</th>
					<th width="200px">계정</th>
					<th width="60px">상태</th>
					<th width="80px">승인</th>
					<th width="90px">상단노출</th>
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
					<td><a class="btn-link" href="/Blogs/Detail/Article/<?= $article['no'] ?>" target="_blank"><?= $article['title'] ?></a></td>
					<td><a class="btn-link" href="/Blogs/Detail/Profile/<?= $article['story_profile'] ?>" target="_blank"><?= $article['nickname'] ?></a></td>
					<td><a class="btn-link" href="/ADMIN/Member?keyword=<?= $article['email'] ?>" target="_blank"><?= $article['email'] ?></a></td>
					<td><?= $article['publ']==1?'완성':($article['publ']==2?'비공개':($article['publ']==3?'-':'미완')) ?></td>
					<td>
						<label class="checkbox-inline">
							<input type="checkbox" name="appr" value="<?= $article['no'] ?>"<?= $article['appr']?' checked':'' ?> />
							<span><?= $article['appr']?'승인':'미승인' ?></span>
						</label>
					</td>
					<td>
						<label class="checkbox-inline">
							<input type="checkbox" name="top" value="<?= $article['no'] ?>"<?= $article['top']?' checked':'' ?> />
							<span><?= $article['top']?'상단노출':'X' ?></span>
						</label>
					</td>
					<td><?= $article['hits'] ?></td>
					<td><a class="btn-link" data-toggle="action" data-action="delete" data-table="story_article" data-pk="<?= $article['no'] ?>">삭제</a></td>
				</tr>
<?php } ?>
			</tbody>
		</table>
		<a class="btn btn-link float-right" href="/ADMIN/Blogs/Article<?= isset($_GET['top'])?'':'?top=true' ?>"><?= isset($_GET['top'])?'all':'featured' ?> article</a>
	</section>