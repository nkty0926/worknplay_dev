<?php
if (strpos($_SERVER['REQUEST_URI'], 'index.php') !== false) {
	header('HTTP/1.1 301 Moved Permanently');
	header('Location: /');
	exit();
}

if (isset($_GET['MAIN']) && !empty($_GET['MAIN']) && !in_array($_GET['MAIN'], array(
	'actions',
	'About',
	'Account',
	'Work',
	'Blogs',
	'Tefl',
	'Study',
	'Lang',
	'ADMIN'
))) {
	$_GET['PAGE'] = $_GET['MAIN'];
	$_GET['MAIN'] = '';
}

if (!isset($_GET['MAIN']) || empty($_GET['MAIN']))
	$_GET['MAIN'] = '';
if (!isset($_GET['PAGE']) || empty($_GET['PAGE']))
	$_GET['PAGE'] = '';
if (!isset($_GET['MENU']) || empty($_GET['MENU']))
	$_GET['MENU'] = '';
if (!isset($_GET['SUB']) || empty($_GET['SUB']))
	$_GET['SUB'] = '';

// $WP
require_once 'classes/Worknplay.php';
$WP = new Worknplay();

// $DB
require_once 'classes/Database.php';
$DB = new Database();

// $CONF
$CONF = array(
	'pagination_pages' => 6,
	'pagination_articles' => 12,
	'date_format' => 'M j, Y',
	'email_lkw' => 'lkw6793@gmail.com',
	'email_ads' => 'worknplayads@gmail.com',
	'email_hr' => 'worknplayhr@gmail.com',
	'phone_ads_kr' => '02-568-7690',
	'phone_fax' => '+82-2-568-7236',
	'phone_ads' => '+82-2-568-7690',
	'phone_hr' => '+82-2-568-7536',
	'language_levels' => array(
		'None',
		'Basic',
		'Conversational',
		'Business',
		'Native'
	),
	'teaching_levels' => array(
		'Nursery (0-3)',
		'Preschool (Age 3-4)',
		'Kindergarten (Age 4-7)',
		'Elementary (Age 5-10)',
		'Middle School (Age 11-13)',
		'High School (Age 14-18)',
		'University',
		'Adults'
	),
	'education_levels' => array(
		'High School',
		'Associate Degree',
		'Bachelor\'s Degree',
		'Master\'s Degree',
		'Doctorate',
		'Professional',
		'Others'
	),
	'career_levels' => array(
		'Student',
		'Entry Level',
		'Experienced',
		'Manager',
		'Executive',
		'Senior Executive',
		'Others'
	),
	'housing_category' => array(
		'Housing Provide',
		'Housing Allowance',
		'Housing No Provide'
	),
	'story_category' => array(
		'Insider_Stories',
		'Living_Abroad',
		'Professional_Jobs',
		'Study',
		'News_and_Events',
		'Teaching_Jobs',
		'Teaching_Resources',
		'TEFL/TESOL',
		'Travel',
	),
	'products' => array(
		'Hot Job Post',
		'Standard Job Post',
		'Resume Search'
	),
	'goPayMethod' => array(
		'Card' => 'Credit Card',
		'DirectBank' => 'Real-time Transfer',
		'VBank' => 'Bank Transfer',
		'Paypal' => 'Paypal'
	)
);

// $USER
$USER = $DB->selectUser($_SESSION['ID']);

// actions
if ($_GET['MAIN'] == 'actions') {
	include_once 'actions/' . $_GET['PAGE'] . '.php';
	exit();
}

// $PAGE
$PAGE = $DB->selectPage();
if (!empty($_GET['PAGE']) && (!isset($PAGE['file']) || empty($PAGE['file']))) {
	$rs = $DB->selectWorkCompany(null, null, $_GET['PAGE']);
	if (isset($rs['no']) && !empty($rs['no'])) {
		$_GET['domain'] = $_GET['PAGE'];
		$_GET['SUB'] = $_GET['MENU'];
		$_GET['PAGE'] = 'Detail';
		$_GET['MENU'] = 'Company';
		$_GET['PK'] = $rs['no'];
		$PAGE = $DB->selectPage();
	}
}
if (isset($PAGE['file']) && !empty($PAGE['file'])) {
	if (empty($PAGE['pk']) xor empty($_GET['PK'])) {
		header('HTTP/1.1 301 Moved Permanently');
		header('Location: /' . $_GET['MAIN'] . '/' . $_GET['PAGE'] . '/' . $_GET['MENU']);
		exit();
	} // ADMIN Required Page
	else if ($PAGE['main'] == 'ADMIN' && !empty($PAGE['page']) && empty($_SESSION['ADMIN'])) {
		header('Location: /');
		exit();
	} // Login Required Page
	else if ($PAGE['login'] == 1 && empty($_SESSION['ID'])) {
		header('Location: /LogIn');
		exit();
	} // Seeker Denied Page
	else if ($PAGE['seeker'] == 2 && $_SESSION['SEEKER']) {
		$_SESSION['dialog'] = "You are using an email address registered for an Employee Account. If you want to browse the resume database, please register as an Employer.";
		header('Location: /' . $_GET['MAIN']);
		exit();
	} // Seeker Required Page
	else if ($PAGE['seeker'] == 1 && empty($_SESSION['SEEKER'])) {
		header('Location: /Work/Seeker/Intro');
		exit();
	} // Employer Denied Page
	else if ($PAGE['employer'] == 2 && $_SESSION['EMPLOYER']) {
		header('Location: /' . $_GET['MAIN']);
		exit();
	} // Employer Required Page
	else if ($PAGE['employer'] == 1 && empty($_SESSION['EMPLOYER'])) {
		header('Location: /Work/Employer/Intro');
		exit();
	} // Redirect Page
	else if (strpos($PAGE['file'], 'Location:') !== false) {
		header($PAGE['file']);
		exit();
	} // Edit Page
	else if ($PAGE['page'] == 'Edit' || $PAGE['page'] == 'Product') {
		header('Cache-Control: no-cache, must-revalidate');
		header('Pragma: no-cache');
		header('Expires: 0');
	} // Search Page
	else if ($PAGE['page'] == 'Search' || in_array($PAGE['menu'], array(
		'JobAlert',
		'ResumeSearch'
	))) {
		$paramnames = array(
			'job_type',
			'job_industry',
			'job_category_parent',
			'job_category_child',
			'job_category_tag',
			'location_country',
			'location_parent',
			'location_child',
			'location_city',
			'education_level',
			'career_level',
			'language_eng',
			'language_kor',
			'language_others',
			'teaching_level',
			'visa_type'
		);
		$params = array();
		foreach ($paramnames as $paramname) {
			if (isset($_GET[$paramname]) && !empty($_GET[$paramname]) && !empty($_GET[$paramname][0])) {
				array_push($params, array(
					'name' => $paramname,
					'values' => $_GET[$paramname]
				));
			} else {
				$_GET[$paramname] = array();
			}
		}
		if (!isset($_GET['keyword']) || empty($_GET['keyword'])) {
			$_GET['keyword'] = '';
		}
		if (!isset($_GET['page']) || empty($_GET['page'])) {
			$_GET['page'] = 1;
		}
		if (!isset($_GET['list'])) {
			$_GET['list'] = 0;
		}
	}

	// Include Page
	include_once $PAGE['file'];
	include_once 'pages/common/header.php';
	include_once 'pages/common/footer.php';
} else if (isset($_GET['MAIN']) && !empty($_GET['MAIN'])) {
	header('HTTP/1.1 301 Moved Permanently');
	if (isset($_GET['SUB']) && !empty($_GET['SUB'])) {
		header('Location: /' . $_GET['MAIN'] . '/' . $_GET['PAGE'] . '/' . $_GET['MENU'] . '/' . $_GET['PK']);
	} else if (isset($_GET['MENU']) && !empty($_GET['MENU'])) {
		header('Location: /' . $_GET['MAIN'] . '/' . $_GET['PAGE']);
	} else if (isset($_GET['PAGE']) && !empty($_GET['PAGE'])) {
		header('Location: /' . $_GET['MAIN']);
	} else {
		header('Location: /');
	}
} else {
	header('HTTP/1.1 301 Moved Permanently');
	header('Location: /');
}
