<?php Ccc::loadClass('Controller_Core_Action');

class Controller_Page extends Controller_Core_Action
{

	public function gridAction()
	{
		Ccc::getBlock('Page_Grid')->toHtml();
	}
	public function addAction()
	{
		$pageModel = Ccc::getModel('page');
		Ccc::getBlock('Page_Edit')->setData(['page'=>$pageModel])->toHtml();
	}
	public function editAction()
	{
		try
		{

			$request = $this->getRequest();
			$id = $request->getRequest('id');
			if(!(int)$id)
			{
				throw new Exception("Request Invelid", 1);
				
			}
			//$postData = $request->getPost('page');
			$pageModel = Ccc::getModel('page');
			$page = $pageModel->load($id);
			if(!$page)
			{
				throw new Exception("Failed to fatch Data", 1);
				
			}
			Ccc::getBlock('Page_Edit')->setData(['page'=>$page])->toHtml();
		}
		catch(Exception $e)
		{
			$this->redirect($this->getView()->getUrl('grid','page',[],true));
		}
	}


	public function saveAction()
	{
		try
		{
			$request = $this->getRequest();
			$postData = $request->getPost('page');
			if(!$postData)
			{
				throw new Exception("Invalid Request", 1);
			}
			$pageModel = Ccc::getModel('page');
			$page = $pageModel;
			$page->setData($postData);
			if(!$page->pageId)
			{
				unset($page->pageId);
				$page->createdAt = date('y-m-d h:i:s');
				
				$insert = $page->save();
				if(!$insert)
				{
					throw new Exception("Unable to Save", 1);
					
				}
			}
			else
			{

				$page->updatedAt = date('y-m-d h:i:s');
				$update = $page->save();
				if(!$update)
				{
					throw new Exception("Unable to Save", 1);
					
				}
			}
			$this->redirect($this->getView()->getUrl('grid','page',[],true));

		}
		catch(Exception $e)
		{
			$this->redirect($this->getView()->getUrl('grid','page',[],true));
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
				throw new Exception("Request Invelid", 1);
				
			}
			$pageModel = Ccc::getModel('page');
			$delete = $pageModel->load($id)->delete();
			if(!$delete)
			{
				throw new Exception("Unable to Save", 1);
				
			}
			$this->redirect($this->getView()->getUrl('grid','page',[],true));
		}
		catch(Exception $e)
		{
			$this->redirect($this->getView()->getUrl('grid','page',[],true));
		}

	}
}