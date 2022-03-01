<?php Ccc::loadClass('Controller_Core_Action');

class Controller_Salesman extends Controller_Core_Action
{
	public function gridAction()
	{
		Ccc::getBlock('Salesman_Grid')->toHtml();
	}
	public function addAction()
	{
		$salesmenModel = Ccc::getModel('salesman');
		Ccc::getBlock('Salesman_Edit')->setData(['salesman'=>$salesmenModel])->toHtml();
	}
	public function editAction()
	{
		try
		{
			$request = $this->getRequest();
			$id = $request->getRequest('id');
			if(!(int)$id)
			{
				throw new Exception("Invalid Request.", 1);
				
			}
			$salesmenModel = Ccc::getModel('salesman');
			$salesmen = $salesmenModel->load($id);
			if(!$salesmen)
			{
				throw new Exception("unable to fatch Record.", 1);
			}
			Ccc::getBlock('Salesman_Edit')->setData(['salesman'=>$salesmen])->toHtml();
		}
		catch(Exception $e)
		{
			$this->redirect($this->getView()->getUrl('grid','salesman',[],true));
		}
	}
	public function saveAction()
	{
		try
		{
			$request = $this->getRequest();
			$postData = $request->getPost('salesman');
			if(!$postData)
			{
				throw new Exception("Invalid Request.", 1);
				
			}
			$salesmenModel = Ccc::getModel('salesman');
			$salesmen = $salesmenModel;
			$salesmen->setData($postData);
			if(!$salesmen->salesmanId)
			{
				unset($salesmen->salesmanId);
				$salesmen->createdAt = date("Y-m-d h:i:s");
		// print_r($salesmen);
		// exit;
				$insert = $salesmen->save();
				if(!$insert)
				{
					throw new Exception("Unable to Save Record.", 1);
					
				}
			} 
			else
			{
				$salesmen->updatedAt = date("Y-m-d h:i:s");
				$update = $salesmen->save();
				if(!$update)
				{
					throw new Exception("Unable to Save Record.", 1);
					
				}	
			}
			$this->redirect($this->getView()->getUrl('grid','salesman',[],true));
		}
		catch(Exception $e)
		{
			$this->redirect($this->getView()->getUrl('grid','salesman',[],true));	
		}
	}

	public function deleteAction()
	{
		try
		{
			$request = $this->getRequest();
			$id = $request->getRequest('id');
			if(!(int)$id)
			{
				throw new Exception("Invalid Request.", 1);
				
			}
			$salesmenModel = Ccc::getModel('salesman');
			$delete = $salesmenModel->load($id)->delete();
			if(!$delete)
			{
				throw new Exception("unable to fatch Record.", 1);
			}
			$this->redirect($this->getView()->getUrl('grid','salesman',[],true));
		}
		catch(Exception $e)
		{
			$this->redirect($this->getView()->getUrl('grid','salesman',[],true));
		}
	}
}