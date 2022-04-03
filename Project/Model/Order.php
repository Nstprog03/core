<?php Ccc::loadClass('Model_Core_Row');

class Model_Order extends Model_Core_Row
{
    protected $billingAddress;
    protected $shippingAddress;
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;
    const STATUS_DEFAULT = 1;
    const STATUS_ENABLED_LBL = 'Enabled';
    const STATUS_DISABLED_LBL = 'Disabled';

    public function __construct()
    {
        $this->setResourceClassName("Order_Resource");
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

        if(array_key_exists($key, $statuses)) {
            return $statuses[$key];
        }
        return $statuses[self::STATUS_DEFAULT];
    }

    public function getBillingAddress($reload = false)
    {
        $addressModel = Ccc::getModel('Order_Address');
        if(!$this->orderId)
        {
            return $addressModel;
        }
        if($this->billingAddress && !$reload)
        {
            return $this->billingAddress;
        }
        $address = $addressModel->fetchRow("SELECT * FROM `order_address` WHERE `orderId` = {$this->orderId} AND `billing` = 1");
        if(!$address)
        {
            return $addressModel;
        }
        $this->setBillingAddress($address);

        return $this->billingAddress;
    }

    public function setBillingAddress(Model_Order_Address $address)
    {
        $this->billingAddress = $address;
        return $this;
    }

    public function getShippingAddress($reload = false)
    {
        $addressModel = Ccc::getModel('Order_Address');
        if(!$this->orderId)
        {
            return $addressModel;
        }
        if($this->shippingAddress && !$reload)
        {
            return $this->shippingAddress;
        }
        $address=$addressModel->fetchRow("SELECT * FROM `order_address` WHERE `orderId` = {$this->orderId} AND `shipping` = 1");
        if(!$address)
        {
            return $addressModel;
        }
        $this->setShippingAddress($address);

        return $this->shippingAddress;
    }

    public function setShippingAddress(Model_Order_Address $address)
    {
        $this->shippingAddress = $address;
        return $this;
    }

    
    public function getItems($reload = false)
    {
        $itemModel = Ccc::getModel('Order_Item');
        if(!$this->orderId)
        {
            return $itemModel;
        }
        if($this->items && !$reload)
        {
            return $this->items;
        }
        $items = $itemModel->fetchAll("SELECT * FROM `order_item` WHERE `orderId` = {$this->orderId}");
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
