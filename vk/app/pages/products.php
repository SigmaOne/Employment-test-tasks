<?php require_once 'util/db_util.php'; ?>                                                                                                                                                                              
<?php require_once 'util/products_crud.php'; ?>                                                                                                                                                                              

<script>
    // Add get parameter to current url and then redirect
	function insertParam(key, value) {
		key = encodeURI(key); value = encodeURI(value);
		var kvp = document.location.search.substr(1).split('&');

		var i=kvp.length; var x; while(i--) {
			x = kvp[i].split('=');

			if (x[0]==key) {
				x[1] = value;
				kvp[i] = x.join('=');
				break;
			}
		}

		if(i < 0) {
			kvp[kvp.length] = [key,value].join('=');
		}

		//this will reload the page, it's likely better to store this until finished
		document.location.search = kvp.join('&'); 
	}

    // Handle sortBySelect change event
    function changeSortBySelect(selectBy) {
		insertParam("sortBy", selectBy);
    }

    // Handle sortBySelect change event
    function changeItemsOnPageSelect(itemsAmount) {
		insertParam("itemsAmount", itemsAmount);
    }
</script>

<h2>Products (<a href="products/new">Add new</a>)</h2>
<p>
Order by:
    <select id="sortBySelect" onchange="changeSortBySelect(value);">
	  <option value="id" <?php if ($_GET["sortBy"] === "id") echo "selected=\"selected\""; ?> >id</option>
	  <option value="price" <?php if ($_GET["sortBy"] === "price") echo "selected=\"selected\""; ?> >price</option>
	</select> 

Items on page: 
    <select id="itemsOnPageSelect" onchange="changeItemsOnPageSelect(value);">
	  <option value="10"      <?php if ($_GET["itemsAmount"] == 10)      echo "selected=\"selected\""; ?> >10</option>
	  <option value="25"      <?php if ($_GET["itemsAmount"] == 25)      echo "selected=\"selected\""; ?> >25</option>
	  <option value="50"      <?php if ($_GET["itemsAmount"] == 50)      echo "selected=\"selected\""; ?> >50</option>
	  <option value="100"     <?php if ($_GET["itemsAmount"] == 100)     echo "selected=\"selected\""; ?> >100</option>
	  <option value="1000"    <?php if ($_GET["itemsAmount"] == 1000)    echo "selected=\"selected\""; ?> >1000</option>
	  <option value="10000"   <?php if ($_GET["itemsAmount"] == 10000)   echo "selected=\"selected\""; ?> >10000</option>
	  <option value="100000"  <?php if ($_GET["itemsAmount"] == 100000)  echo "selected=\"selected\""; ?> >100000</option>
	  <option value="1000000" <?php if ($_GET["itemsAmount"] == 1000000) echo "selected=\"selected\""; ?> >100000</option>
	</select> 
<hr/>
</p>

<?php
// Handle 'delete?' button if POST
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
    $itemsAmount = empty($_GET["itemsAmount"]) ? 10 : $_GET["itemsAmount"];

    switch($_GET["sortBy"]) {
    default:
    case "id":
        $products = getProductsSortedById($connection, 1, $itemsAmount);
        break;
    case "price":
        $products = getProductsSortedByPrice($connection, 1, $itemsAmount);
        break;
    // Special case just for debugging purposes
    // Todo: remove later
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
