<?php
$adapter = new Adapter();
$categories = $adapter->fetchAll('select * FROM `category`');


?>
<html>
<head>
</head>
<body>
	<button name="Add"><a href="category.php?a=addAction"><h3>Add</h3></a></button>
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<th>Category Id</th>
			<th>Category Name</th>
			<th>Status</th>
			<th>Created Date</th>
			<th>Updated Date</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?php if(!$categories):  ?>
			<tr><td colspan="7">No Record available.</td></tr>
		<?php else:  ?>
			<?php foreach ($categories as $category): ?>
			<tr>
				<td><?php echo $category['category_id'] ?></td>
				<td><?php echo $category['name'] ?></td>
				<td><?php if($category['status']==1):echo "Active";else : echo "Inactive"; endif;?></td>
				<td><?php echo $category['created_date'] ?></td>
				<td><?php echo $category['updated_date'] ?></td>
				<td><a href="category.php?a=editAction&id=<?php echo $category['category_id'] ?>">Edit</a></td>
				<td><a href="category.php?a=deleteAction&id=<?php echo $category['category_id'] ?>">Delete</a></td>
			</tr>
			<?php endforeach;	?>
		<?php endif;  ?>
		
	</table>
	
</body>