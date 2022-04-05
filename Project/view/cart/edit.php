<?php 
$customers = $this->getCustomers(); 
$cart = $this->getCart();
$customer = $cart->getCustomer();
$billingAddress = $cart->getBillingAddress();
$shippingAddress = $cart->getShippingAddress();
$shippingMethods = $this->getShippingMethods();
$paymentMethods = $this->getPaymentMethods();
$item = $cart->getItem();
$items = $this->getItems();
$products = $this->getProducts();
$disabled = (!$items)?'disabled':"";
?>

<div class="row">
    <div class="col-sm-12">
        <!-- select -->
        <div class="form-group">
            <select class="form-control" id="cartChange">
            <option value="">Select</option>
                <?php foreach($customers as $cust): ?>
                    <option value="<?php echo $cust->customerId ?>" <?php echo ($cust->customerId == $customer->customerId) ? "selected" : "";?>><?php echo $cust->firstName." ".$cust->email; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>

<div id="customerDetails">
    <h3>Customer Data</h3>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Mobile</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $customer->firstName; ?></td>
                <td><?php echo $customer->lastName; ?></td>
                <td><?php echo $customer->email; ?></td>
                <td><?php echo $customer->mobile; ?></td>
            </tr>
        </tbody>
    </table>
</div>

<div id="cartAddress">

</div>

<div id="paymentShipping">

</div>
    
<div id="cartProduct">

</div>

<div id="cartSubTotal" class="col-sm-6">

</div>

<script type="text/javascript">
    function same() {
        var checkedBox = document.getElementById("customCheckbox4");
        if(checkedBox.checked == true){
            var firstName = document.getElementById("exampleInputFirstName").value;
            var lastName = document.getElementById("exampleInputLastName").value;
            var address = document.getElementById("exampleInputAddress").value;
            var city = document.getElementById("exampleInputCity").value;
            var state = document.getElementById("exampleInputState").value;
            var postalCode = document.getElementById("exampleInputPosatalCode").value;
            var country = document.getElementById("exampleInputCountry").value;

            document.getElementById("exampleInputFirstName1").value = firstName; 
            document.getElementById("exampleInputLastName1").value = lastName; 
            document.getElementById("exampleInputAddress1").value = address; 
            document.getElementById("exampleInputCity1").value = city; 
            document.getElementById("exampleInputState1").value = state; 
            document.getElementById("exampleInputPosatalCode1").value = postalCode; 
            document.getElementById("exampleInputCountry1").value = country; 
        }
        else{
            document.getElementById("exampleInputFirstName1").value = null; 
            document.getElementById("exampleInputLastName1").value = null; 
            document.getElementById("exampleInputAddress1").value = null; 
            document.getElementById("exampleInputCity1").value = null; 
            document.getElementById("exampleInputState1").value = null; 
            document.getElementById("exampleInputPosatalCode1").value = null; 
            document.getElementById("exampleInputCountry1").value = null; 
        }
    }

</script>
<script>
    $(document).ready(function(){
        admin.setUrl("<?php echo $this->getUrl('indexBlock'); ?>");
        admin.load();

        $("#cartChange").change(function(){
            admin.setData({'id' : $(this).val()});
            admin.setUrl("<?php echo $this->getUrl('addCart',null,['id'=>null]);?>");
            admin.load();
        });
    });
</script>