<?php
$cart = $this->getCart();
$shippingMethods = $this->getShippingMethods();
$paymentMethods = $this->getPaymentMethods();
?>
<div>
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Price Information</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Payment Method</th>
                        <th>Shipping Method</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="col-sm-6">
                                <!-- radio -->
                                <div class="form-group">
                                    <?php foreach ($paymentMethods as $paymentMethod) : ?>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="paymentMethod" value="<?php echo $paymentMethod->methodId ?>" id="paymentMethod<?php echo $paymentMethod->methodId ?>" <?php echo ($paymentMethod->methodId == $cart->paymentMethod)?'checked' : '' ?>>
                                <label for="paymentMethod<?php echo $paymentMethod->methodId ?>" class="custom-control-label"><?php echo $paymentMethod->name ?></label>

                            </div>
                            <?php endforeach;?>
                                    <div>
                                        <input type="button" id="cartPaymentMethodSubmitBtn" class="btn btn-primary" name="submit" value="Update">
                                    </div>
                                </div>
                            </div>

                            <!-- <form action="" method="post">
                            </form> -->
                        </td>
                        <td>
                            <div class="col-sm-6">
                                <!-- radio -->
                                <div class="form-group">
                                    <?php foreach ($shippingMethods as $shippingMethod) : ?>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" name="shippingMethod" value="<?php echo $shippingMethod->charge ?>" id="shippingMethod<?php echo $shippingMethod->methodId ?>" <?php echo ($shippingMethod->methodId == $cart->shippingMethod)?'checked' : '' ?>>
                                <label for="shippingMethod<?php echo $shippingMethod->methodId ?>" class="custom-control-label"><?php echo $shippingMethod->name." : ".$shippingMethod->charge ?>   </label>

                            </div>
                            <?php endforeach;?>
                                    </div>
                                    <div>
                                        <input type="button" id="cartShippingMethodSubmitBtn" class="btn btn-primary" name="submit" value="Update">
                                    </div>
                                </div>
                            </div>
                            <!-- <form action="" method="post">
                            </form> -->
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $("#cartPaymentMethodSubmitBtn").click(function(){
        admin.setForm(jQuery("#indexForm"));
        admin.setUrl("<?php echo $this->getUrl('savePaymentMethod') ?>");
        admin.load();
    });

    $("#cartShippingMethodSubmitBtn").click(function(){
        admin.setForm(jQuery("#indexForm"));
        admin.setUrl("<?php echo $this->getUrl('saveShippingMethod') ?>");
        admin.load();
    });
</script>
