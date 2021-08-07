<?php include_once 'pages/3000_Work/3000_Work_header.php'; ?>
	<!-- main -->
	<main class="py-3 py-lg-5">
		<div class="container">
			<div class="row">

		<!-- section -->
		<section class="col-lg-12">

			<h3 class="mb-4">My Page</h3>

		</section>
		<!-- /section -->

		<!-- aside -->
		<aside class="col-lg-3">

<?php include_once 'pages/2000_Account/2000_Account_sidebar.php'; ?>

		</aside>
		<!-- /aside -->

		<!-- section -->
		<section class="col-lg-9">

			<h4 class="border-bottom mb-4 pb-2">My Resumes</h4>

			<!-- table -->
			<table class="table table-bordered table-hover text-center">
				<thead class="thead-light">
					<tr>
						<th width="50%">Resume Title</th>
						<th class="d-none d-lg-table-cell">Views</th>
						<th>Visibility</th>
						<th width="18%" class="d-none d-lg-table-cell">Last Modified</th>
						<th width="12%">Action</th>
					</tr>
				</thead>
				<tbody>
<?php
	$resume_profile = $DB->selectWorkResumeProfile();
	$resumes = $DB->selectWorkResume(null, $_SESSION['ID']);
	if(!$resume_profile['publ']){ $resume = $resumes[0];
?>
					<tr>
						<td class="text-left"><a class="text-danger font-italic" href="/Work/Edit/ResumeProfile?next=<?= $resume['no'] ?>">Unfinished Resume</a></td>
						<td class="d-none d-lg-table-cell"><?= $resume['hits'] ?></td>
						<td><?= $resume['publ']==1?'Public':'Private' ?></td>
						<td class="d-none d-lg-table-cell"><?= date($CONF['date_format'], strtotime($resume['mod'])) ?></td>
						<td class="p-2">
							<div class="dropdown">
								<button type="button" class="btn btn-<?= !$resume['publ']?'primary':'light' ?> btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="/Work/Edit/ResumeProfile?next=<?= $resume['no'] ?>">Edit</a>
								</div>
							</div>
						</td>
					</tr>
<?php }else{ foreach($resumes as $resume){ ?>
					<tr>
						<td class="text-left"><a class="<?= $resume['publ']?'text-muted':'text-danger font-italic' ?>" href="/Work/<?= $resume['publ']?'Detail':'Edit' ?>/Resume/<?= $resume['no'] ?>"><?= $resume['title']?$resume['title']:'Unfinished Resume' ?></a></td>
						<td class="d-none d-lg-table-cell"><?= $resume['hits'] ?></td>
						<td><?= $resume['publ']==1?'Public':'Private' ?></td>
						<td class="d-none d-lg-table-cell"><?= date($CONF['date_format'], strtotime($resume['mod'])) ?></td>
						<td class="p-2">
							<div class="dropdown">
								<button type="button" class="btn btn-<?= !$resume['publ']?'primary':'light' ?> btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="/Work/Edit/Resume/<?= $resume['no'] ?>">Edit</a>
<?php if(isset($resume['publ']) && !empty($resume['publ'])){ if(count($resumes)<3){ ?>
									<a class="dropdown-item" href="/Work/Edit/Resume/<?= $resume['no'] ?>#copy">Copy</a>
<?php } ?>
									<a class="dropdown-item" data-toggle="action" data-action="<?= $resume['publ']==1?'close':'open' ?>" data-table="work_resume" data-pk="<?= $resume['no'] ?>"><?= $resume['publ']==1?'Change Visibility to Private':'Change Visibility to Public' ?></a>
<?php } ?>
									<a class="dropdown-item" data-toggle="action" data-action="delete" data-table="work_resume" data-pk="<?= $resume['no'] ?>">Delete</a>
								</div>
							</div>
						</td>
					</tr>
<?php }} ?>
				</tbody>
			</table>
			<!-- /table -->

			<p class="text-muted"><i class="fa fa-exclamation-circle"></i> You may only create 3 online resumes. If you already have 3 resumes, simply delete one and create a new one.</p>
<?php if(count($resumes)<3){ if(!$resume_profile['publ']){ ?>
			<a class="btn btn-outline-secondary" href="/Work/Edit/ResumeProfile?next=<?= !$resumes[0]['publ']?$resumes[0]['no']:'_NEW' ?>">Create a Resume</a>
<?php }else{ ?>
			<a class="btn btn-outline-secondary" href="/Work/Edit/Resume/<?= $resumes[0]['no'] && !$resumes[0]['publ']?$resumes[0]['no']:'_NEW' ?>">Create a Resume</a>
<?php }} ?>

		</section>
		<!-- /section -->

			</div>
		</div>
	</main>
	<!-- /main -->