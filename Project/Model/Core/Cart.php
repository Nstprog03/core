<?php

class Model_Core_Cart{

    protected $session = null;
    public function __construct()
	{

	}

	public function addCart($cartId)
	{

        $this->getSession()->cart = $cartId;
        return $this;   
	}    
    
    public function getCart()
    {
        if(!$this->getSession()->cart){
            return null;
        }
        return $this->getSession()->cart;
    }

    public function unsetCart()
    {
        if(!$this->getSession()->cart){
            return null;
        }
        unset($this->getSession()->cart);
        return $this;
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
}

?>