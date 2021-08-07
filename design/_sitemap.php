<ul>
<?php
$dir = opendir('.');
while (($file = readdir($dir)) !== false) {
	if (is_file($file) && strpos($file, '.php') !== false && strpos($file, '_sitemap') === false) {
		?>
	<li><a href="/design/<?= str_replace('.php', '', $file) ?>" target="_design"><?= str_replace('.php', '', $file) ?></a></li>
<?php
    }
}
?>
</ul>