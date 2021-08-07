<?php

include_once 'pages/common/header.php';

if ($_SESSION['ID'] && $_SESSION['ID']!='-1') {
	echo '<script>location.replace("' . $_SESSION['PREV_URL'] . '");</script>';
} else if ($_GET['auth']) {
	echo '<script>location.replace("/LogIn");</script>';
	if ($DB->updateMemberAppr($_GET['auth'])) {
		$_SESSION['dialog'] = "Email address confirmation success.";
	} else {
		$_SESSION['dialog'] = "Email address confirmation failed.";
	}
} else if ($_GET['email']) {
	$member = $DB->selectMember(null, $_GET['email']);
	if (isset($member['no']) && !empty($member['no'])) {
		if (!isset($member['auth']) || empty($member['auth'])) {
			$member['auth'] = $DB->updateMemberAuth($member['no']);
		}
?>
	<script defer>$.ajax({ type: 'post', url: '/actions/Mail', data: 'action=MailAuth&email=<?= $member['email'] ?>&auth=<?= $member['auth'] ?>' });</script>

	<!-- main -->
	<main class="container py-3 py-lg-5">

		<!-- section -->
		<section class="py-5 px-3 border">
			<div class="row justify-content-center">
				<div class="col-sm-8 col-md-6 col-lg-4 text-center">
					<figure style="display:inline-block;width:72px;height:72px;border-radius:50%;background-color:var(--gray-light);">
						<img src="/assets/icons/icons8/new-post.png" alt="Email" title="Email" style="width:24px;height:24px;margin:24px;" />
					</figure>
					<h2 class="text-lighter">Verify your account</h2>
					<p class="text-muted">A confirmation email has been sent to <span class="mark"><?= $_GET['email'] ?></span>. Click on the confirmation link in the email to activate your account.</p>
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
		echo '<main class="container py-3 py-lg-5"></main><script defer>$(function(){ Alert("Failed", function(){ location.replace("/LogIn"); }); });</script>';
	}
} else {
	echo '<main class="container py-3 py-lg-5"></main><script defer>$(function(){ Alert("Failed", function(){ location.replace("/LogIn"); }); });</script>';
}

?>