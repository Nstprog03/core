<?php
$adapter = new Adapter();
$customers = $adapter->fetchAll('select * FROM `customer`');


?>
<html>
<head>
</head>
<body>
	<button name="Add"><a href="customer_index.php?a=addAction"><h3>Add</h3></a></button>
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
				<td><?php if($customer['status']==1):echo "Active";else : echo "Inactive"; endif;	?></td>
				<td><?php echo $customer['created_date'] ?></td>
				<td><?php echo $customer['updated_date'] ?></td>
				<td><a href="customer_index.php?a=editAction&id=<?php echo $customer['customer_id'] ?>">Edit</a></td>
				<td><a href="customer_index.php?a=deleteAction&id=<?php echo $customer['customer_id'] ?>">Delete</a></td>
			</tr>
			<?php endforeach;	?>
		<?php endif;  ?>
		
	</table>
	
</body>