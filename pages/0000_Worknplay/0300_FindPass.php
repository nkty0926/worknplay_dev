<?php

include_once 'pages/common/header.php';

if ($_SESSION['ID']) {
	echo '<script>location.replace("' . $_SESSION['PREV_URL'] . '");</script>';
} else if (isset($_GET['auth']) && !empty($_GET['auth'])) {
	$member = $DB->selectMember(null, null, $_GET['auth']);
	if (isset($member['no']) && !empty($member['no'])) {
		if ($_POST['pw']) {
			if ($_POST['pw'] == $_POST['pwck']) {
				$DB->updateMemberAppr($_GET['auth']);
				$DB->updateMemberPw($member['no'], md5($_POST['pw']));
				echo '<script>location.replace("/LogIn");</script>';
			} else {
				echo '<script defer>$(function(){ Alert("Passwords do not match. Please try again."); });</script>';
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

			<h2 class="border-bottom mb-4 pb-2">Change Password</h2>

			<!-- .row -->
			<div class="row">
				<div class="col-sm-8 col-md-6 col-lg-4">

			<!-- fieldset : Change Password -->
			<fieldset>
				<div class="form-group">
					<label for="pw">New Password</label>
					<input type="password" class="form-control" id="pw" name="pw" maxlength="64" required />
				</div>
				<div class="form-group">
					<label for="pwck">Confirm Password</label>
					<input type="password" class="form-control" id="pwck" name="pwck" maxlength="64" required />
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
			</fieldset>
			<!-- /fieldset : Change Password -->

				</div>
			</div>

		</section>
		<!-- /section -->

	</div>
	<!-- /.row -->

		</div>
	</form>
	<!-- /form -->
<?php
		include_once 'pages/common/footer.php';
	} else {
		echo '<main class="container py-3 py-lg-5"></main><script defer>$(function(){ Alert("Failed", function(){ location.replace("/LogIn"); }); });</script>';
	}
	exit();
} else if (isset($_POST['action']) && $_POST['action'] == 'FindPass') {
	if (isset($_POST['email']) && !empty($_POST['email'])) {
		$member = $DB->selectMember(null, $_POST['email']);
		if (isset($member['no']) && !empty($member['no'])) {
			if (!isset($member['authcode']) || empty($member['authcode'])) {
				$member['authcode'] = $DB->updateMemberAuth($member['no']);
			}
?>
	<script defer>$.ajax({ type: 'post', url: '/actions/Mail', data: 'action=FindPass&auth=<?= $member['authcode'] ?>&email=<?= $_POST['email'] ?>' });</script>

	<!-- main -->
	<main class="container py-3 py-lg-5">

		<!-- section -->
		<section class="py-5 px-3 border">
			<div class="row justify-content-center">
				<div class="col-sm-8 col-md-6 col-lg-4 text-center">
					<figure style="display:inline-block;width:72px;height:72px;border-radius:50%;background-color:var(--gray-light);">
						<img src="/assets/icons/icons8/new-post.png" alt="Email" title="Email" style="width:24px;height:24px;margin:24px;" />
					</figure>
					<h2>Check your email</h2>
					<p class="text-muted">We sent an email to <mark><?= $_POST['email'] ?></mark> with instructions to reset your password.</p>
				</div>
			</div>
		</section>
		<!-- /section -->

<?php include 'pages/common/adsbygoogle-horizontal.php'; ?>

	</main>
	<!-- /main -->
<?php
			include_once 'pages/common/footer.php';
		} else {
			echo '<script defer>$(function(){ Confirm("This email address is not registered. Do you want to create an account?", function(){ location.replace("/Register"); }, function(){ location.replace("/LogIn"); }); });</script>';
		}
	} else {
		echo '<main class="container py-3 py-lg-5"></main><script defer>$(function(){ Alert("Failed", function(){ location.replace("/LogIn"); }); });</script>';
	}
	exit();
}
?>
	<!-- form -->
	<form class="needs-validation container py-5" method="post" action="" autocomplete="off">

		<h1 class="text-center font-weight-bold mb-3">Forgot your password?</h1>

		<!-- section -->
		<section class="py-5 px-3 border">
			<div class="row justify-content-center">
				<div class="col-sm-8 col-md-6 col-lg-4">

			<!-- fieldset : Forgot your password? -->
			<fieldset>
				<div class="form-group">
					<label for="email">Email Address</label>
					<input type="email" class="form-control form-control-lg" id="email" name="email" value="<?= isset($_POST['email']) && !empty($_POST['email'])?$_POST['email']:'' ?>" maxlength="64" required />
				</div>
				<p class="text-muted">Enter the email address associated with your account and we’ll send you instructions on how to reset your password.</p>
				<button type="submit" class="btn btn-primary btn-block btn-lg" name="action" value="FindPass">SEND</button>
			</fieldset>
			<!-- /fieldset : Forgot your password? -->

				</div>
			</div>
		</section>
		<!-- /section -->

<?php include 'pages/common/adsbygoogle-horizontal.php'; ?>

	</form>
	<!-- /form -->
<?php include_once 'pages/common/footer.php'; ?>