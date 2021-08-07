<?php

$purchase_hot = $DB->selectWorkPurchase(1);
$purchase_job = $DB->selectWorkPurchase(2);
$purchase_res = $DB->selectWorkPurchase(3);

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

			<h4 class="border-bottom mb-4 pb-2">My Purchase</h4>

<?php if($purchase_hot || $purchase_job || $purchase_res){ ?>
			<!-- .nav-pills -->
			<ul class="nav nav-pills mb-2">
<?php if($purchase_hot){ ?>
				<li class="nav-item"><a class="nav-link border mr-2" href="#tabHotJobs" data-toggle="tab">Hot Jobs</a></li>
<?php } if($purchase_job){ ?>
				<li class="nav-item"><a class="nav-link border mr-2" href="#tabStandardJobs" data-toggle="tab">Standard Jobs</a></li>
<?php } if($purchase_res){ ?>
				<li class="nav-item"><a class="nav-link border mr-2" href="#tabResumeSearch" data-toggle="tab">Resume Search</a></li>
<?php } ?>
			</ul>
			<!-- /.nav-pills -->

			<!-- .tab-content -->
			<div class="tab-content">

<?php if($purchase_hot){ ?>
				<!-- .tab-pane : tabHotJobs -->
				<div class="tab-pane table-responsive fade" id="tabHotJobs">
					<table class="table table-bordered table-hover text-center">
						<thead class="thead-light">
							<tr>
								<th>Date Purchased</th>
								<th>Price / Payment</th>
								<th>Order</th>
								<th>Date Posted</th>
								<th>Expiration Date</th>
								<th class="d-none d-md-table-cell">Receipt</th>
							</tr>
						</thead>
						<tbody>
<?php foreach($purchase_hot as $purchase){ ?>
							<tr>
								<td><?= date($CONF['date_format'], strtotime($purchase['date'])) ?></td>
								<td>&#8361; <?= number_format($purchase['price']) ?> / <?= $purchase['paymethod'] ?></td>
								<td><?= $purchase['credit'] ?> Day<?= $purchase['credit']>1?'s':'' ?></td>
<?php if($purchase['date']<'2015-03-22 00:00:00'){ ?>
								<td colspan="2" class="text-muted">n/a</td>
<?php }else if($purchase['appr']==2){ ?>
								<td colspan="2" class="text-muted">Cancelled</td>
<?php }else if($purchase['appr']==0){ ?>
								<td colspan="2" class="text-danger">Your order is still pending</td>
<?php }else if(isset($purchase['used']) && !empty($purchase['used'])){ ?>
								<td><?= date($CONF['date_format'], strtotime($purchase['used'])) ?></td>
								<td><?= date($CONF['date_format'], strtotime($purchase['used'] . '+' . $purchase['credit'] . 'day')) ?></td>
<?php }else{ ?>
								<td colspan="2">Still available</td>
<?php } ?>
								<td class="d-none d-md-table-cell">
<?php if($purchase['paymethod']!='Bank Transfer' && $purchase['transaction_no'] && $purchase['name'] && $purchase['total']){ ?>
									<form class="form-inline" method="post" action="https://iniweb.inicis.com/app/publication/apReceipt200.jsp?noTid=<?= $purchase['transaction_no'] ?>&noMerchantoid=&flag=0&noMethod=1" target="inicis">
										<input type="hidden" name="noTid" value="<?= $purchase['transaction_no'] ?>" />
										<input type="hidden" name="flgSobo" value="" />
										<input type="hidden" name="noMethod" value="1" />
										<input type="hidden" name="clpaymethod" value="0" />
										<input type="hidden" name="re_mail" value="null" />
										<input type="hidden" name="rt" value="1">
										<input type="hidden" name="valFlg" value="1" />
										<input type="hidden" name="nmBuyer" value="<?= $purchase['name'] ?>" />
										<input type="hidden" name="prGoods" value="<?= $purchase['total'] ?>" />
										<button type="submit" class="fa fa-file-text-o" onclick="window.open('https://iniweb.inicis.com/mall/cr/cm/mCmReceipt_head.jsp?noTid=<?= $purchase['transaction_no'] ?>&noMethod=1','inicis','width=430, height=700, status=no, menubar=no, toolbar=no, titlebar=no, scrollbars=yes, resizable=yes');" style="border:none; background:none;"></button>
									</form>
<?php } ?>
								</td>
							</tr>
<?php } ?>
						</tbody>
					</table>
				</div>
				<!-- /.tab-pane : tabHotJobs -->

<?php } if($purchase_job){ ?>
				<!-- .tab-pane : tabStandardJobs -->
				<div class="tab-pane table-responsive fade" id="tabStandardJobs">
					<table class="table table-bordered table-hover text-center">
						<thead class="thead-light">
							<tr>
								<th>Date Purchased</th>
								<th>Price / Payment</th>
								<th>Package</th>
								<th title="Date Posted">Remaining Credits</th>
								<th title="90 days after date purchased">Expiration Date</th>
								<th class="d-none d-md-table-cell">Receipt</th>
							</tr>
						</thead>
<?php foreach($purchase_job as $purchase){ ?>
						<tbody data-toggle="tbody-collapse">
							<tr>
								<td><?= date($CONF['date_format'], strtotime($purchase['date'])) ?></td>
								<td>&#8361; <?= number_format($purchase['price']) ?> / <?= $purchase['paymethod'] ?></td>
								<td><?= $purchase['credit'] ?> Posting<?= $purchase['credit']>1?'s':'' ?></td>
<?php if($purchase['date']<'2015-03-22 00:00:00'){ ?>
								<td colspan="2" class="text-muted">n/a</td>
<?php }else if($purchase['appr']==2){ ?>
								<td colspan="2" class="text-muted">Cancelled</td>
<?php }else if($purchase['appr']==0){ ?>
								<td colspan="2" class="text-danger">Your order is still pending</td>
<?php }else{ ?>
								<td><?= $purchase['credit'] - count($purchase['jobs']) ?></td>
								<td><?= date($CONF['date_format'], strtotime($purchase['date'] . '+90day')) ?></td>
<?php } ?>
								<td class="d-none d-md-table-cell">
<?php if($purchase['paymethod']!='Bank Transfer' && $purchase['transaction_no'] && $purchase['name'] && $purchase['total']){ ?>
									<form class="form-inline" method="post" action="https://iniweb.inicis.com/app/publication/apReceipt200.jsp?noTid=<?= $purchase['transaction_no'] ?>&noMerchantoid=&flag=0&noMethod=1" target="inicis">
										<input type="hidden" name="noTid" value="<?= $purchase['transaction_no'] ?>" />
										<input type="hidden" name="flgSobo" value="" />
										<input type="hidden" name="noMethod" value="1" />
										<input type="hidden" name="clpaymethod" value="0" />
										<input type="hidden" name="re_mail" value="null" />
										<input type="hidden" name="rt" value="1">
										<input type="hidden" name="valFlg" value="1" />
										<input type="hidden" name="nmBuyer" value="<?= $purchase['name'] ?>" />
										<input type="hidden" name="prGoods" value="<?= $purchase['total'] ?>" />
										<button type="submit" class="fa fa-file-text-o" onclick="window.open('https://iniweb.inicis.com/mall/cr/cm/mCmReceipt_head.jsp?noTid=<?= $purchase['transaction_no'] ?>&noMethod=1','inicis','width=430, height=700, status=no, menubar=no, toolbar=no, titlebar=no, scrollbars=yes, resizable=yes');" style="border:none; background:none;"></button>
									</form>
<?php } ?>
								</td>
							</tr>
						</tbody>
						<tbody class="collapse">
<?php foreach($purchase['jobs'] as $job){ ?>
							<tr>
								<td colspan="3"></td>
								<td><?= date($CONF['date_format'], strtotime($job['date'])) ?></td>
								<td><?= date($CONF['date_format'], strtotime($job['date'] . '+90day')) ?></td>
								<td class="d-none d-md-table-cell"></td>
							</tr>
<?php } ?>
						</tbody>
<?php } ?>
					</table>
				</div>
				<!-- /.tab-pane : tabStandardJobs -->

<?php } if($purchase_res){ ?>
				<!-- .tab-pane : tabResumeSearch -->
				<div class="tab-pane table-responsive fade" id="tabResumeSearch">
					<table class="table table-bordered table-hover text-center">
						<thead class="thead-light">
							<tr>
								<th>Date Purchased</th>
								<th>Price / Payment</th>
								<th>Package</th>
								<th>Date Used</th>
								<th>Expiration Date</th>
								<th class="d-none d-md-table-cell">Receipt</th>
							</tr>
						</thead>
						<tbody>
<?php foreach($purchase_res as $purchase){ ?>
							<tr>
								<td><?= date($CONF['date_format'], strtotime($purchase['date'])) ?></td>
								<td>&#8361; <?= number_format($purchase['price']) ?> / <?= $purchase['paymethod'] ?></td>
								<td><?= $purchase['credit'] ?> Day<?= $purchase['credit']>1?'s':'' ?></td>
<?php if($purchase['date']<'2015-03-22 00:00:00'){ ?>
								<td colspan="2" class="text-muted">n/a</td>
<?php }else if($purchase['appr']==2){ ?>
								<td colspan="2" class="text-muted">Cancelled</td>
<?php }else if($purchase['appr']==0){ ?>
								<td colspan="2" class="text-danger">Your order is still pending</td>
<?php }else if(isset($purchase['used']) && !empty($purchase['used'])){ ?>
								<td><?= date($CONF['date_format'], strtotime($purchase['used'])) ?></td>
								<td><?= date($CONF['date_format'], strtotime($purchase['used'] . '+' . $purchase['credit'] . 'day')) ?></td>
<?php }else{ ?>
								<td colspan="2">Still available</td>
<?php } ?>
								<td class="d-none d-md-table-cell">
<?php if($purchase['paymethod']!='Bank Transfer' && $purchase['transaction_no'] && $purchase['name'] && $purchase['total']){ ?>
									<form class="form-inline" method="post" action="https://iniweb.inicis.com/app/publication/apReceipt200.jsp?noTid=<?= $purchase['transaction_no'] ?>&noMerchantoid=&flag=0&noMethod=1" target="inicis">
										<input type="hidden" name="noTid" value="<?= $purchase['transaction_no'] ?>" />
										<input type="hidden" name="flgSobo" value="" />
										<input type="hidden" name="noMethod" value="1" />
										<input type="hidden" name="clpaymethod" value="0" />
										<input type="hidden" name="re_mail" value="null" />
										<input type="hidden" name="rt" value="1">
										<input type="hidden" name="valFlg" value="1" />
										<input type="hidden" name="nmBuyer" value="<?= $purchase['name'] ?>" />
										<input type="hidden" name="prGoods" value="<?= $purchase['total'] ?>" />
										<button type="submit" class="fa fa-file-text-o" onclick="window.open('https://iniweb.inicis.com/mall/cr/cm/mCmReceipt_head.jsp?noTid=<?= $purchase['transaction_no'] ?>&noMethod=1','inicis','width=430, height=700, status=no, menubar=no, toolbar=no, titlebar=no, scrollbars=yes, resizable=yes');" style="border:none; background:none;"></button>
									</form>
<?php } ?>
								</td>
							</tr>
<?php } ?>
						</tbody>
					</table>
				</div>
				<!-- /.tab-pane : tabResumeSearch -->

<?php } ?>
				<style>.table td,.table th{padding:.5rem;}</style>
				<script defer>
					$(document).on('click', '[data-toggle="tab"]', function(){
						history.pushState({tab: $(this).attr('href')}, document.title, location.href.split('#')[0] + $(this).attr('href'));
					});
					$(window).on('hashchange', function(){
						var tabId = location.hash;
						if (tabId == '') {
							tabId = $('[data-toggle="tab"]').eq(0).attr('href');
						}
						$(tabId).tab('show');
						$('[data-toggle="tab"]').removeClass('active');
						$('[href="' + tabId + '"]').addClass('active');
					});
				</script>

			</div>
			<!-- /.tab-content -->
<?php }else{ ?>
			<a href="/Work/Employer/Intro">Products <i class="fas fa-fw fa-external-link-alt small"></i></a>
<?php } ?>
		</section>
		<!-- /section -->

			</div>
		</div>
	</main>
	<!-- /main -->