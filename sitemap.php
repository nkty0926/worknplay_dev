<?php
header('Content-type: application/xml');

// $WP
require_once 'classes/Worknplay.php';
$WP = new Worknplay();

// $DB
require_once 'classes/Database.php';
$DB = new Database();

$pages = $DB->conn->query("select * from common_page_view where no not like '9%' and file not like 'Location%' and pk not like '[%' and login = 0 order by no")->fetchAll(PDO::FETCH_ASSOC);

?>
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<!-- pages count: <?= count($pages) ?> -->
<?php foreach($pages as $page){ ?>
	<url>
<?php if($_SESSION['DEBUG_MODE']){ ?>
		<!-- <?= $page['title'] ?> -->
<?php } ?>
		<loc><?= $WP->getCurrentHost() ?><?= $page['url'] ?></loc>
		<lastmod><?= date('Y-m-d') ?></lastmod>
		<changefreq>daily</changefreq>
		<priority><?= $page['sub']?'0.7':($page['menu']?'0.8':($page['page']?'0.9':'1.0')) ?></priority>
	</url>
<?php } ?>
<?php $hots = $DB->searchWorkJob(true); ?>
<!-- hots count: <?= count($hots) ?> -->
<?php foreach($hots as $hot){ ?>
	<url>
<?php if($_SESSION['DEBUG_MODE']){ ?>
		<!-- <?= $hot['title'] ?> -->
<?php } ?>
		<loc><?= $WP->getCurrentHost() ?>/Work/Detail/Job/<?= $hot['no'] ?></loc>
		<lastmod><?= substr($hot['mod'], 0, 10) ?></lastmod>
		<changefreq>daily</changefreq>
		<priority>0.7</priority>
	</url>
<?php } ?>
<?php $jobs = $DB->searchWorkJob(false); ?>
<!-- jobs count: <?= count($jobs) ?> -->
<?php foreach($jobs as $job){ ?>
	<url>
<?php if($_SESSION['DEBUG_MODE']){ ?>
		<!-- <?= $job['title'] ?> -->
<?php } ?>
		<loc><?= $WP->getCurrentHost() ?>/Work/Detail/Job/<?= $job['no'] ?></loc>
		<lastmod><?= substr($job['mod'], 0, 10) ?></lastmod>
		<changefreq>daily</changefreq>
		<priority>0.6</priority>
	</url>
<?php } ?>
<?php $feats = $DB->searchWorkCompany(true); ?>
<!-- feats count: <?= count($feats) ?> -->
<?php foreach($feats as $feat){ ?>
	<url>
<?php if($_SESSION['DEBUG_MODE']){ ?>
		<!-- <?= $feat['name'] ?> -->
<?php } ?>
		<loc><?= $WP->getCurrentHost() ?>/Work/Detail/Company/<?= $feat['no'] ?></loc>
		<lastmod><?= substr($feat['mod'], 0, 10) ?></lastmod>
		<changefreq>daily</changefreq>
		<priority>0.5</priority>
	</url>
<?php } ?>
<?php $coms = $DB->searchWorkCompany(false); ?>
<!-- coms count: <?= count($coms) ?> -->
<?php foreach($coms as $com){ ?>
	<url>
<?php if($_SESSION['DEBUG_MODE']){ ?>
		<!-- <?= $com['name'] ?> -->
<?php } ?>
		<loc><?= $WP->getCurrentHost() ?>/Work/Detail/Company/<?= $com['no'] ?></loc>
		<lastmod><?= substr($com['mod'], 0, 10) ?></lastmod>
		<changefreq>daily</changefreq>
		<priority>0.4</priority>
	</url>
<?php } ?>
</urlset>
