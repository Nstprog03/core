<?php

	
	$admins = $this->getData('admins');


?>
<html>
<head>
</head>
<body>
	<button name="Add"><a href="index.php?c=admin&a=add"><h3>Add</h3></a></button>
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<th>admin Id</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Password</th>
			<th>Status</th>
			<th>Created Date</th>
			<th>Updated Date</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?php if(!$admins):  ?>
			<tr><td colspan="10">No Record available.</td></tr>
		<?php else:  ?>
			<?php foreach ($admins as $admin): ?>
			<tr>
				<td><?php echo $admin['admin_id'] ?></td>
				<td><?php echo $admin['firstName'] ?></td>
				<td><?php echo $admin['lastName'] ?></td>
				<td><?php echo $admin['email'] ?></td>
				<td><?php echo $admin['password'] ?></td>
				<td><?php if($admin['status']==1):echo "Active";else : echo "Inactive"; endif;?></td>
				<td><?php echo $admin['created_date'] ?></td>
				<td><?php echo $admin['updated_date'] ?></td>
				<td><a href="index.php?c=admin&a=edit&id=<?php echo $admin['admin_id'] ?>">Edit</a></td>
				<td><a href="index.php?c=admin&a=delete&id=<?php echo $admin['admin_id'] ?>">Delete</a></td>
			</tr>
			<?php endforeach;	?>
		<?php endif;  ?>
		
	</table>
	
</body>