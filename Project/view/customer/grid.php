<?php 
$customers = $this->getCustomers();
$addresses = $this->getAddresses();
?>
<html>
<head>
</head>
<body>
	<button name="Add"><a href="<?php echo $this->getUrl('add') ?>"><h3>Add</h3></a></button>
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<th>customer Id</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Mobile</th>
			<th>Status</th>
			<th>Created Date</th>
			<th>Updated Date</th>
			<th>Address</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?php if(!$customers):  ?>
			<tr><td colspan="10">No Record available.</td></tr>
		<?php else:  ?>
			<?php foreach ($customers as $customer): ?>
				
			<tr>
				<td><?php echo $customer->customerId ?></td>
				<td><?php echo $customer->firstName ?></td>
				<td><?php echo $customer->lastName ?></td>
				<td><?php echo $customer->email ?></td>
				<td><?php echo $customer->mobile ?></td>
				<td><?php if($customer->status==1):echo "Active";else : echo "Inactive"; endif;?></td>
				<td><?php echo $customer->createdAt ?></td>
				<td><?php echo $customer->updatedAt ?></td>
				<td><?php foreach ($addresses as $address): ?>
					<?php if($address->customerId==$customer->customerId):
							echo "Address : ".$address->address."<br>";
							echo "Postal Code : ".$address->postalCode."<br>";
							echo "Ciry : ".$address->city."<br>";
							echo "State : ".$address->state."<br>";
							echo "Country : ".$address->country."<br>";
							echo "Address Type : ";
							if($address->getStatus($address->billing)=='Active')
								echo "Billing";
							if($address->getStatus($address->shipping)=='Active')
								echo ",Shipping";

					endif; ?>
					<?php endforeach;	?>
				</td>
				<td><a href="<?php echo $this->getUrl('edit','customer',['id'=>$customer->customerId],true) ?>">Edit</a></td>
				<td><a href="<?php echo $this->getUrl('delete','customer',['id'=>$customer->customerId],true) ?>">Delete</a></td>
			
			</tr>
			
		<?php endforeach;	?>
		<?php endif;  ?>
		
	</table>
	
</body>