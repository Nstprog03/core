<?php $medias = $this->getMedias(); ?>


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
    <br>
    <br>
    <br>
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
    



    
