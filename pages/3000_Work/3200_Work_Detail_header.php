<?php

if (empty($_GET['PK']) || empty($rs = $DB->selectWorkCompany($_GET['PK']))) {
	header('Location: /Work/Search/Company');
	exit();
} else if ($_GET['PAGE'] != 'Employer') {
	if ((isset($rs['domain']) && !empty($rs['domain'])) && (!isset($_GET['domain']) || empty($_GET['domain']))) {
		header('Location: /Work/' . $rs['domain'] . ($_GET['SUB']?'/'.$_GET['SUB']:''));
		exit();
	} else {
		include_once 'pages/3000_Work/3000_Work_header.php';
	}
}

$articles = $DB->selectWorkJob(null, $rs['no']);
$events = $DB->selectWorkEvent(null, $rs['no']);
$stories = $DB->selectWorkStory($rs['no'], $rs['name']);
$expired = true;
foreach ($articles as $article) {
	if (strtotime($article['date'] . '+180day') > strtotime('now')) {
		$expired = false;
	}
}

?>
	<style>body>main{min-height:auto;}</style>

	<!-- header -->
	<header class="container<?= !$rs['header_size']?'-fluid px-0':'' ?>">
<?php if(isset($rs['header_img']) && !empty($rs['header_img'])){ ?>
<?php if(isset($rs['header_href']) && !empty($rs['header_href'])){ ?>
		<a href="<?= $rs['header_href'] ?>"<?= $rs['header_target']?' target="_blank"':'' ?>>
<?php } ?>
		<figure class="img-fluid position-relative<?= !$rs['header_size']?'':' my-1' ?>" style="height:<?= !$rs['header_size']?'400':'200' ?>px;background-image:url(<?= $rs['header_img'] ?>);" title="<?= $rs['name'] ?>">
<?php if(!$rs['header_text']){ ?>
		<h1 class="position-absolute w-100<?= $rs['header_img']?' line-clamp-2 text-center text-shadow':'' ?>" style="margin-top:<?= !$rs['header_size']?'150':'50' ?>px"><?= $rs['name'] ?><br /><?= $rs['name_kor'] ?></h1>
<?php } ?>
		</figure>
<?php if(isset($rs['header_href']) && !empty($rs['header_href'])){ ?>
		</a>
<?php } ?>
<?php } ?>
		<div class="container mt-1<?= !$rs['header_size']?'':' px-0' ?>">
			<div class="card<?= $rs['brand']?' d-none':' rounded-0' ?>">
				<div class="card-body">
					<div class="row">
						<div class="col-lg-2 mb-1 mb-lg-0">
							<img class="img-thumbnail" src="<?= $rs['logo_img'] ?>" alt="<?= $rs['name'] ?>" title="<?= $rs['name'] ?>" onerror="this.src='/assets/images/common-noimage.png'" />
						</div>
						<div class="col-lg-10">
							<!-- <div class="sharethis-inline-share-buttons float-lg-right text-left"></div> -->
							<h4><?= $rs['name'] ?><?= $rs['name_kor']?' <small class="d-block d-lg-inline">(' . $rs['name_kor'] . ')</small>':'' ?></h4>
<?php if(isset($rs['type_name']) && !empty($rs['type_name'])){ ?>
							<div class="row mb-1">
								<div class="col-lg-2 font-weight-bold">Company Type</div>
								<div class="col-lg-10"><?= $rs['type_name'] ?></div>
							</div>
<?php } if(isset($rs['keyword2']) && !empty($rs['keyword2'])){ ?>
							<div class="row mb-1">
								<div class="col-lg-2 font-weight-bold">Business Area</div>
								<div class="col-lg-10"><?= str_replace(';', ', ', $rs['keyword2']) ?></div>
							</div>
<?php } if(isset($rs['location_parent_name']) && !empty($rs['location_parent_name']) || isset($rs['location_country_name']) && !empty($rs['location_country_name'])){ ?>
							<div class="row mb-1">
								<div class="col-lg-2 font-weight-bold">Location</div>
								<div class="col-lg-10"><?= $WP->printLocation($rs) ?></div>
							</div>
<?php } if(isset($rs['contact_urls']) && !empty($rs['contact_urls'])){ ?>
							<div class="row mb-1">
								<div class="col-lg-2 font-weight-bold">URL(s)</div>
								<div class="col-lg-10">
<?php
	foreach (explode(',', $rs['contact_urls']) as $url) {
		$url_type = explode(';', $url)[0];
		$url_href = explode(';', $url)[1];
?>
									<a class="text-dark" href="<?= $url_href ?>" target="_blank"><img src="/assets/icons/urls/<?= strtolower($url_type) ?>.png" alt="<?= $url_type ?>:" title="<?= $url_type ?>" width="20" height="20" /></a>
<?php } ?>
								</div>
							</div>
<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<div class="row mt-2">
				<div class="col-lg-9">
			<ul class="nav nav-pills nav-pills-gray my-1">
				<li class="nav-item"><a class="nav-link<?= $_GET['SUB']=='' && !$_GET['page']?' active':'' ?>" href="/Work/<?= $rs['domain']?$rs['domain']:'Detail/Company/' . $rs['no'] ?>">Overview</a></li>
<?php if($rs['desc_pages']){ foreach(explode('§', $rs['desc_pages']) as $i => $desc_pages){ $desc_page = explode('¶', $desc_pages); if($desc_page[5]) continue; ?>
				<li class="nav-item"><a class="nav-link<?= $_GET['page']==$i+1?' active':'' ?>" href="/Work/<?= $rs['domain']?$rs['domain']:'Detail/Company/' . $rs['no'] ?>?page=<?= $i+1 ?>" <?= $_GET['PAGE']=='Employer'?' target="_blank"':'' ?>><?= $desc_page[0] ?></a></li>
<?php }} if(isset($articles) && !empty($articles)){ ?>
				<li class="nav-item"><a class="nav-link<?= $_GET['SUB']=='Jobs'?' active':'' ?>" href="/Work/<?= $rs['domain']?$rs['domain']:'Detail/Company/' . $rs['no'] ?>/Jobs" <?= $_GET['PAGE']=='Employer'?' target="_blank"':'' ?>>Jobs</a></li>
<?php } if(false && ($_SESSION['ID'] && $rs['member']==$_SESSION['ID']) || $events){ ?>
				<li class="nav-item"><a class="nav-link<?= $_GET['SUB']=='Events'?' active':'' ?>" href="/Work/<?= $rs['domain']?$rs['domain']:'Detail/Company/' . $rs['no'] ?>/Events" <?= $_GET['PAGE']=='Employer'?' target="_blank"':'' ?>>News &amp; Events</a></li>
<?php } if(($_SESSION['ID'] && $rs['member']==$_SESSION['ID']) || $stories){ ?>
				<li class="nav-item"><a class="nav-link<?= $_GET['SUB']=='Blogs'?' active':'' ?>" href="/Work/<?= $rs['domain']?$rs['domain']:'Detail/Company/' . $rs['no'] ?>/Blogs" <?= $_GET['PAGE']=='Employer'?' target="_blank"':'' ?>>Blogs</a></li>
<?php } ?>
			</ul>
				</div>
				<div class="col-lg-3">
			<div class="sharethis-inline-share-buttons float-right text-left my-1 mr-n2 py-1"></div>
<?php if($_SESSION['ID'] && $rs['member']==$_SESSION['ID']){ ?>
			<a class="nav-link btn btn-light float-right d-print-none my-1 mr-2" href="/Work/Edit/Company/<?= $rs['no'] ?>">Edit</a>
<?php } ?>
				</div>
			</div>
		</div>
	</header>
	<!-- /header -->

