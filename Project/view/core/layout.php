

<!DOCTYPE html>
<html lang="en">
    <?php echo $this->getHead()->toHtml(); ?>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
    
    <?php echo $this->getHeader()->toHtml(); ?>
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="container-fluid">
                        <td id="content"><?php echo $this->getContent()->toHtml(); ?></td>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php echo $this->getFooter()->toHtml(); ?>
</div>
</div>
</body>
</html>
