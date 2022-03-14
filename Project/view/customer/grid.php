<?php 
$customers = $this->getCustomers();
$addresses = $this->getAddresses();
?>

	<button name="Add"><a href="<?php echo $this->getUrl('add') ?>"><h3>Add</h3></a></button>
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<th>customer Id</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Mobile</th>
			<th>Status</th>
			<th>Created Date</th>
			<th>Updated Date</th>
			<th>Address</th>
			<th>Price</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?php if(!$customers):  ?>
			<tr><td colspan="11">No Record available.</td></tr>
		<?php else:  ?>
			<?php foreach ($customers as $customer): ?>
				
			<tr>
				<td><?php echo $customer->customerId ?></td>
				<td><?php echo $customer->firstName ?></td>
				<td><?php echo $customer->lastName ?></td>
				<td><?php echo $customer->email ?></td>
				<td><?php echo $customer->mobile ?></td>
				<td><?php echo $customer->getStatus($customer->status)?></td>
				<td><?php echo $customer->createdAt ?></td>
				<td><?php echo $customer->updatedAt ?></td>
				<td><?php foreach ($addresses as $address): ?>
					<?php if($address->customerId==$customer->customerId):
							echo "Address : ".$address->address."<br>";
							echo "Postal Code : ".$address->postalCode."<br>";
							echo "Ciry : ".$address->city."<br>";
							echo "State : ".$address->state."<br>";
							echo "Country : ".$address->country."<br>";
							echo "Address Type : ";
							if($address->getStatus($address->billing)=='Active')
								echo "Billing";
							if($address->getStatus($address->shipping)=='Active')
								echo ",Shipping";

					endif; ?>
					<?php endforeach;	?>
				</td>
				<td><a href="<?php echo $this->getUrl('grid','customer_price',['id' => $customer->customerId],true); ?>">Price</a></td>
				<td><a href="<?php echo $this->getUrl('edit','customer',['id'=>$customer->customerId],true) ?>">Edit</a></td>
				<td><a href="<?php echo $this->getUrl('delete','customer',['id'=>$customer->customerId],true) ?>">Delete</a></td>
			
			</tr>
			
		<?php endforeach;	?>
		<?php endif;  ?>
		
	</table>
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
	

	
