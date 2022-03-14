<?php $pages = $this->getPages(); ?>

<form action="<?php echo $this->getUrl('delete','page',[],true) ?>" method ="post">
	<table>
		<thead>
			<th>Manage Pages</th>
			<td><button><a href="<?php echo $this->getUrl('add','page',[],true) ?>">Add New</a></button></td>

			<td><input type="submit" name="submit" value="Delete Selected Data"></td>
		</thead>
	</table>
	<table border="3" width="100%" cellspacing="4">
		<tr>
			<th>Check box <input type="checkbox" name="select" id="select" onclick="select()"></th>
			<th>Page Id</th>
			<th>Name</th>
			<th>Code</th>
			<th>Content</th>
			<th>Status</th>
			<th>Created Date</th>
			<th>Updated Date</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?php if(!$pages): ?>
			<tr><td  colspan="9" >NO DATA FOUND</td></tr>
		<?php else : ?>

		<?php foreach ($pages as $page) : ?>
			<tr>
				<td><input type="checkbox" name="page[]" id="<?php echo $page->pageId ?>" value="<?php echo $page->pageId ?>"></td>
				<td><?php echo $page->pageId ?></td>
				<td><?php echo $page->name ?></td>
				<td><?php echo $page->code ?></td>
				<td><?php echo $page->content ?></td>
				<td><?php echo $page->getStatus($page->status) ?></td>
				<td><?php echo $page->createdAt ?></td>
				<td><?php echo $page->updatedAt ?></td>
				<td><a href="<?php echo $this->getUrl('edit','page',['id'=>$page->pageId],true) ?>">Edit</a></td>
				<td><a href="<?php echo $this->getUrl('delete','page',['id'=>$page->pageId],true) ?>">Delete</a></td>
			</tr>
		<?php endforeach;?>
	<?php endif;?>
	
            
	</table>
</form>
	<table>
		<tr>
			<script type="text/javascript"> 
				function select() {
					var checkbox = document.getElementByName('page');
					alert(111);
					// for (i = 0; i < myArray.length; i++)
					// {
						
					// }
					// for (var checkbox of checkboxes) {
     //    				checkbox.checked = this.checked;
    	// 			}	
				}



				function ppr() {
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