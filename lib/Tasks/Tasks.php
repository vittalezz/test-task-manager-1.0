<?php
	
	include($_SERVER['DOCUMENT_ROOT'] . '/functions.php');
	
	class Tasks {
		
		public $username = '';
		public $password = '';
		private $loggedIn = 0;
		
		function __construct() {
		}
		
		public function request($sql) {
			$db = new DB();
			
			$result = $db->request($sql);
			return $result;
		}
		
		public function add($user_name, $user_email, $description) {
			$sql = "INSERT INTO `pref_tasks` (`user_name`, `user_email`, `description`, `completed`, `is_change`) VALUES ('$user_name', '$user_email', '$description', '0', '0')";
			$result = $this->request($sql);
		}
		
		public function load($page = 1, $display = 3, $order_by = 'id', $sort_direction = 'ASC') {
			$data = array();
			
			$itemsOnPage = $display;
			$from = ($page - 1) * $itemsOnPage;
			
			$sql = "SELECT * FROM `pref_tasks` ORDER BY `$order_by` $sort_direction LIMIT $from,$itemsOnPage";
			$result = $this->request($sql);
			
			$items = '';
			$rows = array();
			while ($row = $result->fetch_assoc()) {
				$rows[] = $row;
			}
			foreach ($rows as $row => $task) {
				$item_class_active = ($task['completed'] == 0) ? '' : ' active';
				$item_completed_text = ($task['completed'] == 0) ? 'Не выполнено' : 'Выполнено';
				$item_checkbox_checked = ($task['completed'] == 0) ? '' : ' checked';
				$item_is_change_text = ($task['is_change'] == 0) ? '' : '(Отредактировано)';
				if( isset($_SESSION['logged_admin']) ) {
					$item = '<div data-id="' . $task['id'] . '" class="list-group-item list-group-item-action flex-column align-items-start zindex-hover-3 shadow-hover-add' . $item_class_active . '">
					<div class="d-flex w-100 justify-content-between">
					<h5 class="task-user-name mb-1">' . $task['user_name'] . '</h5>
					<small class="task-completed">
					<label>' . $item_completed_text . '</label>
					<input type="checkbox" name="completed" value="1"' . $item_checkbox_checked . '>
					</small>
					</div>
					<textarea class="task-description mb-1">' . $task['description'] . '</textarea>
					<div class="d-flex w-100 justify-content-between">
					<small class="task-user-email">' . $task['user_email'] . '</small>
					<small class="task-is_change">' . $item_is_change_text . '</small>
					</div>
					</div>';
					} else {
					$item = '<div data-id="' . $task['id'] . '" class="list-group-item list-group-item-action flex-column align-items-start zindex-hover-3 shadow-hover-add' . $item_class_active . '">
					<div class="d-flex w-100 justify-content-between">
					<h5 class="task-user-name mb-1">' . $task['user_name'] . '</h5>
					<small class="task-completed">' . $item_completed_text . '</small>
					</div>
					<p class="task-description mb-1">' . $task['description'] . '</p>
					<div class="d-flex w-100 justify-content-between">
					<small class="task-user-email">' . $task['user_email'] . '</small>
					<small class="task-is_change">' . $item_is_change_text . '</small>
					</div>
					
					
					</div>';
				}
				$items .= $item;
			}
			
			$sql = "SELECT COUNT(*) as count FROM `pref_tasks`";
			$result_paginate = $this->request($sql);
			$rows_count = array();
			while ($row = $result_paginate->fetch_assoc()) {
				$rows_count[] = $row;
			}
			$count = $rows_count[0]['count'];
			
			$pageCount = ceil($count / $itemsOnPage);
			
			$pagination_pages_wrap = '';
			$pagination_pages = '';
			$prevDots = false;
			$nextDots = false;
			for ($i = 1; $i <= $pageCount; $i++) {
				if ( ( $i >= ($page - 1) && $i <= ($page + 1) ) || $i == 1 || $i == $pageCount) {
					if ($i == $page) {
						$pagination_pages .= '<li class="page-item active"><span class="page-link disabled" data-page="' . $i . '">' . $i . '</span></li>';
						} else {
						$pagination_pages .= '<li class="page-item zindex-hover-3"><a class="page-link shadow-hover-add" href="?page=' . $i . '" data-page="' . $i . '">' . $i . '</a></li>';
					}
				} elseif ( $i < ($page - 1) && $i != 1 && $i != $pageCount && $prevDots == false ) {
					$pagination_pages .= '<li class="page-item disabled pagination-dots"><span class="page-link disabled">...</span></li>';
					$prevDots = true;
				} elseif ( $i > ($page + 1) && $i != 1 && $i != $pageCount && $nextDots == false ) {
					$pagination_pages .= '<li class="page-item disabled pagination-dots"><span class="page-link disabled">...</span></li>';
					$nextDots = true;
				}
			}
			if ($page == 1) {
				$prevPage = '<li class="page-item prev-page disabled"><span class="page-link disabled" data-page="">&lt;</span></li>';
			} else {
				$prevPage = '<li class="page-item prev-page zindex-hover-3"><a class="page-link shadow-hover-add" href="?page=' . ($page - 1) . '" data-page="' . ($page - 1) . '">&lt;</a></li>';
			}
			if ($page == $pageCount) {
				$nextPage = '<li class="page-item next-page disabled"><span class="page-link disabled" data-page="">&gt;</span></li>';
			} else {
				$nextPage = '<li class="page-item next-page zindex-hover-3"><a class="page-link shadow-hover-add" href="?page=' . ($page + 1) . '" data-page="' . ($page + 1) . '">&gt;</a></li>';
			}
			if ( !empty($pagination_pages) && $pageCount != 1 ) {
				$pagination_pages_wrap = '
				<nav>
				<ul class="pagination justify-content-center">
					' . $prevPage . '
					' . $pagination_pages . '
					' . $nextPage . '
				</ul>
				</nav>
				';
			}
			
			$data['items'] = $items;
			$data['pagination'] = $pagination_pages_wrap;
			return $data;
		}
		
		public function change($id, $completed, $description, $change) {
			if ( isset($_SESSION['logged_admin']) ) {
				if ($change == 1) {
					$sql = "UPDATE `pref_tasks` SET `description` = '$description', `completed` = '$completed', `is_change` = $change WHERE `pref_tasks`.`id` = $id";
				} else {
					$sql = "UPDATE `pref_tasks` SET `description` = '$description', `completed` = '$completed' WHERE `pref_tasks`.`id` = $id";
				}
				$this->request($sql);
				return true;
			} else {
				return false;
			}
		}
		
	}		