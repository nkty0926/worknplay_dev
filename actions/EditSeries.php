<?php
if (isset($_POST['action']) && $_POST['action'] == 'EditSeries') {
	$columns = array(
		'member',
		'series_title'
	);
	$values = array(
		':no' => $_POST['pk'],
		':member' => $_SESSION['ID'],
		':series_title' => $_POST['series_title']
	);
	if ($_POST['pk'] = $DB->edit('story_series', $columns, $values))
		echo $_POST['pk'];
	else
		echo "Failed";
}