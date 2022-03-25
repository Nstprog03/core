<?php

class Model_Core_Login{

    protected $session = null;

    public function __construct()
	{

	}

    public function setSession($session)
    {
		$this->session = $session;
		return $this->session;
    }

    public function getSession()
    {
        if(!$this->session){
            $this->setSession(Ccc::getModel('Core_Session'));
        }
        return $this->session;
    }

    public function login($loginId)
    {
        if(!$loginId){
            return $this;
        }
        $login['loginId'] = $loginId;
        $this->getSession()->login = $login;
        return $this->getSession()->login;
    }

    public function logout()
    {
        if(!$this->getSession()->login){
            return null;
        }
        unset($this->getSession()->login);

        return $this;
    }

    public function getLogin()
    {
        if(!$this->getSession()->login){
            return false;
        }
        return true;        
    }
}

?>