<?php $categoryData =  $this->getCategory();  
$categories = $this->getCategories(); ?>

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Category Information</h3>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Category Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="category[name]" id="name" value="<?php echo $categoryData->name ?>" placeholder="Category Name">
            </div>
        </div>
        <div class="form-group row">
            <label for="parentId" class="col-sm-2 col-form-label">Subcategory</label>
            <div class="col-sm-10">
                <select class="form-control" name="category[parentId]" id="parentId">
                    <option value="<?php echo null; ?>" <?php echo ($categoryData->parentId == NULL) ? 'selected' : ''; ?>>Root Category</option>
                <?php foreach($categories as $category): ?>
                    <?php if($categoryData->categoryId != $category->categoryId):  ?>
                    <option value="<?php echo $category->categoryId; ?>" <?php echo ($categoryData->parentId == $category->categoryId) ? 'selected' : ''; ?>><?php echo $this->getPath($category->categoryId,$category->path); ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="status" class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
                <select class="form-control" name="category[status]" id="pageSelect">
                    <option value="1" <?php echo($categoryData->getStatus($category->status)=='Active')?'selected':'' ?>>Active</option>
                    <option value="2" <?php echo($categoryData->getStatus($category->status)=='Inactive')?'selected':'' ?>>Inactive</option>
                </select>
            </div>
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-info" id="categorySubmitBtn">Save</button>
            <button type="button" class="btn btn-default" id="categoryCancelBtn">Cancel</button>
        </div>
    </div>
</div>
<script type="text/javascript">
    
    jQuery("#categoryCancelBtn").click(function(){
        admin.setData({'id' : null});
        admin.setUrl("<?php echo $this->getUrl('gridBlock','category',['id' => null]); ?>");
        admin.load();
    });

    jQuery("#categorySubmitBtn").click(function(){
        admin.setForm(jQuery("#indexForm"));
        admin.setUrl("<?php echo $this->getEdit()->getSaveUrl();?>");
        admin.load();
    });
</script>
