<?php
class Ccc_Process_Adminhtml_ProcessController extends Mage_Adminhtml_Controller_Action{

    public function indexAction()
    {
        
        $this->loadLayout();
        $this->_setActiveMenu('process/group');
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

	public function editAction() {

		$processId = $this->getRequest()->getParam('id');
		$process = Mage::getModel('process/process')
			->setStoreId($this->getRequest()->getParam('store', 0))
			->load($processId);

		Mage::register('current_process', $process);
		Mage::getSingleton('cms/wysiwyg_config')->setStoreId($this->getRequest()->getParam('store'));

		if ($processId && !$process->getId()) {
			$this->_getSession()->addError(Mage::helper('process')->__('This process no longer exists'));
			$this->_redirect('*/*/');
			return;
		}
		$this->loadLayout();
		$this->renderLayout();
	}

    public function saveAction() 
    {   
        try
        {
            if (!$this->getRequest()->getPost()){   
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Invalid request.'));   
            }
            $id= ($this->getRequest()->getParam('id'));
            $model = Mage::getModel('process/process')->load($id);
            $model->setData('entity_id',$id);

            $model->setData('name',$this->getRequest()->getPost('name')); 
            $model->setData('group_id',$this->getRequest()->getPost('group_id'));            
            $model->setData('type_id',$this->getRequest()->getPost('type_id'));            
            $model->setData('perRequestCount',$this->getRequest()->getPost('perRequestCount'));            
            $model->setData('requestInterval',$this->getRequest()->getPost('requestInterval'));            
            $model->setData('requestModel',$this->getRequest()->getPost('requestModel'));            
            $model->setData('fileName',$this->getRequest()->getPost('fileName'));            
           
            $model->save();
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('process')->__('Process saved successfully.'));
        }
        catch (Exception $e)
        {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        $this->_redirect('process/adminhtml_process/index');
    }

    public function deleteAction()
    {
        if( $this->getRequest()->getParam('id') > 0 ) 
        {

            $id     = $this->getRequest()->getParam('id');
            $model2  = Mage::getModel('process/process')->load($id);
            $model = Mage::getModel('process/process');             
                $model->setId($this->getRequest()->getParam('id'))
                    ->delete(); //delete operation

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('successfully deleted'));
        }
        $this->_redirect('process/adminhtml_process/index');
    }  

    public function exportCsvAction()
    {
        
        $fileName   = 'sample.csv';
        $process = Mage::getModel('process/process')->load($this->getRequest()->getParam('id'));
        $model = Mage::getModel('process/process_abstract')->setProcess($process);
        //$model = Mage::getModel('process/process')->load($processId);
        $model->getDefaultFile();
            $content = ['type'=>'filename','value'=>'C:\xampp7.42\htdocs\magento\media\process\import\sample.csv','rm'=>1];
        $this->_prepareDownloadResponse($fileName, $content);   
    } 
    public function massDeleteAction() 
    {
        $sampleIds = $this->getRequest()->getParam('process');
        if(!is_array($sampleIds)){
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } 
        else 
        {
            try
            {
                foreach ($sampleIds as $sampleId)
                {
                    $sample = Mage::getModel('process/process')->load($sampleId);
                    $sample->delete();

                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('adminhtml')->__('Total of %d record(s) were successfully deleted', count($sampleIds)));
            } 
            catch (Exception $e)
            {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('process/adminhtml_process/index');
    }   

    public function massDeleteEntrysAction()
    {
        $sampleIds = $this->getRequest()->getParam('process');
        if(!is_array($sampleIds)){
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } 
        else 
        {
            try
            {
                $count = 0;
                foreach ($sampleIds as $sampleId)
                {
                    $entryModel = Mage::getModel('process/entry');
                    $select = $entryModel->getCollection()
                        ->getSelect()
                        ->reset(Zend_Db_Select::COLUMNS)
                        ->columns(['entry_id'])
                        ->where('process_id = ?', $sampleId);
                        $entryIds = $entryModel->getResource()->getReadConnection()->fetchAll($select);
                        foreach ($entryIds as $entryId) 
                        {
                            $entry = Mage::getModel('process/entry')->load($entryId['entry_id']);
                            $entry->delete();
                            $count++;
                        }

                }
                //echo $count;
                Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('adminhtml')->__('Total of '.$count.' record(s) were successfully deleted', count($count)));
            } 
            catch (Exception $e)
            {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('process/adminhtml_process/index');
    }

}

?>
