<?php

try {
	if (isset($_POST['action']) && $_POST['action'] == 'NewFolder') {
		try {
			$query = "insert into save_work_resume_folder (member, folder_name) values(:member, :folder_name)";
			$stmt = $DB->conn->prepare($query);
			$stmt->bindParam(":member", $_SESSION['ID']);
			$stmt->bindParam(":folder_name", $_POST['folder_name']);
			$stmt->execute();
			$stmt->closeCursor();
			header('Location: /Work/Employer/SavedResumes?folder=' . $_GET['folder']);
			exit();
		} catch (PDOException $e) {
			$_SESSION['dialog'] = "이미 존재하는 폴더명입니다.";
		}
	} else if (isset($_POST['action']) && $_POST['action'] == 'EditFolder') {
		try {
			$query = "update save_work_resume_folder set folder_name = :folder_name where member = :member and no = :no";
			$stmt = $DB->conn->prepare($query);
			$stmt->bindParam(":member", $_SESSION['ID']);
			$stmt->bindParam(":no", $_POST['save_work_resume_folder']);
			$stmt->bindParam(":folder_name", $_POST['folder_name']);
			$stmt->execute();
			$stmt->closeCursor();
			header('Location: /Work/Employer/SavedResumes?folder=' . $_POST['save_work_resume_folder']);
			exit();
		} catch (PDOException $e) {
			$_SESSION['dialog'] = "이미 존재하는 폴더명입니다.";
		}
	} else if (isset($_POST['action']) && $_POST['action'] == 'MoveFolder') {
		foreach ($_POST['save_no'] as $save_no) {
			try {
				if (!$_POST['save_work_resume_folder']) {
					$query = "insert into save_work_resume_folder (member, folder_name) values(:member, :folder_name)";
					$stmt = $DB->conn->prepare($query);
					$stmt->bindParam(":member", $_SESSION['ID']);
					$stmt->bindParam(":folder_name", $_POST['folder_name']);
					$stmt->execute();
					$_POST['save_work_resume_folder'] = $DB->conn->lastInsertId();
				}
				$query = "update save_work_resume set save_work_resume_folder = :save_work_resume_folder where member = :member and no = :no";
				$stmt = $DB->conn->prepare($query);
				$stmt->bindParam(":member", $_SESSION['ID']);
				$stmt->bindParam(":no", $save_no);
				$stmt->bindParam(":save_work_resume_folder", $_POST['save_work_resume_folder']);
				$stmt->execute();
				$stmt->closeCursor();
			} catch (PDOException $e) {
				$_SESSION['dialog'] = "This resume is already in the selected folder.";
			}
		}
		header('Location: /Work/Employer/SavedResumes?folder=' . $_POST['save_work_resume_folder']);
		exit();
	} else if (isset($_POST['action']) && $_POST['action'] == 'DeleteSaves') {
		foreach ($_POST['save_no'] as $save_no) {
			$query = "delete from save_work_resume where member = :member and no = :no";
			$stmt = $DB->conn->prepare($query);
			$stmt->bindParam(":member", $_SESSION['ID']);
			$stmt->bindParam(":no", $save_no);
			$stmt->execute();
			$stmt->closeCursor();
		}
		header('Location: /Work/Employer/SavedResumes?folder=' . $_GET['folder']);
		exit();
	}
} catch (PDOException $e) {
	$WP->printStatus($e->getMessage());
}

$folders = $DB->selectWorkResumeFolder();
if (isset($_GET['folder']) && !empty($_GET['folder'])) {
	$saves = $DB->selectWorkResumeFolder($_GET['folder'])['saves'];
	if (!count($saves)) {
		//header('Location: /Work/Employer/SavedResumes');
		//exit();
	}
}

if (empty($USER['work_credit_res_day']))
	$USER['work_credit_res_day'] = $USER['work_credit_hot_day'];

include_once 'pages/3000_Work/3000_Work_header.php';

?>
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

			<h4 class="border-bottom mb-4 pb-2">Resume Folders</h4>

			<!-- table -->
			<div class="table-responsive"><table class="table table-bordered table-hover text-center">
				<thead class="thead-light">
					<tr>
						<th>Folder Name</th>
						<th>Resume</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
<?php foreach($folders as $folder){ ?>
					<tr class="<?= $_GET['folder']==$folder['no']?'table-active':'' ?>">
						<td><?= $folder['folder_name'] ?></td>
						<td class="formatted-number position-relative"><a class="text-dark stretched-link" href="/Work/Employer/SavedResumes?folder=<?= $folder['no'] ?>"><?= count($folder['saves']) ?></a></td>
						<td>
							<button type="button" class="btn btn-light btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>
							<div class="dropdown-menu">
								<a class="dropdown-item" data-toggle="modal" data-target="#modalFormEditFolder" data-name="<?= $folder['folder_name'] ?>" data-pk="<?= $folder['no'] ?>">Edit</a>
								<a class="dropdown-item" data-toggle="action" data-action="delete" data-table="save_work_resume_folder" data-pk="<?= $folder['no'] ?>">Delete</a>
							</div>
						</td>
					</tr>
<?php } ?>
				</tbody>
<?php if(count($folders)<10){ ?>
				<tfoot>
					<tr>
						<td colspan="3">
							<!-- form#formNewFolder -->
							<form class="form-inline needs-validation" id="formNewFolder" method="post" action="">
								<div class="input-group">
									<input type="text" class="form-control" name="folder_name" placeholder="New Folder Name" maxlength="64" required />
									<div class="input-group-append">
										<button type="submit" class="btn btn-light" name="action" value="NewFolder">Create</button>
									</div>
								</div>
							</form>
							<!-- /form#formNewFolder -->
						</td>
					</tr>
				</tfoot>
<?php } ?>
			</table></div>
			<!-- /table -->

			<em class="text-muted">You can have 10 resume folders</em>

<?php if(isset($saves) && !empty($saves)){ ?>
			<!-- form#formSavedResumes -->
			<form class="mt-5 needs-validation" id="formSavedResumes" method="post" action="">

				<h3 class="mb-2">Saved Resumes</h3>

				<!-- table -->
				<div class="table-responsive"><table class="table table-hover mb-0">
					<tbody>
<?php foreach($saves as $save){ $article = $DB->selectWorkResume($save['work_resume']); ?>
						<tr>
							<td width="20%" class="d-none d-md-table-cell" style="min-width:150px;">
								<input type="checkbox" class="float-left" name="save_no[]" value="<?= $save['no'] ?>" />
								<img class="float-right" src="<?= ($USER['work_credit_res_day'] || $_SESSION['RECRUITER']) && $article['logo_img']?$article['logo_img']:'/assets/images/common-profile.png' ?>" alt="<?= $article['title'] ?>" title="<?= $article['title'] ?>" onerror="this.src='/assets/images/common-noimage.png'" width="110" />
							</td>
							<td width="50%">
								<div class="d-md-none">
									<input type="checkbox" class="" name="save_no[]" value="<?= $save['no'] ?>" />
								</div>
								<h6 class="mt0"><a class="text-dark" href="/Work/Detail/Resume/<?= $article['no'] ?>"><?= $article['title'] ?></a></h6>
<?php if($USER['work_credit_res_day'] || $_SESSION['RECRUITER']){ ?>
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
<?php } if($article['resume_date']){ ?>
										<tr class="d-none d-md-table-row">
											<td style="min-width:126px;"><?= substr($article['resume_date'], 0, 10)==substr($article['resume_mod'], 0, 10)?'Date Posted':'Last Modified' ?></td>
											<td><?= date($CONF['date_format'], strtotime($article['resume_mod'])) ?></td>
										</tr>
										<tr class="d-md-none">
											<td style="min-width:122px;">Date Saved</td>
											<td><?= date($CONF['date_format'], strtotime($save['date'])) ?></td>
										</tr>
<?php } ?>
									</tbody>
								</table>
<?php }else{ ?>
								<p class="text-muted">Your credits subscription has expired. Please contact us or <a href="/Work/Employer/Intro">buy more credits</a>.</p>
<?php } ?>
							</td>
							<td width="30%" class="align-bottom d-none d-md-table-cell">
<?php if(isset($article['contact_private']) && !empty($article['contact_private'])){ ?>
								<p class="mb-0"><a class="btn btn-light btn-sm" data-toggle="modal" data-target="#modalFormMessage" data-name="<?= $article['fullname'] ?>" data-pk="<?= $article['no'] ?>">Message</a></p>
<?php } ?>
								<p class="mb-0">Date Saved : <?= date($CONF['date_format'], strtotime($save['date'])) ?></p>
							</td>
						</tr>
<?php } ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="3">
								<input type="checkbox" class="mr-3" name="save_no[]" data-type="checkall" />
								<button type="button" class="btn btn-light" data-toggle="modal" data-target="#modalMoveFolder">Move</button>
								<button type="submit" class="btn btn-light" name="action" value="DeleteSaves">Delete</button>
							</td>
						</tr>
					</tfoot>
				</table></div>
				<!-- /table -->

				<script defer>
					$('#formSavedResumes button[type="submit"]').on('click', function() {
						if ($('input[name="save_no[]"]:checked').length) {
							Confirm("Are you sure you want delete it?", function() {
								$('#formSavedResumes').append('<input type="hidden" name="action" value="DeleteSaves" />').submit();
							});
						} else {
							Alert("Please select the information you want to delete.");
						}
						return false;
					});
				</script>

				<!-- .modal#modalMoveFolder -->
				<div class="modal" id="modalMoveFolder" method="post" action="" tabindex="-1" role="dialog" aria-hidden="true" autocomplete="off" data-backdrop="static">
					<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<div class="form-group">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Select Folder to Move</h4>
						</div>
						<div class="form-group radio required container-fluid">
<?php foreach($DB->selectWorkResumeFolder() as $i => $folder){ if($folder['no']!=$_GET['folder']){ ?>
							<div class="form-check">
								<input type="radio" class="form-check-input" id="workResumeFolder<?= $i ?>" name="save_work_resume_folder" value="<?= $folder['no'] ?>" required />
								<label for="workResumeFolder<?= $i ?>"><?= $folder['folder_name'] ?></label>
							</div>
<?php }} ?>
							<div class="form-check">
								<input type="radio" class="form-check-input" id="workResumeFolder0" name="save_work_resume_folder" value="0" onfocus="$(this).next('label').find('input').focus();" required />
								<label for="workResumeFolder0"><input type="text" class="form-control" name="folder_name" placeholder="New Folder Name" onfocus="$(this).parent('label').prev('input').prop('checked',true);" /></label>
							</div>
						</div>
						<div class="text-right">
							<input type="hidden" name="save_work_resume" value="" />
							<button type="submit" class="btn btn-primary" name="action" value="MoveFolder">Move</button>
							<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
						</div>
					</div>
				</div>
					</div>
				</div>
				<!-- /.modal#modalMoveFolder -->

				<script defer>
					$('[data-target="#modalMoveFolder"]').on('click', function() {
						if (!$('input[name="save_no[]"]:checked').length) {
							Alert("Please select the information you want to move.");
							return false;
						}
					});
					$('#modalMoveFolder button[type="submit"]').on('click', function() {
						if (!$('#modalMoveFolder input[name="save_work_resume_folder"]:checked').length) {
							Alert("Please select the information you want to move.");
							return false;
						} else if ($('#modalMoveFolder input[name="save_work_resume_folder"]:checked').val() == '0') {
							$('#modalMoveFolder input[name="folder_name"]').prop('required', true);
						} else {
							$('#modalMoveFolder input[name="folder_name"]').prop('required', false);
						}
					});
				</script>

			</form>
			<!-- /form#formSavedResumes -->
<?php } ?>

		</section>
		<!-- /section -->

			</div>
		</div>
	</main>
	<!-- /main -->

	<!-- .modal#modalFormEditFolder -->
	<form class="modal" id="modalFormEditFolder" method="post" action="" tabindex="-1" role="dialog" aria-hidden="true" autocomplete="off">
		<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-body">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<div class="form-group">
				<h4 class="modal-title">Edit Folder Name</h4>
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="folder_name" placeholder="Folder Name" maxlength="64" />
			</div>
			<div class="text-right">
				<input type="hidden" name="save_work_resume_folder" />
				<button type="submit" class="btn btn-primary" name="action" value="EditFolder">Submit</button>
				<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
		</div>
	</form>
	<!-- /.modal#modalFormEditFolder -->

	<script defer>
		$('[data-target="#modalFormEditFolder"]').on('click', function() {
			$('#modalFormEditFolder').find('input[name="folder_name"]').val($(this).attr('data-name'));
			$('#modalFormEditFolder').find('input[name="save_work_resume_folder"]').val($(this).attr('data-pk'));
		});
	</script>

<?php

if(isset($saves) && !empty($saves)){

	$modalFormMessage = array(
		'name' => '',
		'table' => 'work_job_application',
		'pk' => ''
	);
	include_once 'pages/modal/Message.php';
}

?>