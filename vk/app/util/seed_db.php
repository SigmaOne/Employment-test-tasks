<?php

require_once 'products_crud.php';

$connection = getDbConnection(DB_NAME);

// Todo: Add automatic generation of 1_000_000 products
insertProduct($connection, "Bike", "Test product", 18000, "https://www.google.ru/url?sa=i&rct=j&q=&esrc=s&source=images&cd=&cad=rja&uact=8&ved=0ahUKEwi53c7N1vjPAhXlIpoKHUPlCnYQjRwIBw&url=http%3A%2F%2Fwww.wiggle.co.uk%2Fbikes%2F&psig=AFQjCNHfofl9ovwxZh6wSQG-XROq2IZNHA&ust=1477578394241203");
insertProduct($connection, "Cup of tea", "Test product", 50, "http://pngimg.com/upload/small/cup_PNG1973.png");

closeDbConnection($connection);

?>
