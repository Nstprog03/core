<?php
$order = $this->getOrder();
$billingAddress = $order->getBillingAddress();
$shippingAddress = $order->getShippingAddress();
$items = $order->getItems();
?>
<table border="1">
    <tr>
        <th>Biling Address</th>
        <th>Shiping Address</th>
    </tr>
    <tr>
        <td>
            <table border="1">
                <tr>
                    <td>First Name</td>
                    <td><?php echo $billingAddress->firstName; ?></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><?php echo $billingAddress->lastName; ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo $billingAddress->email; ?></td>
                </tr>
                <tr>
                    <td>Mobile</td>
                    <td><?php echo $billingAddress->mobile; ?></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><?php echo $billingAddress->address; ?></td>
                </tr>
                <tr>
                    <td>Postal code</td>
                    <td><?php echo $billingAddress->postalCode; ?></td>
                </tr>
                <tr>
                    <td>City</td>
                    <td><?php echo $billingAddress->city; ?></td>
                </tr>
                <tr>
                    <td>State</td>
                    <td><?php echo $billingAddress->state; ?></td>
                </tr>
                <tr>
                    <td>Country</td>
                    <td><?php echo $billingAddress->country; ?></td>
                </tr>
            </table>
        </td>
        <td>
            <table border="1">
                    <tr>
                        <td>First Name</td>
                        <td><?php echo $shippingAddress->firstName; ?></td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td><?php echo $shippingAddress->lastName; ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $shippingAddress->email; ?></td>
                    </tr>
                    <tr>
                        <td>Mobile</td>
                        <td><?php echo $shippingAddress->mobile; ?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><?php echo $shippingAddress->address; ?></td>
                    </tr>
                    <tr>
                        <td>Postal code</td>
                        <td><?php echo $shippingAddress->postalCode; ?></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td><?php echo $shippingAddress->city; ?></td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td><?php echo $shippingAddress->state; ?></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td><?php echo $shippingAddress->country; ?></td>
                    </tr>
            </table>
        </td>
    </tr>
</table>

<table border="1">
    <tr>
        <th>Item Id</th>
        <th>Order Id</th>
        <th>Product Id</th>
        <th>Image</th>
        <th>Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Tax</th>
        <th>Tax Amount</th>
        <th>Discount</th>
    </tr>
    <?php if(!$items): ?>
    <tr>
        <td colspan="6">no item found</td>
    </tr>
    <?php else: ?>
    <?php $i = 0; ?>
    <?php foreach($items as $item): ?>
    <tr>
        <td><?php echo $item->itemId ?></td>
        <td><?php echo $item->orderId ?></td>
        <td><?php echo $item->productId ?></td>
        <td><img src="<?php echo $item->getProduct()->getBase()->getImgPath(); ?>" alt="image not found" width="50" hight="50"></td>
        <td><?php echo $item->name; ?></td>
        <td><?php echo $item->quantity; ?></td>
        <td><?php echo $item->price; ?></td>
        <td><?php echo $item->tax; ?></td>
        <td><?php echo $item->taxAmount; ?></td>
        <td><?php echo $item->discount; ?></td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
    <?php endif;?>
    <tr>
        <td>Shipping Charges</td>
        <td align="right" colspan="9"><?php echo $order->shippingCharge; ?></td>
    </tr>
    <tr>
        <td>Grand Total</td>
        <td align="right" colspan="9"><?php echo $order->grandTotal; ?></td>
    </tr>
</table>
