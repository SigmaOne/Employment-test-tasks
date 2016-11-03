<?php
require_once 'products_crud.php';

for ($i = 0; $i < 1000000; $i++) {
    insertProduct(("Product " . $i), "Test product", rand(1, 100000), "http://product_" . $i . ".png");
}
