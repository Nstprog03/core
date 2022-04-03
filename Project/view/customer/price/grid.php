<?php $products = $this->getProducts(); ?>

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Price Information</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Product Id</th>
                    <th>Name</th>
                    <th>SKU</th>
                    <th>Price</th>
                    <th>Salesman Price</th>
                    <th>Customer Price</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!$products): ?>
                <tr>
                    <td colspan = "6">No Product Found</td>
                </tr>
                <?php else: ?>
                <?php $i = 0; ?>
                <?php foreach($products as $product): ?>
                <tr>
                    <div class="row">
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" name="product[<?php echo $i ?>][productId]" value="<?php echo $product->productId; ?>">
                            <input type="hidden" class="form-control" name="product[<?php echo $i ?>][salesmanPrice]" value="<?php echo $this->getSalesmanPrice($product->productId); ?>">
                            <td><?php echo $product->productId ?></td>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <td><?php echo $product->name ?></td>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <td><?php echo $product->sku ?></td>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <td><?php echo $product->price ?></td>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <td><?php echo $this->getSalesmanPrice($product->productId); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <td><input type="text" class="form-control" name="product[<?php echo $i ?>][price]" value="<?php echo $this->getCustomerPrice($product->productId) ?>"></td>
                        </div>
                    </div>
                </tr>
                <?php $i++; ?>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <button type="button" class="btn btn-info" id="customerPriceSubmitBtn" <?php echo (!$products) ? 'disabled' : ''; ?>>Save</button>
        <button type="button" class="btn btn-default" id="customerPriceCancelBtn">Cancel</button>
    </div>
</div>
<script>
    $("#customerPriceSubmitBtn").click(function(){
        admin.setForm($("#indexForm"));
        admin.setUrl("<?php echo $this->getUrl('save','customer_price'); ?>");
        admin.load();
    });

    $("#customerPriceCancelBtn").click(function(){
        admin.setUrl("<?php echo $this->getUrl('gridBlock','customer'); ?>");
        admin.load();
    });
</script>