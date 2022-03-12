<?php $products = $this->getProducts(); ?>

<form action="<?php echo $this->getUrl('save','customer_price') ?>" method="post">
    <input type="submit" value="save">
    <table border="1" width="100%">
        <tr>
            <th>Product Id</th>
            <th>sku</th>
            <th>Name</th>
            <th>Price</th>
            <th>Salesman Price</th>
            <th>Coustomer Price</th>
        </tr>
        <?php if(!$products): ?>
            <tr>
                <td colspan = "7">Salesman not assign</td>
            </tr>
        <?php else: ?>
        <?php $i = 0; ?>
        <?php foreach($products as $product): ?>
        <tr>
            <input type="hidden" name="product[<?php echo $i ?>][productId]" value="<?php echo $product->productId; ?>">
            <input type="hidden" name="product[<?php echo $i ?>][salesmanPrice]" value="<?php echo $this->getSalesmanPrice($product->productId); ?>">
            <td><?php echo $product->productId ?></td>
            <td><?php echo $product->sku ?></td>
            <td><?php echo $product->name ?></td>
            <td><?php echo $product->price ?></td>
            <td><?php echo $this->getSalesmanPrice($product->productId); ?>
            <td><input type="text" name="product[<?php echo $i ?>][price]" value="<?php echo $this->getCustomerPrice($product->productId) ?>"></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
        <?php endif; ?>
    </table>
</form>
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
    

    
