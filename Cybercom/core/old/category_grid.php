<?php

include 'Adapter.php';

$adapter = new Adapter();
$categories = $adapter->fetchAll('select * FROM `category`');
//print_r($result);





?>
<html>
<head>
</head>
<body>
	<button name="Add"><a href="category_add.php"><h3>Add</h3></a></button>
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<th>
				Category Id
			</th>
			<th>
				Category Name
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
		<?php if(!$categories):  ?>
			<tr><td colspan="7">No Record available.</td></tr>
		<?php else:  ?>
			<?php foreach ($categories as $category): ?>
			<tr>
				<td><?php echo $category['category_id'] ?></td>
				<td><?php echo $category['name'] ?></td>
				<td><?php echo $category['cat_status'] ?></td>
				<td><?php echo $category['created_date'] ?></td>
				<td><?php echo $category['updated_date'] ?></td>
				<td><a href="category_edit.php?id=<?php echo $category['category_id'] ?>">Edit</a></td>
				<td><a href="category_delete.php?id=<?php echo $category['category_id'] ?>">Delete</a></td>
			</tr>
			<?php endforeach;	?>
		<?php endif;  ?>
		
	</table>
	
</body>