<?php $customers = $this->getData('customers');

	$adapter = new Adapter();



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
				<td>
					<?php 
							$selectQuery="select * FROM `address` WHERE `address`.`customer_id` = '$customer[customer_id]'";

							$address=$adapter->fetchRow($selectQuery);
							//print_r($address);
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

					 ?>
				</td>
				<td><a href="index.php?c=customer&a=edit&id=<?php echo $customer['customer_id'] ?>">Edit</a></td>
				<td><a href="index.php?c=customer&a=delete&id=<?php echo $customer['customer_id'] ?>">Delete</a></td>
			</tr>
			<?php endforeach;	?>
		<?php endif;  ?>
		
	</table>
	
</body>