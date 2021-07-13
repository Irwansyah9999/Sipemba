<?php 

class Connection{
	private $conn;

	// Type connection
	private $driver = 'mysql';

	// Atribut connection
	private $host = 'localhost';
	private $username = 'root';
	private $password = '';
	private $database = 'sipemba';
	private $port = 3306;

	function getConnection(){
		try {
			$conn = new PDO("$this->driver:dbname=$this->database;host=$this->host;port=$this->port",$this->username,$this->password);
		} catch (PDOException $e) {
			echo 'Connection Failed'.$e->getMessage();
		}
		
		return $conn;
	}
}



?>