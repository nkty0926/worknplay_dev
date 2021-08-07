<?php

try {
	if (isset($_POST['action']) && $_POST['action'] == 'ReplyMessage') {
		$parent = $DB->selectWorkMessage($_POST['parent']);
		if ($parent['work_job_application']) {
			$application = $DB->selectWorkJobApplication($parent['work_job_application']);
			$resume = $DB->selectWorkResume($application['work_resume']);
			$job = $DB->selectWorkJob($application['work_job']);
			$company = $DB->selectWorkCompany($job['work_company']);
		} else if ($parent['work_resume']) {
			$resume = $DB->selectWorkResume($parent['work_resume']);
			$company = $DB->selectWorkCompany($parent['work_company']);
		} else {
			$company = $DB->selectWorkCompany($parent['work_company']);
			$resume = $DB->selectWorkResumeProfile($company['member'] == $parent['member_send'] ? $parent['member_receive'] : $parent['member_send']);
		}
		$query = "insert into work_message (member_send, member_send_email, member_receive, member_receive_email, work_job_application, work_company, work_resume, title, content) values(:member_send, :member_send_email, :member_receive, :member_receive_email, :work_job_application, :work_company, :work_resume, :title, :content)";
		$stmt = $DB->conn->prepare($query);
		$stmt->bindParam(":member_send", $_SESSION['ID']);
		$stmt->bindParam(":member_send_email", $parent['member_receive_email']);
		$stmt->bindParam(":member_receive", $parent['member_send']);
		$stmt->bindParam(":member_receive_email", $parent['member_send_email']);
		$stmt->bindParam(":work_job_application", $parent['work_job_application']);
		$stmt->bindParam(":work_company", $parent['work_company']);
		$stmt->bindParam(":work_resume", $parent['work_resume']);
		$stmt->bindParam(":title", $_POST['title']);
		$stmt->bindParam(":content", $_POST['content']);
		$stmt->execute();
		$stmt->closeCursor();
		if ($resume['member'] == $_SESSION['ID']) {
			$_SESSION['script'] = "$.ajax({ type: 'post', url: '/actions/Mail', data: 'action=Message&email=" . $parent['member_send_email'] . "&receive_name=" . $company['name'] . "&send_name=" . $resume['fullname'] . "&target=" . $job['title'] ? 'job' : 'company' . "&title=" . $job['title'] ? $job['title'] : $company['name'] . "&href=/" . $_GET['MAIN'] . "/Employer/MessageBox' });";
		} else {
			$_SESSION['script'] = "$.ajax({ type: 'post', url: '/actions/Mail', data: 'action=Message&email=" . $parent['member_send_email'] . "&receive_name=" . $resume['fullname'] . "&send_name=" . $company['name'] . "&target=" . 'resume' . "&title=" . $resume['title'] . "&href=/" . $_GET['MAIN'] . "/Employer/MessageBox' });";
		}
		$_SESSION['dialog'] = "Message Sent.";
		header('Location: /Work/' . $_GET['PAGE'] . '/MessageBox');
		exit();
	} else if (isset($_POST['action']) && $_POST['action'] == 'delete') {
		foreach ($_POST['msg_no'] as $msg_no) {
			$message = $DB->selectWorkMessage($msg_no, $_SESSION['ID']);
			$query = "update work_message set member_send = null where member_send = :member_send and (";
			if ($message['work_company'])
				$query .= "work_company = :work_company";
			else
				$query .= "work_company is null";
			if ($message['work_resume'])
				$query .= " and work_resume = :work_resume";
			else
				$query .= " and work_resume is null";
			if ($message['work_job_application'])
				$query .= " and work_job_application = :work_job_application";
			else
				$query .= " and work_job_application is null";
			$query .= ")";
			$stmt = $DB->conn->prepare($query);
			$stmt->bindParam(":member_send", $_SESSION['ID']);
			if ($message['work_company'])
				$stmt->bindParam(":work_company", $message['work_company']);
			if ($message['work_resume'])
				$stmt->bindParam(":work_resume", $message['work_resume']);
			if ($message['work_job_application'])
				$stmt->bindParam(":work_job_application", $message['work_job_application']);
			$stmt->execute();
			$stmt->closeCursor();
			$query = "update work_message set member_receive = null where member_receive = :member_receive and (";
			if ($message['work_company'])
				$query .= "work_company = :work_company";
			else
				$query .= "work_company is null";
			if ($message['work_resume'])
				$query .= " and work_resume = :work_resume";
			else
				$query .= " and work_resume is null";
			if ($message['work_job_application'])
				$query .= " and work_job_application = :work_job_application";
			else
				$query .= " and work_job_application is null";
			$query .= ")";
			$stmt = $DB->conn->prepare($query);
			$stmt->bindParam(":member_receive", $_SESSION['ID']);
			if ($message['work_company'])
				$stmt->bindParam(":work_company", $message['work_company']);
			if ($message['work_resume'])
				$stmt->bindParam(":work_resume", $message['work_resume']);
			if ($message['work_job_application'])
				$stmt->bindParam(":work_job_application", $message['work_job_application']);
			$stmt->execute();
			$stmt->closeCursor();
			$DB->conn->query("delete from work_message where member_send is null and member_receive is null");
		}
		header('Location: /Work/' . $_GET['PAGE'] . '/MessageBox');
		exit();
	}
} catch (PDOException $e) {
	$WP->printStatus($e->getMessage());
}

$message_groups = $DB->selectWorkMessage(null, $_SESSION['ID'], null, null, null, true);

if (!isset($_GET['order']))
	$_GET['order'] = 1;

include_once 'pages/3000_Work/3000_Work_header.php';

?>
	<!-- form -->
	<form class="py-3 py-lg-5" id="formMessageBox" name="work_message" method="post" action="" data-required="checkbox">
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

			<a class="btn btn-light btn-sm float-right" href="/Work/<?= $_GET['PAGE'] ?>/MessageBox?order=<?= $_GET['order']?0:1 ?>"><?= $_GET['order']?'Newest to oldest':'Oldest to newest' ?></a>
			<h4 class="border-bottom mb-2 pb-2">Message Box</h4>
<?php if(isset($message_groups) && !empty($message_groups)){ ?>

			<!-- section#message-group -->
			<section id="message-group">
<?php

foreach ($message_groups as $message_group) {
	$application = $message_group['work_job_application'] ? $DB->selectWorkJobApplication($message_group['work_job_application']) : null;
	$job = $message_group['work_job'] ? $DB->selectWorkJob($message_group['work_job']) : null;
	$resume = $message_group['work_resume'] ? $DB->selectWorkResume($message_group['work_resume']) : null;
	$resume_profile = $message_group['resume_member'] ? $DB->selectWorkResumeProfile($message_group['resume_member']) : null;
	$resume_member = $message_group['resume_member'] ? $DB->selectMember($message_group['resume_member']) : null;
	$company = $message_group['work_company'] ? $DB->selectWorkCompany($message_group['work_company']) : null;
	$message_group['disabled'] = 1;
	if ($message_group['work_job_application']) {
		if ($company && $resume && $job && $application) $message_group['disabled'] = 0;
	} else if ($message_group['work_resume']) {
		if ($company && $resume) $message_group['disabled'] = 0;
	} else if ($message_group['work_company']) {
		if ($company) $message_group['disabled'] = 0;
	}
	$message_group['name'] = $_GET['PAGE']=='Employer'?($resume_profile['fullname']?$resume_profile['fullname']:(substr($resume_member['email'], 0, strpos($resume_member['email'], '@')) . '**')):$company['name'];
	$message_group['read'] = 1;
	$messages = $DB->selectWorkMessage(null, $_GET['PAGE']=='Employer'?$message_group['resume_member']:$message_group['company_member'], $company['no'], $resume['no'], $application['no']);
	foreach ($messages as $message) {
		if ($message['member_receive']==$_SESSION['ID'] && !$message['read']) {
			$message_group['read'] = 0;
		}
	}
?>
				<article class="message-item border-bottom mb-2 pb-2">

					<input type="checkbox" class="float-left mr-3" name="msg_no[]" value="<?= $message_group['no'] ?>" />
<?php if(!$message_group['read']){ ?>
					<span class="badge badge-danger align-text-top">New</span>
<?php } ?>
					<h6 class="d-inline-block mr-3" data-toggle="collapse-message" data-parent="#message-group"><?= $message_group['name'] ?> <small><?= $message_group['date_max'] ?></small></h6>
<?php if($message_group['work_job_application']){ ?>
					<a class="btn btn-light btn-sm<?= $resume['no'] && $application['no']?'':' disabled' ?>" href="/Work/Detail/Resume/<?= $resume['no'] ?>?application=<?= $application['no'] ?>" target="_blank"><?= $resume['no'] && $application['no']?'Application':'<span class="text-danger">Deleted Application</span>' ?></a>
					<a class="btn btn-light btn-sm<?= $job['no']?'':' disabled' ?>" href="/Work/Detail/Job/<?= $job['no'] ?>" target="_blank"><?= $job['no']?'Job':'<span class="text-danger">Deleted Job</span>' ?></a>
<?php }else if($message_group['work_resume']){ ?>
					<a class="btn btn-light btn-sm<?= $resume['no']?'':' disabled' ?>" href="/Work/Detail/Resume/<?= $resume['no'] ?>" target="_blank"><?= $resume['no']?'Resume':'<span class="text-danger">Deleted Resume</span>' ?></a>
					<a class="btn btn-light btn-sm<?= $company['no']?'':' disabled' ?>" href="/Work/Detail/Company/<?= $company['no'] ?>" target="_blank"><?= $company['no']?'Company Profile':'<span class="text-danger">Deleted Profile</span>' ?></a>
<?php }else{ ?>
					<a class="btn btn-light btn-sm<?= $company['no']?'':' disabled' ?>" href="/Work/Detail/Company/<?= $company['no'] ?>" target="_blank"><?= $company['no']?'Company Profile':'<span class="text-danger">Deleted Profile</span>' ?></a>
<?php } ?>
<?php if(!$message_group['disabled']){ ?>
					<a class="btn btn-light btn-sm float-right" data-toggle="modal" data-target="#modalFormReplyMessage" data-name="<?= $message_group['name'] ?>" data-parent="<?= $message_group['no'] ?>">Reply</a>
<?php } ?>
					<a class="btn btn-light btn-sm" data-toggle="collapse-message" data-parent="#message-group">More <i class="fa fa-caret-down"></i></a>
<?php
	foreach ($_GET['order'] ? array_reverse($messages) : $messages as $message) {
?>
					<div class="collapse">
						<div class="media pt-2">
<?php if ($message['member_receive']==$_SESSION['ID']) { ?>
							<img class="mr-3" src="/assets/images/common-profile.png" alt="<?= $message_group['name'] ?>" style="width:50px;" />
<?php } ?>
							<div class="media-body">
<?php if ($message['member_receive']==$_SESSION['ID']) { ?>
								<span><?= $message_group['name'] ?></span>
<?php } ?>
								<div class="bg-light border rounded p-2">
									<h6 class="border-bottom pb-2 mb-2"><?= $message['title'] ?></h6>
									<div><?= $message['content'] ?></div>
								</div>
								<p class="small mb-0"><?= $message['date'] ?></p>
							</div>
<?php if ($message['member_send']==$_SESSION['ID']) { ?>
							<img class="ml-3" src="/assets/images/common-profile.png" alt="<?= $_SESSION['CURRENT_COMPANY_NAME'] ? $_SESSION['CURRENT_COMPANY_NAME'] : $USER['work_resume_name'] ?>" style="width:50px;" />
<?php } ?>
						</div>
					</div>
<?php } ?>
				</article>
<?php } ?>
			</section>
			<!-- /section#message-group -->

			<button type="submit" class="btn btn-outline-secondary" name="action" value="delete">Delete</button>

			<script defer>
				$('[data-toggle="collapse-message"]').on('click', function() {
					var message = $(this).parents('.message-item');
					if ($(message).find('.collapse').length) {
						$('.message-item').not(message).find('.collapse').collapse('hide');
						$(message).find('.collapse').collapse('toggle');
					} else {
						$(this).remove();
					}
					if ($(message).find('.badge').length) {
						var table = $(message).parents('form').attr('name');
						$(message).find('.badge').remove();
						$.ajax({ type : 'post', url : '/actions/ReadMessage', data : 'action=Read&table=' + table + '&pk=' + $(message).find('input[name="msg_no[]"]').val(), success : function(result) {
							console.log(result + ' : ' + Date());
						} });
					}
				});
			</script>
<?php } ?>

<?php // include 'pages/common/adsbygoogle-horizontal.php' ?>

		</section>
		<!-- /section -->

			</div>
		</div>
	</form>
	<!-- /form -->
<?php if(isset($message_groups) && !empty($message_groups)){ include_once 'pages/modal/ReplyMessage.php'; } ?>