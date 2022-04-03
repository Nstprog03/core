<?php 
$collections = $this->getCollection();
$columns = $this->getColumns();
$actions =  $this->getActions();
$pager = $this->getPager(); ?>

<h2>Records</h2>

<br>
<br>
<div class="row">
    <div class="col-md-2">
        <div class="card card-primary">
            <button class="btn btn-block btn-success" type="button" id="addNew">Add</button>
        </div>
    </div>
</div>
<br>
<br>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <?php foreach ($columns as $key => $column) :?>
            <th><?php echo $column['title'] ?></th>
        <?php endforeach; ?>
        <?php foreach ($actions as $key => $action) :?>
            <th><?php echo $key ?></th>
        <?php endforeach; ?>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($collections as $collection) :?>
        <tr>
            <?php foreach ($columns as $key => $column):?>
                <td><?php echo $this->getColumnData($column,$collection); ?></td>
            <?php endforeach; ?>
            <?php foreach ($actions as $action) : ?>
                <?php $key = $columns['id']['key']; ?>
                <td><button type="button" class="btn btn-block btn-info <?php echo $action['title'] ?>" value="<?php echo $collection->$key; ?>"><?php echo $action['title']; ?></button></td>
            <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<nav aria-label="Page navigation">
  <ul class="pagination justify-content-center">
    <li class="page-item m-1">
      <select class="form-control" id="ppr">
            <option selected>select</option>
            <?php foreach ($pager->getPerPageCountOption() as $pageCount):?>
                <option value="<?php echo $pageCount?>"><?php echo $pageCount?></option>
            <?php endforeach; ?>
        </select>
    </li>
    <li class="page-item m-1"><button type="button" class="pagerBtn btn btn-default" value="<?php echo $this->getUrl('gridBlock',null,['p' => $pager->getStart()]) ?>"  <?php echo (!$this->getPager()->getStart()) ? 'disabled' : ''?>>Start</button>
        </div></li>
    <li class="page-item m-1"><button type="button" class="pagerBtn btn btn-default" value="<?php echo $this->getUrl('gridBlock',null,['p' => $pager->getPrev()]) ?>"  <?php echo (!$this->getPager()->getPrev()) ? 'disabled' : ''?>>Previous</button></li>
    <li class="page-item m-1"><h3><?php echo $this->getPager()->getCurrent() ?></h3></li>
    <li class="page-item m-1">
      <button type="button" class="pagerBtn btn btn-default" value="<?php echo $this->getUrl('gridBlock',null,['p' => $pager->getNext()]) ?>"  <?php echo (!$this->getPager()->getNext()) ? 'disabled' : ''?>>Next</button>
    </li>
    <li class="page-item m-1">
      <button type="button" class="pagerBtn btn btn-default" value="<?php echo $this->getUrl('gridBlock',null,['p' => $pager->getEnd()]) ?>"  <?php echo (!$this->getPager()->getEnd()) ? 'disabled' : ''?>>End</button>
    </li>
  </ul>
</nav>


<script type="text/javascript">
   $("#addNew").click(function(){
        admin.setData({'id' : null});
        admin.setUrl("<?php echo $this->getUrl('addBlock'); ?>");
        admin.load();
    });

    $(".delete").click(function(){
        var data = $(this).val();
        admin.setData({'id' : data});
        admin.setType('GET');
        admin.setUrl("<?php echo $this->getUrl('delete'); ?>");
        admin.load();
    });

    $(".edit").click(function(){
        var data = $(this).val();
        admin.setData({'id' : data});
        admin.setUrl("<?php echo $this->getUrl('editBlock'); ?>");
        admin.setType('GET');        
        admin.load();
    });

    $(".price").click(function(){
        var data = $(this).val();
        admin.setData({'id' : data});
        admin.setUrl("<?php echo $this->getUrl('gridBlock','customer_price'); ?>");
        admin.setType('GET');
        admin.load();
    });
    $(".Manage").click(function(){
        var data = $(this).val();
        admin.setData({'id' : data});
        admin.setUrl("<?php echo $this->getUrl('gridBlock','salesman_salesmanCustomer'); ?>");
        admin.setType('GET');
        admin.load();
    });
     $("#ppr").click(function(){
        var data = $(this).val();
        admin.setUrl("<?php echo $this->getUrl('gridBlock',null,['p'=>1,'ppr'=>null]); ?>&ppr="+data);
        admin.setType('GET');
        admin.load();
    });
     $(".pagerBtn").click(function(){
        var data = $(this).val();
        admin.setUrl(data);
        admin.setType('GET');
        admin.load();
    });
</script>
