<?php $categories = $this->getCategory(); ?>

<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Select</th>
        <th>Category Id</th>
        <th>Category</th>
    </tr>
    </thead>
    <tbody>
    <?php if(!$categories): ?>
    <tr>
        <td colspan="8">No Record Found</td>
    </tr>
    <?php else: ?>
        <?php foreach($categories as $category): ?>
    <?php $tag = ($this->selected($category->categoryId) == 'checked') ? 'exists' : 'new'; ?>
    <tr>
        <td> <input type="checkbox" name="category[<?php echo $tag ?>][]" value="<?php echo $category->categoryId ?>" <?php echo $this->selected($category->categoryId); ?>> </td>
        <td><?php echo $category->categoryId; ?></td>
        <td><?php echo $category->getPath() ?></td>
    </tr>
    <?php endforeach; ?>
    <?php endif; ?>
    <tr>
        <td colspan="3">
            <input type="button" id="categoryFormSubmitBtn" class="btn btn-primary" name="submit" id="submit" value="save">
            <button type="button" id="categoryFromCancelBtn" class="btn btn-primary">Cancel</button>
        </td>
    </tr>
    </tbody>
</table>

<script type="text/javascript">

jQuery("#categoryFromCancelBtn").click(function(){
	admin.setUrl("<?php echo $this->getUrl('gridBlock','product',['id' => null]); ?>");
	admin.load();
});

jQuery("#categoryFormSubmitBtn").click(function(){
	admin.setForm(jQuery("#indexForm"));
	admin.setUrl("<?php echo $this->getEdit()->getSaveUrl();?>");
	admin.load();
});
</script>

