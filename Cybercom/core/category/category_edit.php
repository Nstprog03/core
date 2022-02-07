
<?php require_once('Adapter.php'); ?>
<?php $id=$_GET['id']; ?>
<?php

$id=$_GET['id'];

$adapter = new Adapter();
$category = $adapter->fetchRow("select * FROM `category` WHERE `category`.`category_id` = '$id'");


?>
<html>
<head><title>Category Add</title></head>
<body>

<form action="category.php?a=saveAction&id=<?php echo $id ?>" method="POST">
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<td colspan="2"><b>Category Information</b></td>
		</tr>
		<tr>
			<td width="10%">Category Name<input type="text" name="category[category_id]" value="<?php echo $category['category_id'] ?>" hidden></td>
			<td><input type="text" name="category[name]" value="<?php echo $category['name'] ?>"></td>
		</tr>
		<tr>
			<td width="10%">Status</td>
			<td>
				<select name="category[status]">
					<?php if($category['status']==1): ?>
					<option value="1" selected>Active</option>
					<option value="2">Inactive</option>
					<?php else: ?>
					<option value="1">Active</option>
					<option value="2" selected>Inactive</option>				
					<?php endif; ?>
				</select>
			</td>
		</tr>
		<tr>
			<td width="10%">&nbsp;</td>
			<td>
				<input type="submit" name="submit" value="update">
				<button type="button"><a href="category.php?a=gridAction">Cancel</a></button>
			</td>
		</tr>
		
	</table>	
</form>
</body>
</html>