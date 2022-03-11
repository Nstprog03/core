<?php $pages = $this->getPages(); ?>


	<button><a href="<?php echo $this->getUrl('add','page',[],true) ?>">Add</a></button>
	<table border="3" width="100%" cellspacing="4">
		<tr>
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

	<table>
		<tr><button><a style="<?php echo ($this->pager->getStart()==NULL)? "pointer-events: none" : "" ?>" href="<?php echo $this->getUrl(null,null,['p' => $this->pager->getStart()]) ?>">Start</a></button></tr>
            <tr><button><a style="<?php echo ($this->pager->getPrev()==NULL)? "pointer-events: none" : "" ?>" href="<?php echo $this->getUrl(null,null,['p' => $this->pager->getPrev()]) ?>">Prev</a></button></tr>
            <tr><button><a href="<?php echo $this->getUrl(null,null,['p' => $this->pager->getCurrent()]) ?>">Current</a></button></tr>
            <tr><button><a style="<?php echo ($this->pager->getNext()==NULL)? "pointer-events: none" : "" ?>" href="<?php echo $this->getUrl(null,null,['p' => $this->pager->getNext()]) ?>">Next</a></button></tr>
            <tr><button><a style="<?php echo ($this->pager->getEnd()==NULL)? "pointer-events: none" : "" ?>" href="<?php echo $this->getUrl(null,null,['p' => $this->pager->getEnd()]) ?>">End</a></button></tr>
	</table>