<?php $salesmen = $this->getSalesmen(); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Salesmen Grid</title>
</head>
<body>
	<button name="Add"><a href="<?php echo $this->getUrl('add') ?>"><h3>Add</h3></a></button>
	<table border="3" cellspacing="3" width="100%">
		<tr>
			<th>Salesman ID</th>
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
		<?php if(!$salesmen) : ?>
			<tr>
				<td colspan="10">NO RECORD FOUND</td>
			</tr>
		<?php else : ?>
			<?php foreach ($salesmen as $salesman) : ?>
				<tr>
					<td><?php echo $salesman->salesmanId ?></td>
					<td><?php echo $salesman->firstName ?></td>
					<td><?php echo $salesman->lastName ?></td>
					<td><?php echo $salesman->email ?></td>
					<td><?php echo $salesman->mobile ?></td>

					<td><?php echo $salesman->getStatus($salesman->status) ?></td>
					<td><?php echo $salesman->createdAt ?></td>
					<td><?php echo $salesman->updatedAt ?></td>
					<td><a href="<?php echo $this->getUrl('edit','salesman',['id'=>$salesman->salesmanId],true) ?>">Edit</a></td>
					<td><a href="<?php echo $this->getUrl('delete','salesman',['id'=>$salesman->salesmanId],true) ?>">Delete</a></td>
				</tr>
			<?php endforeach ;?>
		<?php endif; ?>
	</table>
</body>
</html>