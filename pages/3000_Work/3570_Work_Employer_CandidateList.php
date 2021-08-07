<?php

if (isset($_POST['action']) && $_POST['action'] == 'delete') {
	try {
		foreach ($_POST['application_no'] as $application_no) {
			$query = "update work_job_application left join work_job on work_job_application.work_job = work_job.no left join work_company on work_job.work_company = work_company.no set deleted = now() where work_company.member = :member and work_job_application.no = :no";
			$stmt = $DB->conn->prepare($query);
			$stmt->bindParam(":member", $_SESSION['ID']);
			$stmt->bindParam(":no", $application_no);
			$stmt->execute();
			$stmt->closeCursor();
			// $DB->conn->query("delete from work_job_application where deleted is not null and canceled is not null;");
		}
		header('Location: /Work/Employer/CandidateList');
		exit();
	} catch (PDOException $e) {
		$WP->printStatus($e->getMessage());
	}
}

if (isset($_GET['job']) && !empty($_GET['job'])) {
	$jobs[0] = $DB->selectWorkJob($_GET['job']);
	if ($jobs[0]['member'] == $_SESSION['ID'] && (strtotime($jobs[0]['date'] . '+120day') > strtotime('now') || $_SESSION['RECRUITER'])) {
		$applications = $DB->selectWorkJobApplication(null, $_GET['job']);
	} else {
		header('Location: /Work/Employer/CandidateList?page=' . $_GET['page']);
		exit();
	}
} else {
	$applications = $DB->selectWorkJobApplication(null, null, $_SESSION['ID'], $_GET['company'], $_GET['keyword']);
	$count_today = 0;
	foreach ($applications as $application) {
		if (date('Y-m-d', strtotime($application['date'])) == date('Y-m-d')) {
			$count_today++;
		}
	}
}

if (!isset($_GET['page']) || empty($_GET['page'])) {
	$_GET['page'] = 1;
}

include_once 'pages/3000_Work/3000_Work_header.php';

?>
<?php if($_GET['MENU']!='Home'){ ?>
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
<?php }else{ ?>
			<!-- section : Applicants -->
			<section class="mt-5">

			<a class="btn btn-light btn-sm float-right d-none d-lg-inline-block" href="/Work/Employer/CandidateList">More</a>
<?php } ?>

			<h4 class="mb-2">
				<a class="text-dark" href="/Work/Employer/CandidateList">Applicants</a>
<?php if($_GET['company']){ ?>
				- <span class="text-primary"><?= $applications[0]['company_name'] ?></span>
<?php }else if($_GET['job']){ ?>
				- <span class="text-primary"><?= $applications[0]['job_title'] ?></span>
<?php } ?>
				<small>: Total (<span><?= $CONF['pagination_total'] ?></span>)</small>
				<?= isset($count_today)?' <small>/ Today (<span>' . $count_today . '</span>)</small>':'' ?>
			</h4>
<?php if($_GET['MENU']!='Home' && count($applications)>1){ ?>

			<!-- form -->
			<form method="get" action="/Work/Employer/CandidateList">
				<div class="row justify-content-end mb-2 mt-lg-n5 pt-lg-2">
					<div class="col-sm-6 col-lg-3 pt-lg-1">
						<div class="input-group input-group-sm">
							<input type="text" class="form-control form-control-lg border-right-0" name="keyword" value="<?= $_GET['keyword'] ?>" placeholder="Keyword">
							<label class="input-group-append mb-0">
								<button type="submit" class="input-group-text bg-white text-black-50 border-left-0"><i class="fa fa-fw fa-search"></i></button>
							</label>
						</div>
					</div>
				</div>
			</form>
			<!-- /form -->
<?php } ?>

			<!-- form -->
			<form id="formApplications" method="post" action="">

				<!-- table -->
				<div class="table-responsive"><table class="table border-bottom">
					<tbody>
<?php foreach($applications as $i => $article){ if($_GET['MENU']=='Home' && $i>=3) break; ?>
						<tr>
							<td width="20%" class="d-none d-md-table-cell" style="min-width:150px;">
								<input type="checkbox" class="float-left" name="application_no[]" value="<?= $article['no'] ?>" />
<?php if($article['attachment'] || $article['title']){ ?>
								<figure class="float-right bg-gray p-3" style="width:110px;height:110px;">File Applicant</figure>
<?php }else{ ?>
								<img class="float-right" src="<?= $article['logo_img'] ?>" alt="<?= $article['title'] ?>" title="<?= $article['title'] ?>" onerror="this.src='/assets/images/common-noimage.png'" width="110" />
<?php } ?>
							</td>
<?php if(isset($article['canceled']) && !empty($article['canceled'])){ ?>
							<td width="80%">
								<h6 class="text-muted">Canceled Application</h6>
							</td>
<?php }else if(empty($article['work_resume']) && empty($article['attachment']) && empty($article['title'])){ ?>
							<td width="80%">
								<h6 class="text-muted">Deleted Resume</h6>
							</td>
<?php }else{ ?>
							<td>
								<div class="d-md-none">
									<input type="checkbox" class="" name="application_no[]" value="<?= $article['no'] ?>" />
								</div>
<?php if($article['attachment'] || $article['title']){ ?>
								<h6 class="mt0"><?= $article['title'] ?></h6>
<?php }else{ ?>
								<h6 class="mt0"><a class="text-dark" href="/Work/Detail/Resume/<?= $article['work_resume'] ?>?application=<?= $article['no'] ?>"><?= $article['resume_title'] ?></a></h6>
<?php } ?>
								<table class="table-divided-by-colon">
									<tbody>
<?php if(isset($article['fullname']) && !empty($article['fullname'])){ ?>
										<tr><td>Name</td><td><?= $article['fullname'] ?></td></tr>
<?php } if(isset($article['personal_gender']) && !empty($article['personal_gender'])){ ?>
										<tr><td>Gender</td><td><?= $WP->printGender($article) ?></td></tr>
<?php } if(isset($article['nationality_name']) && !empty($article['nationality_name'])){ ?>
										<tr><td style="min-width:106px;">Citizenship</td><td><?= $article['nationality_name'] ?></td></tr>
<?php } if(!$article['contact_private'] && $article['contact_email']){ ?>
										<tr><td>Email</td><td><?= $article['contact_email'] ?></td></tr>
<?php } if($article['attachment'] && $article['title']){ ?>
										<tr><td style="min-width:120px;"><!-- Attachments -->Download</td><td><?= $WP->printAttachments($article); ?></td></tr>
<?php } if($article['resume_date']){ ?>
										<!--
										<tr class="d-none d-md-table-row">
											<td style="min-width:126px;"><?= substr($article['resume_date'], 0, 10)==substr($article['resume_mod'], 0, 10)?'Date Posted':'Last Modified' ?></td>
											<td><?= date($CONF['date_format'], strtotime($article['resume_mod'])) ?></td>
										</tr>
										-->
										<tr class="">
											<td style="min-width:122px;">Date Applied</td>
											<td><?= date($CONF['date_format'], strtotime($article['date'])) ?></td>
										</tr>
<?php } ?>
									</tbody>
								</table>
<?php if(isset($article['contact_private']) && !empty($article['contact_private'])){ ?>
								<p class="mb-0"><a class="btn btn-light btn-sm" data-toggle="modal" data-target="#modalFormMessage" data-name="<?= $article['fullname'] ?>" data-pk="<?= $article['no'] ?>">Message</a></p>
<?php } ?>
								<!--
								<p class="mb-0">Date Applied : <?= date($CONF['date_format'], strtotime($article['date'])) ?></p>
								-->
							</td>
<?php } ?>
						</tr>
						<tr>
							<td class="border-top-0 pt-0 d-none d-md-table-cell"></td>
							<td class="border-top-0 pt-0 text-muted">
<?php if($_SESSION['RECRUITER']){?>
								<a class="text-muted" href="/Work/Employer/CandidateList?company=<?= $article['work_company'] ?>"><?= $article['company_name'] ?></a><br />
<?php } ?>
								<a class="text-muted" href="/Work/Employer/CandidateList?job=<?= $article['work_job'] ?>"><?= $article['job_title'] ?></a>
							</td>
						</tr>
<?php } ?>
					</tbody>
<?php if($_GET['MENU']!='Home'){ ?>
					<tfoot>
						<tr>
							<td colspan="2">
								<input type="checkbox" class="mr-3" name="application_no[]" data-type="checkall" />
								<button type="submit" class="btn btn-light" name="action" value="delete">Delete</button>
							</td>
						</tr>
					</tfoot>
<?php } ?>
				</table></div>
				<!-- /table -->

				<script defer>
					$('#formApplications button[type="submit"]').on('click', function() {
						if ($('input[name="application_no[]"]:checked').length) {
							Confirm("Are you sure you want delete it?", function() {
								$('#formApplications').append('<input type="hidden" name="action" value="delete" />').submit();
							});
						} else {
							Alert("Please select the information you want to delete.");
						}
						return false;
					});
				</script>

<?php if($_GET['MENU']!='Home' && count($applications)>1){ include_once 'pages/common/pagination.php'; } ?>

			</form>
			<!-- /form -->
<?php if($_GET['MENU']=='Home'){ ?>

			<a class="btn btn-light btn-sm mt-2 d-inline-block d-lg-none" href="/Work/Employer/CandidateList">More <i class="fas fa-caret-down"></i></a>

			</section>
			<!-- /section : Applicants -->
<?php }else{ ?>

		</section>
		<!-- /section -->

			</div>
		</div>
	</main>
	<!-- /main -->
<?php } ?>
<?php

if(isset($applications) && !empty($applications)){
	$modalFormMessage = array(
		'name' => '',
		'table' => 'work_job_application',
		'pk' => ''
	);
	include_once 'pages/modal/Message.php';
}

?>