<?php
// File to show all the products from db. From here you can edit/delete/create products
// Todo: Fix undefined index errors

require_once 'lib/products_crud.php';

// Handle 'delete?' button's request to delete product
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["idToDelete"])) {
    deleteProduct($_POST["idToDelete"]);
    echo "<h1>Sucessfully deleted product with id = " . $_POST["idToDelete"] . "</h1>";
}
?>

<script>
    // Add get parameter to current url and then redirect
	function insertParam(key, value) {
		key = encodeURI(key); value = encodeURI(value);
		var kvp = document.location.search.substr(1).split('&');

		var i = kvp.length; var x; while(i--) {
			x = kvp[i].split('=');

			if (x[0] == key) {
				x[1] = value;
				kvp[i] = x.join('=');
				break;
			}
		}

		if (i < 0) {
			kvp[kvp.length] = [key, value].join('=');
		}

		// This will reload the page, it's likely better to store this until finished
		document.location.search = kvp.join('&'); 
	}

    function findGetParameter(parameterName) {
        var result = null, tmp = [];
        location.search .substr(1) .split("&") .forEach(function (item) {
            tmp = item.split("=");
            if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
        });
        return result;
    }

    // Handle sortBySelect change event
    function changeSortBySelect(selectBy) {
		insertParam("sortBy", selectBy);
    }

    // Handle changeItemsOnPageSelect change event
    function changeItemsOnPageSelect(itemsAmount) {
		insertParam("itemsAmount", itemsAmount);
    }

    // Upload additional product instances with AJAX call when user scrolled down to the bottom
    var ajaxLock = false; // Is needed so ajax call below will not be called twice with the same parameters;
    $(window).scroll(function () {
        if ($(window).scrollTop() >= $(document).height() - $(window).height() - 10 && ajaxLock != true) {
            ajaxLock = true;
            var xmlhttp = new XMLHttpRequest();
            
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("products_list").innerHTML += this.responseText;
                }
                ajaxLock = false;
            };
            
            var displayedProductsLength = document.getElementById("products_list").getElementsByTagName("li").length;
            var from = displayedProductsLength + 1;
            var to = from + 9; // 10 items is just an empirical constant which is ok here in my opinion
            var sortBy = findGetParameter("sortBy");
            if (sortBy == null) {
                sortBy = "id";
            }
            
            xmlhttp.open("GET", "getAdditionalProducts?sortBy=" + sortBy  + "&from=" + from + "&to=" + to, true);
            xmlhttp.send();
        }
    });
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
    <option value="1000000" <?php if ($_GET["itemsAmount"] == 1000000) echo "selected=\"selected\""; ?> >1000000</option>
  </select> 
  <hr/>
</p>

<ol id="products_list" >
<?php 
$itemsAmount = empty($_GET["itemsAmount"]) ? 10 : $_GET["itemsAmount"];

switch($_GET["sortBy"]) {
default:
case "id":
    $products = getProductsSortedById(1, $itemsAmount);
    break;
case "price":
    $products = getProductsSortedByPrice(1, $itemsAmount);
    break;
}

foreach($products as $product) {
    echo "<li>";

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

    echo "</li>";
    echo "<br/>";
}
?>
</ol>
