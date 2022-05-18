<?php   
   class Ccc_Process_Model_Process extends Ccc_Process_Model_Process_Abstract
    {
        const IMPORT = 1;
        const EXPORT = 2;
        const CRON = 3;
        
        const IMPORT_LBL = 'Import';
        const EXPORT_LBL = 'Export';
        const CRON_LBL = 'Cron';
        
        const TYPE_DEFAULT = 1;

        
        protected $headers = [];
        protected $filedData = [];
        protected $invalidData = [];
        protected $invalidHeaders = [];
        protected $requiredFiled = [];
        
        protected function _construct()
        {
            $this->_init('process/process');
        }

        public function getType()
        {
            $key = $this->type_id;
            $types = [
                self::IMPORT => self::IMPORT_LBL,
                self::EXPORT => self::EXPORT_LBL,
                self::CRON => self::CRON_LBL,
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

    

?>


