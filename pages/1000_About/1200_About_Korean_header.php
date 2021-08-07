<?php include_once 'pages/common/header.php'; ?>
	<style>.navbar.py-lg-0{display:none !important;}</style>

	<!-- nav.navbar -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
		<div class="container">
			<a class="navbar-brand" href="/">theworknplay.com</a>
			<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="navbar-collapse collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item ml-lg-3<?= $_GET['MENU']=='Intro'?' active':'' ?>">
						<a class="nav-link" href="/About/Korean/Intro">회사소개</a>
					</li>
					<li class="nav-item ml-lg-3<?= $_GET['MENU']=='JobPosting'?' active':'' ?>">
						<a class="nav-link" href="/About/Korean/JobPosting">채용공고/인재검색</a>
					</li>
					<li class="nav-item ml-lg-3<?= $_GET['MENU']=='HeadHunting'?' active':'' ?>">
						<a class="nav-link" href="/About/Korean/HeadHunting">헤드헌팅</a>
					</li>
					<li class="nav-item ml-lg-3<?= $_GET['MENU']=='Marketing'?' active':'' ?>">
						<a class="nav-link" href="/About/Korean/Marketing">외국인 대상 홍보 마케팅</a>
					</li>
					<li class="nav-item ml-lg-3">
						<a class="nav-link" href="/About/English">English</a>
					</li>
					<li class="nav-item ml-lg-3 dropdown no-arrow d-none d-lg-inline-block">
						<a class="nav-link dropdown-toggle" id="navbarDropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<div class="navbar-toggler-wrapper">
								<span class="navbar-toggler-icon"></span>
							</div>
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenu">
							<a class="dropdown-item" href="/Work">Work</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="/design/TeflTesol#Tefl">Tefl</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#Lang">Language</a>
						</div>
					</li>
					<li class="nav-item d-lg-none">
						<a class="nav-link" href="/Work">Work</a>
					</li>
					<li class="nav-item d-lg-none">
						<a class="nav-link" href="/design/TeflTesol#Tefl">Tefl</a>
					</li>
					<li class="nav-item d-lg-none">
						<a class="nav-link" href="#Lang">Language</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- /nav.navbar -->

