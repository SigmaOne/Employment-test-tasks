<?php

function isResource($url) {
    return preg_match('/\.(?:png|jpg|jpeg|gif)$/', $url);
}

// Main routing
if (isResource($_SERVER["REQUEST_URI"])) {
    return false;    // serve the requested resource as-is.
} else { 
    switch($_SERVER["REQUEST_URI"]) {
    case '/products':
        $pageContent = "pages/products.php";
        break;
    case '/products/new':
        $pageContent = "pages/create_product.php";
        break;
    case "/contacts":
        $pageContent = "pages/contacts.php";
        break;
    case "/":
    case "/home":
        $pageContent = "pages/home.php";
        break;
    default:
        $pageContent = "pages/404.php";
        break;
    }
	
	include "layout.php";
}

?>
