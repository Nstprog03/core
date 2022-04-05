<?php Ccc::loadClass("Controller_Admin_Action"); ?>
<?php

class Controller_cart extends Controller_Admin_Action{

    public function __construct()
    {
        $this->setTitle('cart');
        if(!$this->authentication()){
            $this->redirect('login','admin_login');
        }
    }

    public function indexAction()
    {
        $content = $this->getLayout()->getContent();
        $cartIndex = Ccc::getBlock('Cart_Index');
        $content->addChild($cartIndex);

        $this->renderLayout();
    }

    public function indexBlockAction()
    {
        $cartEditAddress = Ccc::getBlock('Cart_Edit_Address')->toHtml();
        $cartEditItem = Ccc::getBlock('Cart_Edit_Item')->toHtml();
        $cartEditPaymentShipping = Ccc::getBlock('Cart_Edit_PaymentShipping')->toHtml();
        $cartEditSubTotal = Ccc::getBlock('Cart_Edit_SubTotal')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#cartAddress',
                    'content' => $cartEditAddress,
                ],
                [
                    'element' => '#paymentShipping',
                    'content' => $cartEditPaymentShipping,
                ],
                [
                    'element' => '#cartProduct',
                    'content' => $cartEditItem,
                ],
                [
                    'element' => '#cartSubTotal',
                    'content' => $cartEditSubTotal,
                ],
                [
                    'element' => '#adminMessage',
                    'content' => $messageBlock
                ]
            ]
        ];
        $this->renderJson($response);


    }
    public function gridBlockAction()
    {
        $this->getCart()->unsetCart();

        $cartGrid = Ccc::getBlock('Cart_Grid')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#indexContent',
                    'content' => $cartGrid,
                    ],
                [
                    'element' => '#adminMessage',
                    'content' => $messageBlock
                ]
            ]
        ];
        $this->renderJson($response);
    }

    public function editBlockAction()
    {
        $cartEdit = Ccc::getBlock('Cart_Edit')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#indexContent',
                    'content' => $cartEdit,
                    ],
                [
                    'element' => '#adminMessage',
                    'content' => $messageBlock
                ]
            ]
        ];
        $this->renderJson($response);
    }

    public function addCartAction()
    {
        try {
            $request = $this->getRequest();
            $customerId = $request->getRequest('id');
            if($this->getCart()->getCart()){
                $this->editBlockAction();   
                exit;
            }
            else{
                $cartModel = Ccc::getModel('Cart');
                $cart = $cartModel->fetchRow("SELECT * FROM `cart` WHERE `customerId` = {$customerId}");
                if($cart){
                    $this->getCart()->addCart($cart->cartId);
                    $this->editBlockAction();   
                    exit;
                }
                else{
                    $cartModel->customerId = $customerId;
                    $cartModel->status = 1;
                    $cart = $cartModel->save();
                    if(!$cart){
                        $this->getMessage()->addMessage('Cart can not created');
                    }
                    $this->saveAddressAction($cart);
                    $this->getCart()->addCart($cart->cartId);
                }
                $this->editBlockAction();   
            }
        }catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
            $this->editBlockAction();   
        }
        
    }

    public function saveAddressAction($cart)
    {
        try {
            $request = $this->getRequest();
            $customer = $cart->getCustomer();
            $customerBillingAddress = $customer->getBillingAddress();
            $customerShippingAddress = $customer->getShippingAddress();
            if($customerBillingAddress){
                $billingAddress = $cart->getBillingAddress();
                $billingAddress->cartId = $cart->cartId;
                $billingAddress->firstName = $customer->firstName;
                $billingAddress->lastName = $customer->lastName;
                $billingAddress->setData($customerBillingAddress->getData());
                unset($billingAddress->addressId);
                unset($billingAddress->customerId);
                $billingAddress->save();
                if(!$billingAddress){
                    throw new Exception("Billing address not saved.", 1);
                }
            }
            if($customerShippingAddress){
                $shippingAddress = $cart->getShippingAddress();
                $shippingAddress->cartId = $cart->cartId;
                $shippingAddress->firstName = $customer->firstName;
                $shippingAddress->lastName = $customer->lastName;
                $shippingAddress->setData($customerShippingAddress->getData());
                unset($shippingAddress->addressId);
                unset($shippingAddress->customerId);
                $shippingAddress->save();
                if(!$shippingAddress){
                    throw new Exception("Shipping address not saved.", 1);
                }
                return $shippingAddress;
            }       
        }catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
            $this->editBlockAction();   
        }
    }

    public function saveCartAddressAction()
    {
        try {
            $request = $this->getRequest();
            $cartId = $this->getCart()->getCart();
            $cartModel = Ccc::getModel('Cart');
            $cart = $cartModel->load($cartId);
            $billingData = $request->getPost('billingAddress');
            $shippingData = $request->getPost('shippingAddress');
            $billingAddress = $cart->getBillingAddress();
            $shippingAddress = $cart->getShippingAddress();
            $billingAddress->setData($billingData);
            $shippingAddress->setData($shippingData);
            $billingAddress->save();
            $shippingAddress->save();
            if($request->getPost('saveInBillingBook')){
                $customer = $cart->getCustomer();
                $customerBillingAddress = $customer->getBillingAddress();
                $customerBillingAddress->setData($billingData);
                unset($customerBillingAddress->firstName);
                unset($customerBillingAddress->lastName);
                $customerBillingAddress->save();
                if(!$customerBillingAddress){
                    throw new Exception("Customer billing address not saved.", 1);
                }
            }
            if($request->getPost('saveInShippingBook')){
                $customer = $cart->getCustomer();
                $customerShippingAddress = $customer->getShippingAddress();
                $customerShippingAddress->setData($shippingData);
                unset($customerShippingAddress->firstName);
                unset($customerShippingAddress->lastName);
                $customerShippingAddress->save();
                if(!$customerShippingAddress){
                    throw new Exception("Customer shipping address not saved.", 1);
                }
            }
            $cartEditAddress = Ccc::getBlock('Cart_Edit_Address')->toHtml();
            $cartEditSubTotal = Ccc::getBlock('Cart_Edit_SubTotal')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
            $response = [
                'status' => 'success',
                'elements' => [
                    [
                        'element' => '#cartAddress',
                        'content' => $cartEditAddress,
                    ],
                    [
                        'element' => '#cartSubTotal',
                        'content' => $cartEditSubTotal,
                    ],
                    [
                        'element' => '#adminMessage',
                        'content' => $messageBlock
                    ]
                ]
            ];
            $this->renderJson($response);
            }catch (Exception $e)
            {
                $this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
                $this->editBlockAction();
            }
    }

    public function savePaymentMethodAction()
    {
        try {
            $request = $this->getRequest();
            $cartId = $this->getCart()->getCart();
            $cartModel = Ccc::getModel('Cart');
            $cart = $cartModel->load($cartId);
            $paymentData = $request->getPost('paymentMethod');
            $cart->setData(['paymentMethod' => $paymentData]);
            $result = $cart->save();
            if(!$result){
                throw new Exception("Payment method not saved.", 1);
            }
            $this->getMessage()->addMessage("Payment method saved.");
            $cartEditPaymentShipping = Ccc::getBlock('Cart_Edit_PaymentShipping')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
            $response = [
                'status' => 'success',
                'elements' => [
                    [
                        'element' => '#paymentShipping',
                        'content' => $cartEditPaymentShipping,
                        ],
                    [
                        'element' => '#adminMessage',
                        'content' => $messageBlock
                    ]
                ]
            ];
            $this->renderJson($response);
        }catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
            $this->editBlockAction();
        }
    }

    public function saveShippingMethodAction()
    {
        try {
            $request = $this->getRequest();
            $cartId = $this->getCart()->getCart();
            $cartModel = Ccc::getModel('Cart');
            $cart = $cartModel->load($cartId);
            $shippingCharge = $request->getPost('shippingMethod');
            if($shippingCharge == 100){
                $shippingMethod = '1';
            }
            elseif($shippingCharge == 70){
                $shippingMethod = '2';
            }
            else{
                $shippingMethod = '3';
            }
            $cart->setData(['shippingMethod' => $shippingMethod, 'shippingCharge' => $shippingCharge]);
            $result = $cart->save();
            if(!$result){
                throw new Exception("Shipping method not saved.", 1);
            }
            $this->getMessage()->addMessage("Shipping method saved.");
            $cartEditAddress = Ccc::getBlock('Cart_Edit_Address')->toHtml();
            $cartEditSubTotal = Ccc::getBlock('Cart_Edit_SubTotal')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
            $response = [
                'status' => 'success',
                'elements' => [
                    [
                        'element' => '#cartAddress',
                        'content' => $cartEditAddress,
                    ],
                    [
                        'element' => '#cartSubTotal',
                        'content' => $cartEditSubTotal,
                    ],
                    [
                        'element' => '#adminMessage',
                        'content' => $messageBlock
                    ]
                ]
            ];
            $this->renderJson($response);
        }catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
            $this->editBlockAction();
        }
    }

    public function addCartItemAction()
    {
        try {
            $taxAmount = null;
            $discount = null;
            $request = $this->getRequest();
            $cartId = $this->getCart()->getCart();
            $cartModel = Ccc::getModel('Cart');
            $cart = $cartModel->load($cartId);
            $productModel = Ccc::getModel('Product');
            $cartData = $request->getPost('cartProduct');
            $item = Ccc::getModel('Cart_Item');
            $item->cartId = $cart->cartId;
            foreach($cartData as $cartItem){
                if(array_key_exists('productId',$cartItem)){
                    $product = $productModel->load($cartItem['productId']);
                    if($product->quantity >= $cartItem['quantity']){
                        $item->setData($cartItem);
                        $item->itemTotal = $product->price * $cartItem['quantity'];
                        $item->tax = $product->tax;
                        $item->taxAmount = ($product->price * $product->tax / 100) * $cartItem['quantity'];
                        $item->discount = $product->discount * $cartItem['quantity'];
                        $saveitem = $item->save();
                        $taxAmount += ($product->price * $product->tax / 100) * $cartItem['quantity'];
                        $discount += $product->discount * $cartItem['quantity'];
                        unset($item->itemId);
                    }
                }
            }
            $subTotal = $item->fetchRow("SELECT sum(`itemTotal`) as subTotal FROM `cart_item`");
            $cart->subTotal = $subTotal->subTotal;
            $cart->taxAmount += $taxAmount;
            $cart->discount += $discount;
            $result = $cart->save();
            if(!$result){
                throw new Exception("subTotal not updated", 1);
            }
            $this->getMessage()->addMessage("Cart Item added successfully.");
            $cartEditItem = Ccc::getBlock('Cart_Edit_Item')->toHtml();
            $cartEditSubTotal = Ccc::getBlock('Cart_Edit_SubTotal')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
            $response = [
                'status' => 'success',
                'elements' => [
                    [
                        'element' => '#cartProduct',
                        'content' => $cartEditItem,
                    ],      
                    [
                        'element' => '#cartSubTotal',
                        'content' => $cartEditSubTotal,
                    ],
                    [
                        'element' => '#adminMessage',
                        'content' => $messageBlock
                    ]
                ]
            ];
            $this->renderJson($response);
        }catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
            $this->redirect('edit');
        }
    }

    public function deleteCartItemAction()
    {
        try {
            $request = $this->getRequest();
            $itemId = $request->getRequest('id');
            $item = Ccc::getModel('Cart_Item')->load($itemId);
            $cart = $item->getCart();
            $cart->subTotal = $cart->subTotal - $item->itemTotal;
            $cart->taxAmount = $cart->taxAmount - $item->taxAmount;
            $cart->discount = $cart->discount - $item->discount;
            $cart->save();
            $result = $item->delete();
            if(!$result){
                throw new Exception("Cart item not deleted.", 1);
            }
            $this->getMessage()->addMessage("Cart item deleted successfully.");
            $cartEditItem = Ccc::getBlock('Cart_Edit_Item')->toHtml();
            $cartEditSubTotal = Ccc::getBlock('Cart_Edit_SubTotal')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
            $response = [
                'status' => 'success',
                'elements' => [
                    [
                        'element' => '#cartProduct',
                        'content' => $cartEditItem,
                    ],      
                    [
                        'element' => '#cartSubTotal',
                        'content' => $cartEditSubTotal,
                    ],
                    [
                        'element' => '#adminMessage',
                        'content' => $messageBlock
                    ]
                ]
            ];
            $this->renderJson($response);
        }catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
            $this->editBlockAction();
        }
    }

    public function cartItemUpdateAction()
    {
        try {
            $taxAmount = null;
            $discount = null;
            $request = $this->getRequest();
            $cartId = $this->getCart()->getCart();
            $cartModel = Ccc::getModel('Cart');
            $cart = $cartModel->load($cartId);
            $productModel = Ccc::getModel('Product');
            $cartData = $request->getPost('cartItem');
            $item = $cart->getItem();
            foreach($cartData as $cartItem){
                $product = $productModel->load($cartItem['productId']);
                if($product->quantity >= $cartItem['quantity']){
                    $item->setData($cartItem);
                    $item->itemTotal = $product->price * $cartItem['quantity'];
                    $item->tax = $product->tax;
                    $item->taxAmount = ($product->price * $product->tax / 100) * $cartItem['quantity'];
                    $item->discount = $product->discount * $cartItem['quantity'];
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
            if(!$result){
                throw new Exception("subTotal not updated", 1);
            }
            $this->getMessage()->addMessage("Cart item updated successfully.");
            $cartEditItem = Ccc::getBlock('Cart_Edit_Item')->toHtml();
            $cartEditSubTotal = Ccc::getBlock('Cart_Edit_SubTotal')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
            $response = [
                'status' => 'success',
                'elements' => [
                    [
                        'element' => '#cartProduct',
                        'content' => $cartEditItem,
                    ],
                    [
                        'element' => '#cartSubTotal',
                        'content' => $cartEditSubTotal,
                    ],
                    [
                        'element' => '#adminMessage',
                        'content' => $messageBlock
                    ]
                ]
            ];
            $this->renderJson($response);
        }catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
            $this->editBlockAction();
        }
    }

    public function placeOrderAction()
    {
        try {
            
            $request = $this->getRequest();
            $cartId = $this->getCart()->getCart();
            $cartModel = Ccc::getModel('Cart');
            $cart = $cartModel->load($cartId);
            $customer = $cart->getCustomer();
            $orderModel = Ccc::getModel('order');
            $orderModel->customerId = $customer->customerId;
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
            if(!$order){
                throw new Exception("Order not added.", 1);
            }
    
            $items = $cart->getItems();
            foreach($items as $item){
                $product = $item->getProduct();
                $itemModel = Ccc::getModel('Order_Item');
                $itemModel->orderId = $order->orderId;
                $itemModel->productId = $product->productId;
                $itemModel->name = $product->name;
                $itemModel->sku = $product->sku;
                $itemModel->price = $item->itemTotal;
                $itemModel->tax = $product->tax;
                $itemModel->taxAmount = ($product->price * $product->tax / 100) * $item->quantity;
                $itemModel->discount = $product->discount;
                $itemModel->quantity = $item->quantity;
                $result = $itemModel->save();
                if($result){
                    $item->delete();
                }
            }
            $addressModel = Ccc::getModel('Order_Address');
            $billingData = $cart->getBillingAddress();
            $shippingData = $cart->getShippingAddress();
            $billingAddress = $order->getBillingAddress();
            $shippingAddress = $order->getShippingAddress();
            unset($billingData->cartId);
            unset($billingData->addressId);
            unset($shippingData->cartId);
            unset($shippingData->addressId);
            $billingAddress->setData($billingData->getData());
            $billingAddress->email = $customer->email;
            $billingAddress->mobile = $customer->mobile;
            $billingAddress->orderId = $order->orderId;
            $shippingAddress->setData($shippingData->getData());
            $shippingAddress->email = $customer->email;
            $shippingAddress->mobile = $customer->mobile;
            $shippingAddress->orderId = $order->orderId;
    
            $billingResult = $billingAddress->save();
            $shipinhResult = $shippingAddress->save();
            if(!$billingResult){
                throw new Exception("Billing address not saved", 1);
            }
            if(!$shipinhResult){
                throw new Exception("Shipping address not saved", 1);
            }
            if($order){
                $cart->delete();
            }
            if($billingResult){
                $billingData->delete();
            }
            if($shipinhResult){
                $shippingData->delete();
            }
            
            $this->getMessage()->addMessage("Order placed successfully.");
            $this->gridBlockAction();
            }
            catch (Exception $e)
            {
                $this->getMessage()->addMessage($e->getMessage(),Model_Core_Message::MESSAGE_ERROR);
                $this->gridBlockAction();
            }
    }
}

?>