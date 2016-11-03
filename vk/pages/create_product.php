<?php
require_once 'lib/products_crud.php';
require_once 'lib/input_validation.php';

$name = $description = $price = $imgUrl = ""; 
$nameError = $descriptionError = $priceError = $imgUrlError = ""; 

// Handle 'create_product' form submition
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = format_input($_POST["name"]);
    $description = format_input($_POST["description"]);
    $price = format_input($_POST["price"]);
    $imgUrl = format_input($_POST["imgUrl"]);

    // Run validations
    if (empty($name) || !preg_match("/^[a-zA-Z ]*$/", $name)) {
        $nameError = "Name is required. Only letters and whitespaces allowed";
    }
    if (empty($description)) {
        $descriptionError = "Description is required";
    }
    if (empty($price) || !is_numeric($price) || $price < 0) {
        $priceError = "Price is required, should be numeric and more then zero";
    }
    if (empty($imgUrl) || !filter_var($imgUrl, FILTER_VALIDATE_URL)) {
        $imgUrlError = "Image url should be valid and not null";
    }

    if (empty($nameError) && empty($descriptionError) && empty($priceError) && empty($imgUrlError)) {
        // Add new product to db
        insertProduct($name, $description, $price, $imgUrl);

        $name = $description = $price = $imgUrl = ""; 
        echo "<h1 class=\"success\">Success saving to db</h1>";

        // Todo: Add redirect to 'products/' after insertion
    } else {
        echo "<h1 class=\"error\">Form validation failed</h1>";
    }
}
?>

<h3>Create new product</h3>

<form id="create_product" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
  Name: 
  <span class="error">* <?php echo $nameError; ?></span><br/>
  <input type="text" name="name" value="<?php echo $name; ?>"/><br/>
  
  Description: 
  <span class="error">* <?php echo $descriptionError; ?></span><br/>
  <input type="text" name="description" value="<?php echo $description; ?>"/><br/>

  Price: 
  <span class="error">* <?php echo $priceError; ?></span><br/>
  <input type="text" name="price" value="<?php echo $price; ?>"/><br/>

  Image url: 
  <span class="error">* <?php echo $imgUrlError; ?></span><br/>
  <input type="text" name="imgUrl" value="<?php echo $imgUrl; ?>"/><br/><br/>

  <input type="submit" value="Create">
</form>
