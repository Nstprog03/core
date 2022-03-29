<?php $customer = $this->getCustomer(); ?>
<p id="done"></p>

<table>
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
		<td width="10%">&nbsp;</td>
		<td>
			<input type="button" name="submit" id="submit" value="Save">
			<button type="button"><a href="<?php echo $this->getUrl('grid','customer',[],true) ?>">Cancel</a></button>
		</td>
	</tr>
</table>