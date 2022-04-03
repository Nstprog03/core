<?php Ccc::loadClass('Controller_Core_Action');

class Controller_Admin_Action extends Controller_Core_Action
{
	public function authentication()
    {
		$loginModel = Ccc::getModel("Admin_Login");
		$request = $this->getRequest();
        if($request->getRequest('c') == 'admin_login'){
			$this->redirect();
        }
        if(!$loginModel->getLogin()){
			$this->redirect('login','admin_login');
        }
        return true;
    }
}