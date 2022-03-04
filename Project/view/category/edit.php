<?php 
$categoryData =  $this->getCategory();  
$categories = $this->getCategories();
?>

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
                           <option value="1" <?php echo ($categoryData->getStatus($categoryData->status)=='Active')?'selected':'' ?>>Active</option>
                    <option value="2" <?php echo ($categoryData->getStatus($categoryData->status)=='Inactive')?'selected':'' ?>>Inactive</option>
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
