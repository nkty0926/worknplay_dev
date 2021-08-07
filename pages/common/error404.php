<?php header('HTTP/1.1 404 Not Found'); session_start(); if($_SESSION['PROD_MODE']){ header('Location: /'); exit; } ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<style>#image,#contents{width:100%;}@media(min-width:768px){#image,#contents{float:left;width:50%;padding-right:5%;box-sizing:border-box;}#image{width:100%;}}</style>
		<script>setTimeout(function(){location.replace("/");},4000);</script>
	</head>
	<body>
		<div id="image">
			<img src="/assets/images/error404.jpg" />
		</div>
		<div id="contents">
			<h1>404 - PAGE NOT FOUND</h1>
			<p>The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
			<a href="/">GO TO HOMEPAGE</a>
		</div>
	</body>
</html>