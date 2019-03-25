<?php
class dbclass{
	private $host="localhost";
	private $username="root";
	private $password ="";
	private $db="employee";
	public $conn;
	public function dbConnect(){
		$this->conn=null;
		try{
			$this->conn=new mysqli($this->host, $this->username, $this->password, $this->db);
		}catch(mysqli_sql_exception $e){
			echo "Error: " . $e->getMessage();
		}
		return $this->conn;
	}
	
}
?>