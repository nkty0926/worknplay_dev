<?php

include_once 'pages/common/header.php';

if ($_POST['pw']) {
	if ($DB->login($_SESSION['EMAIL'], md5($_POST['pw']))) {
		if ($DB->deleteMember($_SESSION['ID'])) {
			session_destroy();
			echo '<script defer>$(function(){ Alert("Account deleted.", function(){ location.replace("/"); }); });</script>';
		} else {
			echo '<script defer>$(function(){ Alert("Error"); });</script>';
		}
	} else {
		echo '<script defer>$(function(){ Alert("Wrong password. Please try again."); });</script>';
	}
}

?>
	<!-- form -->
	<form class="needs-validation py-3 py-lg-5" id="fromDeleteAccount" method="post" action="">
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

			<h4 class="border-bottom mb-4 pb-2">Delete Account</h4>

			<!-- .row -->
			<div class="row">
				<div class="col-sm-8 col-lg-6">

			<!-- fieldset : Delete Account -->
			<fieldset>
				<div class="form-group">
					<label for="pw">Current Password</label>
					<input type="password" class="form-control" id="pw" name="pw" maxlength="64" required />
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Delete Account</button>
				</div>
			</fieldset>
			<!-- /fieldset : Delete Account -->

			<script defer>
				$('#fromDeleteAccount button[type="submit"]').on('click', function() {
					Confirm("Are you sure you want delete account?", function() {
						$('#fromDeleteAccount').submit();
					});
					return false;
				});
			</script>

				</div>
			</div>
			<!-- /.row -->

		</section>
		<!-- /section -->

	</div>
	<!-- /.row -->

		</div>
	</form>
	<!-- /form -->
<?php include_once 'pages/common/footer.php'; ?>