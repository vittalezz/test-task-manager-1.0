<?php
	$page = ( isset($_GET['page']) ) ? $_GET['page'] : 1;
	$display = ( isset($_GET['display']) ) ? $_GET['display'] : 3;
	$order_by = ( isset($_GET['sort_by']) ) ? $_GET['sort_by'] : 'id';
	$sort_direction = ( isset($_GET['sort_direction']) ) ? $_GET['sort_direction'] : 'ASC';
	$tasks_data = $tasks->load($page, $display, $order_by, $sort_direction);
	$tasks_items = $tasks_data['items'];
	$tasks_pagination = $tasks_data['pagination'];
	
	$sort_list_item_data_direction = array();
	$sort_list_item_data_direction['id'] = '';
	$sort_list_item_data_direction['user_name'] = '';
	$sort_list_item_data_direction['description'] = '';
	$sort_list_item_data_direction['user_email'] = '';
	$sort_list_item_data_direction['completed'] = '';
	if ($order_by == 'id') {
		$sort_list_item_data_direction['id'] = ($sort_direction == 'ASC') ? 'ASC' : 'DESC';
		} elseif ($order_by == 'user_name') {
		$sort_list_item_data_direction['user_name'] = ($sort_direction == 'ASC') ? 'ASC' : 'DESC';
		} elseif ($order_by == 'description') {
		$sort_list_item_data_direction['description'] = ($sort_direction == 'ASC') ? 'ASC' : 'DESC';
		} elseif ($order_by == 'user_email') {
		$sort_list_item_data_direction['user_email'] = ($sort_direction == 'ASC') ? 'ASC' : 'DESC';
		} elseif ($order_by == 'completed') {
		$sort_list_item_data_direction['completed'] = ($sort_direction == 'ASC') ? 'ASC' : 'DESC';
	}