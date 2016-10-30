<?php require_once 'util/db_util.php'; ?>                                                                                                                                                                              
<?php require_once 'util/products_crud.php'; ?>                                                                                                                                                                              

<h3>Products (<a href="products/new">Add new</a>)</h3>

<?php

// Todo: consider http 'delete' method usage
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["idToDelete"])) {
    $connection = getDbConnection(DB_NAME);
    deleteProduct($connection, $_POST["idToDelete"]);
    closeDbConnection($connection);

    echo "<h1>Sucessfully deleted product with id = " . $_POST["idToDelete"] . "</h1>";
}

?>

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

      echo "  <form action=\"" . htmlspecialchars($_SERVER["PHP_SELF"]) . "\" method=\"post\">";
      echo "    <input type=\"hidden\" name=\"idToDelete\" value=\"" . $product["id"] . "\"/>";
      echo "    <input type=\"submit\" name=\"submit\" value=\"delete?\"/>";
      echo "  </form>";

      echo "</li>" . PHP_EOL;
      echo "<br/>";
    }
?>
</ol>
