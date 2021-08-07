<?php

include_once 'pages/3000_Work/3000_Work_header.php';

// $WP->printStatus();
// print_r($_POST);echo"<br />";
// print_r(serialize($_POST));echo"<br />";
// print_r(base64_encode(serialize($_POST)));echo"<br />";
// print_r(base64_decode(base64_encode(serialize($_POST))));echo"<br />";
// print_r(unserialize(base64_decode(base64_encode(serialize($_POST)))));echo"<br />";

if (!isset($_POST['credit_total']) || empty($_POST['credit_total'])) {
	echo '<script>location.replace("/Work/Product/Select");</script>';
	exit();
} else {
	$_SESSION['PAYMENT'] = true;
}

require_once 'libraries/INIpayWebStandard/libs/INIStdPayUtil.php';
$inistdpayUtil = new INIStdPayUtil();

$goPayMethod = $CONF['goPayMethod'];
$goPayMethodKeys = array_keys($goPayMethod);
$goPayMethodValues = array_values($goPayMethod);

// ############################################
// 1.전문 필드 값 설정(***가맹점 개발수정***)
// ############################################
$mid = $_SESSION['PROD_MODE'] ? "worknplay0" : "INIpayTest"; // 가맹점 ID(가맹점 수정후 고정)
$signKey = $_SESSION['PROD_MODE'] ? "cm1SaG1CSllTckZuaVRBcmRhNXRWZz09" : "SU5JTElURV9UUklQTEVERVNfS0VZU1RS"; // 가맹점에 제공된 웹 표준 사인키(가맹점 수정후 고정)
$timestamp = $inistdpayUtil->getTimestamp(); // util에 의해서 자동생성
$oid = $mid . "_" . $timestamp; // 가맹점 주문번호(가맹점에서 직접 설정)
$price = $_SESSION['PROD_MODE'] ? $_POST['credit_total'] : "1000"; // 상품가격(특수기호 제외, 가맹점에서 직접 설정)
$cardNoInterestQuota = "11-2:3:,34-5:12,14-6:12:24,12-12:36,06-9:12,01-3:4"; // 카드 무이자 여부 설정(가맹점에서 직접 설정)
$cardQuotaBase = "2:3:4:5:6:11:12:24:36"; // 가맹점에서 사용할 할부 개월수 설정

// ###################################
// 2. 가맹점 확인을 위한 signKey를 해시값으로 변경 (SHA-256방식 사용)
// ###################################
$mKey = $inistdpayUtil->makeHash($signKey, "sha256");
$params = array(
	"oid" => $oid,
	"price" => $price,
	"timestamp" => $timestamp
);
$sign = $inistdpayUtil->makeSignature($params, "sha256");

/* 기타 */
$siteDomain = $WP->getCurrentHost() . '/libraries/INIpayWebStandard/INIStdPaySample'; // 가맹점 도메인 입력

?>
	<style>.inipay_modal.fade.in{opacity:1;}</style>
<?php if($_SESSION['PROD_MODE']){ ?>
	<!-- 상용 JS(가맹점 MID 변경 시 주석 해제, 테스트용 JS 주석 처리 필수!) -->
	<script src="https://stdpay.inicis.com/stdjs/INIStdPay.js"></script>
<?php }else{ ?>
	<!-- 테스트 JS(샘플에 제공된 테스트 MID 전용) -->
	<script src="https://stgstdpay.inicis.com/stdjs/INIStdPay.js"></script>
<?php } ?>
	<script>
function pay(){ INIStdPay.pay('formOrderProduct'); }
function pay_mobile(){
	var date = new Date();
	document.inipaymobile.P_OID.value = 'inipaymobile' + date.getFullYear() + '' + date.getMonth()+1 + '' + date.getDate() + '' + date.getHours() + '' + date.getMinutes() + '' + date.getSeconds();
	document.inipaymobile.P_UNAME.value = $('#buyername').val();
	document.inipaymobile.P_MOBILE.value = $('#buyertel').val();
	if(window.open("", "BTPG_WALLET", "top=" + ((screen.height - 440) / 2) + ", left=" + ((screen.width - 320) / 2) + ", width=320, height=440"))
		document.inipaymobile.submit();
	else Alert("Please turn off your pop-up blocker.");
}
	</script>

	<!-- main -->
	<main class="py-3 py-lg-5">
		<div class="container">
			<div class="row">

		<!-- section -->
		<section class="col-lg-12">

			<!-- form : inipaymobile -->
			<form name="inipaymobile" method="post" action="https://mobile.inicis.com/smart/wcard/" target="BTPG_WALLET">
				<input type="hidden" name="inipaymobile_type" value="web" />
				<input type="hidden" name="P_OID" value="<?= $oid ?>" />
				<input type="hidden" name="P_GOODS" value="Work Credit" />
				<input type="hidden" name="P_AMT" value="<?= $price ?>" />
				<input type="hidden" name="P_UNAME" value="" />
				<input type="hidden" name="P_MOBILE" value="" />
				<input type="hidden" name="P_EMAIL" value="" />
				<input type="hidden" name="paymethod" value="wcard" />
				<input type="hidden" name="P_MNAME" value="WorknPlay" />
				<input type="hidden" name="P_MID" value="<?= $mid ?>" />
				<input type="hidden" name="P_NEXT_URL" value="https://mobile.inicis.com/smart/testmall/next_url_test.php" />
				<input type="hidden" name="P_NOTI_URL" value="https://mobile.inicis.com/rnoti/rnoti.php" />
				<input type="hidden" name="P_HPP_METHOD" value="1" />
			</form>
			<!-- /form : inipaymobile -->

			<!-- form : formOrderProduct -->
			<form class="section" id="formOrderProduct" method="post" action="/Work/Product/Payment">

				<!-- 필수 옵션 -->
				<input type="hidden" name="version" value="1.0" />
				<input type="hidden" name="mid" value="<?= $mid ?>" />
				<input type="hidden" name="mKey" value="<?= $mKey ?>" />
				<input type="hidden" name="signature" value="<?= $sign ?>" />
				<input type="hidden" name="timestamp" value="<?= $timestamp ?>" />
				<input type="hidden" name="oid" value="<?= $oid ?>" />
				<input type="hidden" name="returnUrl" value="<?= $WP->getCurrentHost() ?>/Work/Product/Payment" value="Work Credit" />
				<input type="hidden" name="goodname" value="Work Credit" />
				<input type="hidden" name="price" value="<?= $price ?>" />
				<input type="hidden" name="currency" value="WON" />
				<input type="hidden" name="buyeremail" value="<?= $_SESSION['EMAIL'] ?>" />
				<!-- 기본 옵션 -->
				<input type="hidden" name="offerPeriod" value="" />
				<input type="hidden" name="acceptmethod" value="" />
				<!-- 표시 옵션 -->
				<input type="hidden" name="languageView" value="en" />
				<input type="hidden" name="charset" value="UTF-8" />
				<input type="hidden" name="payViewType" value="overlay" />
				<input type="hidden" name="closeUrl" value="<?= $siteDomain ?>/close.php" />
				<input type="hidden" name="popupUrl" value="<?= $siteDomain ?>/popup.php" />
				<!-- 결제 수단별 옵션 -->
				<input type="hidden" name="nointerest" value="<?= $cardNoInterestQuota ?>" />
				<input type="hidden" name="quotabase" value="<?= $cardQuotaBase ?>" />
				<input type="hidden" name="vbankRegNo" value="" />
				<!-- 추가 옵션 -->
				<input type="hidden" name="merchantData" value='<?= base64_encode(serialize($_POST)) ?>' />

				<h3>Review your Order</h3>

				<!-- table : Review your Order -->
				<table class="table table-bordered text-center" id="tableMyOrder">
					<thead class="thead-light">
						<tr>
							<th width="50%">Order(s)</th>
							<th width="30%">PACKAGE</th>
							<th width="20%">PRICE</th>
						</tr>
					</thead>
					<tbody>
<?php for($i=0; $i<count($_POST['credit_product']); $i++){ ?>
						<tr>
							<td><?= $_POST['credit_product'][$i] ?></td>
							<td><?= $_POST['credit_package'][$i] ?> <?= $_POST['credit_product'][$i]!='Standard Job Posting'?'Day':'Posting' ?><?= $_POST['credit_package'][$i]>1?'s':'' ?></td>
							<td>&#8361; <?= number_format($_POST['credit_price'][$i]) ?></td></tr>
<?php } ?>
					</tbody>
					<tfoot>
						<tr class="table-active">
							<td colspan="2">Total (including VAT)</td>
							<td>&#8361; <?= number_format($_POST['credit_total']) ?></td>
						</tr>
					</tfoot>
				</table>
				<!-- /table : Review your Order -->

				<!-- fieldset : Payment Option -->
				<fieldset class="mb-4">

					<legend>Payment Option</legend>

					<!-- .form-control : gopaymethod -->
					<div class="form-control text-center bg-light" style="margin-bottom:-1px;">
						<div class="form-check form-check-inline mx-4 d-none d-md-inline-flex">
							<input type="radio" class="form-check-input" id="gopaymethod1" name="gopaymethod" value="<?= $goPayMethodKeys[0] ?>" required data-payment="#paymentCard" />
							<label class="form-check-label" for="gopaymethod1"><?= $goPayMethodValues[0] ?></label>
						</div>
						<!--
						<div class="form-check form-check-inline mx-4 d-none d-md-inline-flex">
							<input type="radio" class="form-check-input" id="gopaymethod2" name="gopaymethod" value="<?= $goPayMethodKeys[1] ?>" required data-payment="#paymentCard" />
							<label class="form-check-label" for="gopaymethod2"><?= $goPayMethodValues[1] ?></label>
						</div>
						-->
						<div class="form-check form-check-inline mx-4">
							<input type="radio" class="form-check-input" id="gopaymethod3" name="gopaymethod" value="<?= $goPayMethodKeys[2] ?>" required data-payment="#paymentVBank" />
							<label class="form-check-label" for="gopaymethod3"><?= $goPayMethodValues[2] ?></label>
						</div>
						<div class="form-check form-check-inline mx-4">
							<input type="radio" class="form-check-input" id="gopaymethod4" name="gopaymethod" value="<?= $goPayMethodKeys[3] ?>" required data-payment="#paymentPaypal" />
							<label class="form-check-label" for="gopaymethod4"><?= $goPayMethodValues[3] ?></label>
						</div>
					</div>
					<!-- .form-control : gopaymethod -->

					<!-- .card : buyerInfo -->
					<div class="card collapse" id="buyerInfo">
						<div class="card-body">
							<div class="form-row justify-content-center mb-n3">
								<div class="col-sm-6 col-lg-3 mb-3">
									<label class="required" for="buyername">Bank Account Name</label>
									<input type="text" class="form-control" id="buyername" name="buyername" maxlength="64" required />
								</div>
								<div class="col-sm-6 col-lg-3 mb-3">
									<label class="required" for="buyertel">Phone Number</label>
									<input type="tel" class="form-control" id="buyertel" name="buyertel" maxlength="64" required />
								</div>
							</div>
						</div>
					</div>
					<!-- /.card : buyerInfo -->

				</fieldset>
				<!-- /fieldset : Payment Option -->

				<!-- .payment : paymentCard -->
				<div class="row justify-content-center payment collapse" id="paymentCard">
					<div class="col-sm-6 col-lg-4">
						<button type="button" class="btn btn-primary btn-block" title="INICIS" onclick="pay();">PAYMENT</button>
					</div>
				</div>
				<!-- /.payment : paymentCard -->

				<!-- .payment : paymentVBank -->
				<div class="row justify-content-center payment collapse" id="paymentVBank">
					<div class="col-sm-6 col-lg-4">
						<button type="submit" class="btn btn-primary btn-block" title="Bank Transfer" onclick="$('#formOrderProduct').attr('action', '/Work/Product/Payment').attr('target', '_self');">PAYMENT</button>
					</div>
				</div>
				<!-- /.payment : paymentVBank -->

				<!-- .payment : paymentPaypal -->
				<div class="row justify-content-center payment collapse" id="paymentPaypal">
					<div class="col-sm-6 col-lg-4">
						<div id="paypal-button"></div>
					</div>
				</div>
				<!-- /.payment : paymentPaypal -->

			</form>
			<!-- /form : formOrderProduct -->

			<script src="https://www.paypalobjects.com/api/checkout.js"></script>
			<script>
paypal.Button.render({

<?php if($_SESSION['PROD_MODE']){ ?>
env: 'production',
<?php }else{ ?>
env: 'sandbox',
<?php } ?>

locale: 'en_US',

style: {
  layout: 'horizontal',
  size: 'responsive',
  shape: 'rect',
  color: 'gold',
  label: 'paypal',
  tagline: false,
  fundingicons: false
},

funding: { allowed: [ paypal.FUNDING.CARD ] },

commit: true,

client: {
<?php if($_SESSION['PROD_MODE']){ ?>
  production: 'AQg67gjlgLsYHcg1nTErPsnOOMSlA6tRkDxMDkInrvrusNSKNvTmWQoHOr_YWaK1NVY0uS0OP14-tGyO'
<?php }else{ ?>
  sandbox: 'AWZnhbWvb9iDfdr9bEk3W-TX8Eb51nPOahDhqo2UZF_hYa3k5M6RvT7r9KVuARNUoR8HUMh_XLak2U0w'
<?php } ?>
},

payment: function(data, actions) {
  return actions.payment.create({
   transactions: [{
	  item_list: {
		items: [
<?php $paypal_totalprice = 0; for($i=0; $i<count($_POST['credit_product']); $i++){ ?>
		  {
			currency: 'USD',
			name: '<?= $_POST['credit_product'][$i] ?>',
			description: '<?= $_POST['credit_package'][$i] ?> <?= $_POST['credit_product'][$i]!='Standard Job Posting'?'Day':'Posting' ?><?= $_POST['credit_package'][$i]>1?'s':'' ?>',
			price: '<?= number_format($_POST['credit_price'][$i]/str_replace(',', '', $_SESSION['EXCHANGE_USD']), 2) ?>',
			quantity: '1'
		  },
<?php $paypal_totalprice += number_format($_POST['credit_price'][$i]/str_replace(',', '', $_SESSION['EXCHANGE_USD']), 2, '.', ''); } ?>
		],
	  },
	  amount: {
		currency: 'USD',
		total: '<?= number_format($_POST['credit_total']/str_replace(',', '', $_SESSION['EXCHANGE_USD']), 2) ?>',
		details: {
		  subtotal: '<?= number_format($paypal_totalprice, 2) ?>',
		  handling_fee: '<?= number_format(number_format($_POST['credit_total']/str_replace(',', '', $_SESSION['EXCHANGE_USD']), 2, '.', '') - $paypal_totalprice, 2) ?>',
		}
	  }
	}]
  });
},

onAuthorize: function(data, actions) {
  return actions.payment.execute().then(function() {
	$('#formOrderProduct').attr('action', '/Work/Product/Payment').attr('target', '_self').submit();
  });
}

}, '#paypal-button');
			</script>
			<script defer>
				$('#formOrderProduct input[name="gopaymethod"]').on('change click', function(){ $('#buyerInfo').addClass('show'); });
				$('#formOrderProduct input[name="gopaymethod"], #buyerInfo input').on('change keyup', function(){
					$('.payment').removeClass('show');
					if(!$('#buyerInfo input').is(function(){ if(!$(this).val()) return true; }) && !$('#buyerInfo .has-error').length && $('input[name="gopaymethod"]:checked').length){
						$($('input[name="gopaymethod"]:checked').data('payment')).addClass('show');
					}
				});
				$('#formOrderProduct').on('submit', function(){
					$('#tableMyOrder>tbody>tr').each(function(){
						$(this).append('<input type="hidden" name="credit_product[]" value="' + $(this).find('td:first-child').text() + '"/>');
						$(this).append('<input type="hidden" name="credit_package[]" value="' + $(this).find('td:nth-child(2)').text().replace(/[^0-9]/g, '') + '"/>');
						$(this).append('<input type="hidden" name="credit_price[]" value="' + $(this).find('td:nth-child(3)').text().replace(/[^0-9]/g, '') + '"/>');
					});
					$('#tableMyOrder>tfoot>tr').append('<input type="hidden" name="credit_total" value="' + $('#tableMyOrder>tfoot>tr>td:last-child').text().replace(/[^0-9]/g, '') + '"/>');
				});
			</script>

			</section>
			<!-- /section -->

				</div>
			</div>
		</main>
		<!-- /main -->