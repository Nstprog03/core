<?php $salesmen = $this->getSalesmen(); ?>



	<button name="Add" ><a id="update" href="<?php echo $this->getUrl('add') ?>"><h3>Add</h3></a></button>
	<table border="3" cellspacing="3" width="100%">
		<tr>
			<th>Salesman ID</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Mobile</th>
			<th>Status</th>
			<th>Percentage</th>
			<th>Created Date</th>
			<th>Updated Date</th>
			<th>Customer</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?php if(!$salesmen) : ?>
			<tr>
				<td colspan="10">NO RECORD FOUND</td>
			</tr>
		<?php else : ?>
			<?php foreach ($salesmen as $salesman) : ?>
				<tr>
					<td><?php echo $salesman->salesmanId ?></td>
					<td><?php echo $salesman->firstName ?></td>
					<td><?php echo $salesman->lastName ?></td>
					<td><?php echo $salesman->email ?></td>
					<td><?php echo $salesman->mobile ?></td>

					<td><?php echo $salesman->getStatus($salesman->status) ?></td>
					 <td><?php echo $salesman->discount; ?></td>
					<td><?php echo $salesman->createdAt ?></td>
					<td><?php echo $salesman->updatedAt ?></td>
					<td><a  href="<?php echo $this->getUrl('grid','salesman_salesmanCustomer',['id' => $salesman->salesmanId],true); ?>">Manage</a></td>
					<td><a id="update" href="<?php echo $this->getUrl('edit','salesman',['id'=>$salesman->salesmanId],true) ?>">Edit</a></td>
					<td><a id= "delete" href="<?php echo $this->getUrl('delete','salesman',['id'=>$salesman->salesmanId],true) ?>">Delete</a></td>
				</tr>
			<?php endforeach ;?>
		<?php endif; ?>
	</table>
	<table>
		<tr>
			
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

			<script type="text/javascript">
				$(document).on('click','#delete',function () {
					event.preventDefault();
					$.ajax({
						  type: 'GET',
						  url: jQuery(this).attr('href'),
						  success: function(data) {

						  	$('#layout').load("<?php echo $this->getUrl('grid');?>");
						},
						dataType : 'json'
						});

				});

				$(document).on('click','#update',function () {

					event.preventDefault();
					$.ajax({
							  type: 'GET',
							  url: jQuery(this).attr('href'),
							  success: function(data) {
							  	//console.log(data);
							  	$('#layout').html(data);
							},
							dataType : 'html'
							});
							 // alert();

				});
			</script>