<?php 
	$vendor = $this->getVendor();
	$address = $vendor->getAddress();
?>


<form action="<?php echo $this->getUrl('save','vendor',['id'=>$vendor->vendorId],true) ?>" method="POST">
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<td colspan="2"><b>Personal Information</b></td>
		</tr>
		<tr>
			<td width="10%">First Name<input type="text" name="vendor[vendorId]" value="<?php echo $vendor->vendorId ?>" hidden></td>
			<td><input type="text" name="vendor[firstName]" value="<?php echo $vendor->firstName ?>"></td>
		</tr>
		
		<tr>
			<td width="10%">Last Name</td>
			<td><input type="text" name="vendor[lastName]" value="<?php echo $vendor->lastName ?>"></td>
		</tr>
		<tr>
			<td width="10%">Email</td>
			<td><input type="text" name="vendor[email]" value="<?php echo $vendor->email ?>"></td>
		</tr>
		<tr>
			<td width="10%">Mobile</td>
			<td><input type="text" name="vendor[mobile]" value="<?php echo $vendor->mobile ?>"></td>
		</tr>
		<tr>
			<td width="10%">Status</td>
			<td>
				<select name="vendor[status]">
					<option value="1" <?php echo ($vendor->getStatus($vendor->status)=='Active')?'selected':'' ?>>Active</option>
					<option value="2" <?php echo ($vendor->getStatus($vendor->status)=='Inactive')?'selected':'' ?>>Inactive</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2"><b>Address Information</b></td>
		</tr>
		
		<input type="text" name="address[vendorId] " value="<?php echo $address->vendorId ?>" hidden>
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
			<td width="10%">&nbsp;</td>
			<td>
				<input type="submit" name="submit" value="update">
				<button type="button"><a href="<?php echo $this->getUrl('grid','vendor',[],true) ?>">Cancel</a></button>
			</td>
		</tr>
		
	</table>	
</form>
