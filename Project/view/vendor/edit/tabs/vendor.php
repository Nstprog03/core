<?php $vendor = $this->getVendor();?>

<div class="card card-info">
    <div class="card-body">
      <div class="form-group row">
        <label for="firstName" class="col-sm-2 col-form-label">First Name<input type="text" name="vendor[vendorId]" value="<?php echo $vendor->vendorId ?>" hidden></label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="vendor[firstName]" id="firstName" value="<?php echo $vendor->firstName ?>" placeholder="First Name">
        </div>
      </div>
      <div class="form-group row">
        <label for="lastName" class="col-sm-2 col-form-label">Last Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="vendor[lastName]" id="lastName" value="<?php echo $vendor->lastName ?>" placeholder="Last Name">
        </div>
      </div>
      <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control"  name="vendor[email]" id="email" value="<?php echo $vendor->email ?>" placeholder="Email">
        </div>
      </div>
      <div class="form-group row">
        <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
        <div class="col-sm-10">
            <input type="mobile" class="form-control"  name="vendor[mobile]" id="mobile" value="<?php echo $vendor->mobile ?>" placeholder="Mobile">
        </div>
      </div>
      <div class="form-group row">
        <label for="status" class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-10">
            <select class="form-control" name="vendor[status]" id="pageSelect">
                <option value="1" <?php echo($vendor->getStatus($vendor->status)=='Active')?'selected':'' ?>>Active</option>
                <option value="2" <?php echo($vendor->getStatus($vendor->status)=='Inactive')?'selected':'' ?>>Inactive</option>
            </select>
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