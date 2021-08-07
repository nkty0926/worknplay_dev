<?php
set_time_limit(0);
include_once 'classes/Mailer.php';
$mailer = new Mailer();
$mailer->test("jbj0728@naver.com", "name", "subject", date('YmdHis', strtotime('now+9hours')));