<?php

$articles = $DB->conn->query("select count(*) as count, substring_index(email, '@', -1) as domain from member group by domain having count(*) > 1 order by count(*) desc")->fetchAll(PDO::FETCH_ASSOC);

include_once 'pages/9000_ADMIN/9000_ADMIN_header.php';

?>
	<section class="container-fluid">

		<table class="table table-bordered table-hover table-sm" id="dataTable">
			<thead class="thead-light">
				<tr>
					<th>COUNT</th>
					<th>DOMAIN</th>
				</tr>
			</thead>
			<tbody>
<?php foreach($articles as $article){ ?>
				<tr>
					<td><?= $article['count'] ?></td>
					<td><?= $article['domain'] ?></td>
				</tr>
<?php } ?>
			</tbody>
		</table>
	</section>