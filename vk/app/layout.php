<?php require 'functions.php'; ?>                                                                                                                                                                              

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title><?php siteName(); ?></title>
    <style type="text/css">
        .wrap {
           max-width: 700px;
           margin: 50px auto;
           padding: 30px;
           text-align: center;
           box-shadow: 0 0 5px rgba(0,0,0,.5);
        }
        .content {
           text-align: left;
           padding: 40px;
        }
    </style>
</head>

<body>
<div class="wrap">

    <header>
        <h2><?php siteName(); ?></h2>
        <nav class="menu">
            <a href="/home">Home</a> |
            <a href="/products">Products</a> |
            <a href="/contacts">Contacts</a>
        </nav>
    </header>

    <div class="content">
        <?php include $pageContent ?>
    </div>

    <footer><small>&copy;<?php echo date('Y'); ?> <?php siteName(); ?>. All rights reserved.</small></footer>
</div>
</body>

</html>

