<?php
	$dataJson = ( isset($_POST['json_string'] ) ) ? json_decode($_POST['json_string'], true) : '';
	if ( !empty($dataJson) ) {
		if ($dataJson['task'] == 'change') {
			if ( $tasks->change($dataJson['id'], $dataJson['completed'], $dataJson['description'], $dataJson['change']) === true ) {
				echo json_encode(array('success' => 'success'));
				die;
			} else {
				echo json_encode(array('error' => 'Вы не авторизированы, страница будет перезагружена'));
				die;
			}
		}
	}