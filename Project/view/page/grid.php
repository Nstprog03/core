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

