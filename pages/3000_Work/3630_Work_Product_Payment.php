<?php

include_once 'pages/3000_Work/3000_Work_header.php';

if (!$_SESSION['PAYMENT'] || (!$_POST['gopaymethod'] && !$_POST['resultCode'])) {
	echo '<script>location.replace("/Work/Product/Select");</script>';
	exit();
} else {
	$_SESSION['PAYMENT'] = false;
}

require_once 'libraries/INIpayWebStandard/libs/INIStdPayUtil.php';
require_once 'libraries/INIpayWebStandard/libs/HttpClient.php';
$inistdpayUtil = new INIStdPayUtil();

$products = $CONF['products'];
$goPayMethod = $CONF['goPayMethod'];
$iniCardCode = array(
	'01' => '하나(외환)',
	'03' => '롯데',
	'04' => '현대',
	'06' => '국민',
	'11' => 'BC',
	'12' => '삼성',
	'14' => '신한',
	'15' => '한미',
	'16' => 'NH',
	'17' => '하나 SK',
	'21' => '해외 Visa',
	'22' => '해외 Master',
	'23' => '해외 JCB',
	'24' => '해외 Amex',
	'25' => '해외 Diners',
	'26' => '중국 은련',
	'32' => '광주',
	'33' => '전북',
	'34' => '하나',
	'35' => '산업카드',
	'41' => 'NH',
	'43' => '씨티',
	'44' => '우리',
	'48' => '신협체크',
	'51' => '수협',
	'52' => '제주',
	'54' => 'MG새마을금고체크',
	'55' => '케이뱅크',
	'56' => '카카오뱅크',
	'71' => '우체국체크',
	'95' => '저축은행체크'
);

$_POST = array_merge($_POST, unserialize(base64_decode($_POST['merchantData'])));
// $WP->printStatus();
// print_r(base64_decode($_POST['merchantData']));echo"<br />";
// print_r(unserialize(base64_decode($_POST['merchantData'])));echo"<br />";

if ($_POST['resultCode']) {
	try {
		if (strcmp("0000", $_REQUEST["resultCode"]) == 0) {

			// ############################################
			// 1.전문 필드 값 설정(***가맹점 개발수정***)
			// ############################################
			$mid = $_REQUEST["mid"]; // 가맹점 ID 수신 받은 데이터로 설정
			$signKey = $_SESSION['PROD_MODE'] ? "cm1SaG1CSllTckZuaVRBcmRhNXRWZz09" : "SU5JTElURV9UUklQTEVERVNfS0VZU1RS"; // 가맹점에 제공된 키(이니라이트키) (가맹점 수정후 고정) !!!절대!! 전문 데이터로 설정금지
			$timestamp = $inistdpayUtil->getTimestamp(); // util에 의해서 자동생성
			$charset = "UTF-8"; // 리턴형식[UTF-8,EUC-KR](가맹점 수정후 고정)
			$format = "JSON"; // 리턴형식[XML,JSON,NVP](가맹점 수정후 고정)

			$authToken = $_REQUEST["authToken"]; // 취소 요청 tid에 따라서 유동적(가맹점 수정후 고정)
			$authUrl = $_REQUEST["authUrl"]; // 승인요청 API url(수신 받은 값으로 설정, 임의 세팅 금지)
			$netCancel = $_REQUEST["netCancelUrl"]; // 망취소 API url(수신 받은f값으로 설정, 임의 세팅 금지)

			$mKey = hash("sha256", $signKey); // 가맹점 확인을 위한 signKey를 해시값으로 변경 (SHA-256방식 사용)

			// #####################
			// 2.signature 생성
			// #####################
			$signParam["authToken"] = $authToken; // 필수
			$signParam["timestamp"] = $timestamp; // 필수
			$signature = $inistdpayUtil->makeSignature($signParam); // signature 데이터 생성 (모듈에서 자동으로 signParam을 알파벳 순으로 정렬후 NVP 방식으로 나열해 hash)

			// #####################
			// 3.API 요청 전문 생성
			// #####################
			$authMap["mid"] = $mid; // 필수
			$authMap["authToken"] = $authToken; // 필수
			$authMap["signature"] = $signature; // 필수
			$authMap["timestamp"] = $timestamp; // 필수
			$authMap["charset"] = $charset; // default=UTF-8
			$authMap["format"] = $format; // default=XML

			try {
				$httpUtil = new HttpClient();

				// #####################
				// 4.API 통신 시작
				// #####################
				$authResultString = "";
				if ($httpUtil->processHTTP($authUrl, $authMap)) {
					$authResultString = $httpUtil->body;
					// echo "<p><b>RESULT DATA :</b> $authResultString</p>"; //PRINT DATA
				} else {
					echo "Http Connect Error\n" . $httpUtil->errormsg;
					throw new Exception("Http Connect Error");
					exit();
				}

				// ############################################################
				// 5.API 통신결과 처리(***가맹점 개발수정***)
				// ############################################################
				$resultMap = json_decode($authResultString, true);

				/**
				 * *********************** 결제보안 추가 2016-05-18 START ***************************
				 */
				$secureMap["mid"] = $mid; // mid
				$secureMap["tstamp"] = $timestamp; // timestemp
				$secureMap["MOID"] = $resultMap["MOID"]; // MOID
				$secureMap["TotPrice"] = $resultMap["TotPrice"]; // TotPrice
				$secureSignature = $inistdpayUtil->makeSignatureAuth($secureMap); // signature 데이터 생성
				if ((strcmp("0000", $resultMap["resultCode"]) == 0) && (strcmp($secureSignature, $resultMap["authSignature"]) == 0)) {
					/**
					 * ***************************************************************************
					 * 여기에 가맹점 내부 DB에 결제 결과를 반영하는 관련 프로그램 코드를 구현한다.
					 *
					 * [중요!] 승인내용에 이상이 없음을 확인한 뒤 가맹점 DB에 해당건이 정상처리 되었음을 반영함
					 * 처리중 에러 발생시 망취소를 한다.
					 * ****************************************************************************
					 */

					$_POST['gopaymethod'] = $resultMap['payMethod'] == 'VCard' ? 'Card' : $resultMap['payMethod'];
					$_POST['buyername'] = $resultMap['buyerName'];
					$_POST['buyertel'] = $resultMap['buyerTel'];
					for ($i = 0; $i < count($_POST['credit_product']); $i++) {
						for ($product = 1; $product <= count($products); $product++) {
							if ($_POST['credit_product'][$i] == $products[$product - 1]) {
								$query = "insert into work_credit (appr, product, member, credit, price, total, paymethod, approval_no, transaction_no, name, phone) values(1, :product, :member, :credit, :price, :total, :paymethod, :approval_no, :transaction_no, :name, :phone)";
								$stmt = $DB->conn->prepare($query);
								$stmt->bindParam(":product", $product);
								$stmt->bindParam(":member", $_SESSION['ID']);
								$stmt->bindParam(":credit", $_POST['credit_package'][$i]);
								$stmt->bindParam(":price", $_POST['credit_price'][$i]);
								$stmt->bindParam(":total", $_POST['credit_total']);
								$stmt->bindParam(":paymethod", $goPayMethod[$_POST['gopaymethod']]);
								$stmt->bindParam(":approval_no", $resultMap['applNum']);
								$stmt->bindParam(":transaction_no", $resultMap['tid']);
								$stmt->bindParam(":name", $_POST['buyername']);
								$stmt->bindParam(":phone", $_POST['buyertel']);
								$stmt->execute();
								$stmt->closeCursor();
							}
						}
					}

					// echo "<h5>거래 성공</h5>";
				} else {
					// echo "<h5>거래 실패</h5>";
					// echo "<h5>결과 코드</h5> : " . "<p>" . @(in_array($resultMap["resultCode"] , $resultMap) ? $resultMap["resultCode"] : "null" ) . "</p>";
					// 결제보안키가 다른 경우.
					if ((strcmp($secureSignature, $resultMap["authSignature"]) != 0) && (strcmp("0000", $resultMap["resultCode"]) == 0)) {
						// echo "<p>" . "* 데이터 위변조 체크 실패" . "</p>";
						// 망취소
						if (strcmp("0000", $resultMap["resultCode"]) == 0) {
							throw new Exception("데이터 위변조 체크 실패");
						}
					} else {
						// echo "<h5>결과 내용</h5> : " . "<p>" . @(in_array($resultMap["resultMsg"] , $resultMap) ? $resultMap["resultMsg"] : "null" ) . "</p>";
					}
					echo '<script defer>$(function(){ Alert("Payment failed : ' . ($resultMap['resultMsg'] ? $resultMap['resultMsg'] : '결제 실패') . ' (' . $resultMap['resultCode'] . ')", function(){ location.replace("/Work"); }); });</script>';
					exit();
				}
				/**
				 * *********************** 결제보안 추가 2016-05-18 END ***************************
				 */

				echo "<form name='frm' method='post'><input type='hidden' name='tid' value='" . @(in_array($resultMap["tid"], $resultMap) ? $resultMap["tid"] : "null") . "' /></form>";
				// 수신결과를 파싱후 resultCode가 "0000"이면 승인성공 이외 실패
				// 가맹점에서 스스로 파싱후 내부 DB 처리 후 화면에 결과 표시
				// payViewType을 popup으로 해서 결제를 하셨을 경우
				// 내부처리후 스크립트를 이용해 opener의 화면 전환처리를 하세요
				// throw new Exception("강제 Exception");
			} catch (Exception $e) {
				// ####################################
				// 실패시 처리(***가맹점 개발수정***)
				// ####################################
				// echo $e->getMessage() . ' (오류코드:' . $e->getCode() . ')';
				echo '<script defer>$(function(){ Alert("Payment failed : ' . $e->getMessage() . ' (' . $e->getCode() . ')", function(){ location.replace("/Work"); }); });</script>';

				// #####################
				// 망취소 API
				// #####################
				$netcancelResultString = ""; // 망취소 요청 API url(고정, 임의 세팅 금지)
				if ($httpUtil->processHTTP($netCancel, $authMap)) {
					$netcancelResultString = $httpUtil->body;
				} else {
					echo "Http Connect Error\n" . $httpUtil->errormsg;
					throw new Exception("Http Connect Error");
					exit();
				}
				// $WP->printStatus($resultMap);
				// echo "<p>" . $netcancelResultString . "</p>"; exit; // 취소 결과 확인
			}
		} else {
			// #############
			// 인증 실패시
			// #############
			echo '<script defer>$(function(){ Alert("Payment failed : ' . ($_POST['resultMsg'] ? $_POST['resultMsg'] : '인증 실패') . ' (' . $_POST['resultCode'] . ')", function(){ location.replace("/Work"); }); });</script>';
			exit();
		}
	} catch (Exception $e) {
		// echo $e->getMessage() . ' (오류코드:' . $e->getCode() . ')';
		echo '<script defer>$(function(){ Alert("Payment failed : ' . $e->getMessage() . ' (' . $e->getCode() . ')", function(){ location.replace("/Work"); }); });</script>';
		exit();
	}
} else {
	try {
		if ($goPayMethod[$_POST['gopaymethod']] == 'Paypal'/* || $_SESSION['TEST_MODE']*/ || $_SESSION['ADMIN']) {
			$appr = 1;
		} else {
			$appr = 0;
		}
		for ($i = 0; $i < count($_POST['credit_product']); $i++) {
			for ($product = 1; $product <= count($products); $product++) {
				if ($_POST['credit_product'][$i] == $products[$product - 1]) {
					$query = "insert into work_credit (appr, product, member, credit, price, total, paymethod, name, phone) values(:appr, :product, :member, :credit, :price, :total, :paymethod, :name, :phone)";
					$stmt = $DB->conn->prepare($query);
					$stmt->bindParam(":appr", $appr);
					$stmt->bindParam(":product", $product);
					$stmt->bindParam(":member", $_SESSION['ID']);
					$stmt->bindParam(":credit", $_POST['credit_package'][$i]);
					$stmt->bindParam(":price", $_POST['credit_price'][$i]);
					$stmt->bindParam(":total", $_POST['credit_total']);
					$stmt->bindParam(":paymethod", $goPayMethod[$_POST['gopaymethod']]);
					$stmt->bindParam(":name", $_POST['buyername']);
					$stmt->bindParam(":phone", $_POST['buyertel']);
					$stmt->execute();
					$stmt->closeCursor();
				}
			}
		}
	} catch (PDOException $e) {
		echo '<script defer>$(function(){ Alert("Payment failed : 주문 실패 (' . $e->getCode() . ')", function(){ location.replace("/Work/Employer"); }); });</script>';
		exit();
	}
}

$_SESSION['EMPLOYER'] = 1;
$USER['work_credit_hot'] = $USER['work_credit_job'] = $USER['work_credit_res_day'] = 0;
if ($_POST['resultCode'] || $appr) {
	for ($i = 0; $i < count($_POST['credit_product']); $i++) {
		if ($_POST['credit_product'][$i] == $products[0]) {
			$USER['work_credit_hot'] = 1;
		} else if ($_POST['credit_product'][$i] == $products[1]) {
			$USER['work_credit_job'] = 1;
		} else if ($_POST['credit_product'][$i] == $products[2]) {
			$USER['work_credit_res_day'] = 1;
		}
	}
}

?>
	<!-- main -->
	<main class="py-3 py-lg-5">
		<div class="container">
			<div class="row">

		<!-- section -->
		<section class="col-lg-12">

			<h1 class="text-center">Payment successful</h1>

			<table class="table table-bordered text-center">
				<thead>
					<tr class="active">
						<th width="50%">PRODUCT</th>
						<th width="30%">PACKAGE</th>
						<th width="20%">PRICE</th>
					</tr>
				</thead>
				<tbody>
<?php for($i=0; $i<count($_POST['credit_product']); $i++){ ?>
					<tr>
						<td><?= $_POST['credit_product'][$i] ?></td>
						<td><?= $_POST['credit_package'][$i] ?> <?= $_POST['credit_product'][$i]==1 || $_POST['credit_product'][$i]==3?'Day':'Credit' ?><?= $_POST['credit_package'][$i]>1?'s':'' ?></td>
						<td>&#8361; <?= number_format($_POST['credit_price'][$i]) ?></td>
					</tr>
<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="2">Total (including VAT)</td>
						<td>&#8361; <?= number_format($_POST['credit_total']) ?></td>
					</tr>
				</tfoot>
			</table>

			<table class="table table-bordered text-center">
				<thead>
					<tr class="active">
						<th>Payment method</th>
<?php if($_POST['resultCode'] && $_POST['gopaymethod']=='Card'){ ?>
						<th>Details</th>
<?php }else if($_POST['resultCode'] && $_POST['gopaymethod']=='DirectBank'){ ?>
						<td>Issued cash receipt</td>
<?php } ?>
						<th>Bank Account Name / Phone Number</th>
<?php if($_POST['resultCode']){ ?>
						<th>Receipt</th>
<?php } ?>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?= $goPayMethod[$_POST['gopaymethod']] ?></td>
<?php if($_POST['resultCode'] && $_POST['gopaymethod']=='Card'){ ?>
						<td><?= $iniCardCode[$resultMap["CARD_Code"]] ?>(<?= $resultMap["CARD_Num"] ?>) / <?= intval($resultMap["CARD_Quota"])?$resultMap["CARD_Quota"] . ' months installment':'Single payment' ?><?= $resultMap["CARD_Interest"] && $resultMap["EventCode"]?' (Interest-free)':'' ?></td>
<?php }else if($_POST['resultCode'] && $_POST['gopaymethod']=='DirectBank'){ ?>
						<td><?= $resultMap["CSHR_ResultCode"]?(' Yes (' . ($resultMap["CSHR_Type"]?'company':'personal') . ' receipt)'):' No' ?></td>
<?php } ?>
						<td><?= $_POST['buyername'] ?> / <?= $_POST['buyertel'] ?></td>
<?php if($_POST['resultCode']){ ?>
						<td>
							<form method="post" action="https://iniweb.inicis.com/app/publication/apReceipt200.jsp?noTid=<?= $resultMap["tid"] ?>&noMerchantoid=&flag=0&noMethod=1" target="inicis">
								<input type="hidden" name="noTid" value="<?= $resultMap["tid"] ?>" />
								<input type="hidden" name="flgSobo" value="" />
								<input type="hidden" name="noMethod" value="1" />
								<input type="hidden" name="clpaymethod" value="0" />
								<input type="hidden" name="re_mail" value="null" />
								<input type="hidden" name="rt" value="1">
								<input type="hidden" name="valFlg" value="1" />
								<input type="hidden" name="nmBuyer" value="<?= $resultMap["buyerName"] ?>" />
								<input type="hidden" name="prGoods" value="<?= $resultMap["TotPrice"] ?>" />
								<button type="submit" class="fa fa-file-text-o" onclick="window.open('https://iniweb.inicis.com/mall/cr/cm/mCmReceipt_head.jsp?noTid=<?= $resultMap["tid"] ?>&noMethod=1','inicis','width=430, height=700, status=no, menubar=no, toolbar=no, titlebar=no, scrollbars=yes, resizable=yes');" style="border:none; background:none;"></button>
							</form>
						</td>
<?php } ?>
					</tr>
				</tbody>
			</table>

<?php if(!$_POST['resultCode'] && $_POST['gopaymethod']=='VBank'){ ?>
			<div class="row justify-content-center mb-3">
				<div class="col-lg-8">
					<div class="card bg-light">
						<div class="card-body">
							<h5 class="text-bolder">Bank account information</h5>
							<p>
								Name of Bank : Industrial Bank of Korea (중소기업은행)<br />
								Account Number : 389-042320-01-011<br />
								Bank Holder : Worknplay(워크앤플레이)<br />
								<br />
								송금한 후 5~10분 이후에 크리딧이 추가되며, 만일 그 이후에도 크레딧이 추가되어 있지 않으면 02-568-7690으로 연락 바라며, 세금계산서는 사업자등록증을 <a href="mailto:worknplayads@gmail.com">worknplayads@gmail.com</a>으로 보내 주시면 발행하여 드립니다.<br />
								<br />
								Best regards.<br />
								TheWorknPlay Team
							</p>
						</div>
					</div>
				</div>
			</div>

<?php } ?>
			<div class="text-center">
<?php if($USER['work_credit_res_day']){ ?>
				<a class="btn btn-light btn-lg" href="/Work/Search/Resume">Search for resume</a>
<?php } ?>
<?php if($USER['work_credit_hot'] || $USER['work_credit_job']){ ?>
				<a class="btn btn-light btn-lg" href="/Work/Employer">Post a Job</a>
<?php } ?>
				<a class="btn btn-light btn-lg" href="/Work/Employer">Employer Home</a>
			</div>

		</section>
		<!-- /section -->

			</div>
		</div>
	</main>
	<!-- /main -->