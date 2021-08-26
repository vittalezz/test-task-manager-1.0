<?php
	$classes = array();
	if( $admin->isLoggedIn() == 1 ) {
		$classes['logged_icon'] = 'logged-true';
		} else {
		$classes['logged_icon'] = 'logged-false';
	}