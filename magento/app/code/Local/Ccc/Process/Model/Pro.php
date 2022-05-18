<?php   
   class Ccc_Process_Model_Pro extends Ccc_Process_Model_Process_Abstract
   {
      protected function _construct()
      {
         $this->_init('process/pro');
      }

      public function getIdentifier($row)
      {
         return $row['name'];
      }
      public function prepareRow($row)
      {
         return [
            'stdname' => $row['stdname'],
            'email' => $row['email'],
            'gender' => $row['gender'],
            'rollno' => $row['rollno'],
            'status' => $row['status'],
         ];
      }

      public function validateRow($row)
      {
         return $row;
      }
   }  