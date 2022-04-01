<?php $page = $this->getPage() ?>
<!DOCTYPE html>

	<form action="<?php echo $this->getUrl('save','page',[],true) ?>" id="form" method="post">
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
					<input type="button" id="submit" value="Save" >
					<button id = "cancel">Cancel</button>
				</td>
				
			</tr>
		</table>
	</form>
<script type="text/javascript">
	$(document).on('click','#cancel',function () {
	  event.preventDefault();
	  $.ajax({
	        type: 'GET',
	        url: "<?php echo $this->getUrl('gridContent')?>",
	        success: function(data) {
	          $('#content').html(data);
	      },
	      dataType : 'html'
	      });

	});
	$(document).ready(function()
    {
        $("#submit").click(function()
        {
            var data = $("#form").serializeArray();
            admin.setData(data);
            admin.validate();
            admin.setUrl("<?php echo $this->getUrl('gridContent') ?>")
            admin.load();
        });
    });
</script>