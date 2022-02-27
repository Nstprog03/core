<?php $medias = $this->getMedias(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Media</title>
</head>
<body>

    <form action="<?php echo $this->getUrl('save','product_media') ?>" method="POST" align=center>
        <input type="submit" value="update">
        <button><a href="<?php echo $this->getUrl('grid','product',[],true); ?>">Cancel</a></button>
        <table border=3 align=center width=100% cellspacing=4>
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
            <?php if(!$medias): ?>
                <tr>
                    <td colspan=8>No Recored Found</td>
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
            <?php  endforeach; ?>
            <?php  endif; ?>
        </table>
    </form>

    <form action="<?php echo $this->getUrl('save','product_media') ?>" method="POST" enctype="multipart/form-data">
        <input type="file" name="name">
        <input type="submit" value="upload">
    </form>
    
</body>
</html>