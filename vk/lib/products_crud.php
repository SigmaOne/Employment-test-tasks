<?php
// Contains all the CRUD operations on products

require_once 'lib/db_util.php';
require_once 'lib/products_cache_crud.php';

define('SORTED_BY_ID_BASE_KEY', "products:sortedById");
define('SORTED_BY_PRICE_BASE_KEY', "products:sortedByPrice");

// CREATE
function insertProduct($name, $description, $price, $imgUrl) {
    $sql = "insert into products (name, description, price, img_url) 
            values ('" . $name . "', '" . $description . "', '" . $price . "', '" . $imgUrl . "')";

    $connection = getDbConnection(DB_NAME);
    $result = mysqli_query($connection, $sql);
    $id = mysqli_insert_id($connection);
    closeDbConnection($connection);

    if ($result) {
        // Todo: consider optimization: invalidate cache only if the last cached element's attribute(id or price) > attribute of newly inserted product
        invalidateProductsCache(SORTED_BY_ID_BASE_KEY);
        invalidateProductsCache(SORTED_BY_PRICE_BASE_KEY);
    } else {
        die("Error: " . $sql . "<br>" . mysqli_error($connection) . PHP_EOL);
    }
}

// UPDATE
function updateProduct($id, $name, $description, $price, $imgUrl) {
    $sql = "update products set name='" . $name . "', description='" . $description . "', price='" . $price . "', img_url='" . $imgUrl . "' where id=" . $id;

    $connection = getDbConnection(DB_NAME);
    $result = mysqli_query($connection, $sql);
    closeDbConnection($connection);

    if ($result) {
        invalidateProductsCache(SORTED_BY_ID_BASE_KEY);
        invalidateProductsCache(SORTED_BY_PRICE_BASE_KEY);
    } else {
        die("Error updating record");
    }
}

// DELETE
function deleteProduct($id) {
    $sql = "delete from products where id=" . $id;

    $connection = getDbConnection(DB_NAME);
    $result = mysqli_query($connection, $sql);
    closeDbConnection($connection);

    if ($result) {
        invalidateProductsCache(SORTED_BY_ID_BASE_KEY);
        invalidateProductsCache(SORTED_BY_PRICE_BASE_KEY);
    } else {
        die("Error deleting record: " . mysqli_error($conn));
    }
}

// READ
//
// $firstIndex and last index are used to get products from interval
// e.g. getProductsSortedById($connection, 1, 5) will return first 5 products
//
function getProductsSortedById($firstIndex, $lastIndex) {
	$products = [];
    $requestedAmount = $lastIndex - $firstIndex + 1; // Todo: consider returning null if $lastIndex < $firstIndex

    // Check cache
    $products = getManyFromProductsCache(SORTED_BY_ID_BASE_KEY, $firstIndex, $lastIndex);
    $cachedAmount = count($products);

    echo "cachedAmount: " . $cachedAmount . "<br/>";
    echo "requestedAmount: " . $requestedAmount . "<br/>";

    if ($cachedAmount == $requestedAmount) {
        // Cache contains every requested products
        echo "Cache contains every requested products  <br/>";
        return $products;
    } elseif ($cachedAmount != 0) {
        // Cache contains only part of a requested products, so go fetch remaining from db
        echo "Cache contains only part of a requested products, so go fetch remaining from db <br/>";
        $remainingAmount = $requestedAmount - $cachedAmount;
        $sql = "select * from products order by id limit " . $remainingAmount . " offset " . ($firstIndex + $cachedAmount - 1);

        $connection = getDbConnection(DB_NAME);
        $result = mysqli_query($connection, $sql);
        closeDbConnection($connection);

        if ($result) {
            if (mysqli_num_rows($result) != 0) {
                $index = ($firstIndex + $cachedAmount);
                while($product = mysqli_fetch_assoc($result)) {
                    array_push($products, $product);
                    saveOneToProductsCache(SORTED_BY_ID_BASE_KEY, $index++, $product);
                }
            }
            return $products;
        } else {
            die("Cannot fetch additional products from MySQL Sorted by Id");
        }
    } else {
        // Cache doesn't have any requested products
        echo "Cache doesn't have any requested products <br/>";
        $sql = "select * from products order by id limit " . ($lastIndex - $firstIndex + 1) . " offset " . ($firstIndex - 1);

        $connection = getDbConnection(DB_NAME);
        $result = mysqli_query($connection, $sql);
        closeDbConnection($connection);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $index = $firstIndex;
                while($product = mysqli_fetch_assoc($result)) {
                    array_push($products, $product);
                    saveOneToProductsCache(SORTED_BY_ID_BASE_KEY, $index++, $product);
                }
            }     
            return $products;
        } else {
            die("Cannot fetch products Sorted by Id");
        }
    }
}

// $firstIndex and last index are used to get products from interval
// e.g. getProductsSortedByPrice($connection, 1, 5) will return first 5 products
//
function getProductsSortedByPrice($firstIndex, $lastIndex) {
	$products = [];
    $requestedAmount = $lastIndex - $firstIndex + 1; // Todo: consider returning null if $lastIndex < $firstIndex

    // Check cache
    $products = getManyFromProductsCache(SORTED_BY_PRICE_BASE_KEY, $firstIndex, $lastIndex);
    $cachedAmount = count($products);

    echo "cachedAmount: " . $cachedAmount . "<br/>";
    echo "requestedAmount: " . $requestedAmount . "<br/>";

    if ($cachedAmount == $requestedAmount) {
        // Cache contains every requested products
        echo "Cache contains every requested products  <br/>";
        return $products;
    } elseif ($cachedAmount != 0) {
        // Cache contains only part of a requested products, so go fetch remaining from db
        echo "Cache contains only part of a requested products, so go fetch remaining from db <br/>";
        $remainingAmount = $requestedAmount - $cachedAmount ;
        $sql = "select * from products order by price limit " . $remainingAmount . " offset " . ($firstIndex + $cachedAmount - 1);

        $connection = getDbConnection(DB_NAME);
        $result = mysqli_query($connection, $sql);
        closeDbConnection($connection);

        if ($result) {
            if (mysqli_num_rows($result) != 0) {
                $index = ($firstIndex + $cachedAmount);
                while($product = mysqli_fetch_assoc($result)) {
                    array_push($products, $product);
                    saveOneToProductsCache(SORTED_BY_PRICE_BASE_KEY, $index++, $product);
                }
            }
            return $products;
        } else {
            die("Cannot fetch additional products from MySQL Sorted by Id");
        }
    } else {
        // Cache doesn't have any requested products
        echo "Cache doesn't have any requested products <br/>";
        $sql = "select * from products order by price limit " . ($lastIndex - $firstIndex + 1) . " offset " . ($firstIndex - 1);

        $connection = getDbConnection(DB_NAME);
        $result = mysqli_query($connection, $sql);
        closeDbConnection($connection);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $index = $firstIndex;
                while($product = mysqli_fetch_assoc($result)) {
                    array_push($products, $product);
                    saveOneToProductsCache(SORTED_BY_PRICE_BASE_KEY, $index++, $product);
                }
            }     
            return $products;
        } else {
            die("Cannot fetch products Sorted by Id");
        }
    }
}

// There's no caching because it's only used at '/update_product.php' get request.
// And for it's caching i should have yet anouther baseKey for unsorted products.
function getProduct($id) {
    $sql = "select * from products where id = " . $id;

    $connection = getDbConnection(DB_NAME);
    $result = mysqli_query($connection, $sql);
    closeDbConnection($connection);

    if (mysqli_num_rows($result) == 1) {
        return mysqli_fetch_assoc($result); // return hashtable
    } else {
        return null;
    }
}
