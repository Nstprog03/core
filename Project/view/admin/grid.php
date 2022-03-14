<?php $admins = $this->getAdmins();?>

	<button name="Add"><a href="<?php echo $this->getUrl('add') ?>"><h3>Add</h3></a></button>
	<table border="1" width="100%" cellspacing="4">
		<tr>
			<th>Admin Id</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Status</th>
			<th>Created Date</th>
			<th>Updated Date</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?php if(!$admins):  ?>
			<tr><td colspan="9">No Record available.</td></tr>
		<?php else:  ?>
			<?php foreach ($admins as $admin): ?>
			<tr>
				<td><?php echo $admin->adminId ?></td>
				<td><?php echo $admin->firstName ?></td>
				<td><?php echo $admin->lastName ?></td>
				<td><?php echo $admin->email ?></td>
				<td><?php echo $admin->getStatus($admin->status)?></td>
				<td><?php echo $admin->createdAt ?></td>
				<td><?php echo $admin->updatedAt ?></td>
				<td><a href="<?php echo $this->getUrl('edit','admin',['id'=>$admin->adminId],true) ?>">Edit</a></td>
				<td><a href="<?php echo $this->getUrl('delete','admin',['id'=>$admin->adminId],true) ?>">Delete</a></td>
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
	
