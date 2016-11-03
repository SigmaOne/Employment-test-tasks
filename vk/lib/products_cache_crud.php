<?php
// Contains all the CRUD caching operations on products

// Standard product's schema in my architecure is like so:
//
// products
//   :sortedBySomething
//     :seed (current seed) 
//     :xyz (seed 1)
//       :1
//         :id 
//         :name
//         :description
//         :imgUrl
//       :2
//         :id 
//         :name
//         :description
//         :imgUrl
//     :abc (seed 2)
//       :1
//         :id 
//         :name
//         :description
//         :imgUrl
//
// $baseKey in this example is "products:sortedBySomething"
// In my case i have 2 baseKeys:
//   products:sortedById
//   products:sortedByPrice
//
// $baseProductKey in this example is "products:sortedBySomething:xyz:1" or "products:sortedBySomething:xyz:2"

require_once 'lib/products_crud.php';

// --- 'private' functions used only in this module ---
function getProductByBaseProductKey($mc, $baseProductKey) {
    $idKey = $baseProductKey . ":id";
    $nameKey = $baseProductKey . ":name";
    $descriptionKey = $baseProductKey . ":description";
    $priceKey = $baseProductKey . ":price";
    $imgUrlKey = $baseProductKey . ":imgUrl";

    return [
        "id" => memcache_get($mc, $idKey),
        "name" => memcache_get($mc, $nameKey),
        "description" => memcache_get($mc, $descriptionKey),
        "price" => memcache_get($mc, $priceKey),
        "imgUrl" => memcache_get($mc, $imgUrlKey)
    ];
}

function saveProductByBaseProductKey($mc, $baseProductKey, $product) {
    $idKey = $baseProductKey . ":id";
    $nameKey = $baseProductKey . ":name";
    $descriptionKey = $baseProductKey . ":description";
    $priceKey = $baseProductKey . ":price";
    $imgUrlKey = $baseProductKey . ":imgUrl";

    memcache_set($mc, $idKey, $product["id"], 0, 60);
    memcache_set($mc, $nameKey, $product["name"], 0, 60);
    memcache_set($mc, $descriptionKey, $product["description"], 0, 60);
    memcache_set($mc, $priceKey, $product["price"], 0, 60);
    memcache_set($mc, $imgUrlKey, $product["imgUrl"], 0, 60);
}

// Todo: fix memcache_touch(...)
function extendProductByBaseProductKey($mc, $baseProductKey) {
    die("memcache_touch(...) doesn't work for some reason in procedural style");

    memcache_touch($mc, $baseProductKey . ":id", 60);
    memcache_touch($mc, $baseProductKey . ":name", 60);
    memcache_touch($mc, $baseProductKey . ":description", 60);
    memcache_touch($mc, $baseProductKey . ":price", 60);
    memcache_touch($mc, $baseProductKey . ":imgUrl", 60);
}

function deleteProductByBaseProductKey($mc, $baseProductKey) {
    memcache_delete($mc, $baseProductKey . ":id");
    memcache_delete($mc, $baseProductKey . ":name");
    memcache_delete($mc, $baseProductKey . ":description");
    memcache_delete($mc, $baseProductKey . ":price");
    memcache_delete($mc, $baseProductKey . ":imgUrl");
}

// --- 'public' functions which are used from outer modules ---
function getOneFromProductsCache($baseKey, $id) {
    $mc = memcache_connect('127.0.0.1', 11211);
    $seed = memcache_get($mc, $baseKey . ":seed");
    $baseProductKey = $baseKey . ":" . $seed . ":" . $id;
    $idKey = $baseProductKey . ":id";

    if(memcache_get($mc, $idKey) != false) {
        $product = getProductByBaseProductKey($mc, $baseProductKey);
        saveProductByBaseProductKey($mc, $baseProductKey, $product); // Extend caching time
        return $product;
    } else {
        return NULL;
    }
}

function getManyFromProductsCache($baseKey, $firstIndex, $lastIndex) {
    $mc = memcache_connect('127.0.0.1', 11211);
    $seed = memcache_get($mc, $baseKey . ":seed");
    $products = [];

    for($id = $firstIndex; $id <= $lastIndex; $id++) {
        $baseProductKey = $baseKey . ":" . $seed . ":" . $id;
        $idKey = $baseProductKey . ":id";

        if(memcache_get($mc, $idKey) != false) {
            $product = getProductByBaseProductKey($mc, $baseProductKey);
            saveProductByBaseProductKey($mc, $baseProductKey, $product); // Extend caching time
            array_push($products, $product);
        } 
    }
    return $products;
}

function saveOneToProductsCache($baseKey, $index, $product) {
    $mc = memcache_connect('127.0.0.1', 11211);
    $seedKey = $baseKey . ":seed";
    $seed = memcache_get($mc, $seedKey);
    $baseProductKey = $baseKey . ":" . $seed . ":" . $index;

    saveProductByBaseProductKey($mc, $baseProductKey, $product);
}

function saveManyToProductsCache($baseKey, $index, $products) {
    $mc = memcache_connect('127.0.0.1', 11211);
    $seed = memcache_get($mc, $baseKey . ":seed");

    foreach ($products as $product) {
        $baseProductKey = $baseKey . ":" . $seed . ":" . $index;
        saveProductByBaseProductKey($mc, $baseProductKey, $product);
    }
}

function deleteOneFromProductsCache($baseKey, $index) {
    $mc = memcache_connect('127.0.0.1', 11211);
    $seed = memcache_get($mc, $baseKey . ":seed");
    $baseProductKey = $baseKey . ":" . $seed . ":" . $id;
    
    deleteOneFromProductsCache($mc, $baseProductKey);
}

function invalidateProductsCache($baseKey) {
    $mc = memcache_connect('127.0.0.1', 11211);

    $seedKey = $baseKey . ":seed";
    $seed = rand();

    memcache_set($mc, $seedKey, $seed, 0, 0);
}
