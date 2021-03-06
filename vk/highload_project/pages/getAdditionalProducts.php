<?php 
// File to get Additional products as <li></li> elements. Is used with ajax calls
// Todo: Fix undefined index errors

require_once 'lib/products_crud.php';

$from = $_GET["from"];
$to = $_GET["to"];
$sortBy = $_GET["sortBy"];

switch($_GET["sortBy"]) {
default:
case "id":
    $products = getProductsSortedById($from, $to);
    break;
case "price":
    $products = getProductsSortedByPrice($from, $to);
    break;
}

foreach($products as $product) {
  echo "<li>" . PHP_EOL;

  echo "  <b>Id</b>: " . $product["id"] . "<br/>";
  echo "  <b>Name</b>: " . $product["name"] . "<br/>";
  echo "  <b>Description</b>: " . $product["description"] . "<br/>";
  echo "  <b>Price</b>: " . $product["price"] . "<br/>";
  echo "  <b>Img url</b>: <a href=\"" . $product["img_url"] . "\">url</a><br/>";

  echo "  <form action=\"products/edit\" method=\"get\">";
  echo "    <input type=\"hidden\" name=\"idToEdit\" value=\"" . $product["id"] . "\"/>";
  echo "    <input type=\"submit\" name=\"editButton\" value=\"edit\"/>";
  echo "  </form>";

  echo "  <form action=\"" . htmlspecialchars($_SERVER["PHP_SELF"]) . "\" method=\"post\">";
  echo "    <input type=\"hidden\" name=\"idToDelete\" value=\"" . $product["id"] . "\"/>";
  echo "    <input type=\"submit\" name=\"deleteButton\" value=\"delete?\"/>";
  echo "  </form>";

  echo "</li>" . PHP_EOL;
  echo "<br/>";
}
