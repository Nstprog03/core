<?php
    $categories = $this->getCategories();

    $result = $this->pathAction();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Category</title>
</head>
<body>
    <a href='<?php echo $this->getUrl('category','add',[],true) ?>'><input type="button" >Add Category</a>
            <h2>All Records</h2>
            <table cellpadding="7px" width="100%" border="3">
                <thead>
                    <th>Category ID</th>
                    <th>Name</th>
                    <th>Path</th>
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>Updated Date</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                        if(!$categories):?>
                            <tr><td colspan="10">No Record available.</td></tr>
                    
                <?php else:
                    foreach ($categories as $category):
                ?>
                <tr>
                    <td><?php echo($category['categoryID']); ?></td>
                    <td><?php echo $result[$category['categoryID']]; ?></td>
                    <td><?php echo $category['path']; ?></td>
                    <td>
                        <?php 
                            if($category['status'] == 1){
                                echo("Active");
                            } 
                            else{
                                echo("Inactive");
                            } ?>
                    </td>
                    <td><?php echo($category['createdDate']); ?></td>
                    <td><?php echo($category['updatedDate']); ?></td>
                    <td>
                        <a href="<?php echo $this->getUrl('category','edit',['id'=>$category['categoryID']],true) ?>">Edit</a>
                    </td>
                    <td>
                        <a href="<?php echo $this->getUrl('category','delete',['id'=>$category['categoryID']],true) ?>">Delete</a>
                    </td>
                </tr>
                <?php
                        endforeach;
                    endif;
                ?>
        </tbody>
    </table>
</body>
</html>
