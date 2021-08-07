<?php
if (isset($_POST['action']) && $_POST['action'] == 'Question') {
	try {
		$columns = array(
			'page',
			'pk',
			'name',
			'email',
			'phone',
			'title',
			'content'
		);
		$values = array(
			':page' => $_POST['page'],
			':pk' => !empty($_POST['pk']) ? $_POST['pk'] : null,
			':name' => $_POST['name'],
			':email' => $_POST['email'],
			':phone' => $_POST['phone'],
			':title' => $_POST['title'],
			':content' => $_POST['content']
		);
		if ($DB->edit('common_question', $columns, $values))
			echo "Thank you for your feedback!";
		else
			echo "Failed";
	} catch (Exception $e) {
		echo "Error";
		$WP->printStatus($e->getMessage());
	}
}