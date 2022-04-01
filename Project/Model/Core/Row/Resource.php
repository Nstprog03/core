<?php

class Model_Core_Row_Resource
{
	protected $tableName = null;
	protected $primaryKey = null;

	public function __construct()
	{
	}

	public function getAdapter()
	{
		global $adapter;
		return $adapter;
	}

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

	public function insert(array $insertArray)
	{
		$columnName = [];
		$columnValue = [];
		foreach ($insertArray as $columnKey => $value) 
		{
			if($value != null) 
			{
				array_push($columnName, $columnKey);
				array_push($columnValue, $value);
			}
			
		}
		$columnNames = implode(',', $columnName);
		$columnValues = "'". implode("','", $columnValue) . "'";
		$tableName = $this->getTableName();

		$query = "INSERT INTO $tableName($columnNames) VALUES($columnValues)";
		
		$result = $this->getAdapter()->insert($query);

		return $result;
	}

	public function update(array $updateArray, array $updateWhere)
	{
		$tableName = $this->getTableName();
		$valueArray = [];
		$nullValueArray = [];
		$key = key($updateWhere);
		$value = $updateWhere[$key];
		foreach ($updateArray as $columnName => $columnValue) 
		{
			if($columnValue == null)
			{
				array_push($nullValueArray, $columnName);
			}
			else 
			{
				$valueArray[] = "$columnName='$columnValue'";
			}
			
		}
		foreach ($nullValueArray as $nullColumnName) {
			$query2 = "UPDATE {$tableName} SET {$nullColumnName} = null WHERE $key = $value";
			$result = $this->getAdapter()->update($query2);
		}
		$setString = implode(",", $valueArray);
		$query = "UPDATE $tableName SET $setString WHERE $key = $value";
		$result = $this->getAdapter()->update($query);
		return $result;
	}

	public function fetchAll($query)
	{
		$result = $this->getAdapter()->fetchAll($query);
		return $result;
	}

	public function fetchRow($query)
	{
		$result = $this->getAdapter()->fetchRow($query);
		return $result;
	}

	public function delete(array $deleteArray)
	{
		$tableName = $this->getTableName();
		$key = key($deleteArray);
		$value = $deleteArray[$key];
		$query = "DELETE FROM $tableName WHERE $key = $value";
		$result = $this->getAdapter()->delete($query);
		return $result;
	}

}






?>