<?php

$products = $this->getProducts();
?>

<form action="<?php echo $this->getUrl('save','customer_price') ?>" method="post">
    <input type="submit" value="save">
    <table border="1" width="100%">
        <tr>
            <th>Product Id</th>
            <th>Name</th>
            <th>MRP</th>
            <th>MSP</th>
            <th>Cost</th>
            <th>Discount</th>
        </tr>
        <?php if(!$products): ?>
            <tr>
                <td colspacing = "6">No Product Found</td>
            </tr>
        <?php else: ?>
        <?php $i = 0; ?>
        <?php foreach($products as $product): ?>
        <tr>
            <input type="hidden" name="product[<?php echo $i ?>][productId]" value="<?php echo $product->productId; ?>">
            <input type="hidden" name="product[<?php echo $i ?>][msp]" value="<?php echo $product->msp; ?>">
            <input type="hidden" name="product[<?php echo $i ?>][mrp]" value="<?php echo $product->price; ?>">
            <td><?php echo $product->productId ?></td>
            <td><?php echo $product->name ?></td>
            <td><?php echo $product->price ?></td>
            <td><?php echo $product->msp ?></td>
            <td><?php echo $product->costPrice ?></td>
            <td><input type="text" name="product[<?php echo $i ?>][discount]" value="<?php echo $this->getDiscount($product->productId) ?>"></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
        <?php endif; ?>
    </table>
</form>