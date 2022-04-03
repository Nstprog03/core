<?php $medias = $this->getMedia(); ?>

<div>
    <input type="button" id="productMediaUpdateBtn" class="btn btn-primary" value="update">
    <button type="button" id="productCancelBtn" class="btn btn-primary">Cancel</button>
</div>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Image Id</th>
        <th>Product Id</th>
        <th>Name</th>
        <th>Base</th>
        <th>Thumb</th>
        <th>Small</th>
        <th>Gallery</th>
        <th>Remove</th>
    </tr>
    </thead>
    <tbody>
    <?php if(!$medias): ?>
    <tr>
        <td colspan="8">No Record Found</td>
    </tr>
    <?php else: ?>
    <?php foreach ($medias as $media): ?>
    <tr>
        <td><?php echo $media->mediaId ?></td>
        <td><?php echo $media->productId ?></td>
        <td><?php echo $media->name ?></td>
        <td>
            <input type="radio" name="media[base]" value = "<?php echo $media->mediaId ?>" <?php echo $this->selected($media->mediaId,'base'); ?> >
        </td>
        <td>
            <input type="radio" name="media[thumb]" value = "<?php echo $media->mediaId ?>" <?php echo $this->selected($media->mediaId,'thumb'); ?> >
        </td>
        <td>
            <input type="radio" name="media[small]" value = "<?php echo $media->mediaId ?>" <?php echo $this->selected($media->mediaId,'small'); ?> >
        </td>
        <td>
            <input type="checkbox" name="media[gallery][]" value = "<?php echo $media->mediaId ?>" <?php echo $media->gallery == 1 ? 'checked' : ''; ?>>
        </td>
        <td>
            <input type="checkbox" name="media[remove][]" value = "<?php echo $media->mediaId ?>" >
        </td>
    </tr>
    <?php endforeach; ?>
    <?php endif; ?>
    <tr>
        <td colspan="8"><input type="file" name="name" id="image" onChange="fileUpload(this)"></td>
    </tr>

    </tbody>
</table>

<script type="text/javascript">

jQuery("#productCancelBtn").click(function(){
    admin.setData({'id' : null});
    admin.setUrl("<?php echo $this->getUrl('gridBlock','product',['id' => null]); ?>");
    admin.load();
});

jQuery("#productMediaUpdateBtn").click(function(){
    admin.setForm(jQuery("#indexForm"));
    admin.setUrl("<?php echo $this->getUrl('saveMedia','product'); ?>");
    admin.load();
});

function fileUpload(fileData) {
    var file = fileData.files[0];
    var formData = new FormData();
    formData.append('name', file);

    $.ajax({
    type: "POST",
    url: "<?php echo $this->getUrl('saveMedia','product'); ?>",    
    contentType: false,
    processData: false,
    data: formData,
    success: function (data) {
        admin.manageElemants(data.elements);
    }
});
}
</script>

