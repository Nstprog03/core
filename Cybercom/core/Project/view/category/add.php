<?php require_once('Model/Core/Adapter.php');

$adapter = new Adapter();


$categories = $adapter->fetchAll("SELECT * FROM `category` ORDER BY `p_category_id`");
//$adapter =new Adapter(); 

 $result=$adapter->pathAction();

 ?>
<html>
<head><title>Category Add</title></head>
<body>
<form action="index.php?c=category&a=save" method="POST">
	<table border="1" width="100%" cellspacing="4">
		 <tr>
                <td width="10%">Subcategory</td>
                <td>
                    <select name="category[p_category_id]" id="parentId">
                        <option value=<?php echo null; ?>>Root Category</option>
                    <?php foreach($categories as $category): ?>
                        <option value="<?php echo $category['category_id']?>"><?php echo $result[$category['category_id']];?></option>
                    <?php endforeach; ?>
                    </select>
                </td>
        </tr>

		<tr>
			<td colspan="2"><b>Category</b></td>
		</tr>
		<tr>
			<td width="10%">Category Name</td>
			<td><input type="text" name="category[name]"></td>
		</tr>
		<tr>
			<td width="10%">Status</td>
			<td>
				<select name="category[status]">
					<option value="1">Active</option>
					<option value="2">Inactive</option>
				</select>
			</td>
		</tr>		
		<tr>
			<td width="10%">&nbsp;</td>
			<td>
				<input type="submit" name="submit" value="Save">
				<button type="button"><a href="index.php?c=category&a=grid">Cancel</a></button>
			</td>
		</tr>
		
	</table>	
</form>
</body>
</html>