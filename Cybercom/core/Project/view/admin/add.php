<?php 



 ?>
<html>
<head><title>Admin Add</title></head>
<body>
<form action="index.php?c=admin&a=save" method="POST">
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<td colspan="2"><b>Personal Information</b></td>
		</tr>
		<tr>
			<td width="10%">First Name</td>
			<td><input type="text" name="admin[firstName]"></td>
		</tr>
		
		<tr>
			<td width="10%">Last Name</td>
			<td><input type="text" name="admin[lastName]"></td>
		</tr>
		<tr>
			<td width="10%">Email</td>
			<td><input type="text" name="admin[email]"></td>
		</tr>
		<tr>
			<td width="10%">Password</td>
			<td><input type="text" name="admin[password]"></td>
		</tr	>
		<tr>
			<td width="10%">Status</td>
			<td>
				<select name="admin[status]">
					<option value="1">Active</option>
					<option value="2">Inactive</option>
				</select>
			</td>
		</tr>
		<tr>
			<td width="10%">&nbsp;</td>
			<td>
				<input type="submit" name="submit" value="Save">
				<button type="button"><a href="index.php?c=admin&a=grid">Cancel</a></button>
			</td>
		</tr>
		
	</table>	
</form>
</body>
</html>