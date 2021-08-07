<?php

include_once 'pages/common/header.php';

if ($_SESSION['ID']) {
	echo '<script>location.replace("' . $_SESSION['PREV_URL'] . '");</script>';
	exit();
} else if (isset($_POST['action']) && $_POST['action'] == 'Register') {
	if ($_POST['pw'] == $_POST['pwck']) {
		if ($DB->register($_POST['email'], $_POST['pw'])) {
			echo '<script>location.href = "/MailAuth?email=' . $_POST['email'] . '";</script>';
			exit();
		} else if ($DB->selectMember(null, $_POST['email'])['appr']) {
			echo '<script defer>$(function(){ Confirm("An account under this email address already exists. Log in?", function(){ location.replace("/LogIn"); }); });</script>';
		} else {
			echo '<script defer>$(function(){ Confirm("This email address has not been confirmed. Send confirmation email again?", function(){ location.replace("/MailAuth?email=' . $_POST['email'] . '"); }); });</script>';
		}
	} else {
		echo '<script defer>$(function(){ Alert("Passwords do not match. Please try again."); });</script>';
	}
}

?>
	<!-- form -->
	<form class="needs-validation py-3 py-lg-5" method="post" action="" autocomplete="off">
		<div class="container">

			<h1 class="text-center text-primary font-weight-bold mb-3">Join the WorknPlay Network!</h1>

			<!-- section -->
			<section class="py-5 px-3 border">
				<div class="row justify-content-center">
					<div class="col-sm-8 col-md-6 col-lg-4">

						<div class="text-center">
							<fb:login-button class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false" scope="public_profile, email" onlogin="checkLoginState();" style="display:inline-block;width:257px;height:40px;vertical-align:bottom;background-color:#1877f2;border-radius:4px;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 216 216" class="_5h0m" color="#ffffff" style="float:left;height:24px;margin:8px;"><path fill="#ffffff" d="M204.1 0H11.9C5.3 0 0 5.3 0 11.9v192.2c0 6.6 5.3 11.9 11.9 11.9h103.5v-83.6H87.2V99.8h28.1v-24c0-27.9 17-43.1 41.9-43.1 11.9 0 22.2.9 25.2 1.3v29.2h-17.3c-13.5 0-16.2 6.4-16.2 15.9v20.8h32.3l-4.2 32.6h-28V216h55c6.6 0 11.9-5.3 11.9-11.9V11.9C216 5.3 210.7 0 204.1 0z"></path></svg><span style="float:right;margin:8px 24px 8px 10px;font-size:16px;line-height:24px;color:#ffffff;cursor:not-allowed;">Continue With Facebook</span></fb:login-button>
<?php if($_SESSION['PROD_MODE']){ ?>
							<script src="/assets/js/Facebook.js"></script>
<?php } ?>
						</div>

						<div class="h5 text-center" id="login-or"><span>OR</span></div>
						<style>#login-or{margin:3rem 0 2rem;}#login-or::before{content:"";display:block;width:100%;margin:.625rem 0 calc(-4px - .625rem);border-top:1px solid #007bff;}#login-or>span{padding:0 1em;background-color:#ffffff;color:#007bff;}</style>

						<p class="text-center text-muted my-3">Register with an email address</p>

						<!-- fieldset : Register with an email address -->
						<fieldset>
							<div class="form-group">
								<label for="email">Email Address</label>
								<input type="email" class="form-control form-control-lg" id="email" name="email" value="<?= isset($_POST['email']) && !empty($_POST['email'])?$_POST['email']:'' ?>" maxlength="64" required />
							</div>
							<div class="form-group">
								<label for="pw">Password</label>
								<input type="password" class="form-control form-control-lg" id="pw" name="pw" maxlength="64" required />
							</div>
							<div class="form-group">
								<label for="pwck">Confirm Password</label>
								<input type="password" class="form-control form-control-lg" id="pwck" name="pwck" maxlength="64" required />
							</div>
							<div class="form-group">
								<label class="text-muted">
									<input type="checkbox" name="agree" value="true" required />
									By signing up, I agree to WorknPlay's
									<a href="/TermsAndConditions" target="_blank" onclick="return false;">terms of service</a>,
									<a href="/PrivacyPolicy" target="_blank" onclick="return false;">privacy policy</a>.
								</label>
							</div>
							<button type="submit" class="btn btn-primary btn-block btn-lg" name="action" value="Register">REGISTER</button>
						</fieldset>
						<!-- /fieldset : Register with an email address -->

					</div>
				</div>
			</section>
			<!-- /section -->

<?php include 'pages/common/adsbygoogle-horizontal.php'; ?>

		</div>
	</form>
	<!-- /form -->
<?php include_once 'pages/common/footer.php'; ?>