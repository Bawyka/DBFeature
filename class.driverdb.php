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
	public function DelOne($tbl, $idn, $val)
	{
		
		$idn = (int) $idn;
	
		if ($result = $this->pdo->prepare("DELETE FROM `".$tbl."` WHERE `".$idn."`=:val LIMIT 1"))
		{
		
			$result->bindValue(":val",$val,PDO::PARAM_INT);
			
			$result->execute();
			
		}
		
		
		if ($result = $this->pdo->prepare("SELECT COUNT(id) FROM `".$tbl."` WHERE `".$idn."`=:val"))
		{
		
			$result->bindValue(":val",$val,PDO::PARAM_INT);
			
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
	
	
	/* Update One Record
	 * @param (string) $tbl - tableName 
	 * @param (string) $clm - Column Name
	 * @param (string/int) $val - value
	 * @return bool
	 */
	public function UpdOne($tbl,$clm,$upd,$idn,$val)
	{
	
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
		if ($result = $this->pdo->prepare("UPDATE `".$tbl."` SET `".$clm."`=:upd WHERE `".$idn."`=:val"))
		{
		
			$result->bindValue(":upd",$upd);
			$result->bindValue(":val",$val);
			
			$result->execute();
			
			$count = $result->rowCount();
			
			if ($count===0)
			{
			
				return FALSE;
			
			}
			else
			{
			
				return TRUE;
			
			}
		
		}
		
		return FALSE;
	
	}
	
	
	/* Get One Data
	 * @param (string) $tbl - table name
	 * @param (string) $clm - column of wanted data
	 * @param $idn - identifier of WHERE
	 * @param $val - identifier value
	 * @return $data
	 */
	public function GetOne($tbl,$clm,$idn,$val)
	{
	
		if ($result = $this->pdo->prepare("SELECT `".$clm."` FROM `".$tbl."` WHERE `".$idn."`=:val LIMIT 1"))
		{
		
			$result->bindValue(":val",$val);
			
			$result->execute();
			
			$assoc = $result->fetch(PDO::FETCH_ASSOC);
			
			$data = $assoc[$clm];
			
			return $data;
		
		}
		
		return FALSE;
	
	}
	
	/* count some rows
	 * @param (string) $tbl - name of the table
	 * @param (string) $clm - requested column
	 * @param $idn - identifier of row
	 * @param $val - value of row
	 * @return (int) $count
	 */
	public function CountRows($tbl,$clm,$idn,$val)
	{
	
		if ($result = $this->pdo->prepare("SELECT `".$clm."` FROM `".$tbl."` WHERE `".$idn."`=:val"))		
		{
		
			$result->bindValue(":val",$val);
			$result->execute();
			
			$count = $result->rowCount();
		
			return $count;
		
		}
		
		return FALSE;
		
	}


}