
<?php  ?>
<?php ?>
<?php $id=$_GET['id'];

	/*try
	{
		$id=$_GET['id'];
		if(!$id)
		{
			throw new Exception("Invelid Request", 1);
			
		}

		$adapter=new Adapter();
		$customer=$adapter->fetchRow("select * FROM `customer` WHERE `customer`.`customer_id` = '$id'");
		$address=$adapter->fetchRow("select * FROM `address` WHERE `address`.`customer_id` = '$id'");
	}
	catch(Exception $e)
	{
		throw new Exception("Invelid Request", 1);
	}*/
	$data = $this->getData('data');
	$customer = $data[0];
	$address = $data[1];

	$adapter = new Adapter();

?>
<html>
<head><title>Customer Edit</title></head>
<body>

<form action="index.php?c=customer&a=save&id=<?php echo $id ?>" method="POST">
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<td colspan="2"><b>Personal Information</b></td>
		</tr>
		<tr>
			<td width="10%">First Name<input type="text" name="customer[customer_id]" value="<?php echo $customer['customer_id'] ?>" hidden></td>
			<td><input type="text" name="customer[firstName]" value="<?php echo $customer['firstName'] ?>"></td>
		</tr>
		
		<tr>
			<td width="10%">Last Name</td>
			<td><input type="text" name="customer[lastName]" value="<?php echo $customer['lastName'] ?>"></td>
		</tr>
		<tr>
			<td width="10%">Email</td>
			<td><input type="text" name="customer[email]" value="<?php echo $customer['email'] ?>"></td>
		</tr>
		<tr>
			<td width="10%">Mobile</td>
			<td><input type="text" name="customer[mobile]" value="<?php echo $customer['mobile'] ?>"></td>
		</tr>
		<tr>
			<td width="10%">Status</td>
			<td>
				<select name="customer[status]">
					<?php if($customer['status']==1): ?>
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
			<td colspan="2"><b>Address Information</b></td>
		</tr>
		



		<tr>
			<td width="10%">Address</td>
			<td><input type="text" name="address[address_detail] " value="<?php echo $address['address'] ?>"></td>
		</tr>
		
		<tr>
			<td width="10%">Postal Code</td>
			<td><input type="number" name="address[postalCode]" value="<?php echo $address['postalCode'] ?>"></td>
		</tr>
		<tr>
			<td width="10%">City</td>
			<td><input type="text" name="address[city]" value="<?php echo $address['city'] ?>"></td>
		</tr>
		<tr>
			<td width="10%">State</td>
			<td><input type="text" name="address[state]" value="<?php echo $address['state'] ?>"></td>
		</tr>
		<tr>
			<td width="10%">Country</td>
			<td><input type="text" name="address[country]" value="<?php echo $address['country'] ?>"></td>
		</tr>
		<tr>
			<td width="10%">Address Type</td>
			<td>
				<?php if($address['billing']==1): ?>
				<input type="checkbox" name="address[billing]" value="1" checked>
				<?php else: ?>
				<input type="checkbox" name="address[billing]" value="1">
				<?php endif; ?>
				<label for="billing"> Billing</label><br>
				<?php if($address['shiping']==1): ?>
				<input type="checkbox" name="address[shiping]" value="1" checked>
				<?php else: ?>
				<input type="checkbox" name="address[shiping]" value="1">
				<?php endif; ?>
				
				<label for="shiping"> Shiping</label><br>
			</td>
		</tr>
		<tr>
			<td width="10%">&nbsp;</td>
			<td>
				<input type="submit" name="submit" value="update">
				<button type="button"><a href="index.php?c=customer&a=grid">Cancel</a></button>
			</td>
		</tr>
		
	</table>	
</form>
</body>
</html>