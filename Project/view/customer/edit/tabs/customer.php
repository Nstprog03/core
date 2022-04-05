<?php $customer = $this->getCustomer();?>

<div class="card card-info">
    <div class="card-body">
      <div class="form-group row">
        <label for="firstName" class="col-sm-2 col-form-label">First Name<input type="text" name="customer[customerId]" value="<?php echo $customer->customerId ?>" hidden></label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="customer[firstName]" id="firstName" value="<?php echo $customer->firstName ?>" placeholder="First Name">
        </div>
      </div>
      <div class="form-group row">
        <label for="lastName" class="col-sm-2 col-form-label">Last Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="customer[lastName]" id="lastName" value="<?php echo $customer->lastName ?>" placeholder="Last Name">
        </div>
      </div>
      <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control"  name="customer[email]" id="email" value="<?php echo $customer->email ?>" placeholder="Email">
        </div>
      </div>
      <div class="form-group row">
        <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
        <div class="col-sm-10">
            <input type="mobile" class="form-control"  name="customer[mobile]" id="mobile" value="<?php echo $customer->mobile ?>" placeholder="Mobile">
        </div>
      </div>
      <div class="form-group row">
        <label for="status" class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-10">
            <select class="form-control" name="customer[status]" id="pageSelect">
                <option value="1" <?php echo($customer->getStatus($customer->status)=='Active')?'selected':'' ?>>Active</option>
                <option value="2" <?php echo($customer->getStatus($customer->status)=='Inactive')?'selected':'' ?>>Inactive</option>
            </select>
        </div>
      </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="button" class="btn btn-info" id="customerSubmitBtn">Save</button>
        <button type="button" class="btn btn-default" id="customerCancelBtn">Cancel</button>
    </div>
    <!-- /.card-footer -->
</div>

<script>
    $("#customerSubmitBtn").click(function(){
    	
        admin.setForm($("#indexForm"));
        admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
        admin.load();
    });

    $("#customerCancelBtn").click(function(){
        admin.setUrl("<?php echo $this->getUrl('gridBlock','customer'); ?>");
        admin.load();
    });
</script>