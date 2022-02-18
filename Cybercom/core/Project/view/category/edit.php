<?php
    $Controller_Category = new Controller_Category();

    $categories = $this->getData('categories');
    
    $row = $this->getData('allData');

    $result = $Controller_Category->pathAction();
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Category</title>
</head>
<body>
    <h2>Edit Category</h2>
    <form action="index.php?c=category&a=save&id=<?php echo $categories['categoryID']?>" method="post">
        <input type="text" name="category[parentID]" value="<?php echo $categories['parentID']; ?>" hidden />
        <label>Name</label>
        <input type="text" name="category[name]" value="<?php echo $categories['name']; ?>" required/>
        <br>
        <br>

        <label>Sub-Category</label>
        <select name="category[root]">
            <option selected value="" <?php echo ($categories['parentID']==NULL) ? "selected" : ''; ?>>Root Category</option>
            <?php foreach ($row as $value) { ?>
                <option value="<?php echo $value['categoryID']; ?>" <?php echo ($value['categoryID']==$categories['parentID']) ? "selected" : ''; ?>>
                    <?php echo $result[$value['categoryID']]; ?>
                </option>
            <?php }?>
        </select>


        <br>
        <br>
        
        <label>Status</label>
        <select name="category[status]">
            <?php if($categories['status']==1): ?>
            <option value="1" selected>Active</option>
            <option value="2">Inactive</option>
            <?php else: ?>
            <option value="1">Active</option>
            <option value="2" selected>Inactive</option>                
            <?php endif; ?>
        </select>
        <br>
        <br>        
        <input type='submit' name='Update' id='submit' value='update'/>
    </form>
</body>
</html>
