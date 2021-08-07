<?php

$tables = $DB->conn->query("select table_name from information_schema.tables where table_schema = 'theworknplay' and table_name like 'code_%' and table_name not like '%subw'")->fetchAll(PDO::FETCH_ASSOC);

include_once 'pages/9000_ADMIN/9000_ADMIN_header.php';

?>
	<style>#detail .modal-body{padding:0;}#detail .modal-footer{display:none;}</style>
	<section class="container-fluid">
		<div class="row row-6">
<?php foreach($tables as $i => $table){
	if ($table['table_name'] == 'code_country_city')
		$articles = $DB->conn->query("select * from " . $table['table_name'] . " order by country_code")->fetchAll(PDO::FETCH_ASSOC);
	else
		$articles = $DB->conn->query("select * from " . $table['table_name'] . " order by no")->fetchAll(PDO::FETCH_ASSOC); ?>
<?php if($i%2==0 && $i>1){ ?>
		</div>
		<div class="row row-6">
<?php } ?>
			<div class="col-md-6 mb-4">
				<div class="card bg-white">
					<div class="card-body">
						<h3 class="card-title mb-md-n3"><?= str_replace('_', ' ', str_replace('code_', '', $table['table_name'])) ?></h3>
						<table class="table table-bordered table-hover table-sm" id="dataTable<?= $i ?>">
							<thead class="thead-light">
								<tr>
									<th width="80px"><?= (strpos($table['table_name'], 'code_country') !== false) ? 'COUNTRY CODE' : 'NO' ?></th>
<?php if($table['table_name'] == 'code_country_city'){ ?>
									<th>COUNTRY NAME</th>
<?php } ?>
									<th>NAME</th>
<?php if($table['table_name'] == 'code_country'){ ?>
									<th>PHONE CODE</th>
<?php } ?>
								</tr>
							</thead>
							<tbody>
<?php foreach($articles as $article){ ?>
								<tr>
									<td><?= ($table['table_name'] == 'code_country_city') ? $article['country_code'] : $article['no'] ?></td>
<?php if($table['table_name'] == 'code_country_city'){ ?>
									<td><?= $article['country_name'] ?></td>
<?php } ?>
									<td><?= ($table['table_name'] == 'code_country_city') ? $article['city_name'] : $article['name'] ?></td>
<?php if($table['table_name'] == 'code_country'){ ?>
									<td><?= $article['phone_code'] ?></td>
<?php } ?>
								</tr>
<?php } ?>
							</tbody>
						</table>
						<script defer>$(function(){ $('#dataTable<?= $i ?>').DataTable({ searching:true, ordering:false, order:[0, "asc"], paging:true, lengthChange:false, pageLength:10, pagingType:"numbers", /*lengthMenu:[10,15,20,25,50,100], */info:false }); });</script>
					</div>
				</div>
			</div>
<?php } ?>
		</div>
	</section>