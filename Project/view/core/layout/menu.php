<?php ?>
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <style>
                body {
                    margin: 0;
                }

                .topnav {
                    display: table;
                    text-align: center;
                    width: 100%;

                    overflow: hidden;
                    background-color: #20cfcf;
                }

                .topnav a {
                    color: #f2f2f2;
                    display: inline-block;
                    float: none;
                    font-size: 25px;
                    padding: 10px 30px;
                    text-decoration: none;
                    font-weight: bold;
                }

                .topnav a:hover {
                    background-color: #ddd;
                    color: black;
                }

                .logout{
                    color: #DC143C;
                }

            </style>
        </head>
        <body>

        <div class="topnav">
            <?php
            $fileList = glob('Controller/*.php');
            foreach($fileList as $filename){
                if(is_file($filename)){
                    $file = explode("/", $filename);
                    //print_r($file);
                    $fileList = explode(".",$file[1]); ?>
                    <?php if(strtolower($fileList[0])!='order' && strtolower($fileList[0])!='customer' && strtolower($fileList[0])!='admin') : ?>
                    <a href="index.php?c=<?php echo (strtolower($fileList[0])); ?>&a=grid&p=1"><?php echo $fileList[0]; ?></a>
                    <?php endif;?>
                    <?php if(strtolower($fileList[0])=='customer' || strtolower($fileList[0])=='admin') : ?>
                    <a href="index.php?c=<?php echo (strtolower($fileList[0])); ?>&a=index"><?php echo $fileList[0]; ?></a>
                    <?php endif;
                }   
            }
        ?>
        <?php if(!$this->getLoginName()): ?>
            <a class="logout" href="index.php?c=admin_login&a=login">LOG IN</a>
        <?php else:?>
            <a class="logout" href="index.php?c=admin_login&a=logout">LOGOUT</a>
            <?php echo "<br>Hi' ".$this->getLoginName(); ?>
        <?php endif;?>
        </div>
        <div>
        </div>
    </body>

