<?php $page = $this->getPage();?>

<div class="card card-info">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name<input type="text" name="page[pageId]" value="<?php echo $page->pageId ?>" hidden></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control"  name="page[name]" id="name" value="<?php echo $page->name ?>" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="code" class="col-sm-2 col-form-label">Code</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control"  name="page[code]" id="code" value="<?php echo $page->code ?>" placeholder="Code">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="content" class="col-sm-2 col-form-label">Content</label>
                    <div class="col-sm-10">
                        <input type="content" class="form-control"  name="page[content]" id="content" value="<?php echo $page->content ?>" placeholder="Content">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="page[status]" id="pageSelect">
                            <option value="1" <?php echo($page->getStatus($page->status)=='Active')?'selected':'' ?>>Active</option>
                            <option value="2" <?php echo($page->getStatus($page->status)=='Inactive')?'selected':'' ?>>Inactive</option>
                        </select>
                    </div>
                  </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="button" class="btn btn-info" id="pageSubmitBtn">Save</button>
                    <button type="button" class="btn btn-default" id="pageCancelBtn">Cancel</button>
                </div>
                <!-- /.card-footer -->
            </div>
            
<script>
    $("#pageSubmitBtn").click(function(){
        admin.setForm($("#indexForm"));
        admin.setUrl("<?php echo $this->getEdit()->getSaveUrl(); ?>");
        admin.load();
    });

    $("#pageCancelBtn").click(function(){
        admin.setUrl("<?php echo $this->getUrl('gridBlock','page'); ?>");
        admin.load();
    });
</script>