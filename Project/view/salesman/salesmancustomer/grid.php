<?php 
$customers = $this->getCustomers();
?>
<h3>Avalilabel Customer</h3>
<form action="<?php echo $this->getUrl('save','Salesman_SalesmanCustomer',['id'=> $this->getSalesmanId()],true) ?>" method="post">
    <input type="submit" value="save">
    <button><a href="<?php echo $this->getUrl('grid','Salesman'); ?>">Cancel</a></button>
    <table border="1" width="100%">
        <tr>
            <th>Select</th>
            <th>Customer Id</th>
            <th>First Name</th>
            <th>Last Name</th>
        </tr>
        <?php if(!$customers): ?>
                <tr>
                    <td colspan="4">No Recored Found</td>
                </tr>
            <?php else: ?>
            <?php foreach ($customers as $customer): ?>
            <tr>
                <td><input type="checkbox" name="customer[]" value='<?php echo $customer->customerId; ?>' <?php echo $this->selected($customer->customerId); ?> ></td>
                <td><?php echo $customer->customerId; ?></td>
                <td><?php echo $customer->firstName; ?></td>
                <td><?php echo $customer->lastName; ?></td>
            </tr>
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