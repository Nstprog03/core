<?php Ccc::loadClass("Controller_Admin_Action");

class Controller_cart extends Controller_Admin_Action
{
    public function __construct()
    {

        if(!$this->authentication())
        {
            $this->redirect('login','admin_login');
        }
    }

    public function gridAction()
    {

        $this->setTitle('Cart');
        $this->getCart()->unsetCart();
        $cartGrid = Ccc::getBlock('Cart_Grid');
        $content = $this->getLayout()->getContent();
        $content->addChild($cartGrid,'Grid');
        $this->renderLayout();
    }

    public function editAction()
    {
        try
        {
            $this->setTitle('Edit Cart');
            $content = $this->getLayout()->getContent();
            $cartEdit = Ccc::getBlock('Cart_Edit');
            $content->addChild($cartEdit,'edit');
            $this->renderLayout();
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->redirect('grid','cart',[],true);
        }
    }

    public function addCartAction()
    {
        try
        {
            if($this->getCart()->getCart())
            {
                $this->redirect('edit','cart',[],true);
            }
            else
            {
                $cartModel = Ccc::getModel('Cart');
                $request = $this->getRequest();
                $customerId = (int)$request->getRequest('id');
                
                if(!$customerId)
                {
                    throw new Exception("Request Invalid.");
                }
                $cart = $cartModel->fetchRow("SELECT * FROM cart WHERE customerId = {$customerId}");
                if($cart)
                {
                    $this->getMessage()->addMessage('Cart already exists!',1);
                    $this->getCart()->addCart($cart->cartId);
                    $this->redirect('edit','cart',[],true);
                }
                else
                {

                    $cartModel->customerId = $customerId;
                    $cartModel->createdAt = date("Y-m-d h:i:s");
                    $cart = $cartModel->save();
                    if(!$cart)
                    {
                        throw new Exception("Unable to save cart.");
                    }
                    $this->saveAddressAction($cart);
                }
                    $this->getCart()->addCart($cart->cartId);
                $this->getMessage()->addMessage('Cart loaded.');
                $this->redirect('edit','cart',[],true);
            }
            
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->redirect('grid','cart',[],true);
        }
    }

    public function saveAddressAction($cart)
    {
        try
        {
          
            $customer = $cart->getCustomer();
            $customerBillingAddress = $customer->getBillingAddress();
            $customerShippingAddress = $customer->getShippingAddress();
            if($customerBillingAddress)
            {
                $bilingAddress = $cart->getBillingAddress();
                $bilingAddress->cartId = $cart->cartId;
                $bilingAddress->firstName = $customer->firstName;
                $bilingAddress->lastName = $customer->lastName;
                $bilingAddress->setData($customerBillingAddress->getData());
                unset($bilingAddress->addressId);
                unset($bilingAddress->customerId);
                $bilingAddress->save();
            }
            if($customerShippingAddress)
            {
                $shipingAddress = $cart->getShippingAddress();
                $shipingAddress->cartId = $cart->cartId;
                $shipingAddress->firstName = $customer->firstName;
                $shipingAddress->lastName = $customer->lastName;
                $shipingAddress->setData($customerShippingAddress->getData());
                unset($shipingAddress->addressId);
                unset($shipingAddress->customerId);
                $shipingAddress->save();
            }
            $this->getMessage()->addMessage("Address Saved.");
        }
        catch (Exveption $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
             $this->redirect('grid','cart',[],true);
        }
    }

    public function saveCartAddressAction()
    {
        try
        {
            $cartModel = Ccc::getModel('Cart');
            
            $request = $this->getRequest();
            $cartId = $this->getCart()->getCart();

            $cart = $cartModel->load($cartId);
            $billingData = $request->getPost('billingAddress');
            $shippingData = $request->getPost('shippingAddress');
            
            $billingAddress = $cart->getBillingAddress();
            $shippingAddress = $cart->getShippingAddress();
            
            $billingAddress->setData($billingData);
            $shippingAddress->setData($shippingData);
            $billingAddress->save();
            $shippingAddress->save();
            
            if($request->getPost('saveToBillingBook'))
            {
                $customer = $cart->getCustomer();
                $customerBillingAddress = $customer->getBillingAddress();
                $customerBillingAddress->setData($billingData);
                unset($customerBillingAddress->firstName);
                unset($customerBillingAddress->lastName);
                $customerBillingAddress->save();
            }
            if($request->getPost('saveToShippingBook'))
            {
                $customer = $cart->getCustomer();
                $customerShippingAddress = $customer->getShippingAddress();
                $customerShippingAddress->setData($shippingData);
                unset($customerShippingAddress->firstName);
                unset($customerShippingAddress->lastName);
                $customerShippingAddress->save();
            }
            $this->getMessage()->addMessage("Address Saved.");
             $this->redirect('edit','cart',[],true);
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
             $this->redirect('grid','cart',[],true);
        }
    }

    public function saveShipingMethodAction()
    {
        try
        {
            $cartModel = Ccc::getModel('Cart');
        
            $request = $this->getRequest();
            
            $cartId = $this->getCart()->getCart();
            $cart = $cartModel->load($cartId);
            
            $shippingMethod = $request->getPost('shippingMethod');
            if($shippingMethod == 1)
            {
                $shippingCharge = '100';
            }
            else if($shippingMethod == 2)
            {
                $shippingCharge = '75';
            }
            else
            {
                $shippingCharge = '50';
            }
            $cart->setData(['shippingCharge' => $shippingCharge, 'shippingMethod' => $shippingMethod]);
            $result = $cart->save();
            if(!$result)
            {
                throw new Exception("Shipping method not saved.");
            }
            $this->getMessage()->addMessage("Shipping method saved.");
             $this->redirect('edit','cart',[],true);
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
             $this->redirect('grid','cart',[],true);
        }
    }

    public function savePaymentMethodAction()
    {
        try
        {
            $cartModel = Ccc::getModel('Cart');
            
            $request = $this->getRequest();
            $cartId = $this->getCart()->getCart();

            $cart = $cartModel->load($cartId);
            $paymentData = $request->getPost('paymentMethod');
            $cart->setData(['paymentMethod' => $paymentData]);

            $result = $cart->save();
            if(!$result)
            {
                throw new Exception("Payment method not saved.");
            }
            $this->getMessage()->addMessage("Payment method saved.");
             $this->redirect('edit','cart',[],true);
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
             $this->redirect('grid','cart',[],true);
        }
    }

    public function addCartItemAction()
    {
        try
        {
            $cartModel = Ccc::getModel('Cart');
            $productModel = Ccc::getModel('Product');
            
            $request = $this->getRequest();
            $cartId = $this->getCart()->getCart();
            
            $cart = $cartModel->load($cartId);
            $cartData = $request->getPost('cartItem');

            $item = $cart->getItem();

            $item->cartId = $cart->cartId;
            foreach($cartData as $cartItem)
            {
                if(array_key_exists('productId',$cartItem))
                {
                    $product = $productModel->load($cartItem['productId']);
                    
                    if($product->quantity >= $cartItem['quantity'])
                    {
                        unset($item->itemId);
                        $item->setData($cartItem);
                        $item->itemTotal = $product->price * $cartItem['quantity'];
                        $item->tax = $product->tax;
                        $item->taxAmount = ($product->price * $product->tax / 100) * $cartItem['quantity'];
                        $item->discount = ($product->discount * $cartItem['quantity']); 
                        $item->save();
                        $taxAmount += ($product->price * $product->tax / 100) * $cartItem['quantity'];
                        $discount +=($product->discount * $cartItem['quantity']);
                        unset($item->itemId);
                    }
                }
            }
            $subTotal = $item->fetchRow("SELECT sum(`itemTotal`) as subTotal FROM `cart_item`");
            $cart->subTotal = $subTotal->subTotal;
            $cart->taxAmount = $taxAmount;
            $cart->discount = $discount;
            $result = $cart->save();
            if(!$result)
            {
                throw new Exception("subTotal not updated", 1);
            }
            $this->getMessage()->addMessage("Product added in cart.");
             $this->redirect('edit','cart',[],true);
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
             $this->redirect('grid','cart',[],true);
        }
    }

    public function cartItemUpdateAction()
    {
        try
        {
            $productModel = Ccc::getModel('Product');
            $cartModel = Ccc::getModel('Cart');
            
            $request = $this->getRequest();
            $cartId = $this->getCart()->getCart();
            
            $cart = $cartModel->load($cartId);
            
            $cartData = $request->getPost('cartItem');
            
            $item = $cart->getItem();
            foreach($cartData as $cartItem)
            {
                $product = $productModel->load($cartItem['productId']);
                if($product->quantity >= $cartItem['quantity'])
                {
                    $item->setData($cartItem);
                    $item->itemTotal = $product->price * $cartItem['quantity'];
                    $item->discount = $product->discount * $cartItem['quantity'];
                    $item->tax = $product->tax;
                    $item->taxAmount = ($product->price * $product->tax / 100) * $cartItem['quantity'];
                    $taxAmount += ($product->price * $product->tax / 100) * $cartItem['quantity'];
                    $discount += $product->discount * $cartItem['quantity'];
                    $item->save();
                }
            }
            $subTotal = $item->fetchRow("SELECT sum(`itemTotal`) as subTotal FROM `cart_item`");
            $cart->subTotal = $subTotal->subTotal;
            $cart->taxAmount = $taxAmount;
            $cart->discount = $discount;
            $result = $cart->save();
            if(!$result)
            {
                throw new Exception("subTotal not updated", 1);
            }
            $this->getMessage()->addMessage("Cart updated successfully.");
             $this->redirect('edit','cart',[],true);
        }
        catch(Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
             $this->redirect('grid','cart',[],true);
        }
    }

    public function deleteCartItemAction()
    {
        try
        {
            $item = Ccc::getModel('Cart_Item');
            $cart = Ccc::getModel('Cart');
            $request = $this->getRequest();
            $itemId = $request->getRequest('itemId');
            if(!$itemId)
            {
                throw new Exception("Request Invalid.");
            }
            
            $result = $item->load($itemId);
            if($result)
            {
                $cart = $cart->load($result->cartId);                
                $cart->subTotal = $cart->subTotal - $result->itemTotal;
                $cart->taxAmount = $cart->taxAmount - $result->taxAmount;
                $cart->discount = $cart->discount - $result->discount;
                $save = $cart->save();
                if(!$save)
                {
                    $this->getMessage()->addMessage("not save.",3);
                    $this->redirect('edit',null,['itemId' => null]);
                }
            }
            $res = $result->delete();
            if($res)
            {
                $this->getMessage()->addMessage("Cart item deleted successfully.",1);
                $this->redirect('edit',null,['itemId' => null]);
            }

            $this->redirect('edit',null,['itemId' => null]);   
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
             $this->redirect('grid','cart',[],true);
        }
    }

    public function placeOrderAction()
    {
        try
        {
            $productModel = Ccc::getModel('Product');
            $cartModel = Ccc::getModel('Cart');
            $orderModel = Ccc::getModel('order');
            $addressModel = Ccc::getModel('Order_Address');
            
            $request = $this->getRequest();
            $cartId = $this->getCart()->getCart();

            $cart = $cartModel->load($cartId);
            
            $customer = $cart->getCustomer();
            
            $orderModel->customerId = $cart->customerId;
            $orderModel->firstName = $customer->firstName;
            $orderModel->lastName = $customer->lastName;
            $orderModel->email = $customer->email;
            $orderModel->mobile = $customer->mobile;
            $orderModel->shippingId = $cart->shippingMethod;
            $orderModel->shippingCharge = $cart->shippingCharge;
            $orderModel->paymentId = $cart->paymentMethod;
            $orderModel->grandTotal = $request->getPost('grandTotal');
            $orderModel->taxAmount = $request->getPost('taxAmount');
            $orderModel->discount = $request->getPost('discount');
            $order = $orderModel->save();
            if($order)
            {
                $items = $cart->getItems();
          
                foreach($items as $item)
                {
                    $product = $item->getProduct(true);
                    $itemModel = Ccc::getModel('Order_Item');
                    $itemModel->orderId = $order->orderId;
                    $itemModel->productId = $product->productId;
                    $itemModel->name = $product->name;
                    $itemModel->sku = $product->sku;
                    $itemModel->price = $item->itemTotal;
                    $itemModel->tax = $product->tax;
                    $itemModel->taxAmount = ($product->price * $product->tax / 100) * $item->quantity;
                    $itemModel->quantity = $item->quantity;
                    if($item->productId == $product->productId)
                    {
                        $product->quantity -= $item->quantity;
                    }
                    $product->save();

                }

                $billingData = $cart->getBillingAddress();
                $shipingData = $cart->getShippingAddress();
                $billingAddress = $order->getBillingAddress();
                $shippingAddress = $order->getShippingAddress();
                $billingAddress->setData($billingData->getData());
                $billingAddress->email = $customer->email;
                $billingAddress->mobile = $customer->mobile;
                $billingAddress->orderId = $order->orderId;
                $shippingAddress->setData($shipingData->getData());
                $shippingAddress->email = $customer->email;
                $shippingAddress->mobile = $customer->mobile;
                $shippingAddress->orderId = $order->orderId;
                unset($billingAddress->cartId);
                unset($billingAddress->addressId);
                unset($shippingAddress->cartId);
                unset($shippingAddress->addressId);
                $billingResult = $billingAddress->save();
                $shippinhResult = $shippingAddress->save();

                if($billingResult)
                {
                    $billingData->delete();
                }
                if($shippinhResult)
                {
                    $shipingData->delete();
                }
                if($order)
                {
                    $cart->delete();
                }
                $this->getMessage()->addMessage("Order placed successfully.");
                $this->redirect('grid',null,[],true);
            }
            
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
             $this->redirect('grid','cart',[],true);
        }
    }
}
