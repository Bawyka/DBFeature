<?php require_once "class.database.php";

# ДРАЙВЕР ДЛЯ РАБОТЫ С БАЗОЙ ДАННЫХ
class DriverDB extends DB {

	function __construct(){
	
		parent::__construct();
	
	}
	
	// getting all data from table 
	// in @param (string) $tbl - name of the table
	// out @return (array) $data
	public function GetData($tbl)
	{
	
		if ($result = $this->pdo->prepare("SELECT * FROM ".$tbl.""))
		{
		
			$result->execute();
			
			$data = $result->fetchAll(PDO::FETCH_ASSOC);
			
			return $data;
		
		}
	
	}


}