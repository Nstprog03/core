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
	
		$dbData = array();
		foreach($data as $key => $value ) {
	    	$dbData[''.$key] ="'".$value."'";
		}
		$insertQuery = ("INSERT INTO $this->tableName (" . implode(',',array_keys($data)) . 
			") VALUES ( ". implode(',', array_values($dbData)) . ")");
		$insertId=$adapter->insert($insertQuery);

		if(!$insertId)
		{
			throw new Exception("Error Processing Request", 1);
			
		}
		return $insertId;
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

		$update=$adapter->update($updateQuery);
		if(!$update)
		{
			throw new Exception("Error Processing Request", 1);
			
		}
	}
	public function delete($primaryKey = null,array $data = null)
	{
		$deleteQuery = "DELETE FROM $this->tableName WHERE $this->primaryKey=$primaryKey";
		global $adapter;
		$delete=$adapter->delete($deleteQuery);
		if(!$delete)
		{
			throw new Exception("Error Processing Request", 1);
			
		}
	}
	public function fetchAll($query)
	{

		global $adapter;
		$fetchAll=$adapter->fetchAll($query);
		if(!$fetchAll)
		{
			throw new Exception("Error Processing Request", 1);
			
		}
		return $fetchAll;
	}
	public function fetchRow($query)
	{
		global $adapter;
		$fetchRow=$adapter->fetchRow($query);
		if(!$fetchRow)
		{
			throw new Exception("Error Processing Request", 1);
			
		}
		return $fetchRow;
	}

}