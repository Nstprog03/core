<?php $products = $this->getProducts();?>

    <input type="button" id="customerPriceSubmitFormBtn" value="save">
    <Button type="button" id="cancel">Cancel</Button>
    <table border="1" width="100%">
        <tr>
            <th>Product Id</th>
            <th>sku</th>
            <th>Name</th>
            <th>Price</th>
            <th>Salesman Price</th>
            <th>Coustomer Price</th>
        </tr>
        <?php if(!$products): ?>
            <tr>
                <td colspan = "7">Salesman not assign</td>
            </tr>
        <?php else: ?>
        <?php $i = 0; ?>
        <?php foreach($products as $product): ?>
        <tr>
            <input type="hidden" name="product[<?php echo $i ?>][productId]" value="<?php echo $product->productId; ?>">
            <input type="hidden" name="product[<?php echo $i ?>][salesmanPrice]" value="<?php echo $this->getSalesmanPrice($product->productId); ?>">
            <td><?php echo $product->productId ?></td>
            <td><?php echo $product->sku ?></td>
            <td><?php echo $product->name ?></td>
            <td><?php echo $product->price ?></td>
            <td><?php echo $this->getSalesmanPrice($product->productId); ?>
            <td><input type="text" name="product[<?php echo $i ?>][price]" value="<?php echo $this->getCustomerPrice($product->productId) ?>"></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
        <?php endif; ?>
    </table>
<script>
    $("#customerPriceSubmitFormBtn").click(function(){
        
        admin.setForm($("#indexForm"));
        admin.setUrl("<?php echo $this->getUrl('save','customer_price'); ?>");
        //alert(admin.getUrl());
        admin.load();
    });

    $("#cancel").click(function(){
        admin.setUrl("<?php echo $this->getUrl('gridBlock','customer'); ?>");
        admin.load();
    });
</script>