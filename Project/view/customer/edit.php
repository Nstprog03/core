<?php 
	$customer = $this->getCustomer();
	$address = $this->getAddress();
?>


<form action="<?php echo $this->getUrl('save','customer',['id'=>$customer->customerId],true) ?>" method="POST">
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<td colspan="2"><b>Personal Information</b></td>
		</tr>
		<tr>
			<td width="10%">First Name<input type="text" name="customer[customerId]" value="<?php echo $customer->customerId ?>" hidden></td>
			<td><input type="text" name="customer[firstName]" value="<?php echo $customer->firstName ?>"></td>
		</tr>
		
		<tr>
			<td width="10%">Last Name</td>
			<td><input type="text" name="customer[lastName]" value="<?php echo $customer->lastName ?>"></td>
		</tr>
		<tr>
			<td width="10%">Email</td>
			<td><input type="text" name="customer[email]" value="<?php echo $customer->email ?>"></td>
		</tr>
		<tr>
			<td width="10%">Mobile</td>
			<td><input type="text" name="customer[mobile]" value="<?php echo $customer->mobile ?>"></td>
		</tr>
		<tr>
			<td width="10%">Status</td>
			<td>
				<select name="customer[status]">
					<option value="1" <?php echo ($customer->getStatus($customer->status)=='Active')?'selected':'' ?>>Active</option>
					<option value="2" <?php echo ($customer->getStatus($customer->status)=='Inactive')?'selected':'' ?>>Inactive</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2"><b>Address Information</b></td>
		</tr>
		
		<input type="text" name="address[customerId] " value="<?php echo $address->customerId ?>" hidden>
		<input type="text" name="address[addressId] " value="<?php echo $address->addressId ?>" hidden>


		<tr>
			<td width="10%">Address</td>
			<td><input type="text" name="address[address] " value="<?php echo $address->address ?>"></td>
		</tr>
		
		<tr>
			<td width="10%">Postal Code</td>
			<td><input type="number" name="address[postalCode]" value="<?php echo $address->postalCode ?>"></td>
		</tr>
		<tr>
			<td width="10%">City</td>
			<td><input type="text" name="address[city]" value="<?php echo $address->city ?>"></td>
		</tr>
		<tr>
			<td width="10%">State</td>
			<td><input type="text" name="address[state]" value="<?php echo $address->state ?>"></td>
		</tr>
		<tr>
			<td width="10%">Country</td>
			<td><input type="text" name="address[country]" value="<?php echo $address->country ?>"></td>
		</tr>
		<tr>
			<td width="10%">Address Type</td>
			<td>
				<input type="checkbox" name="address[billing]" value="1" <?php echo ($address->getStatus($address->billing)=='Active')?'checked':'' ?>>
				
				<label for="billing"> Billing</label><br>

				<input type="checkbox" name="address[shipping]" value="1" <?php echo ($address->getStatus($address->shipping)=='Active')?'checked':'' ?>>
				
				<label for="shiping"> Shipping</label><br>
			</td>
		</tr>
		<tr>
			<td width="10%">&nbsp;</td>
			<td>
				<input type="submit" name="submit" value="update">
				<button type="button"><a href="<?php echo $this->getUrl('grid','customer',[],true) ?>">Cancel</a></button>
			</td>
		</tr>
		
	</table>	
</form>
