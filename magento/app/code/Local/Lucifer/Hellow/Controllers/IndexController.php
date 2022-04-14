<?php
 
class Lucifer_Hellow_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {


        $this->loadLayout();

        //print_r($this->_blocks);
        //$this->renderLayout();
        // echo 'Hello developer...';
        // echo "<pre>";
        // $this->loadLayout();
        // //$a=$this->getLayout()->createBlock('Hellow/grid');
        // //var_dump($a);

        // $this->getLayout()->createBlock('customer/account_dashboard');
        // exit;
         $this->getLayout()->getBlock('content')->append(
            $this->getLayout()->createBlock('grid')
        );
        //$this->getLayout()->getBlock('head')->setTitle($this->__('Grid'));

         $this->renderLayout();
        //echo "<pre>";
        //print_r($this);
        //print_r(get_class_methods($this));
        //$this->sayHelloAction();    
    }
 
    public function sayHelloAction()
    {
        echo 'Hello one more time...';
    }
}
?>