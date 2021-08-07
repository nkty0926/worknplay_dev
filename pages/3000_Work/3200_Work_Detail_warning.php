<?php if($_GET['MAIN']!='actions'){ ?>
	<!-- section -->
	<section class="py-lg-5 bg-white d-print-none">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-10">
<?php } ?>

			<div class="my-4 card bg-white">
				<div class="card-body">
					<p class="text-muted mb-0">
						TheWorknPlay shall not be considered responsible for damages or losses incurred from the use of this site. Users are solely responsible for all content posted by themselves.
						When applying for jobs, never provide credit card information, bank account information, or perform any sort of monetary transaction. If you are ever asked to do so by a recruiter or an employer on TheWorknPlay, please contact us at <a href="mailto:<?= $CONF['email_ads'] ?>"><?= $CONF['email_ads'] ?></a>.
						Please view our Privacy and Terms of Service <a href="javascript:void(0);">here</a>.
					</p>
				</div>
			</div>

<?php if($_GET['MAIN']!='actions'){ ?>
<?php include 'pages/common/adsbygoogle-horizontal.php' ?>

				</div>
			</div>
		</div>
	</section>
	<!-- /section -->
<?php } ?>