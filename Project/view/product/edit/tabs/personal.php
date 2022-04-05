<?php $product = $this->getProduct(); ?>

<section class="content">
    <div class="container-fluid">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">Personal Information</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="form-group">
                <label for="exampleInputFirstName1">sku</label>
                <input type="text" name="product[sku]" value="<?php echo $product->sku ?>" class="form-control" id="exampleInputFirstName1" placeholder="sku">
                </div>
                <div class="form-group">
                <label for="exampleInputLastName1">Name</label>
                <input type="text" name="product[name]" value="<?php echo $product->name ?>" class="form-control" id="exampleInputLastName1" placeholder="Name">
                </div>
                <div class="form-group">
                <label for="exampleInputEmail1">Price</label>
                <input type="float" name="product[price]" value="<?php echo $product->price ?>" class="form-control" id="exampleInputEmail1" placeholder="Price">
                </div>
                <div class="form-group">
                <label for="exampleInputEmail1">Cost Price</label>
                <input type="float" name="product[costPrice]" value="<?php echo $product->costPrice ?>" class="form-control" id="exampleInputEmail1" placeholder="Cost Price">
                </div>
                <div class="form-group">
                <label for="exampleInputEmail1">MSP</label>
                <input type="float" name="product[msp]" value="<?php echo $product->msp ?>" class="form-control" id="exampleInputEmail1" placeholder="MSP">
                </div>
                <div class="form-group">
                <label for="exampleInputEmail1">Discount</label>
                <input type="float" name="product[discount]" value="<?php echo $product->discount ?>" class="form-control" id="exampleInputEmail1" placeholder="Discount">
                In Percentage:<input type="radio" name="discountMethod" value="1">&nbsp;&nbsp;&nbsp;
                In Money:<input type="radio" name="discountMethod" value="2" checked>
                </div>
                <div class="form-group">
                <label for="exampleInputEmail1">Tax</label>
                <input type="float" name="product[tax]" value="<?php echo $product->tax ?>" class="form-control" id="exampleInputEmail1" placeholder="Tax">
                </div>
                <div class="form-group">
                <label for="exampleInputEmail1">Quantity</label>
                <input type="number" name="product[quantity]" value="<?php echo $product->quantity ?>" class="form-control" id="exampleInputEmail1" placeholder="Quantity">
                </div>
                <div class="row">
                <div class="col-sm-6">
                    <!-- select -->
                    <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="product[status]">
                        <option value="1" <?php echo ($product->getStatus($product->status)=='Enabel')?'selected':'' ?>>Enabel</option>
                        <option value="2" <?php echo ($product->getStatus($product->status)=='Disabled')?'selected':'' ?>>Disabled</option>
                    </select>
                    </div>
                </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <input type="button" id="productFormSubmitBtn" class="btn btn-primary" name="submit" value="save">
                <button type="button" id="productFromCancelBtn" class="btn btn-primary" >Cancel</button>
            </div>
        </div>
        <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<input type="hidden" name="product[productId]" value="<?php echo $product->productId ?>" class="form-control" id="exampleInputFirstName1">
<script type="text/javascript">

jQuery("#productFromCancelBtn").click(function(){
	admin.setUrl("<?php echo $this->getUrl('gridBlock','product',['id' => null]); ?>");
	admin.load();
});

jQuery("#productFormSubmitBtn").click(function(){
	admin.setForm(jQuery("#indexForm"));
	admin.setUrl("<?php echo $this->getEdit()->getSaveUrl();?>");
	admin.load();
});
</script>

