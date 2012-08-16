<?php require_once "class.database.php";

# ДРАЙВЕР ДЛЯ РАБОТЫ С БАЗОЙ ДАННЫХ
class DriverDB extends DB {

	function __construct(){
	
		parent::__construct();
	
	}
	
	/* getting all data from table 
	 * in @param (string) $tbl - name of the table
	 * out @return (array) $data
	 */
	public function GetData($tbl)
	{
	
		if ($result = $this->pdo->prepare("SELECT * FROM ".$tbl.""))
		{
		
			$result->execute();
			
			$data = $result->fetchAll(PDO::FETCH_ASSOC);
			
			return $data;
		
		}
	
	}
	
	/* Delete One Record
	 * in @param (string) $tbl - name of the table
	 * in @param (int) $idn - id of record
	 * @return bool
	 */
	public function DelOne($tbl, $idn)
	{
		
		$idn = (int) $idn;
	
		if ($result = $this->pdo->prepare("DELETE FROM `".$tbl."` WHERE `id`=:idn LIMIT 1"))
		{
		
			$result->bindValue(":idn",$idn,PDO::PARAM_INT);
			
			$result->execute();
			
		}
		
		
		if ($result = $this->pdo->prepare("SELECT COUNT(id) FROM `".$tbl."` WHERE `id`=:idn"))
		{
		
			$result->bindValue(":idn",$idn,PDO::PARAM_INT);
			
			$result->execute();
			
			$nRows = $result->fetchColumn();
			
			if ($nRows === "0")
			{
				
				return TRUE;
			
			}
			else
			{
			
				return FALSE;
			
			}
		}

		
		return FALSE;
	
	}
	

	/* Checking if the Row exists in the table or No.
	 * @param (string) $tbl - name of the table
	 * @param (string) $clm - column name
	 * @param (string/int) $rc - record value
	 */
	public function ExistsRow($tbl,$clm,$rc)
	{
	
		if ($result = $this->pdo->prepare("SELECT COUNT(id) FROM `".$tbl."` WHERE `".$clm."`=:rc"))
		{
		
			$result->bindValue(":rc",$rc);
			
			$result->execute();
			
			$nRows = $result->fetchColumn();
			
			if ($nRows==="0") {
			
				return FALSE;
			
			}
			else
			{
			
				return TRUE;
			
			}
		
		}
		
		return FALSE;
	
	}


}