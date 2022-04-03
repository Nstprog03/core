<?php $address = $this->getAddress();?>
	<div class="card card-info">
    <div class="card-body">
      <div class="form-group row">
        <label for="address" class="col-sm-2 col-form-label">Address</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="address[address]" id="address" value="<?php echo $address->address ?>" placeholder="Address">
        </div>
      </div>
      <div class="form-group row">
        <label for="postalCode" class="col-sm-2 col-form-label">Postal Code</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="address[postalCode]" id="postalcode" value="<?php echo $address->postalCode ?>" placeholder="Postal Code">
        </div>
      </div>
      <div class="form-group row">
        <label for="city" class="col-sm-2 col-form-label">City</label>
        <div class="col-sm-10">
            <input type="city" class="form-control"  name="address[city]" id="city" value="<?php echo $address->city ?>" placeholder="City">
        </div>
      </div>
      <div class="form-group row">
        <label for="state" class="col-sm-2 col-form-label">State</label>
        <div class="col-sm-10">
            <input type="state" class="form-control"  name="address[state]" id="state" value="<?php echo $address->state ?>" placeholder="State">
        </div>
      </div>
      <div class="form-group row">
        <label for="country" class="col-sm-2 col-form-label">Country</label>
        <div class="col-sm-10">
            <input type="country" class="form-control"  name="address[country]" id="country" value="<?php echo $address->state ?>" placeholder="Country">
        </div>
      </div>
      	
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="button" class="btn btn-info" id="vendorSubmitBtn">Save</button>
        <button type="button" class="btn btn-default" id="vendorCancelBtn">Cancel</button>
    </div>
    <!-- /.card-footer -->
</div>

<script>
    $("#vendorSubmitBtn").click(function(){
        admin.setForm($("#indexForm"));
        admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
        admin.load();
    });

    $("#vendorCancelBtn").click(function(){
        admin.setUrl("<?php echo $this->getUrl('gridBlock','vendor'); ?>");
        admin.load();
    });
</script>