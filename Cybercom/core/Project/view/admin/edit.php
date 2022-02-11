
<?php require_once('Model/Core/Adapter.php'); ?>
<?php $id=$_GET['id'];;?>
<?php

	try
	{
		$id=$_GET['id'];
		if(!$id)
		{
			throw new Exception("Invelid Request", 1);
			
		}

		$adapter=new Adapter();
		$admin=$adapter->fetchRow("select * FROM `admin` WHERE `admin`.`admin_id` = '$id'");
		$address=$adapter->fetchRow("select * FROM `address` WHERE `address`.`admin_id` = '$id'");
	}
	catch(Exception $e)
	{
		throw new Exception("Invelid Request", 1);
	}


?>
<html>
<head><title>Admin Edit</title></head>
<body>

<form action="index.php?c=admin&a=save&id=<?php echo $id ?>" method="POST">
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<td colspan="2"><b>Admin Information</b></td>
		</tr>
		<tr>
			<td width="10%">First Name<input type="text" name="admin[admin_id]" value="<?php echo $admin['admin_id'] ?>" hidden></td>
			<td><input type="text" name="admin[firstName]" value="<?php echo $admin['firstName'] ?>"></td>
		</tr>
		
		<tr>
			<td width="10%">Last Name</td>
			<td><input type="text" name="admin[lastName]" value="<?php echo $admin['lastName'] ?>"></td>
		</tr>
		<tr>
			<td width="10%">Email</td>
			<td><input type="text" name="admin[email]" value="<?php echo $admin['email'] ?>"></td>
		</tr>
		<tr>
			<td width="10%">Password</td>
			<td><input type="text" name="admin[password]" value="<?php echo $admin['password'] ?>"></td>
		</tr>
		<tr>
			<td width="10%">Status</td>
			<td>
				<select name="admin[status]">
					<?php if($admin['status']==1): ?>
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
				<button type="button"><a href="index.php?c=admin&a=grid">Cancel</a></button>
			</td>
		</tr>
		
	</table>	
</form>
</body>
</html>