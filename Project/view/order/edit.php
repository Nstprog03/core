<?php 
$order = $this->getOrder();
$billingAddress = $order->getBillingAddress();
$shippingAddress = $order->getShippingAddress();
$items = $order->getItems();
$comment = $order->getComment();

?>

<table class="table table-bordered table-striped">
    <tr>
        <th>Biling Address</th>
        <th>Shiping Address</th>
    </tr>
    <tr>
        <td>
            <table class="table table-bordered table-striped">
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
                    <td>City</td>
                    <td><?php echo $billingAddress->city; ?></td>
                </tr>
                <tr>
                    <td>State</td>
                    <td><?php echo $billingAddress->state; ?></td>
                </tr>
                <tr>
                    <td>Postal Code</td>
                    <td><?php echo $billingAddress->postalCode; ?></td>
                </tr>
                <tr>
                    <td>Country</td>
                    <td><?php echo $billingAddress->country; ?></td>
                </tr>
            </table>
        </td>
        <td>
            <table class="table table-bordered table-striped">
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
                        <td>City</td>
                        <td><?php echo $shippingAddress->city; ?></td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td><?php echo $shippingAddress->state; ?></td>
                    </tr>
                    <tr>
                        <td>Postal Code</td>
                        <td><?php echo $shippingAddress->postalCode; ?></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td><?php echo $shippingAddress->country; ?></td>
                    </tr>
            </table>
        </td>
    </tr>
</table>

<table class="table table-bordered table-striped">
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
        <td><img src="Media/Product/<?php echo $item->getProduct()->getBase()->name; ?>" alt="image not found" width="50" hight="50"></td>
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
        <td>Shiping Charge</td>
        <td align="right" colspan="9"><?php echo $order->shippingCharge; ?></td>
    </tr>
    <tr>
        <td>Grand Total</td>
        <td align="right" colspan="9"><?php echo $order->grandTotal; ?></td>
    </tr>
</table>

<div id="orderStatus">
    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="exampleInputNote1">Note</label>
                                <input type="text" name="order[note]" value="<?php echo $comment->note ?>" class="form-control" id="exampleInputNote1" placeholder="Enter Note">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                    <div class="col-sm-12">
                        <!-- select -->
                        <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="order[status]">
                            <option value="1" <?php echo ($order->getStatus($order->status)=='Pending')?'selected':'' ?>>Pending</option>
                            <option value="2" <?php echo ($order->getStatus($order->status)=='Processing')?'selected':'' ?>>Processing</option>
                            <option value="3" <?php echo ($order->getStatus($order->status)=='Completed')?'selected':'' ?>>Completed</option>
                            <option value="4" <?php echo ($order->getStatus($order->status)=='Cancelled')?'selected':'' ?>>Cancelled</option>
                        </select>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                    <div class="col-sm-12">
                        <!-- select -->
                        <div class="form-group">
                        <label>state</label>
                        <select class="form-control" name="order[state]">
                            <option value="1" <?php echo ($order->getState($order->state)=='Pending')?'selected':'' ?>>Pending</option>
                            <option value="2" <?php echo ($order->getState($order->state)=='Packaging')?'selected':'' ?>>Packaging</option>
                            <option value="3" <?php echo ($order->getState($order->state)=='Shipped')?'selected':'' ?>>Shipped</option>
                            <option value="4" <?php echo ($order->getState($order->state)=='Delivery')?'selected':'' ?>>Delivery</option>
                            <option value="5" <?php echo ($order->getState($order->state)=='Dispatched')?'selected':'' ?>>Dispatched</option>
                            <option value="6" <?php echo ($order->getState($order->state)=='Completed')?'selected':'' ?>>Completed</option>
                        </select>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                    <div class="col-sm-12">
                        <!-- select -->
                        <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="order[customerNotified]">
                            <option value="1" <?php echo ($comment->customerNotified == 1)?'selected':'' ?>>Yes</option>
                            <option value="2" <?php echo ($comment->customerNotified == 2)?'selected':'' ?>>No</option>
                        </select>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" id="orderStatusUpdateBtn" class="btn btn-primary" name="submit" value="<?php echo $order->orderId ?>">Update</button>
                    <button type="button" id="orderCancelBtn" class="btn btn-primary">Cancel</button>
                </div>
            </div>
            <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
</div>

<script type="text/javascript">
    $("#orderStatusUpdateBtn").click(function(){
        admin.setForm(jQuery("#indexForm"));
        admin.setUrl("<?php echo $this->getUrl('statusUpdate','order'); ?>");
        admin.setType('POST');
        admin.load();
    });

    $("#orderCancelBtn").click(function(){
        admin.setUrl("<?php echo $this->getUrl('gridBlock','cart',['id' => null]); ?>");
        admin.load();
    })
</script>