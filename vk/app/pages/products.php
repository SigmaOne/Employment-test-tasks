<?php require_once 'util/db_util.php'; ?>                                                                                                                                                                              
<?php require_once 'util/products_crud.php'; ?>                                                                                                                                                                              

<h3>Products</h3>

<ol>
<?php 
    $connection = getDbConnection(DB_NAME);
    $products = getAllProducts($connection);

    foreach($products as $product) {
      echo "<li>" . PHP_EOL;
      echo "  <b>Name</b>: " . $product["name"] . "<br/>";
      echo "  <b>Description</b>: " . $product["description"] . "<br/>";
      echo "  <b>Price</b>: " . $product["price"] . "<br/>";
      echo "  <b>Img url</b>: <a href=\"" . $product["img_url"] . "\">url</a><br/>";
      echo "</li>" . PHP_EOL;

      echo "<br/>";
    }
?>
</ol>
