
<?php $product=$this->getProduct(); ?>
<?php $categories=$this->getCategories(); ?>	

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
			<td width="10%">MSP</td>
			<td><input type="text" name="product[msp]" value="<?php echo $product->msp ?>"></td>
		</tr>
		<tr>
			<td width="10%">Cost Price</td>
			<td><input type="text" name="product[costPrice]" value="<?php echo $product->costPrice ?>"></td>
		</tr>
		<tr>
			<td width="10%">Discount</td>
			<td><input type="text" name="product[discount]" value="<?php echo $product->discount ?>">
			In Percentage:<input type="radio" name="discountMethod" value="1">&nbsp;&nbsp;&nbsp;
			In Money:<input type="radio" name="discountMethod" value="2" checked ></td>
		</tr>
		<tr>
			<td width="10%">Tax</td>
			<td><input type="text" name="product[tax]" value="<?php echo $product->tax ?>"></td>
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
			<td><h4>Categories<h4></td>
			<td>
				<table border="1" width="100%">
					<tr>
						<th>Select</th>
						<th>Category Id</th>
						<th>Category</th>
					</tr>
					<?php if(!$categories): ?>
					<tr>
						<td colspan="3">No category Found</td>
					</tr>
					<?php else: ?>
					<?php foreach($categories as $category): ?>
					<?php $tag = ($this->selected($category->categoryId)=='checked')?'exists':'new' ?>
					<tr>
						<td> <input type="checkbox" name="category[<?php echo $tag ?>][]" value="<?php echo $category->categoryId ?>" <?php echo $this->selected($category->categoryId); ?>> </td>
						<td><?php echo $category->categoryId; ?></td>
						<td><?php echo $this->getPath($category->categoryId,$category->path) ?></td>
					</tr>

					<?php endforeach; ?>

					<?php endif; ?>
				</table>
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
