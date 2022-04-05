<?php $salesman = $this->getSalesman();?>

<div class="card card-info">
        <div class="card-body">
          <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">First Name<input type="text" name="salesman[salesmanId]" value="<?php echo $salesman->salesmanId ?>" hidden></label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  name="salesman[firstName]" id="firstName" value="<?php echo $salesman->firstName ?>" placeholder="First Name">
            </div>
        </div>
            <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Last Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  name="salesman[lastName]" id="lastName" value="<?php echo $salesman->lastName ?>" placeholder="Last Name">
            </div>
          </div>
          <div class="form-group row">
            <label for="code" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  name="salesman[email]" id="email" value="<?php echo $salesman->email ?>" placeholder="Email">
            </div>
          </div>
          <div class="form-group row">
            <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
            <div class="col-sm-10">
                <input type="number" class="form-control"  name="salesman[mobile]" id="mobile" value="<?php echo $salesman->mobile ?>" placeholder="Mobile">
            </div>
          </div>
          <div class="form-group row">
            <label for="discount" class="col-sm-2 col-form-label">Discount</label>
            <div class="col-sm-10">
                <input type="number" class="form-control"  name="salesman[discount]" id="discount" value="<?php echo $salesman->discount ?>" placeholder="Discount">
            </div>
          </div>
          <div class="form-group row">
            <label for="status" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
                <select class="form-control" name="salesman[status]" id="salesmanSelect">
                    <option value="1" <?php echo($salesman->getStatus($salesman->status)=='Active')?'selected':'' ?>>Active</option>
                    <option value="2" <?php echo($salesman->getStatus($salesman->status)=='Inactive')?'selected':'' ?>>Inactive</option>
                </select>
            </div>
          </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="button" class="btn btn-info" id="salesmanSubmitBtn">Save</button>
            <button type="button" class="btn btn-default" id="salesmanCancelBtn">Cancel</button>
        </div>
        <!-- /.card-footer -->
    </div>
</div>
</div>

            
<script>
    $("#salesmanSubmitBtn").click(function(){
        admin.setForm($("#indexForm"));
        admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
        admin.load();
    });

    $("#salesmanCancelBtn").click(function(){
        admin.setUrl("<?php echo $this->getUrl('gridBlock','salesman'); ?>");
        admin.load();
    });
</script>