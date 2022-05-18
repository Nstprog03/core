<?php
class Ccc_Process_Adminhtml_Process_ColumnController extends Mage_Adminhtml_Controller_Action{

    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('process/column');
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

	public function editAction() {

		$processId = $this->getRequest()->getParam('id');
		$process = Mage::getModel('process/column')
			->setStoreId($this->getRequest()->getParam('store', 0))
			->load($processId);

		Mage::register('current_process_column', $process);
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
        // print_r($this->getRequest()->getPost('exception'));exit;
        try
        {
            if (!$this->getRequest()->getPost()){   
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Invalid request.'));   
            }
            $id= ($this->getRequest()->getParam('id'));
            //echo"<pre>";
            //print_r($this->getRequest()->getPost());
            $model = Mage::getModel('process/column')->load($id);
            $model->setData('entity_id',$id);

            $model->setData('name',$this->getRequest()->getPost('name')); 
            $model->setData('process_id',$this->getRequest()->getPost('process_id'));            
            $model->setData('required',$this->getRequest()->getPost('required'));            
            $model->setData('casting_type',$this->getRequest()->getPost('casting_type'));
            $model->setData('sample_data',$this->getRequest()->getPost('sample_data'));            
            $model->setData('exception',$this->getRequest()->getPost('exception')); //print_r($model); 
            //$model->castingType =  $this->getRequest()->getPost('casting_type');         
            //exit;
           
            $model->save();
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('process')->__('Process Column saved successfully.'));
        }
        catch (Exception $e)
        {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        $this->_redirect('process/adminhtml_process_column/index');
    }

    public function deleteAction()
    {
        if( $this->getRequest()->getParam('id') > 0 ) 
        {

            $id     = $this->getRequest()->getParam('id');
            $model2  = Mage::getModel('process/column')->load($id);
            $model = Mage::getModel('process/column');             
                $model->setId($this->getRequest()->getParam('id'))
                    ->delete(); //delete operation

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('successfully deleted'));
                $this->_redirect('process/adminhtml_process_column/index');   

        }
        $this->_redirect('process/adminhtml_process_column/index');
    }   

    public function massDeleteAction() 
    {
        $sampleIds = $this->getRequest()->getParam('column');
        if(!is_array($sampleIds)){
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } 
        else 
        {
            try
            {
                foreach ($sampleIds as $sampleId)
                {
                    $sample = Mage::getModel('process/column')->load($sampleId);
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
        $this->_redirect('process/adminhtml_process_column/index');
    }   

}

?>