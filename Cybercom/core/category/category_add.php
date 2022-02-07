<?php require_once('Adapter.php') ?>
<html>
<head><title>Category Add</title></head>
<body>
<form action="category.php?a=saveAction" method="POST">
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<td colspan="2"><b>Category</b></td>
		</tr>
		<tr>
			<td width="10%">Category Name</td>
			<td><input type="text" name="category[name]"></td>
		</tr>
		<tr>
			<td width="10%">Status</td>
			<td>
				<select name="category[status]">
					<option value="1">Active</option>
					<option value="2">Inactive</option>
				</select>
			</td>
		</tr>		
		<tr>
			<td width="10%">&nbsp;</td>
			<td>
				<input type="submit" name="submit" value="Save">
				<button type="button"><a href="category.php?a=gridAction">Cancel</a></button>
			</td>
		</tr>
		
	</table>	
</form>
</body>
</html>