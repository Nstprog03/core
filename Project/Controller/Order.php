<?php Ccc::loadClass("Controller_Admin_Action");

class Controller_Order extends Controller_Admin_Action
{
    public function __construct()
    {
        if(!$this->authentication())
        {
            $this->redirect('login','Admin_login');
        }
    }

    public function gridAction()
    {
        $this->setTitle('Order');
        $orderGrid = Ccc::getBlock('Order_Grid');
        $content = $this->getLayout()->getContent();
        $content->addChild($orderGrid,'Grid');
        $this->renderLayout();
    }

    public function editAction()
    {
        try
        {
            $this->setTitle('Order Edit');
            $orderModel = Ccc::getModel("Order");
            
            $request = $this->getRequest();
            $orderId = $request->getRequest('id');
            if(!$orderId)
            {
                throw new Exception('Invalid Request.');          
            }

            if(!(int)$orderId)
            {
                throw new Exception('Invalid Request.');
            }

            $order = $orderModel->load($orderId);
            if(!$order)
            {
                throw new Exception('Data not found.');
            }
    
            $content = $this->getLayout()->getContent();
            $orderEdit = Ccc::getBlock('Order_Edit');
            
            $items = $order->getItems();
            $orderEdit = Ccc::getBlock('Order_Edit')->setData(['order' => $order]);

            $content->addChild($orderEdit,'Edit');
            $this->renderLayout();
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->redirect('grid','order');
        }
    }
}
