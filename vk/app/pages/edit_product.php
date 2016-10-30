<?php require_once 'util/db_util.php'; ?>                                                                                                                                                                              
<?php require_once 'util/products_crud.php'; ?>                                                                                                                                                                              
<?php require_once 'util/input_validation.php'; ?>

<?php

$connection = getDbConnection(DB_NAME);
$product = getProduct($connection, $_GET["idToEdit"]);

$name = $product["name"];
$description = $product["description"];
$price = $product["price"];
$imgUrl = $product["img_url"];
$nameError = $descriptionError = $priceError = $imgUrlError = ""; 

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Todo: add validation
    $id = $_POST["id"];
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
    if (empty($price) || !is_numeric($price)) {
        $priceError = "Price is required and should be numeric";
    }
    if (empty($imgUrl) || !filter_var($imgUrl, FILTER_VALIDATE_URL)) {
        $imgUrlError = "Image url should be valid and not null";
    }

    if (empty($nameError) && empty($descriptionError) && empty($priceError) && empty($imgUrlError)) {
        updateProduct($connection, $id, $name, $description, $price, $imgUrl);
        echo "<h1 class=\"success\">Success updating product with id = " . $id . " in db</h1>";
    } else {
        echo "<h1 class=\"error\">Failure updating to db</h1>";
    }
}

closeDbConnection($connection);

?>

<h3>Create new product</h3>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
  <input type="hidden" name="id" value="<?php echo $_GET["idToEdit"]; ?>">

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

  <input type="submit" value="Save changes">
</form>
