<?php require_once('Model/Core/Adapter.php'); 

class Model_Core_Table
{
	protected $tableName = null; 
	protected $primaryKey = null;
	

	public function getTableName()
	{	
		return $this->tableName;
	}
	public function setTableName($tableName)
	{	
		$this->tableName = $tableName;
		return $this;
	}
	public function getPrimaryKey()
	{	
		return $this->primaryKey;
	}
	public function setPrimaryKey($primaryKey)
	{	
		$this->primaryKey = $primaryKey;
		return $this;
	}
	
	
	public function insert(array $data=null)
	{
		global $adapter;
	
		$prep = array();
		foreach($data as $key => $value ) {
	    	$prep[''.$key] ="'".$value."'";
		}
		$sth = ("INSERT INTO $this->tableName (" . implode(',',array_keys($data)) . 
			") VALUES ( ". implode(',', array_values($prep)) . ")");

		try{
			$insertId=$adapter->insert($sth);
			print_r($insertId);
			if(!$insertId)
			{
				throw new Exception("Error Processing Request", 1);
				
			}

		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}

		

	}
	public function update(array $data=null,$primaryKey=null)
	{
		global $adapter;
		$f="";
		foreach($data as $key => $value ) {
	    	$prep[''.$key] ="'".$value."'";
	    	$f.= $key."=".$prep[''.$key].",";
		}
		$final=rtrim($f,',');
		$updateQuery="UPDATE $this->tableName SET $final WHERE $this->tableName.$this->primaryKey = $primaryKey";

		try{
			$update=$adapter->update($updateQuery);
			//print_r($insertId);
			if(!$update)
			{
				throw new Exception("Error Processing Request", 1);
				
			}

		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}

		
	}
	public function delete($primaryKey = null,array $data = null)
	{
		$deleteQuery = "DELETE FROM $this->tableName WHERE $this->primaryKey=$primaryKey";
		global $adapter;
	
	try{
			$delete=$adapter->delete($deleteQuery);
			//print_r($insertId);
			if(!$delete)
			{
				throw new Exception("Error Processing Request", 1);
				
			}

		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	public function fetchAll()
	{
		$fetchQuery="SELECT * FROM $this->tableName";
		global $adapter;
		try{
			$fetchAll=$adapter->fetchAll($fetchQuery);
			if(!$fetchAll)
			{
				throw new Exception("Error Processing Request", 1);
				
			}
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
		return $fetchAll;
	}
	public function fetchRow($primaryKey=null)
	{
		$fetchQuery="SELECT * FROM $this->tableName WHERE $this->primaryKey=$primaryKey";
		global $adapter;
		try{
			$fetchRow=$adapter->fetchRow($fetchQuery);
			if(!$fetchRow)
			{
				throw new Exception("Error Processing Request", 1);
				
			}
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
		return $fetchRow;
	}

}