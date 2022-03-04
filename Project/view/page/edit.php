<?php $page = $this->getPage() ?>
<!DOCTYPE html>

	<form action="<?php echo $this->getUrl('save','page',[],true) ?>" method="post">
		<table cellpadding="4" border="3" width="100%">
			<tr colspan="2">
				<th>Page Edit<th>
			<input type="hidden" name="page[pageId]" value="<?php echo $page->pageId ?>">
			</tr>
			<tr>
				<td width="10%">Name</td>
				<td><input type="text" name="page[name]" value="<?php echo $page->name ?>" ></td>
			</tr>
			<tr>
				<td width="10%">Code</td>
				<td><input type="text" name="page[code]" value="<?php echo $page->code ?>" ></td>
			</tr>
			<tr>	
				<td width="10%">Content</td>
				<td><input type="text" name="page[content]" value="<?php echo $page->content ?>" ></td>
			</tr>
			<tr>	
				<td width="10%">Status</td>
				<td>
					<select name="page[status]">
						<option value="1" <?php echo ($page->getStatus($page->status)=='Active')?'selected':'' ?>>Active</option>
					<option value="2" <?php echo ($page->getStatus($page->status)=='Inactive')?'selected':'' ?>>Inactive</option>
					</select>
				</td>
			</tr>	
				<td width="10%">&nbsp;</td>
				<td>
					<input type="submit" value="Save" >
					<button><a href="<?php echo $this->getUrl('grid','page',[],true) ?>">Cancel</a></button>
				</td>
				
			</tr>
		</table>
	</form>
