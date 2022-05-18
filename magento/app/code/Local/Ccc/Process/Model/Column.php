<?php 
class Ccc_Process_Model_Column extends Mage_Core_Model_Abstract
{
	const VARCHAR = 1;
	const INT = 2;
	const DECIMAL = 3;
	const TEXT = 4;
	const YES = 1;
	const NO = 2;
	const VARCHAR_LBL = 'Varchar';
	const INT_LBL = 'Integer';
	const DECIMAL_LBL = 'Decimal';
	const TEXT_LBL = 'Text';
	const YES_LBL = 'Yes';
	const NO_LBL = 'No';
	const TYPE_DEFAULT = 1;
	public function _construct()
	{
		$this->_init('process/column');
	}
	public function getIsException()
	{
		$key = $this->exception;
		$types = [
			self::YES => self::YES_LBL,
			self::NO => self::NO_LBL,
		];

		if(!$key)
		{
			return $types;
		}

		if (array_key_exists($key,$types)) 
		{	
			return $types[$key];
		}
		
		return self::TYPE_DEFAULT;
	}
	public function getRequired()
	{
		$key = $this->required;
		$types = [
			self::YES => self::YES_LBL,
			self::NO => self::NO_LBL,
		];

		if(!$key)
		{
			return $types;
		}

		if (array_key_exists($key,$types)) 
		{	
			return $types[$key];
		}
		return self::TYPE_DEFAULT;
	}
	public function getCastingType()
	{
		$key = $this->casting_type;
		$types = [
			self::VARCHAR => self::VARCHAR_LBL,
			self::INT => self::INT_LBL,
			self::TEXT => self::TEXT_LBL,
			self::DECIMAL => self::DECIMAL_LBL,
		];

		if(!$key)
		{
			return $types;
		}

		if (array_key_exists($key,$types)) 
		{	
			return $types[$key];
		}
		return self::TYPE_DEFAULT;
	}
}