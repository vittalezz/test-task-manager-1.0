<?php
	$errors = array();
	$success = '';
	
	if ( isset($_POST['login']) ) {
		$errors['username'] = !empty($_POST['username']) ? '' : 'Заполните логин';
		$errors['password'] = !empty($_POST['password']) ? '' : 'Заполните пароль';
		
		if ( empty($errors['username']) && empty($errors['password']) ) {
			$admin->username = $_POST['username'];
			$admin->password = $_POST['password'];
			$admin->login();
			
			if ( $admin->isLoggedIn() == 0 ) {
				$errors['username_or_password'] = 'Неверный логин или пароль';
				} else {
				$success = 'Вы успешно авторизированы, можете перейти на <a href="/">главную страницу</a>';
			}
		}
	}
	