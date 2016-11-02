<?php
require_once 'db_util.php';

// CREATE
function insertProduct($connection, $name, $description, $price, $imgUrl) {
    $sql = "insert into products (name, description, price, img_url) 
            values ('" . $name . "', '" . $description . "', '" . $price . "', '" . $imgUrl . "')";

    if (!mysqli_query($connection, $sql)) {
        die("Error: " . $sql . "<br>" . mysqli_error($connection) . PHP_EOL);
    }
}

// READ
function getProduct($connection, $id) {
    $sql = "select * from products where id = " . $id;

    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) == 1) {
		return mysqli_fetch_assoc($result); // return hashtable
	} else {
		return null;
	}
}

function getAllProducts($connection) {
	$sql = "select * from products";
	$resulted_array = array();

	if ($result = mysqli_query($connection, $sql)) {
		if (mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				array_push($resulted_array, $row);
			}
		}
	} else {
		die("Cannot fetch all products");
	}

	return $resulted_array;
}


// $firstIndex and last index are used to get products from interval
// e.g. getProductsSortedById($connection, 1, 5) will return first 5 products
//
function getProductsSortedById($connection, $firstIndex, $lastIndex) {
	$sql = "select * from products limit " . ($lastIndex - $firstIndex + 1) . " offset " . ($firstIndex - 1);
	$resulted_array = array();

	if ($result = mysqli_query($connection, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                array_push($resulted_array, $row);
            }
        }
    } else {
        die("Cannot fetch products Sorted by Id");
    }

	return $resulted_array;
}

// $firstIndex and last index are used to get products from interval
// e.g. getProductsSortedById($connection, 1, 5) will return first 5 products
//
function getProductsSortedByPrice($connection, $firstIndex, $lastIndex) {
	$sql = "select * from products order by price limit " . ($lastIndex - $firstIndex + 1) . " offset " . ($firstIndex - 1);
	$resulted_array = array();

	if ($result = mysqli_query($connection, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                array_push($resulted_array, $row);
            }
        }
    } else {
        die("Cannot fetch products Sorted by Price");
    }

	return $resulted_array;
}

// UPDATE
function updateProduct($connection, $id, $name, $description, $price, $imgUrl) {
    $sql = "update products set name='" . $name . "', description='" . $description . "', price='" . $price . "', img_url='" . $imgUrl . "' where id=" . $id;

    if (!mysqli_query($connection, $sql)) {
        die("Error updating record: " . mysqli_error($conn));
    }
}

// DELETE
function deleteProduct($connection, $id) {
    $sql = "delete from products where id=" . $id;

    if (!mysqli_query($connection, $sql)) {
        die("Error deleting record: " . mysqli_error($conn));
    }
}
