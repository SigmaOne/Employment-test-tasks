<?php
require_once 'db_util.php';

// Standard product's schema is like that:
//
// products
//   :sortedBySomething
//     :seed(current seed)
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
// $basekey in this example is "products:sortedBySomething"

function getOneFromProductsCache($baseKey, $id) {
    $mc = memcache_connect('127.0.0.1', 11211);

    $seed = memcache_get($mc, $baseKey + ":seed");
    $baseKey = $baseKey + ":" + $seed + ":"+ $id;

    $idKey = $baseKey + ":id";
    $nameKey = $baseKey + ":name";
    $descriptionKey = $baseKey + ":description";
    $priceKey = $baseKey + ":price";
    $imgUrl = $baseKey + ":imgUrl";

    // Todo: consider optimization, when you will not request other product's attributes if "id" key is empty
    $product = [
        "id" => memcache_get($mc, $idKey),
        "name" => memcache_get($mc, $nameKey),
        "description" => memcache_get($mc, $descriptionKey),
        "price" => memcache_get($mc, $priceKey),
        "imgUrl" => memcache_get($mc, $imgUrlKey)
    ];

    if (!empty($product)) {
        return $product;
    } else {
        return NULL;
    }
}

function getManyFromProductsCache($baseKey, $ids) {
    $mc = memcache_connect('127.0.0.1', 11211);

    $seed = memcache_get($mc, $baseKey + ":seed");
    $products = [];

    foreach($ids as $id) {
        $baseKey = $baseKey + ":" + $seed + ":" + $id;

        $idKey = $baseKey + ":id";
        $nameKey = $baseKey + ":name";
        $descriptionKey = $baseKey + ":description";
        $priceKey = $baseKey + ":price";
        $imgUrl = $baseKey + ":imgUrl";

        $product = [
            "id" => memcache_get($mc, $idKey),
            "name" => memcache_get($mc, $nameKey),
            "description" => memcache_get($mc, $descriptionKey),
            "price" => memcache_get($mc, $priceKey),
            "imgUrl" => memcache_get($mc, $imgUrlKey)
        ];

        if (!empty($product)) {
            array_push($products, $product);
        }     
    }

    if (!empty($products)) {
        return $products;
    } else {
        return NULL;
    }
}

function saveOneToProductsCache($baseKey, $product) {
    $mc = memcache_connect('127.0.0.1', 11211);
    $seed = memcache_get($mc, $baseKey + ":seed");
    $baseKey = $baseKey + ":" + $seed + ":" + $product["id"];

    $idKey = $baseKey + ":id";
    $nameKey = $baseKey + ":name";
    $descriptionKey = $baseKey + ":description";
    $priceKey = $baseKey + ":price";
    $imgUrl = $baseKey + ":imgUrl";

    memcache_set($mc, $idKey, $product["id"], 0, 60);
    memcache_set($mc, $nameKey, $product["name"], 0, 60);
    memcache_set($mc, $descriptionKey, $product["description"], 0, 60);
    memcache_set($mc, $priceKey, $product["price"], 0, 60);
    memcache_set($mc, $imgUrlKey, $product["imgUrl"], 0, 60);
}

function saveManyToProductsCache($baseKey, $products) {
    $mc = memcache_connect('127.0.0.1', 11211);
    $seed = memcache_get($mc, $baseKey + ":seed");

    foreach ($products as $product) {
        $baseKey = $baseKey + ":" + $seed + ":" + $product["id"];

        $idKey = $baseKey + ":id";
        $nameKey = $baseKey + ":name";
        $descriptionKey = $baseKey + ":description";
        $priceKey = $baseKey + ":price";
        $imgUrl = $baseKey + ":imgUrl";

        memcache_set($mc, $idKey, $product["id"], 0, 60);
        memcache_set($mc, $nameKey, $product["name"], 0, 60);
        memcache_set($mc, $descriptionKey, $product["description"], 0, 60);
        memcache_set($mc, $priceKey, $product["price"], 0, 60);
        memcache_set($mc, $imgUrlKey, $product["imgUrl"], 0, 60);
    }
}

function invalidateProductsCache($baseKey) {
    $mc = memcache_connect('127.0.0.1', 11211);

    $seed = rand();
    memcached_set($mc, $baseKey + ":seed", $seed, 0, 60);
}
