    <?php
class Ccc_Process_Adminhtml_Process_UploadController extends Mage_Adminhtml_Controller_Action{

    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('process/group');
        $this->renderLayout();
    }

    public function uploadfileAction()
    {
        $processId = $this->getRequest()->getParam('id');
        Mage::getSingleton('cms/wysiwyg_config')->setStoreId($this->getRequest()->getParam('store'));

        $process = Mage::getModel('process/process')
            ->load($processId);
        Mage::register('current_process_media', $process);

        if (!$processId) {
            $this->_getSession()->addError(Mage::helper('process')->__('This process no longer exists'));
            $this->_redirect('*/*/');
            return;
        }
        $this->loadLayout();
        $this->renderLayout();
    }

    public function uploadAction()
    {
        $processId = $this->getRequest()->getParam('id');
        $process = Mage::getModel('process/process');
        if($process->load($processId))
        {
            // print_r($process->getData()['requestModel']);
            // exit;
            $model = Mage::getModel($process->getData()['requestModel']);
        // print_r($process->getData()['requestModel']);
        // exit;
            $fileName = $model->setProcess($process)->uploadFile();
        }
        $this->_redirect('process/adminhtml_process/index');
    }

    public function verifyAction()
    {
        try{
            $processId = $this->getRequest()->getParam('id');
            $process = Mage::getModel('process/process');
            if($process->load($processId))
            {
                $model = Mage::getModel($process->getData()['requestModel']);
                $fileName = $model->setProcess($process)->verify();
            }
            Mage::getSingleton('adminhtml/session')->addSuccess('Data verified successfully.');
        }
        catch(Exception $e)
        {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        $this->_redirect('process/adminhtml_process/index');

    }

    protected function _preparProcessEntryVariable()
    {
        $processId = $this->getRequest()->getParam('id');
        $process = Mage::getModel('process/process')->load($processId);
        $sessionProcessEntry = [
            'processId' => $process,
            'totalCount' => 0,
            'perRequestCount' => 0,
            'totalRequest' => 0,
            'currentRequest' => 0
        ];
        $entry = Mage::getModel('process/entry');
        $select = $entry->getCollection()
                ->getSelect()
                ->reset(Zend_Db_Select::COLUMNS)
                ->columns(['count(entry_id)'])
                ->where('process_id = ?', $processId)
                ->where('start_time IS NULL');
        $entryData = $entry->getResource()->getReadConnection()->fetchOne($select);
        if(!$entryData)
        {
            throw new Exception("No recored available for execution", 1);
        }
        $sessionProcessEntry['totalCount'] = $entryData;
        $sessionProcessEntry['perRequestCount'] = $process->getData()['perRequestCount'];
        $sessionProcessEntry['totalRequest'] = ceil($sessionProcessEntry['totalCount']/$sessionProcessEntry['perRequestCount']);
        $sessionProcessEntry['currentRequest'] = 1;
        Mage::getSingleton('core/session')->setProcessEntryVariable($sessionProcessEntry);
    }

    public function executeAction()
    {
        try 
        {
            $this->loadLayout();
            $this->_preparProcessEntryVariable();
            $this->renderLayout();
        } 
        catch (Exception $e) 
        {
            $sessionProcessEntry = Mage::getSingleton('core/session')->getProcessEntryVariable();
            if(empty($sessionProcessEntry))
            {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
            else
            {
                Mage::getSingleton('adminhtml/session')->addSuccess("Data executed successfully.");
                Mage::getSingleton('core/session')->clear();
            }
            $this->_redirect('process/adminhtml_process/index');
        }
    }

    public function processEntryAction()
    {
        try 
        {

            $responce = [
                'status' => "success",
                'reload' => false,
                'message' => null,
                'current' => null,
            ];
            $reload = false;
            $sessionProcessEntry = Mage::getSingleton('core/session')->getProcessEntryVariable();
            $process = $sessionProcessEntry['processId'];
            if(!$process)
            {
                throw new Exception("No process found.", 1);
            }
            $requestModel = Mage::getModel($process->getData('requestModel'));
            
            if(!$requestModel)
            {
                throw new Exception("Request model not found", 1);
            }
            
            $requestModel->setProcess($process)->execute();
            $responce['message'] = "Complate ". $sessionProcessEntry['currentRequest'] * $sessionProcessEntry['perRequestCount'] ." out of ". $sessionProcessEntry['totalCount'];
            $responce['current'] = $sessionProcessEntry['currentRequest'] + 1;
            if($sessionProcessEntry['currentRequest'] == $sessionProcessEntry['totalRequest'])
            {
                $responce['reload'] = true;
                $responce['message'] = "Complate ". $sessionProcessEntry['totalCount'] ." out of ". $sessionProcessEntry['totalCount'];
            }
            $sessionProcessEntry['currentRequest'] += 1;
            $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($responce));
            Mage::getSingleton('core/session')->setProcessEntryVariable($sessionProcessEntry);

        } 
        catch (Exception $e) 
        {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            echo get_class($this->_redirect('process/adminhtml_process/index'));
        }
    }

    public function exportCsvAction()
    {
        $process = Mage::getModel('process/process')->load($this->getRequest()->getParam('id'));
        $model = Mage::getModel('process/process_abstract')->setProcess($process)->getSampleFile();
        $fileName   = 'sample.csv';
        $content = ['type'=>'filename','value'=>Mage::getBaseDir('media') . DS . 'process'. DS . 'import' . DS . 'sample.csv','rm'=>1];
        $this->_prepareDownloadResponse($fileName, $content);

        $this->_redirect('process/adminhtml_process/index');
    }
}

?>