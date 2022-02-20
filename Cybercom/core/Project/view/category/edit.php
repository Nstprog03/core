<?php

    //echo "<pre>";
    $categories = $this->getCategories();
    //print_r($categories);
    //echo "<br>";
    $category = $this->getCategory();
    //print_r($category);
    $result = $this->pathAction();
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
    <form action="<?php echo $this->getUrl('category','save',['id'=>$category['categoryID']],true) ?>   " method="post">
        <input type="text" name="category[parentID]" value="<?php echo $category['parentID']; ?>" hidden />
        <input type="text" name="category[categoryID]" value="<?php echo $category['categoryID']; ?>" hidden />
        <label>Name</label>
        <input type="text" name="category[name]" value="<?php echo $category['name']; ?>" required/>
        <br>
        <br>

        <label>Sub-Category</label>
        <select name="category[root]">
            <option selected value="" <?php echo ($category['parentID']==NULL) ? "selected" : ''; ?>>Root Category</option>
            <?php foreach ($categories as $value) { ?>
                <option value="<?php echo $value['categoryID']; ?>" <?php echo ($value['categoryID']==$category['parentID']) ? "selected" : ''; ?>>
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
