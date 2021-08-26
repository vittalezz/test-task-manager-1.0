<?php
	
	include($_SERVER['DOCUMENT_ROOT'] . '/functions.php');
	
	class Admin {
		
		public $username = '';
		public $password = '';
		private $loggedIn = 0;
		
		function __construct() {
			$this->loggedIn = ( isset($_SESSION['logged_admin']) ) ? 1 : 0;
			$this->username = ( isset($_SESSION['logged_admin']) ) ? $_SESSION['logged_admin'] : '';
		}
		
		public function login() {
			$db = new DB();
			
			$sql = "SELECT * FROM `pref_admin_users` WHERE `login` = '" . $this->username . "' and `password` ='" . md5($this->password) . "'";
			$result = $db->request($sql);
			if ($result->num_rows > 0) {
				$this->loggedIn = 1;
				$_SESSION['logged_admin'] = $this->username;
			}
		}
		
		public function logout() {
			$this->loggedIn = 0;
			unset($_SESSION['logged_admin']);
		}
		
		public function isLoggedIn() {
			return $this->loggedIn;
		}
		
	}		