<?php 
$cart = $this->getCart();
$billingAddress = $cart->getBillingAddress();
$shippingAddress = $cart->getShippingAddress();

?>

<div>
    <section class="content">
		<div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                        <h3 class="card-title">Billing Address</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                            <label for="exampleInputFirstName">First Name</label>
                            <input type="text" name="billingAddress[firstName]" value="<?php echo $billingAddress->firstName ?>" class="form-control" id="exampleInputFirstName" placeholder="Enter First Name">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputLastName">Last Name</label>
                            <input type="text" name="billingAddress[lastName]" value="<?php echo $billingAddress->lastName ?>" class="form-control" id="exampleInputLastName" placeholder="Enter Last Name">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputAddress">Address</label>
                            <input type="text" name="billingAddress[address]" value="<?php echo $billingAddress->address ?>" class="form-control" id="exampleInputAddress" placeholder="Enter Address">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputCity">City</label>
                            <input type="text" name="billingAddress[city]" value="<?php echo $billingAddress->city ?>" class="form-control" id="exampleInputCity" placeholder="Enter City">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputState">State</label>
                            <input type="text" name="billingAddress[state]" value="<?php echo $billingAddress->state ?>" class="form-control" id="exampleInputState" placeholder="Enter State">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputPosatalCode">Postal Code</label>
                            <input type="number" name="billingAddress[postalCode]" value="<?php echo $billingAddress->postalCode ?>" class="form-control" id="exampleInputPosatalCode" placeholder="Enter Postal Code">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputCountry">Country</label>
                            <input type="text" name="billingAddress[country]" value="<?php echo $billingAddress->country ?>" class="form-control" id="exampleInputCountry" placeholder="Enter Country">
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input custom-control-input-info" type="checkbox" id="customCheckbox4" onclick="same()">
                                <label for="customCheckbox4" class="custom-control-label">Same as Shipping Address</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input custom-control-input-info" name="saveInBillingBook" value="1" type="checkbox" id="customCheckbox5">
                                <label for="customCheckbox5" class="custom-control-label">Save to Address Book</label>
                            </div>
                        </div>
                        <div class="card-footer">
                        <input type="button" id="customerAddressSubmitBtn" class="btn btn-primary" name="submit" value="Save">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                        <h3 class="card-title">Shipping Address</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                            <label for="exampleInputFirstName1">First Name</label>
                            <input type="text" name="shippingAddress[firstName]" value="<?php echo $shippingAddress->firstName ?>" class="form-control" id="exampleInputFirstName1" placeholder="Enter First Name">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputLastName1">Last Name</label>
                            <input type="text" name="shippingAddress[lastName]" value="<?php echo $shippingAddress->lastName ?>" class="form-control" id="exampleInputLastName1" placeholder="Enter Last Name">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputAddress1">Address</label>
                            <input type="text" name="shippingAddress[address]" value="<?php echo $shippingAddress->address ?>" class="form-control" id="exampleInputAddress1" placeholder="Enter Address">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputCity1">City</label>
                            <input type="text" name="shippingAddress[city]" value="<?php echo $shippingAddress->city ?>" class="form-control" id="exampleInputCity1" placeholder="Enter City">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputState1">State</label>
                            <input type="text" name="shippingAddress[state]" value="<?php echo $shippingAddress->state ?>" class="form-control" id="exampleInputState1" placeholder="Enter State">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputPosatalCode1">Postal Code</label>
                            <input type="number" name="shippingAddress[postalCode]" value="<?php echo $shippingAddress->postalCode ?>" class="form-control" id="exampleInputPosatalCode1" placeholder="Enter Postal Code">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputCountry1">Country</label>
                            <input type="text" name="shippingAddress[country]" value="<?php echo $shippingAddress->country ?>" class="form-control" id="exampleInputCountry1" placeholder="Enter Country">
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input custom-control-input-info" name="saveInShippingBook" value="1" type="checkbox" id="customCheckbox6">
                                <label for="customCheckbox6" class="custom-control-label">Save to Address Book</label>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
		    <!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
</div>

<script>
    $("#customerAddressSubmitBtn").click(function(){
        admin.setForm(jQuery("#indexForm"));
        admin.setUrl("<?php echo $this->getUrl('saveCartAddress') ?>");
        admin.load();
    });

</script>
