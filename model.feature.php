<?php require_once "class.driverdb.php";

# МОДЕЛЬ в которой будут свои/пользовательские функции
class Feature extends DriverDB {

	public function __construct()
	{
		// вызываем конструктор родителя для работы с БД
		parent::__construct();
		
		echo "Привет, Мир!";
	
	}

}