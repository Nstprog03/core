<?php

include 'Adapter.php';

$adapter = new Adapter();
$result=$adapter->fetchAll('select * FROM `products`');
//print_r($result);





?>
<html>
<head>
</head>
<body>
	<table border="3">
		<tr>
			<th>
				Product Id
			</th>
			<th>
				Product Name
			</th>
			<th>
				Price
			</th>
			<th>
				Quantity
			</th>
			<th>
				Status
			</th>
			<th>
				Create Date
			</th>
			<th>
				Update Date
			</th>
			<th>
				Edit
			</th>
			<th>
				Delete
			</th>
		</tr>
		<?php for($i=0;$i<count($result);$i++){ ?>
		<tr>
			<td><?php echo($i+1) ?></td>
			<td><?php echo($result[$i]['name']) ?></td>
			<td><?php echo($result[$i]['price']) ?></td>
			<td><?php echo($result[$i]['quantity']) ?></td>
			<td><?php echo($result[$i]['pro_status']) ?></td>
			<td><?php echo($result[$i]['created_date']) ?></td>
			<td><?php echo($result[$i]['updated_date']) ?></td>
			<td ><a href="product_edit.php?id=<?php echo $result[$i]['product_id']?>">Edit</a></td>
			<td><a href="product_delete.php?id=<?php echo $result[$i]['product_id']?>">Delete</a></td>
		</tr>
	<?php }?>
	</table>
	
		<button name="Add"><a href="product_add.php"><h3>Add</h3></a></button>
	
</body>