<?php
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
	}
}
if (!isset($_GET['keyword']) || empty($_GET['keyword'])) {
	$_GET['keyword'] = '';
}
if (!isset($_GET['page']) || empty($_GET['page'])) {
	$_GET['page'] = 1;
}
if (!isset($_GET['list']) || empty($_GET['list'])) {
	$_GET['list'] = 0;
}
$hots = $DB->searchWorkJob(true, trim($_GET['keyword']), $params);
$articles = $DB->searchWorkJob(false, trim($_GET['keyword']), $params);
if (count($hots)) {
	shuffle($hots);
	$articles = array_merge($hots, $articles);
	$CONF['pagination_total'] += count($hots);
}
foreach ($articles as $i => $article) {
	$articles[$i]['location_child_name'] = '';
	$articles[$i]['period'] = explode(' ~ ', $articles[$i]['period'])[0];
	$articles[$i]['desc'] = $WP->stringFilter($articles[$i]['desc']);
	$articles[$i]['location'] = $WP->printLocation($articles[$i]);
	$articles[$i]['period'] = $WP->printPeriod($articles[$i]);
	$articles[$i]['pagination_total'] = $CONF['pagination_total'];
}
echo json_encode($articles);