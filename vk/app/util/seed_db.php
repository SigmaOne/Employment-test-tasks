<?php
require_once 'products_crud.php';

$connection = getDbConnection(DB_NAME);
for ($i = 0; $i < 1000000; $i++) {
    insertProduct($connection, ("Product " . $i), "Test product", rand(1, 100000), "http://product_" . $i . ".png");
}
closeDbConnection($connection);

?>
