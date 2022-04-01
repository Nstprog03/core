<?php $billingAddress = $this->getBillingAddress();?>
<?php $shippingAddress = $this->getShippingAddress();?>

<table>
	<tr>
		<td colspan="2"><b>Billing Address</b></td>
	</tr>
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
	<tr>
		<td colspan="2"><b>Shipping Address</b></td>
	</tr>
	<tr>
		<td colspan="2"><input type = "checkbox"  name = "sameBill" id="sameBill" onclick="same()"><b>Same As Billing Address</b></td>
	</tr>

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

	<tr>
		<td width="10%">&nbsp;</td>
		<td>
			
			<button type="button" id="customerSubmitBtn" name="save">Save</button>
			<button type="button" id="cancel">Cancel</button>
		</td>
	</tr>

</table>
		<input type="hidden" name="billingAddress[billing]" value="1">
		<input type="hidden" name="billingAddress[shipping]" value="2">
		<input type="hidden" name="shippingAddress[shipping]" value="1">
		<input type="hidden" name="shippingAddress[billing]" value="2">

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
<script>
    $("#customerSubmitBtn").click(function(){
        admin.setForm($("#indexForm"));
        admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
        admin.load();
    });

    $("#cancel").click(function(){
        admin.setUrl("<?php echo $this->getUrl('gridBlock','customer'); ?>");
        admin.load();
    });
</script>