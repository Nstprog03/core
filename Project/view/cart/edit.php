<?php 
$customers = $this->getCustomers();
$cart = $this->getCart();
$customer = $cart->customer;
$billingAddress = $cart->billingAddress;
$shippingAddress = $cart->shippingAddress;
$products = $this->getProducts();
$item = $cart->item;
$items = $this->getItems();
$disabled = (!$items)?'disabled':"";

?>
<select id="selectcustomer" onchange="changeCustomer()">
    <option value="none">Select</option>
    <?php foreach($customers as $cust): 
        print_r($cust->customerId); ?>
    <option value="<?php echo $cust->customerId ?>" <?php echo ($cust->customerId == $customer->customerId)?'selected':'' ?>> ID :<?php echo $cust->customerId ?> Name: <?php echo $cust->firstName." ".$cust->lastName." Email: ".$cust->email; ?></option>
    <?php endforeach; ?>
</select>
<h3>Customer Data</h3>
<table border="1">
    <tr>
        <td><label>Email: </label><input type="email" name="email" value="<?php echo $customer->email; ?>"></td>
        <td><label>Mobile: </label><input type="number" name="mobile" value="<?php echo $customer->mobile; ?>"></td>
    </tr>
</table>
<br>
<br>
<form action="<?php echo $this->getUrl('saveCartAddress') ?>" method="POST">
    <table border="1">
        <tr>
            <th>Billing Address</th>
            <th>Shipping Address</th>
        </tr>
        <tr>
            <td>
                <table border="1">
                    <tr>
                        <input type="hidden" name="billingAddress[billing]" value="1">
                        <input type="hidden" name="billingAddress[shipping]" value="2">
                        <td>First Name</td>
                        <td><input type="text" name="billingAddress[firstName]" id="billingAddress[firstName]" value="<?php echo $billingAddress->firstName; ?>"></td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td><input type="text" name="billingAddress[lastName]" id="billingAddress[lastName]" value="<?php echo $billingAddress->lastName; ?>"></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><textarea name="billingAddress[address]" id="billingAddress[address]" rows="4" cols="50"><?php echo $billingAddress->address; ?></textarea></td>
                    </tr>
                    <tr>
                        <td>Zip code</td>
                        <td><input type="text" name="billingAddress[postalCode]" id="billingAddress[postalCode]" value="<?php echo $billingAddress->postalCode; ?>"></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td><input type="text" name="billingAddress[city]" id="billingAddress[city]" value="<?php echo $billingAddress->city; ?>"></td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td><input type="text" name="billingAddress[state]" id="billingAddress[state]" value="<?php echo $billingAddress->state; ?>"></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td><input type="text" name="billingAddress[country]" id="billingAddress[country]" value="<?php echo $billingAddress->country; ?>"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="checkbox" name="saveToBillingBook" value=1>Save to Address Book</td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="checkbox" name="copyAddress" id="copyAddress" onchange="sameAddress()" />Mark As Shiping</td>
                    </tr>
                </table>
            </td>
            <td>
                <table border="1">
                    <tr>
                        <input type="hidden" name="shippingAddress[billing]" value="2">
                        <input type="hidden" name="shippingAddress[shipping]" value="1">
                        <td>First Name</td>
                        <td><input type="text" name="shippingAddress[firstName]" id="shippingAddress[firstName]" value="<?php echo $shippingAddress->firstName; ?>"></td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td><input type="text" name="shippingAddress[lastName]" id="shippingAddress[lastName]" value="<?php echo $shippingAddress->lastName; ?>"></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><textarea name="shippingAddress[address]" id="shippingAddress[address]" rows="4" cols="50"><?php echo $shippingAddress->address; ?></textarea></td>
                    </tr>
                    <tr>
                        <td>Zip code</td>
                        <td><input type="text" name="shippingAddress[postalCode]" id="shippingAddress[postalCode]" value="<?php echo $shippingAddress->postalCode; ?>"></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td><input type="text" name="shippingAddress[city]" id="shippingAddress[city]" value="<?php echo $shippingAddress->city; ?>"></td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td><input type="text" name="shippingAddress[state]" id="shippingAddress[state]" value="<?php echo $shippingAddress->state; ?>"></td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td><input type="text" name="shippingAddress[country]" id="shippingAddress[country]" value="<?php echo $shippingAddress->country; ?>"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="checkbox" name="saveToShippingBook">Save to Address Book</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <input type="submit" value="Save Address">
</form>
<br>
<br>
<table border="1">
    <tr>
        <th>Payment Method</th>
        <th>Shiping Method</th>
    </tr>
    <tr>
        <td>
            <table>
                <form action="<?php echo $this->getUrl('savePaymentMethod');?>" method="POST">
                    <tr>
                        <td><input type="radio" name="paymentMethod" value="1">Credit/Debit</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="paymentMethod" value="2">UPI</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="paymentMethod" value="3">QR</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="paymentMethod" value="4" checked>Case On Delivery</td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Update"></td>
                    </tr>
                </form>
            </table>
        </td>
        <td>
            <table>
                <form action="<?php echo $this->getUrl('saveShipingMethod');?>" method="POST">
                    <tr>
                        <td><input type="radio" name="shippingMethod" value="1">Same Day Delivery</td>
                        <td>100</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="shippingMethod" value="2">Express</td>
                        <td>75</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="shippingMethod" value="3" checked>Normal Delivery</td>
                        <td>50</td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Update"></td>
                    </tr>
                </form>
            </table>
        </td>
    </tr>
</table>
<br>
<br>
<div id="productTable">
    <form action="<?php echo $this->getUrl('addCartItem');?>" method="POST">
        <input type="submit" value="Add Item">
        <button type="button" id="hideProduct">Cancel</button>
        <table border="1" id="productTable">
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            <?php if(!$products): ?>
            <tr>
                <td colspan="6">Products not available!</td>
            </tr>
            <?php else: ?>
            <?php $i = 0; ?>
            <?php foreach($products as $product): ?>
            <tr>
                <?php if($product->base): ?>
                <td><img src="<?php  echo $product->getBase()->getImgPath();?>" alt="No Image Found" width="50" height="50"></td>
                <?php else: ?>
                <td>No Base Image</td>
                <?php endif; ?>
                <td><?php echo $product->name; ?></td>
                <td><input type="number" name="cartItem[<?php echo $i ?>][quantity]" min="1"></td>
                <td><?php echo $product->price; ?></td>
                <td>200</td>
                <td><input type="checkbox" name="cartItem[<?php echo $i ?>][productId]" value="<?php echo $product->productId ?>"></td>
            </tr>
            <?php $i++; ?>
            <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </form>
</div>
<br>
<br>
<div>
    <form action="<?php echo $this->getUrl('cartItemUpdate'); ?>" method="POST">
        <input type="submit" value="Update">
        <button type="button" value="" id="showProduct">New Item</button>
        <table border="1">
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Row Tatal</th>
                <th>Delete</th>
            </tr>
            <?php if(!$items): ?>
            <tr>
                <td colspan="6">no item found</td>
            </tr>
            <?php else: ?>
            <?php $i = 0; ?>
            <?php foreach($items as $item): ?>
            <tr>
                <input type="hidden" name="cartItem[<?php echo $i ?>][itemId]" value="<?php echo $item->itemId ?>">
                <input type="hidden" name="cartItem[<?php echo $i ?>][productId]" value="<?php echo $item->productId ?>">
                <td><img src="<?php echo $item->getProduct()->getBase()->getImgPath(); ?>" alt="No Image Found" width="50" height="50"></td>
                <td><?php echo $item->getProduct()->name; ?></td>
                <td><input type="number" name="cartItem[<?php echo $i ?>][quantity]" value="<?php echo $item->quantity; ?>" min="1"></td>
                <td><?php echo $item->getProduct()->price; ?></td>
                <td align="right"><?php echo $item->itemTotal; ?></td>
                <td align="center"><a href="<?php echo $this->getUrl('deleteCartItem',null,['itemId' => $item->itemId]) ?>">Remove</a></td>
            </tr>
            <?php $i++; ?>
            <?php endforeach; ?>
            <?php endif;?>
            <tr>
                <td colspan="5" align="right"><?php echo $this->getTotal(); ?></td>
            </tr>
        </table>
    </form>
    
</div>
<br>
<br>
<form action="<?php echo $this->getUrl('placeOrder') ?>" method="POST">
    <table>
        <tr>
            <td width="70%" align="right">Subtotal</td>
            <td><?php echo (!$this->getTotal()) ? '0' : $this->getTotal(); ?></td>
        </tr>
        <tr>
            <td width="70%" align="right">Shipping</td>

            <td><?php echo (!$cart->cart->shippingCharge) ? '0' : $cart->cart->shippingCharge;?></td>
        </tr>
        <tr>
            <td width="70%" align="right">Tax</td>
            <td><?php echo $this->getTax($cart->cart->cartId); ?></td>
        </tr>
        <tr>
            <td width="70%" align="right">Discount</td>
            <td><?php echo $cart->cart->discount; ?></td>
        </tr>
        <tr>
            <td width="70%" align="right">Grand Total</td>
            <input type="hidden" name="grandTotal" value="<?php echo $this->getTotal() + ($cart->cart->shippingCharge) + $this->getTax($cart->cart->cartId) - $cart->cart->discount; ?>">
            <input type="hidden" name="discount" value="<?php echo $cart->cart->discount;    ?>">
            <input type="hidden" name="taxAmount" value="<?php echo $this->getTax($cart->cart->cartId); ?>">
            <td><?php echo $this->getTotal() + ($cart->cart->shippingCharge) + $this->getTax($cart->cart->cartId) - $cart->cart->discount;; ?></td>
        </tr>
        <tr>
            <td width="70%" align="right"></td>
            <td><input type="submit" name="Place Order" <?php echo $disabled; ?> /></td>
        </tr>
    </table>
</form><br>

<script type="text/javascript">
    function changeCustomer() 
    {
        const val = document.getElementById('selectcustomer').selectedOptions[0].value;
        window.location = "<?php echo $this->getUrl('addCart','cart',['id'=>null]);?>&id="+val;
    }

    function sameAddress()
    {
        var checkedBox = document.getElementById("copyAddress");
        
        if(checkedBox.checked == true)
        {
            document.getElementById("shippingAddress[firstName]").value = document.getElementById("billingAddress[firstName]").value; 
            document.getElementById("shippingAddress[lastName]").value = document.getElementById("billingAddress[lastName]").value; 
            document.getElementById("shippingAddress[address]").value = document.getElementById("billingAddress[address]").value; 
            document.getElementById("shippingAddress[postalCode]").value = document.getElementById("billingAddress[postalCode]").value; 
            document.getElementById("shippingAddress[city]").value = document.getElementById("billingAddress[city]").value; 
            document.getElementById("shippingAddress[state]").value = document.getElementById("billingAddress[state]").value; 
            document.getElementById("shippingAddress[country]").value = document.getElementById("billingAddress[country]").value; 
        }
        else
        {
            document.getElementById("shippingAddress[firstName]").value = null; 
            document.getElementById("shippingAddress[lastName]").value = null; 
            document.getElementById("shippingAddress[address]").value = null; 
            document.getElementById("shippingAddress[postalCode]").value = null; 
            document.getElementById("shippingAddress[city]").value = null; 
            document.getElementById("shippingAddress[state]").value = null; 
            document.getElementById("shippingAddress[country]").value = null; 
        }
    }
</script>
<script>
    $(document).ready(function(){
        $("#productTable").hide();
        $("#showProduct").click(function(){
            $("#productTable").show();
        });
        $("#hideProduct").click(function(){
            $("#productTable").hide();
        });
    });
</script>
