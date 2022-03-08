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