<?php
	class DB {
		
		public $conn;
		private $host = 'localhost';
		private $user = 'u0985581_210730';
		private $password  = '8A0k3W3s';
		private $database = 'u0985581_210730';
		
		function __construct()
		{
			$this->conn = new mysqli($this->host, $this->user, $this->password, $this->database);
			if($this->$conn->connect_error){
				die("Ошибка: " . $this->$conn->connect_error);
			}
		}
		
		public function request($sql) {
			$this->conn->set_charset('utf8');
			$result = $this->conn->query($sql);
			return $result;
		}
		
	}	