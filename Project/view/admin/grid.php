<?php $admins = $this->getAdmins();?>

	<button name="Add"><a href="<?php echo $this->getUrl('add') ?>"><h3>Add</h3></a></button>
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<th>Admin Id</th>
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
				<td><?php echo $admin->adminId ?></td>
				<td><?php echo $admin->firstName ?></td>
				<td><?php echo $admin->lastName ?></td>
				<td><?php echo $admin->email ?></td>
				<td><?php echo $admin->password ?></td>
				<td><?php echo $admin->getStatus($admin->status)?></td>
				<td><?php echo $admin->createdAt ?></td>
				<td><?php echo $admin->updatedAt ?></td>
				<td><a href="<?php echo $this->getUrl('edit','admin',['id'=>$admin->adminId],true) ?>">Edit</a></td>
				<td><a href="<?php echo $this->getUrl('delete','admin',['id'=>$admin->adminId],true) ?>">Delete</a></td>
			</tr>
			<?php endforeach;	?>
		<?php endif;  ?>
		
	</table>