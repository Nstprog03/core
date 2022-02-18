
<html>
<head><title>Product Add</title></head>
<body>
<form action="index.php?c=product&a=save" method="POST">
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<td colspan="2"><b>Product Information</b></td>
		</tr>
		<tr>
			<td width="10%">Name</td>
			<td><input type="text" name="product[name]"></td>
		</tr>
		
		<tr>
			<td width="10%">Price</td>
			<td><input type="text" name="product[price]"></td>
		</tr>
		<tr>
			<td width="10%">Quantity</td>
			<td><input type="text" name="product[quantity]"></td>
		</tr>
		<tr>
			<td width="10%">Status</td>
			<td>
				<select name="product[status]">
					<option value="1">Active</option>
					<option value="2">Inactive</option>
				</select>
			</td>
		</tr>		
		<tr>
			<td width="10%">&nbsp;</td>
			<td>
				<input type="submit" name="submit" value="Save">
				<button type="button"><a href="index.php?c=product&a=grid">Cancel</a></button>
			</td>
		</tr>
		
	</table>	
</form>
</body>
</html>