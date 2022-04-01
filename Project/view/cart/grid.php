<?php $orders = $this->getOrders(); ?>
<a href="<?php echo $this->getUrl('edit','cart') ?>"><button>Add New</button></a>

<br>
<br>
<br>
<br>
<table border="1">
    <tr>
        <th>Order Id</th>
        <th>Customer Id</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Mobile</th>
        <th>Grand Total</th>
        <th>Action</th>
    </tr>
    <?php if(!$orders): ?>
    <tr>
        <td colspan="7">No order found</td>
    </tr>
    <?php else: ?>
    <?php foreach($orders as $order): ?>
    <tr>
        <td><?php echo $order->orderId ?></td>
        <td><?php echo $order->customerId ?></td>
        <td><?php echo $order->firstName ?></td>
        <td><?php echo $order->lastName ?></td>
        <td><?php echo $order->email ?></td>
        <td><?php echo $order->mobile ?></td>
        <td><?php echo $order->grandTotal ?></td>
        <td><a href="<?php echo $this->getUrl('edit','order',['id' => $order->orderId],true); ?>">View Order</a></td>
    </tr>
    <?php endforeach; ?>
    <?php endif; ?>
</table>