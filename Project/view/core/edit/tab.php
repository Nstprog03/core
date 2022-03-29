<?php $tabs = $this->getTabs(); ?>
<?php foreach($tabs as $key => $tab): ?>
    <a href="<?php echo $tab['url'] ?>" <?php echo ($this->getCurrentTab() == $key) ? 'style ="color:red;"' : 'style ="color:green;"' ; ?>><?php echo $tab['title'];?></a>
<?php endforeach;?>