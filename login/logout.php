<?php
include($_SERVER['DOCUMENT_ROOT'] . '/functions.php');
$admin = new Admin();

if ( isset($_POST['logout']) && $admin->isLoggedIn() == 1 ) {
   $admin->logout();
}

$new_url = '/login';
header('Location: '.$new_url);