
<?php require_once('Adapter.php'); ?>
<?php $id=$_GET['id'];?>
<?php

$id=$_GET['id'];

$adapter=new Adapter();
$product=$adapter->fetchRow("select * FROM `product` WHERE `product`.`product_id` = '$id'");


?>
<html>
<head><title>Product Add</title></head>
<body>

<form action="product.php?a=saveAction&id=<?php echo $id ?>" method="POST">
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<td colspan="2"><b>Product Information</b><input type="text" name="product[product_id]" value="<?php echo $product['product_id'] ?>" hidden></td>
		</tr>
		<tr>
			<td width="10%">Name</td>
			<td><input type="text" name="product[name]" value="<?php echo $product['name'] ?>"></td>
		</tr>
		
		<tr>
			<td width="10%">Price</td>
			<td><input type="text" name="product[price]" value="<?php echo $product['price'] ?>"></td>
		</tr>
		<tr>
			<td width="10%">Quantity</td>
			<td><input type="text" name="product[quantity]" value="<?php echo $product['quantity'] ?>"></td>
		</tr>
		<tr>
			<td width="10%">Status</td>
			<td>
				<select name="product[status]">
					<?php if($product['status']==1): ?>
					<option value="1" selected>Active</option>
					<option value="2">Inactive</option>
					<?php else: ?>
					<option value="1">Active</option>
					<option value="2" selected>Inactive</option>				
					<?php endif; ?>
				</select>
			</td>
		</tr>
		<tr>
			<td width="10%">&nbsp;</td>
			<td>
				<input type="submit" name="submit" value="update">
				<button type="button"><a href="product.php?a=gridAction">Cancel</a></button>
			</td>
		</tr>
		
	</table>	
</form>
</body>
</html>