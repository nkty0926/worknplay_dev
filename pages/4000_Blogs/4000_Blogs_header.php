<?php include_once 'pages/common/header.php'; ?>
	<!-- nav.navbar -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary border-bottom border-primary sticky-top py-0 py-lg-2">
		<div class="container">
			<div class="navbar-collapse collapse" id="navbarResponsive">
				<ul class="navbar-nav nav-underline text-uppercase">
					<li class="nav-item">
						<a class="nav-link<?= $_GET['PAGE']==''?' active':'' ?>" href="/Blogs">Home</a>
					</li>
					<li class="nav-item dropdown d-none d-lg-block">
						<a class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Category <span class="caret"></span></a>
						<div class="dropdown-menu">
<?php foreach($CONF['story_category'] as $category){ ?>
							<a class="dropdown-item" href="/Blogs?category=<?= urlencode($category) ?>&list=<?= !isset($_GET['list']) || $_GET['list']?1:0 ?>"><?= str_replace('_', ' ', $category) ?></a>
<?php } ?>
						</div>
					</li>
				</ul>
				<div class="d-none d-lg-block overflow-hidden" id="jCarouselLite" style="max-height:20px;">
					<ul class="list-unstyled">
<?php $stories = $DB->selectStoryArticle(); shuffle($stories); foreach($stories as $article){ ?>
						<li><a class="text-white line-clamp-1" href="/Blogs/Detail/Article/<?= $article['no'] ?>"><?= $article['title'] ?></a></li>
<?php } ?>
					</ul>
					<script defer>$(function(){ $.fn.size = function() { return this.length; }; $('#jCarouselLite').jCarouselLite({ visible: 1, auto: 5000, vertical: true, circular: true }); });</script>
				</div>
				<ul class="navbar-nav ml-auto">
<?php if(empty($_SESSION['ID'])){ ?>
					<li class="nav-item mb-2 mb-lg-0 ml-lg-3">
						<span class="nav-link btn btn-light border p-2 px-lg-3">
							<a href="/LogIn" style="color:inherit;text-decoration:none;">LOG IN</a>
							<span style="pointer-events:none;">|</span>
							<a href="/Register" style="color:inherit;text-decoration:none;">REGISTER</a>
						</span>
					</li>
<?php }else{ ?>
					<li class="nav-item mb-2 mb-lg-0 ml-lg-3">
						<a class="nav-link btn btn-primary text-light active border p-2 px-lg-3" href="/Blogs/Edit/Article/_NEW">POST A BLOG</a>
					</li>
<?php if($USER['story_profile_nickname']){ ?>
					<li class="nav-item mb-2 mb-lg-0 ml-lg-3">
						<a class="nav-link btn btn-primary text-light active border p-2 px-lg-3" href="/Blogs/MyPage"><?= $USER['story_profile_nickname'] ?></a>
					</li>
<?php }} ?>
				</ul>
			</div>
		</div>
	</nav>
	<!-- /.navbar -->

<?php if($_GET['PAGE']!='Detail' && $_GET['PAGE']!='MyPage' && $_GET['PAGE']!='MySeries' && false){ ?>

	<!-- header -->
	<header class="position-relative w-100 d-none d-sm-block" id="jParticle" style="height:300px;">
		<figure class="position-absolute w-100 h-100" style="z-index:-1;background-image:url(/assets/images/4000-story-header-201805011747.jpg);"></figure>
	</header>
	<script defer>$(function(){var particles=0;if($(window).width()<480){particles=20;}else if($(window).width()<767){particles=50;}else if($(window).width()>767){particles=80;}$('#jParticle').jParticle({particlesNumber:particles,background:"transparent"});});</script>
	<!-- /header -->
<?php } ?>

