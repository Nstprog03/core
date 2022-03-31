<?php Ccc::loadClass('Model_Core_Row');

class Model_Cart extends Model_Core_Row
{
    protected $item;
    protected $items;
    protected $billingAddress;
    protected $shippingAddress;
    protected $customer;

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;
    const STATUS_DEFAULT = 1;
    const STATUS_ENABLED_LBL = 'Active';
    const STATUS_DISABLED_LBL = 'Inactive';

    public function __construct()
    {
        $this->setResourceClassName("Cart_Resource");
        parent::__construct();
    }

    public function getStatus($key = null)
    {
        $statuses = [
           self::STATUS_ENABLED => self::STATUS_ENABLED_LBL,
           self::STATUS_DISABLED => self::STATUS_DISABLED_LBL
        ];
        if(!$key)
        {
            return $statuses;
        }

        if(array_key_exists($key, $statuses))
        {
            return $statuses[$key];
        }
        return $statuses[self::STATUS_DEFAULT];
    }

    public function getBillingAddress($reload = false)
    {
        $addressModel = Ccc::getModel('Cart_Address');
        if(!$this->cartId)
        {
            return $addressModel;
        }
        if($this->billingAddress && !$reload)
        {
            return $this->billingAddress;
        }
        $address = $addressModel->fetchRow("SELECT * FROM `cart_address` WHERE `cartId` = {$this->cartId} AND `billing` = 1");
        
        if(!$address)
        {
            return $addressModel;
        }
        $this->setBillingAddress($address);

        return $this->billingAddress;
    }

    public function setBillingAddress(model_cart_address $address)
    {
        $this->billingAddress = $address;
        return $this;
    }

    public function getShippingAddress($reload = false)
    {
        $addressModel = Ccc::getModel('Cart_Address');
        if(!$this->cartId)
        {
            return $addressModel;
        }
        if($this->shippingAddress && !$reload)
        {
            return $this->shippingAddress;
        }
        $address = $addressModel->fetchRow("SELECT * FROM `cart_address` WHERE `cartId` = {$this->cartId} AND `shipping` = 1");
        if(!$address)
        {
            return $addressModel;
        }
        $this->setShippingAddress($address);

        return $this->shippingAddress;
    }

    public function setShippingAddress(Model_Cart_Address $address)
    {
        $this->shippingAddress = $address;
        return $this;
    }

    public function getItem($reload = false)
    {
        $itemModel = Ccc::getModel('Cart_Item');
        if(!$this->cartId)
        {
            return $itemModel;
        }
        if($this->item && !$reload)
        {
            return $this->item;
        }
        $item = $itemModel->fetchRow("SELECT * FROM `cart_item` WHERE `cartId` = {$this->cartId}");
        if(!$item)
        {
            return $itemModel;
        }
        $this->setItem($item);

        return $this->item;
    }

    public function setItem($item)
    {
        $this->item = $item;
        return $this;
    }

    public function setCustomer(Model_Customer $customer)
    {
        $this->customer = $customer;
        return $this;
    }

    public function getCustomer($reload = false)
    {
        $customerModel = Ccc::getModel('Customer');
        if(!$this->customerId)
        {
            return $customerModel;
        }
        if($this->customer && !$reload)
        {
            return $this->customer;
        }

        $customer = $customerModel->fetchRow("SELECT * FROM `customer` WHERE `customerId` = {$this->customerId}");
        if(!$customer)
        {
            return $customerModel;
        }
        $this->setCustomer($customer);
        return $this->customer;
    }

    public function getItems($reload = false)
    {

        $itemModel = Ccc::getModel('Cart_Item');
        if(!$this->cartId)
        {
            return $itemModel;
        }
        if($this->items && !$reload)
        {
            return $this->items;
        }
        $items = $itemModel->fetchAll("SELECT * FROM `cart_item` WHERE `cartId` = {$this->cartId}");
        if(!$items)
        {
            return $itemModel;
        }
        $this->setItems($items);

        return $this->items;
    }

    public function setItems($items)
    {
        $this->items = $items;
        return $this;
    }
}
