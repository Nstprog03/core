<?php $billingAddress = $this->getBillingAddress();?>
<?php $shippingAddress = $this->getShippingAddress();?>

<table>
	<tr>
		<label for="address" class="col-sm-2 col-form-label">Billing Address</label>
	</tr>
	<div class="card card-info">
    <div class="card-body">
      <div class="form-group row">
        <label for="address" class="col-sm-2 col-form-label">Address</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="billingAddress[address]" id="billingaddress" value="<?php echo $billingAddress->address ?>" placeholder="Address">
        </div>
      </div>
      <div class="form-group row">
        <label for="postalCode" class="col-sm-2 col-form-label">Postal Code</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="billingAddress[postalCode]" id="billingpostalcode" value="<?php echo $billingAddress->postalCode ?>" placeholder="Postal Code">
        </div>
      </div>
      <div class="form-group row">
        <label for="city" class="col-sm-2 col-form-label">City</label>
        <div class="col-sm-10">
            <input type="city" class="form-control"  name="billingAddress[city]" id="billingcity" value="<?php echo $billingAddress->city ?>" placeholder="City">
        </div>
      </div>
      <div class="form-group row">
        <label for="state" class="col-sm-2 col-form-label">State</label>
        <div class="col-sm-10">
            <input type="state" class="form-control"  name="billingAddress[state]" id="billingstate" value="<?php echo $billingAddress->state ?>" placeholder="State">
        </div>
      </div>
      <div class="form-group row">
        <label for="country" class="col-sm-2 col-form-label">Country</label>
        <div class="col-sm-10">
            <input type="country" class="form-control"  name="billingAddress[country]" id="billingcountry" value="<?php echo $billingAddress->state ?>" placeholder="Country">
        </div>
      </div>
      	<tr>
			<label for="address" class="col-sm-2 col-form-label">Shipping Address</label>
		</tr>
		<div class="card card-info">
    <div class="card-body">
    <div class="form-group row">
            <label for="Address" class="col-sm-2 col-form-label">&nbsp;</label>
            <div class="col-sm-10">
                 <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="copyAddress" id="sameBill" onchange="same()">
                    <label for="copyAddress" class="form-check-label">Same as Billing Address</label>
                </div>
            </div>
        </div>
      <div class="form-group row">
        <label for="address" class="col-sm-2 col-form-label">Address</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="shippingAddress[address]" id="shippingaddress" value="<?php echo $shippingAddress->address ?>" placeholder="Address">
        </div>
      </div>
      <div class="form-group row">
        <label for="postalCode" class="col-sm-2 col-form-label">Postal Code</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="shippingAddress[postalCode]" id="shippingpostalcode" value="<?php echo $shippingAddress->postalCode ?>" placeholder="Postal Code">
        </div>
      </div>
      <div class="form-group row">
        <label for="city" class="col-sm-2 col-form-label">City</label>
        <div class="col-sm-10">
            <input type="city" class="form-control"  name="shippingAddress[city]" id="shippingcity" value="<?php echo $shippingAddress->city ?>" placeholder="City">
        </div>
      </div>
      <div class="form-group row">
        <label for="state" class="col-sm-2 col-form-label">State</label>
        <div class="col-sm-10">
            <input type="state" class="form-control"  name="shippingAddress[state]" id="shippingstate" value="<?php echo $shippingAddress->state ?>" placeholder="State">
        </div>
      </div>
      <div class="form-group row">
        <label for="country" class="col-sm-2 col-form-label">Country</label>
        <div class="col-sm-10">
            <input type="country" class="form-control"  name="shippingAddress[country]" id="shippingcountry" value="<?php echo $shippingAddress->state ?>" placeholder="Country">
        </div>
      </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="button" class="btn btn-info" id="customerBtnSubmitBtn">Save</button>
        <button type="button" class="btn btn-default" id="customerBtnCancelBtn">Cancel</button>
    </div>
    <!-- /.card-footer -->
</div>

</table>
		<input type="hidden" name="billingAddress[billing]" value="1">
		<input type="hidden" name="billingAddress[shipping]" value="2">
		<input type="hidden" name="shippingAddress[shipping]" value="1">
		<input type="hidden" name="shippingAddress[billing]" value="2">

<script type="text/javascript">
    function same() {
            var checkedBox = document.getElementById("sameBill");
            if(checkedBox.checked == true){
                document.getElementById("shippingaddress").value = document.getElementById("billingaddress").value; 
				document.getElementById("shippingpostalcode").value = document.getElementById("billingpostalcode").value; 
				document.getElementById("shippingcity").value = document.getElementById("billingcity").value; 
				document.getElementById("shippingstate").value = document.getElementById("billingstate").value; 
				document.getElementById("shippingcountry").value = document.getElementById("billingcountry").value; 
            }
            else{
                    document.getElementById("shippingaddress").value = null; 
                    document.getElementById("shippingpostalcode").value = null; 
                    document.getElementById("shippingcity").value = null; 
                    document.getElementById("shippingstate").value = null; 
                    document.getElementById("shippingcountry").value = null; 
            }
    }
</script>
<script>
    $("#customerSubmitBtn").click(function(){
        admin.setForm($("#indexForm"));
        admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
        admin.load();
    });

    $("#cancel").click(function(){
        admin.setUrl("<?php echo $this->getUrl('gridBlock','customer'); ?>");
        admin.load();
    });
</script>