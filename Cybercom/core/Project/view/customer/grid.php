<?php 
$customers = $this->getCustomers();
$addresses = $this->getAddresses();


?>
<html>
<head>
</head>
<body>
	<button name="Add"><a href="index.php?c=customer&a=add"><h3>Add</h3></a></button>
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
				<td><?php echo $customer['customer_id'] ?></td>
				<td><?php echo $customer['firstName'] ?></td>
				<td><?php echo $customer['lastName'] ?></td>
				<td><?php echo $customer['email'] ?></td>
				<td><?php echo $customer['mobile'] ?></td>
				<td><?php if($customer['status']==1):echo "Active";else : echo "Inactive"; endif;?></td>
				<td><?php echo $customer['created_date'] ?></td>
				<td><?php echo $customer['updated_date'] ?></td>
				<td><?php foreach ($addresses as $address): ?>
					<?php if($address['customer_id']==$customer['customer_id']):
							echo "Address : ".$address['address']."<br>";
							echo "Postal Code : ".$address['postalCode']."<br>";
							echo "Ciry : ".$address['city']."<br>";
							echo "State : ".$address['state']."<br>";
							echo "Country : ".$address['country']."<br>";
							echo "Address Type : ";
							if($address['billing']==1)
								echo "Billing";
							if($address['shiping']==1)
								echo ",Shiping";

					endif; ?>
					<?php endforeach;	?>
				</td>
				<td><a href="<?php echo $this->getUrl('customer','edit',['id'=>$customer['customer_id']],true) ?>">Edit</a></td>
				<td><a href="<?php echo $this->getUrl('customer','delete',['id'=>$customer['customer_id']],true) ?>">Delete</a></td>
			
			</tr>
			
		<?php endforeach;	?>
		<?php endif;  ?>
		
	</table>
	
</body>