<?php 
	$salesman = $this->getSalesman();
?>

<form action="<?php echo $this->getUrl('save','salesman',['id'=>$salesman->salesmanId],true) ?>" method="POST">
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<td colspan="2"><b>Personal Information</b></td>
		</tr>
		<tr>
			<td width="10%">First Name<input type="text" name="salesman[salesmanId]" value="<?php echo $salesman->salesmanId ?>" hidden></td>
			<td><input type="text" name="salesman[firstName]" value="<?php echo $salesman->firstName ?>"></td>
		</tr>
		
		<tr>
			<td width="10%">Last Name</td>
			<td><input type="text" name="salesman[lastName]" value="<?php echo $salesman->lastName ?>"></td>
		</tr>
		<tr>
			<td width="10%">Email</td>
			<td><input type="text" name="salesman[email]" value="<?php echo $salesman->email ?>"></td>
		</tr>
		<tr>
			<td width="10%">Mobile</td>
			<td><input type="text" name="salesman[mobile]" value="<?php echo $salesman->mobile ?>"></td>
		</tr>
		 <tr>
            <td width="10%">Discount</td>
            <td><input type="text" name="salesman[discount]" value=<?php echo $salesman->discount ?>></td>
        </tr>
		<tr>
			<td width="10%">Status</td>
			<td>
				<select name="salesman[status]">
					<option value="1" <?php echo ($salesman->getStatus($salesman->status)=='Active')?'selected':'' ?>>Active</option>
					<option value="2" <?php echo ($salesman->getStatus($salesman->status)=='Inactive')?'selected':'' ?>>Inactive</option>
				</select>
			</td>
		</tr>

		<tr>
			<td width="10%">&nbsp;</td>
			<td>
				<input type="submit" name="submit" value="update">
				<button type="button"><a href="<?php echo $this->getUrl('grid','salesman',[],true) ?>">Cancel</a></button>
			</td>
		</tr>
		
	</table>	
</form>
