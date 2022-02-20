<?php 
	$customer = $this->getCustomer();
	$address = $this->getAddress();
?>
<html>
<head><title>Customer Edit</title></head>
<body>

<form action="<?php echo $this->getUrl('customer','save',['id'=>$customer['customer_id']],true) ?>" method="POST">
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
			<td width="10%">Address</td><input type="text" name="address[customer_id] " value="<?php echo $address['customer_id'] ?>" hidden>
			<td><input type="text" name="address[address] " value="<?php echo $address['address'] ?>"></td>
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
				<button type="button"><a href="<?php echo $this->getUrl('customer','grid',[],true) ?>">Cancel</a></button>
			</td>
		</tr>
		
	</table>	
</form>
</body>
</html>