<?php $salesmen = $this->getSalesmen(); ?>



	<button name="Add"><a href="<?php echo $this->getUrl('add') ?>"><h3>Add</h3></a></button>
	<table border="3" cellspacing="3" width="100%">
		<tr>
			<th>Salesman ID</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Mobile</th>
			<th>Status</th>
			<th>Percentage</th>
			<th>Created Date</th>
			<th>Updated Date</th>
			<th>Customer</th>
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
					 <td><?php echo $salesman->discount; ?></td>
					<td><?php echo $salesman->createdAt ?></td>
					<td><?php echo $salesman->updatedAt ?></td>
					<td><a href="<?php echo $this->getUrl('grid','salesman_salesmanCustomer',['id' => $salesman->salesmanId],true); ?>">Manage</a></td>
					<td><a href="<?php echo $this->getUrl('edit','salesman',['id'=>$salesman->salesmanId],true) ?>">Edit</a></td>
					<td><a href="<?php echo $this->getUrl('delete','salesman',['id'=>$salesman->salesmanId],true) ?>">Delete</a></td>
				</tr>
			<?php endforeach ;?>
		<?php endif; ?>
	</table>
