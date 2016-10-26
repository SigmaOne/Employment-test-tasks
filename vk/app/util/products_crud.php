<?php

require 'db_util.php';

// CREATE
function insertProduct($connection, $name, $description, $price, $imgUrl) {
    $sql = "insert into products (name, description, price, img_url) 
            values ('" . $name . "', '" . $description . "', '" . $price . "', '" . $imgUrl . "')";

    if (mysqli_query($connection, $sql)) {
        echo "Product '" . $name . "' has been inserted sucessfully" . PHP_EOL;
    } else {
        die("Error: " . $sql . "<br>" . mysqli_error($connection) . PHP_EOL);
    }
}

// Todo: add other crud operations

// READ

// UPDATE

// DELETE

?>
