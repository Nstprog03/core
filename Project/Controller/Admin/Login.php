<?php Ccc::loadClass("Controller_Admin_Action"); ?>
<?php

class Controller_Admin_Login extends Controller_Admin_Action{

	public function loginAction()
	{
		$this->setTitle('Admin Login');

		$content = $this->getLayout()->getContent();
		$loginGrid = Ccc::getBlock('Admin_Login_Grid','grid');
		$content->addChild($loginGrid,'grid');
		$this->renderLayout();
	}

	public function loginPostAction()
	{
		try
		{
			$adminModel = Ccc::getModel("Admin");
			$loginModel = Ccc::getModel("Admin_Login");
			$request = $this->getRequest();
			if(!$request->isPost())
			{
				throw new Exception("invalid request", 1);
			}
			if(!$request->getPost())
			{
				throw new Exception("invalid request", 1);
			}
			$loginData = $request->getPost('admin');
			$password = md5($loginData['password']);
			$admin = $adminModel->fetchAll("SELECT * FROM `admin` WHERE `email` = '{$loginData['email']}' AND `password` = '{$password}'");
			if(!$admin)
			{
				$this->getMessage()->addMessage("Login details incorect",Model_Core_Message::MESSAGE_ERROR);
				throw new Exception("invalid request", 1);
			}
			$loginModel->login($admin[0]->email);
			$this->getMessage()->addMessage('You are Logedin');
			$this->redirect('index','admin');
		}
		catch (Exception $e) 
		{
			$this->redirect('login','admin_login',[],true);
		}
	}

	public function logoutAction()
	{
		$loginModel = Ccc::getModel("Admin_Login");
		if($loginModel->getLogin())
		{
			$loginModel->logout();
		}
		$this->redirect('login','admin_login');		
	}

}

?>