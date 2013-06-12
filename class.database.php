<?php require_once "class.config.php";

# КЛАСС ПОДКЛЮЧЕНИЯ К БАЗЕ ДАННЫХ
class DB extends Config {

	public function __construct()
	{
		try
		{
			$this->pdo = new PDO("mysql:host=".$this->DB_HOST.";dbname=".$this->DB_NAME.";charset=".$this->CHARSET,$this->DB_USER,$this->DB_PASS);
		}
		catch(PDOException $e)
		{
			die("Error ". $e->getMessage());
		}
	}
}