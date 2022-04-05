<?php Ccc::loadClass('Model_Core_Row');

class Model_Order extends Model_Core_Row
{
    protected $billingAddress;
    protected $shippingAddress;
    protected $comment;
    const STATUS_PENDING = 1;
    const STATUS_PROCESSING = 2;
    const STATUS_COMPLETED = 3;
    const STATUS_CANCELLED = 4;
    const STATUS_PENDING_LBL = 'Pending';
    const STATUS_PROCESING_LBL = 'Processing';
    const STATUS_COMPLETED_LBL = 'Completed';
    const STATUS_CANCELLED_LBL = 'Cancelled';
    const STATE_PENDING = 1;
    const STATE_PACKAGING = 2;
    const STATE_SHIPPED = 3;
    const STATE_DELIVERY = 4;
    const STATE_DISPATCHED = 5;
    const STATE_COMPLETED = 6;
    const STATE_PENDING_LBL = 'Pending';
    const STATE_PACKAGING_LBL = 'Packaging';
    const STATE_SHIPPED_LBL = 'Shipped';
    const STATE_DELIVERY_LBL = 'Delivery';
    const STATE_DISPATCHED_LBL = 'Dispatched';
    const STATE_COMPLETED_LBL = 'Completed';

    public function __construct()
    {
        $this->setResourceClassName("Order_Resource");
        parent::__construct();
    }

   public function getStatus($key = null)
    {
        $statuses = [
            self::STATUS_PENDING => self::STATUS_PENDING_LBL,
            self::STATUS_PROCESSING => self::STATUS_PROCESING_LBL,
            self::STATUS_COMPLETED => self::STATUS_COMPLETED_LBL,
            self::STATUS_CANCELLED => self::STATUS_CANCELLED_LBL
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
    public function getState($key = null)
    {
        $states = [
            self::STATE_PENDING => self::STATE_PENDING_LBL,
            self::STATE_PACKAGING => self::STATE_PACKAGING_LBL,
            self::STATE_SHIPPED => self::STATE_SHIPPED_LBL,
            self::STATE_DELIVERY => self::STATE_DELIVERY_LBL,
            self::STATE_DISPATCHED => self::STATE_DISPATCHED_LBL,
            self::STATE_COMPLETED => self::STATE_COMPLETED_LBL

        ];
        if(!$key)
        {
            return $states;
        }

        if(array_key_exists($key, $states)) {
            return $states[$key];
        }
        return $states[self::STATE_PENDING];
    }

    public function getComment($reload = false)
    {

        $commentModel = Ccc::getModel('Order_Comment');
        if(!$this->orderId)
        {
            return $commentModel;
        }
        if($this->comment && !$reload)
        {
            return $this->comment;
        }
        $comment = $commentModel->fetchRow("SELECT * FROM `order_comment` WHERE `orderId` = {$this->orderId}");
        if(!$comment)
        {
            return $commentModel;
        }
        $this->setComment($comment);

        return $this->comment;
    }

    public function setComment(Model_Order_Comment $comment)
    {
        $this->comment = $comment;
        return $this;
    }
}
