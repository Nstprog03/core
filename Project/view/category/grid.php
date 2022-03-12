<?php $categories = $this->getCategories(); ?>


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
                <th>Madia</th>
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
                <td><?php echo $category->createdAt; ?></td>
                <td><?php echo $category->updatedAt; ?></td>
                <td><a href='<?php echo $this->getUrl('edit','category',['id'=>$category->categoryId],true) ?>'>Edit</a></td>
                <td><a href='<?php echo $this->getUrl('delete','category',['id'=>$category->categoryId],true) ?>'>Delete</a></td>
                <td><a href="<?php echo $this->getUrl('grid','category_media',['id'=>$category->categoryId],true) ?>">Gallary</a></td>
                <td><a href="<?php echo $this->getUrl('gallery','category_media',['id'=>$category->categoryId],true) ?>">Show Media</a></td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
    <table>
        <tr>
            <script type="text/javascript"> function ppr() {
                const pprValue = document.getElementById('ppr').selectedOptions[0].value;
                let language = window.location.href;
                if(!language.includes('ppr'))
                {
                    language+='&ppr=20';
                }
                const myArray = language.split("&");
                for (i = 0; i < myArray.length; i++)
                {
                    if(myArray[i].includes('p='))
                    {
                        myArray[i]='p=1';
                    }
                    if(myArray[i].includes('ppr='))
                    {
                        myArray[i]='ppr='+pprValue;
                    }
                }
                const str = myArray.join("&");  
                location.replace(str);
            }
            </script>
            <select onchange="ppr()" id="ppr">
                <option selected>select</option>
                <?php foreach($this->getPager()->getPerPageCountOption() as $perPageCount) :?>  
                <option value="<?php echo $perPageCount ?>" ><?php echo $perPageCount ?></a></option>
                <?php endforeach;?>
            </select>
        </tr>
        <tr><button><a style="<?php echo ($this->getPager()->getStart()==NULL)? "pointer-events: none" : "" ?>" href="<?php echo $this->getUrl(null,null,['p' => $this->getPager()->getStart()]) ?>">Start</a></button></tr>
            <tr><button><a style="<?php echo ($this->getPager()->getPrev()==NULL)? "pointer-events: none" : "" ?>" href="<?php echo $this->getUrl(null,null,['p' => $this->getPager()->getPrev()]) ?>">Prev</a></button>
            &nbsp;&nbsp;&nbsp;&nbsp;<?php echo "<b>".$this->getPager()->getCurrent()."</b>"?>&nbsp;&nbsp;&nbsp;&nbsp;</tr>
            <tr><button><a style="<?php echo ($this->getPager()->getNext()==NULL)? "pointer-events: none" : "" ?>" href="<?php echo $this->getUrl(null,null,['p' => $this->getPager()->getNext()]) ?>">Next</a></button></tr>
            <tr><button><a style="<?php echo ($this->getPager()->getEnd()==NULL)? "pointer-events: none" : "" ?>" href="<?php echo $this->getUrl(null,null,['p' => $this->getPager()->getEnd()]) ?>">End</a></button></tr>

    </table>
