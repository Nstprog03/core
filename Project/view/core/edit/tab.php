<?php $tabs = $this->getTabs(); ?>
<div class="row">
          <div class="col-12">
            <div class="card card-danger card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
<?php foreach($tabs as $key => $tab): ?>
    <li class="nav-item">
        <button type="button" class="nav-link loadTab <?php echo ($this->getCurrentTab() == $key) ? 'active' : '' ; ?>" data-toggle="pill" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true" value="<?php echo $tab['url'] ?>" <?php echo ($this->getCurrentTab() == $key) ? 'disabled' : '' ?>><?php echo $tab['title'];?></button>
      </li>
    
<?php endforeach;?>
</ul>
</div>
</div>
</div>
</div>
<script>
    jQuery(".loadTab").click(function(){
        admin.setUrl($(this).val());
        admin.setType('GET');
        admin.load();
    });
</script>
