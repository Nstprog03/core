<?php $products=$this->getProducts();	 ?>

	<button name="Add"><a href="<?php echo $this->getUrl('add') ?>"><h3>Add</h3></a></button>
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<th>product Id</th>
			<th>Name</th>
			<th>Base Image</th>
			<th>Thumb Image</th>
			<th>Image</th>
			<th>Price</th>
			<th>Cost Price</th>
			<th>MSP</th>
			<th>Quantity</th>
			<th>Status</th>
			<th>Created Date</th>
			<th>Updated Date</th>
			<th>Edit</th>
			<th>Delete</th>
			<th>Media</th>
			<th>Gallery</th>
		</tr>
		<?php if(!$products):  ?>
			<tr><td colspan="12">No Record available.</td></tr>
		<?php else:  ?>
			<?php foreach ($products as $product): ?>
			<tr>
				<td><?php echo $product->productId ?></td>
				<td><?php echo $product->name ?></td>
				<?php if($product->base): ?>
				<td><img src="<?php echo "Media/Product/".$this->getMedia($product->base)['name']  ?>" alt="No Image Found" width="50" height="50"></td>
				<?php else: ?>
				<td>No Base Image</td>
				<?php endif; ?>	
				<?php if($product->thumb): ?>
				<td><img src="<?php echo "Media/Product/".$this->getMedia($product->thumb)['name']  ?>" alt="No Image Found" width="50" height="50"></td>
				<?php else: ?>
				<td>No Thumb Image</td>
				<?php endif; ?>	
				<?php if($product->small): ?>
				<td><img src="<?php echo "Media/Product/".$this->getMedia($product->small)['name']  ?>" alt="No Image Found" width="50" height="50"></td>
				<?php else: ?>
				<td>No Small Image</td>
				<?php endif; ?>	
				<td><?php echo $product->price ?></td>
				<td><?php echo $product->costPrice ?></td>
				<td><?php echo $product->msp ?></td>
				<td><?php echo $product->quantity ?></td>
				<td><?php echo $product->getStatus($product->status)?></td>
				<td><?php echo $product->createdAt ?></td>
				<td><?php echo $product->updatedAt ?></td>
				<td><a href="<?php echo $this->getUrl('edit','product',['id'=>$product->productId],true) ?>">Edit</a></td>
				<td><a href="<?php echo $this->getUrl('delete','product',['id'=>$product->productId],true) ?>">Delete</a></td>
				<td><a href="<?php echo $this->getUrl('grid','product_media',['id'=>$product->productId],true) ?>">Edit Media</a></td>
				<td><a href="<?php echo $this->getUrl('gallery','product_media',['id'=>$product->productId],true) ?>">Show Media</a></td>
			</tr>
			<?php endforeach;	?>
		<?php endif;  ?>
		
	</table>
	
