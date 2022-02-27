<?php $categories = $this->getCategories(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
</head>
<body>
    <div id="add"><button><a href="<?php echo $this->getUrl('add','category') ?>">Add CATEGORY</a></button></div>
    <div id="item">
        <table border=1 width=100%>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Base Image</th>
                <th>Thumb Image</th>
                <th>Small Image</th>
                <th>Status</th>
                <th>Created Date</th>
                <th>Updated Date</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Gallery</th>
            </tr>
            <?php if(!$categories): ?>
            <tr><td colspan="7">No Recored Receive</td></tr>
            <?php else: ?>
            <?php foreach($categories as $category): ?>
            <tr>
                <td><?php  echo $category->categoryId; ?></td>
                <td><?php echo $this->getPath($category->categoryId,$category->path); ?></td>
                <?php if($category->base ): ?>
                <td><img src="<?php echo 'Media/Category/'.$this->getMedia($category->base)['name']; ?>" alt="No Image found" width=50 height=50></td>
                <?php else: ?>
                <td>No base image</td>
                <?php endif; ?>

                <?php if($category->thumb ): ?>
                <td><img src="<?php echo 'Media/Category/'.$this->getMedia($category->thumb)['name']; ?>" alt="No Image found" width=50 height=50></td>
                <?php else: ?>
                <td>No thumb image</td>
                <?php endif; ?>

                <?php if($category->small ): ?>
                <td><img src="<?php echo 'Media/Category/'.$this->getMedia($category->small)['name']; ?>" alt="No Image found" width=50 height=50></td>
                <?php else: ?>
                <td>No small image</td>
                <?php endif; ?>
                <td><?php echo $category->getStatus($category->status); ?></td>
                <td><?php echo $category->createdDate; ?></td>
                <td><?php echo $category->updatedDate; ?></td>
                <td><a href='<?php echo $this->getUrl('edit','category',['id'=>$category->categoryId],true) ?>'>Edit</a></td>
                <td><a href='<?php echo $this->getUrl('delete','category',['id'=>$category->categoryId],true) ?>'>Delete</a></td>
                <td><a href="<?php echo $this->getUrl('grid','category_media',['id'=>$category->categoryId],true) ?>">Gallary</a></td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </tabel>
    </div>
</body>
</html>