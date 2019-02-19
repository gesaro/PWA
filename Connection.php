<?php

	class Connection{
		private $host='127.0.0.1';
		private $user='PWA';
		private $pass='PWA123';
		private $DB='--database--';
		private $conn;
		function connect(){
			$this->conn=new mysqli($this->host,$this->user,$this->pass,$this->DB);
			return $this->conn;
		}
		function disconnect(){
			mysqli_close($this->conn);
		}
	}
?>