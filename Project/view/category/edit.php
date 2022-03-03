<?php 
$categoryData =  $this->getCategory();  
$categories = $this->getCategories();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD POST</title>
</head>

<body>
    <div id="form">
        <form action="<?php echo $this->getUrl('save','category',['id'=>$categoryData->categoryId],true) ?>" method="POST" enctype="multipart/form-data">
            <table border="1" width="100%" cellspacing="4">
                <tr>
                    <td width="10%">Subcategory</td>
                    <td>
                        <select name="category[parentId]" id="parentId">
                            <option value="<?php echo null; ?>" <?php echo ($categoryData->parentId == NULL) ? 'selected' : ''; ?>>Root Category</option>
                        <?php foreach($categories as $category): ?>
                            <?php if($categoryData->categoryId != $category->categoryId):  ?>
                            <option value="<?php echo $category->categoryId; ?>" <?php echo ($categoryData->parentId == $category->categoryId) ? 'selected' : ''; ?>><?php echo $this->getPath($category->categoryId,$category->path); ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="10%">Category Name</td>
                    <td><input type="text" name="category[name]" value= "<?php echo $categoryData->name; ?>"> </td>
                </tr>
                <tr>
                    <td width="10%">Status</td>
                    <td>
                        <select name="category[status]" id="status">
                            <?php if($categoryData->status == 1):?>
                            <option value="1" selected>Enabel</option>
                            <option value="2">Disabel</option>
                        <?php else: ?>
                            <option value="1">Enabel</option>
                            <option value="2" selected>Disabel</option>
                        <?php endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="10%"></td>
                    <td>
                        <input type="submit" name="submit" value="save">
                        <button><a href="<?php echo $this->getUrl('grid','category'); ?>">Cancel</a></button>
                    </td>
                </tr>
            </table>   
        </form>
    </div>
</body>

</html>