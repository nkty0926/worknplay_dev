<?php

include_once 'pages/common/header.php';

if ($_POST['pwnew']) {
	if ($_POST['pwnew'] == $_POST['pwnewck']) {
		if ($DB->updateMemberPw($_SESSION['ID'], md5($_POST['pwnew']))) {
			echo '<script defer>$(function(){ Dialog("New password saved."); });</script>';
		} else {
			echo '<script defer>$(function(){ Dialog("Error"); });</script>';
		}
	} else {
		echo '<script defer>$(function(){ Dialog("Passwords do not match. Please try again."); });</script>';
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

			<h4 class="border-bottom mb-4 pb-2">Change Password</h4>

<?php if(isset($account['type']) && !empty($account['type'])){ ?>
			<h1 class="text-danger">You cannot use your Facebook Account for this menu.</h1>

			<script>setTimeout(function(){location.replace("/Account");},4000);</script>
<?php }else{ ?>
			<!-- .row -->
			<div class="row">
				<div class="col-sm-8 col-lg-6">

			<!-- fieldset : Change Password -->
			<fieldset>
				<div class="form-group">
					<label for="pwnew">New Password</label>
					<input type="password" class="form-control" id="pwnew" name="pwnew" maxlength="64" required />
				</div>
				<div class="form-group">
					<label for="pwnewck">Confirm Password</label>
					<input type="password" class="form-control" id="pwnewck" name="pwnewck" maxlength="64" required />
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</fieldset>
			<!-- /fieldset : Change Password -->

				</div>
			</div>
			<!-- /.row -->
<?php } ?>

		</section>
		<!-- /section -->

	</div>
	<!-- /.row -->

		</div>
	</form>
	<!-- /form -->
<?php include_once 'pages/common/footer.php'; ?>