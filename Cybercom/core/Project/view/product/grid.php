<?php
$products=$this->getData('products');
$controllerProducts = new Controller_Product();


?>
<html>
<head>
</head>
<body>
	<button name="Add"><a href="index.php?c=product&a=add"><h3>Add</h3></a></button>
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<th>product Id</th>
			<th>Name</th>
			<th>Price</th>
			<th>Quantity</th>
			<th>Status</th>
			<th>Created Date</th>
			<th>Updated Date</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?php if(!$products):  ?>
			<tr><td colspan="9">No Record available.</td></tr>
		<?php else:  ?>
			<?php foreach ($products as $product): ?>
			<tr>
				<td><?php echo $product['product_id'] ?></td>
				<td><?php echo $product['name'] ?></td>
				<td><?php echo $product['price'] ?></td>
				<td><?php echo $product['quantity'] ?></td>
				<td><?php if($product['status']==1):echo "Active";else : echo "Inactive"; endif;?></td>
				<td><?php echo $product['created_date'] ?></td>
				<td><?php echo $product['updated_date'] ?></td>
				<td><a href="index.php?c=product&a=edit&id=<?php echo $product['product_id'] ?>">Edit</a></td>
				<td><a href="index.php?c=product&a=delete&id=<?php echo $product['product_id'] ?>">Delete</a></td>
			</tr>
			<?php endforeach;	?>
		<?php endif;  ?>
		
	</table>
	
</body>