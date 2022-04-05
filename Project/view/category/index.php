<form action="<?php echo $this->getUrl('gridBlock'); ?>" method="POST" id="indexForm" enctype="multipart/form-data">
    <div id="indexContent">
        
    </div>
</form>
<script type="text/javascript">
    admin.setForm(jQuery("#indexForm"));
    admin.load();
</script>
