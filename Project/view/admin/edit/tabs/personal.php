<?php $admin = $this->getAdmin();?>

<div class="card card-info">
    <div class="card-body">
      <div class="form-group row">
        <label for="firstName" class="col-sm-2 col-form-label">First Name<input type="text" name="admin[adminId]" value="<?php echo $admin->adminId ?>" hidden></label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="admin[firstName]" id="firstName" value="<?php echo $admin->firstName ?>" placeholder="First Name">
        </div>
      </div>
      <div class="form-group row">
        <label for="lastName" class="col-sm-2 col-form-label">Last Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control"  name="admin[lastName]" id="lastName" value="<?php echo $admin->lastName ?>" placeholder="Last Name">
        </div>
      </div>
      <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control"  name="admin[email]" id="email" value="<?php echo $admin->email ?>" placeholder="Email">
        </div>
      </div>
      <?php if(!$admin->adminId):?>
      <div class="form-group row">
        <label for="password" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control"  name="admin[password]" id="password" value="<?php echo $admin->password ?>" placeholder="Password">
        </div>
      </div>
      <?php endif; ?>
      <div class="form-group row">
        <label for="status" class="col-sm-2 col-form-label">Status</label>
        <div class="col-sm-10">
            <select class="form-control" name="admin[status]" id="pageSelect">
                <option value="1" <?php echo($admin->getStatus($admin->status)=='Active')?'selected':'' ?>>Active</option>
                <option value="2" <?php echo($admin->getStatus($admin->status)=='Inactive')?'selected':'' ?>>Inactive</option>
            </select>
        </div>
      </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="button" class="btn btn-info" id="adminSubmitBtn">Save</button>
        <button type="button" class="btn btn-default" id="adminCancelBtn">Cancel</button>
    </div>
    <!-- /.card-footer -->
</div>

<script>
    $("#adminSubmitBtn").click(function(){
        admin.setForm($("#indexForm"));
        admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
        admin.load();
    });

    $("#adminCancelBtn").click(function(){
        admin.setUrl("<?php echo $this->getUrl('gridBlock','admin'); ?>");
        admin.load();
    });
</script>