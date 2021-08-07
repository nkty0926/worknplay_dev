<?php

include_once 'pages/common/header.php';

if (isset($_POST['action']) && $_POST['action'] == 'AccountEmail') {
	if ($DB->login($_SESSION['EMAIL'], md5($_POST['pw']))) {
		$member = $DB->selectMember(null, $_POST['email']);
		if (!isset($member['no']) || empty($member['no'])) {
			if ($DB->updateMemberEmail($_SESSION['ID'], $_POST['email'])) {
				session_destroy();
				echo '<script>location.replace("/MailAuth?email=' . $_POST['email'] . '");</script>';
				exit();
			} else {
				echo '<script defer>$(function(){ Alert("Error"); });</script>';
			}
		} else {
			echo '<script defer>$(function(){ Alert("Incorrect or duplicate Email address.", function(){ $(\'#fieldsetAccountEmailBlockquote\').show(); }); });</script>';
		}
	} else {
		echo '<script defer>$(function(){ Alert("Wrong password. Please try again.", function(){ $(\'#fieldsetAccountEmailBlockquote\').show(); }); });</script>';
	}
} else if (isset($_POST['action']) && $_POST['action'] == 'AccountProfile') {
	$values = array(
		':nickname' => $_POST['nickname'],
		':logo_img' => $_POST['logo_img'],
		':email' => $_SESSION['EMAIL']
	);
	if ($DB->editMember($values)) {
		echo '<script>location.replace("/Account/MyInfo");</script>';
		exit();
	} else {
		echo '<script defer>$(function(){ Alert("Failed"); });</script>';
	}
}

?>
	<!-- form -->
	<form class="needs-validation py-3 py-lg-5" method="post" action="">
		<div class="container">

	<h3 class="mb-4">Account Settings</h3>

	<!-- .row -->
	<div class="row">

		<!-- aside -->
		<aside class="col-lg-3">

<?php include_once 'pages/2000_Account/2000_Account_sidebar.php'; ?>

		</aside>
		<!-- /aside -->

		<!-- section -->
		<section class="col-lg-9">

			<h4 class="border-bottom mb-4 pb-2">Contact Information</h4>

			<!-- .row -->
			<div class="row">
				<div class="col-sm-8 col-lg-6">

			<!-- fieldset : Account Email Address -->
			<fieldset id="fieldsetAccountEmail">
				<legend class="h5 font-weight-normal">Account Email Address</legend>
				<div class="input-group">
					<input type="text" class="form-control" name="email" value="<?= $_SESSION['EMAIL'] ?>" disabled />
					<div class="input-group-append">
						<a class="btn btn-secondary mb-0" id="fieldsetAccountEmailChange" href="javascript:void(0);" data-toggle="collapse=" data-target="fieldsetAccountEmailBlockquote">CHANGE</a>
					</div>
				</div>
<?php if(!$account['type']){ ?>

				<!-- #fieldsetAccountEmailBlockquote -->
				<blockquote class="border-left mb-0 py-3 pl-3 collapse" id="fieldsetAccountEmailBlockquote">
					<label class="required">New Email Address</label>
					<input type="email" name="autocomplete_email" class="d-none" />
					<div class="form-group">
						<input type="email" class="form-control" name="email" maxlength="64" />
					</div>
					<label class="required">Current Password</label>
					<input type="password" name="autocomplete_pw" class="d-none" />
					<div class="form-group">
						<input type="password" class="form-control" name="pw" maxlength="64" />
					</div>
					<div class="form-group mb-0">
						<button type="submit" class="btn btn-primary" name="action" value="AccountEmail">Save</button>
						<button type="button" class="btn btn-secondary" id="fieldsetAccountEmailCancel">Cancel</button>
					</div>
				</blockquote>
				<!-- /#fieldsetAccountEmailBlockquote -->

<?php } ?>
			</fieldset>
			<!-- /fieldset : Account Email Address -->

				</div>
			</div>
			<!-- /.row -->

			<!-- .row -->
			<div class="row">
				<div class="col-sm-12 col-lg-12">
					<hr class="my-4" />
				</div>
			</div>
			<!-- /.row -->

			<!-- .row -->
			<div class="row">
				<div class="col-sm-8 col-lg-6">

			<!-- fieldset : Account Profile -->
			<fieldset id="fieldsetAccountProfile">
				<legend class="h5 mb-3 font-weight-normal">Account Profile <small class="text-muted">to comment and review</small></legend>
				<div class="form-group">
					<input type="text" class="form-control" name="nickname" value="<?= $account['nickname'] ?>" placeholder="Nickname" maxlength="64" />
				</div>
				<div class="form-group">
					<label class="img-thumbnail collapse<?= $account['logo_img']?'':' show' ?> mb-0" id="logoImg-collapse" for="logoImg-file" style="cursor:pointer;">
						<div class="text-center p-3">
							<img src="/assets/images/2100-account-logo-img-placeholder.png" alt="Add a Profile Image" title="Add a Profile Image" />
							<p class="lead text-uppercase my-1" style="color:#0079b9;">Add a Profile Image</p>
							<p class="text-muted small mb-0">Choose a file to upload</p>
						</div>
					</label>
					<style>#logoImg-collapse>div{border:2px dashed var(--gray-light);}#logoImg-collapse>div:hover{border-color:#0079b9;}</style>
					<div id="logoImg-target">
<?php if(isset($account['logo_img']) && !empty($account['logo_img'])){ ?>
						<figure><a class="form-remove" href="javascript:void(0);" data-toggle="remove">&times;</a><img src="<?= $account['logo_img']?>" alt="Profile Image" title="Profile Image" /></figure>
<?php } ?>
					</div>
				</div>
				<div class="form-group mb-0">
					<button type="submit" class="btn btn-primary" name="action" value="AccountProfile">Save</button>
				</div>
				<input type="file" class="d-none" id="logoImg-file" accept="image/gif, image/jpeg, image/png" data-name="logo_img" data-target="#logoImg-target" data-target-collapse="#logoImg-collapse" />
				<input type="hidden" name="logo_img" value="<?= $account['logo_img'] ?>" />
			</fieldset>
			<!-- /fieldset : Account Profile -->

				</div>
			</div>
			<!-- /.row -->

		</section>
		<!-- /section -->

	</div>
	<!-- /.row -->

	<script defer>
		$('button[type="submit"][value="AccountEmail"]').on('click', function(){ $('#fieldsetAccountProfile').prop('disabled', true); });
		$('button[type="submit"][value="AccountProfile"]').on('click', function(){ $('#fieldsetAccountEmail').prop('disabled', true); });
		$('#fieldsetAccountEmailChange').on('click', function(){
			$('#fieldsetAccountEmailBlockquote').collapse('show').find('input.form-control').prop('required', true).val('');
			$('#fieldsetAccountProfile').prop('disabled', true);
		});
		$('#fieldsetAccountEmailCancel, button[type="submit"][value="AccountProfile"]').on('click', function(){
			$('#fieldsetAccountEmailBlockquote').collapse('hide').find('input.form-control').prop('required', false).val('').removeClass('has-error');
			$('#fieldsetAccountProfile').prop('disabled', false);
		});
	</script>

		</div>
	</form>
	<!-- /form -->
<?php include_once 'pages/common/footer.php'; ?>