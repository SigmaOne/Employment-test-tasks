<?php require_once 'util/db_util.php'; ?>                                                                                                                                                                              
<?php require_once 'util/products_crud.php'; ?>                                                                                                                                                                              

<script>
	function changeSortBySelect(selectBy) {
		//alert(selectBy);
		window.location = "/products?sortBy=" + selectBy;
	}
</script>

<h3>Products (<a href="products/new">Add new</a>)
Order by:
    <select id="sortBySelect" onchange="changeSortBySelect(value);">
	  <option value="id" selected="" >id</option>
	  <option value="price" <?php if ($_GET["sortBy"] === price) echo "selected=\"selected\""; ?> >price</option>
	</select> 
</h3>
<!--//  -->

<hr/>

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

    switch($_GET["sortBy"]) {
    default:
    case "id":
        $products = getProductsSortedById($connection, 1, 100);
        break;
    case "price":
        $products = getProductsSortedByPrice($connection, 1, 100);
        break;
	case "none":
		$products = getAllProducts($connection);
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
?>
</ol>
