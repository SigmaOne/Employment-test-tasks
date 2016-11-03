<?php
// Main router which handles all the reques mapping
// Server is started with him like so "php -S localhost:8000 router.php"

switch($_SERVER["REQUEST_URI"]) {

// HTML pages
case (preg_match('/\/products\/new.*/', $_SERVER["REQUEST_URI"]) ? true : false):
    $pageContent = "pages/create_product.php";
    include "layout.php";
    break;

case (preg_match('/\/products\/edit.*/', $_SERVER["REQUEST_URI"]) ? true : false):
    $pageContent = "pages/edit_product.php";
    include "layout.php";
    break;

case (preg_match('/\/products[^\/]*/', $_SERVER["REQUEST_URI"]) ? true : false):
    $pageContent = "pages/products.php";
    include "layout.php";
    break;

case "/contacts":
    $pageContent = "pages/contacts.php";
    include "layout.php";
    break;

case "/":
case "/home":
    $pageContent = "pages/home.php";
    include "layout.php";
    break;

default:
    $pageContent = "pages/404.php";
    include "layout.php";
    break;

// AJAX calls
case (preg_match('/\/getAdditionalProducts.*/', $_SERVER["REQUEST_URI"]) ? true : false):
    include "pages/getAdditionalProducts.php";
    break;

// Resources
case (preg_match('/\.(?:png|jpg|jpeg|gif)$/', $_SERVER["REQUEST_URI"]) ? true : false):
    return false;
}
