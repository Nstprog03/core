<?php 
	$customer = $this->getCustomer();
	$billingAddress = $customer->getBillingAddress();
	$shippingAddress = $customer->getShippingAddress();
	
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
			<td colspan="2"><b>Billing Address</b></td>
		</tr>
		
		<input type="text" name="billingAddress[customerId] " value="<?php echo $billingAddress->customerId ?>" hidden>
		<input type="text" name="billingAddress[addressId] " value="<?php echo $billingAddress->addressId ?>" hidden>


		<tr>
			<td width="10%">Address</td>
			<td><input type="text" id="billingaddress" name="billingAddress[address] " value="<?php echo $billingAddress->address ?>"></td>
		</tr>
		
		<tr>
			<td width="10%">Postal Code</td>
			<td><input type="number" id="billingpostalcode" name="billingAddress[postalCode]" value="<?php echo $billingAddress->postalCode ?>"></td>
		</tr>
		<tr>
			<td width="10%">City</td>
			<td><input type="text" id="billingcity" name="billingAddress[city]" value="<?php echo $billingAddress->city ?>"></td>
		</tr>
		<tr>
			<td width="10%">State</td>
			<td><input type="text" id="billingstate" name="billingAddress[state]" value="<?php echo $billingAddress->state ?>"></td>
		</tr>
		<tr>
			<td width="10%">Country</td>
			<td><input type="text" id="billingcountry" name="billingAddress[country]" value="<?php echo $billingAddress->country ?>"></td>
		</tr>
			<input type="hidden" name="billingAddress[billing]" value="1">
			<input type="hidden" name="billingAddress[shipping]" value="2">
		<tr>
			<td colspan="2"><b>Shipping Address</b></td>
		</tr>
		<tr>
			<td colspan="2"><input type = "checkbox"  name = "sameBill" id="sameBill" onclick="same()"><b>Same As Billing Address</b></td>
		</tr>
		
		<input type="text" name="shippingAddress[customerId] "  value="<?php echo $shippingAddress->customerId ?>" hidden>
		<input type="text" name="shippingAddress[addressId] "  value="<?php echo $shippingAddress->addressId ?>" hidden>


		<tr>
			<td width="10%">Address</td>
			<td><input type="text" name="shippingAddress[address] " id="shippingaddress" value="<?php echo $shippingAddress->address ?>"></td>
		</tr>
		
		<tr>
			<td width="10%">Postal Code</td>
			<td><input type="number" name="shippingAddress[postalCode]" id="shippingpostalcode" value="<?php echo $shippingAddress->postalCode ?>"></td>
		</tr>
		<tr>
			<td width="10%">City</td>
			<td><input type="text" name="shippingAddress[city]" id="shippingcity" value="<?php echo $shippingAddress->city ?>"></td>
		</tr>
		<tr>
			<td width="10%">State</td>
			<td><input type="text" name="shippingAddress[state]" id="shippingstate" value="<?php echo $shippingAddress->state ?>"></td>
		</tr>
		<tr>
			<td width="10%">Country</td>
			<td><input type="text" name="shippingAddress[country]" id="shippingcountry" value="<?php echo $shippingAddress->country ?>"></td>
		</tr>
			<input type="hidden" name="shippingAddress[shipping]" value="1">
			<input type="hidden" name="shippingAddress[billing]" value="2">

		<tr>
			<td width="10%">&nbsp;</td>
			<td>
				<input type="submit" name="submit" value="update">
				<button type="button"><a href="<?php echo $this->getUrl('grid','customer',[],true) ?>">Cancel</a></button>
			</td>
		</tr>
		
	</table>	
</form>

<script type="text/javascript">
    function same() {
            var checkedBox = document.getElementById("sameBill");
            
            if(checkedBox.checked == true){
                document.getElementById("shippingaddress").value = document.getElementById("billingaddress").value; 
				document.getElementById("shippingpostalcode").value = document.getElementById("billingpostalcode").value; 
				document.getElementById("shippingcity").value = document.getElementById("billingcity").value; 
				document.getElementById("shippingstate").value = document.getElementById("billingstate").value; 
				document.getElementById("shippingcountry").value = document.getElementById("billingcountry").value; 
            }
            else{
                    document.getElementById("shippingaddress").value = null; 
                    document.getElementById("shippingpostalcode").value = null; 
                    document.getElementById("shippingcity").value = null; 
                    document.getElementById("shippingstate").value = null; 
                    document.getElementById("shippingcountry").value = null; 
            }
    }
</script>
