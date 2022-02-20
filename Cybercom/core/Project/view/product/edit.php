
<?php $product=$this->getProduct(); ?>
<html>
<head><title>Product Edit</title></head>
<body>

<form action="<?php echo $this->getUrl('product','save',['id'=>$product['product_id']],true) ?>" method="POST">
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
				<button type="button"><a href="<?php echo $this->getUrl('product','grid') ?>">Cancel</a></button>
			</td>
		</tr>
		
	</table>	
</form>
</body>
</html>