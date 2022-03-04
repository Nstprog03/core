
<?php $product=$this->getProduct(); ?>


<form action="<?php echo $this->getUrl('save','product',['id'=>$product->productId],true) ?>" method="POST">
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<td colspan="2"><b>Product Information</b><input type="text" name="product[productId]" value="<?php echo $product->productId ?>" hidden></td>
		</tr>
		<tr>
			<td width="10%">Name</td>
			<td><input type="text" name="product[name]" value="<?php echo $product->name ?>"></td>
		</tr>
		
		<tr>
			<td width="10%">Price</td>
			<td><input type="text" name="product[price]" value="<?php echo $product->price ?>"></td>
		</tr>
		<tr>
			<td width="10%">Quantity</td>
			<td><input type="text" name="product[quantity]" value="<?php echo $product->quantity ?>"></td>
		</tr>
		<tr>
			<td width="10%">Status</td>
			<td>
				<select name="product[status]">
					<option value="1" <?php echo ($product->getStatus($product->status)=='Active')?'selected':'' ?>>Active</option>
					<option value="2" <?php echo ($product->getStatus($product->status)=='Inactive')?'selected':'' ?>>Inactive</option>
				</select>
			</td>
		</tr>
		<tr>
			<td width="10%">&nbsp;</td>
			<td>
				<input type="submit" name="submit" value="update">
				<button type="button"><a href="<?php echo $this->getUrl('grid') ?>">Cancel</a></button>
			</td>
		</tr>
		
	</table>	
