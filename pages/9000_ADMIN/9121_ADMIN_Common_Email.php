<?php include_once 'pages/9000_ADMIN/9000_ADMIN_header.php'; ?>
	<section class="container-fluid">

<ul>
<?php
$dir = opendir('pages/mail');
while (($file = readdir($dir)) !== false) {
	if (strpos($file, '.html') !== false) {
?>
	<li><a href="/pages/mail/<?= $file ?>"><?= str_replace('.html', '', $file) ?></a></li>
<?php
	}
}
?>
</ul>
	</section>