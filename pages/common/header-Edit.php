<?php if(isset($rs['publ']) && !empty($rs['publ'])) $form_header_title = str_replace('Create', 'Edit', $form_header_title); ?>
		<!-- nav.navbar -->
		<nav class="navbar navbar-expand navbar-dark bg-primary border-bottom sticky-top py-2">
			<div class="container flex-wrap">
				<h3 class="navbar-brand text-uppercase mb-0"><?= $form_header_title ?></h3>
				<ul class="navbar-nav ml-auto">
<?php if(!isset($rs['no']) || empty($rs['publ'])){ ?>
					<li class="nav-item mb-0 ml-3">
						<button type="submit" class="nav-link btn btn-light text-dark text-uppercase border rounded-0 p-2 px-lg-3" data-type="save">Save</button>
					</li>
<?php } if($_GET['MAIN']!='Blogs' && $_GET['MENU']!='ResumeProfile'){ ?>
					<li class="nav-item mb-0 ml-3">
						<button type="submit" class="nav-link btn btn-light text-dark text-uppercase border rounded-0 p-2 px-lg-3" data-type="preview">Preview</button>
					</li>
<?php } ?>
					<li class="nav-item mb-0 ml-3">
						<button type="submit" class="nav-link btn btn-primary text-light text-uppercase active border rounded-0 p-2 px-lg-3" data-type="publish"><?= isset($_GET['next']) && !empty($_GET['next'])?'Next':'Publish' ?></button>
					</li>
				</ul>
			</div>
			<style>body>nav.navbar-dark{display:none;}@media(max-width:768px){body>nav{display:none !important;}}.list-group-item{border:0;}</style>
		</nav>
		<!-- /nav.navbar -->
