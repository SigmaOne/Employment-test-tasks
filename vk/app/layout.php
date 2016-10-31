<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Vk.com highload test project</title>

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
        .success {
           color: green;
        }
        .error {
           color: red;
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>

<body>
    <div class="wrap">

        <header>
            <h2>Vk.com highload test project</h2>
            <nav class="menu">
                <a href="/home">Home</a> |
                <a href="/products">Products</a> |
                <a href="/contacts">Contacts</a>
            </nav>
        </header>

        <div class="content">
            <?php include $pageContent ?>
        </div>

        <footer><small>&copy;<?php echo date('Y'); ?> SigmaOne. All rights reserved.</small></footer>
    </div>
</body>

</html>

