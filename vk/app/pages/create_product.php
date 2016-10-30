<?php require_once 'util/db_util.php'; ?>                                                                                                                                                                              
<?php require_once 'util/products_crud.php'; ?>                                                                                                                                                                              
<?php require_once 'util/input_validation.php'; ?>

<?php

$name = $description = $price = $imgUrl = ""; 
$nameError = $descriptionError = $priceError = $imgUrlError = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Todo: add validation
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
        // Add new product to db
        $connection = getDbConnection(DB_NAME);
        insertProduct($connection, $name, $description, $price, $imgUrl);
        closeDbConnection($connection);

        $name = $description = $price = $imgUrl = ""; 
        echo "<h1 class=\"success\">Success saving to db</h1>";

        // Todo: Add redirect to 'products/'
    } else {
        echo "<h1 class=\"error\">Failure saving to db</h1>";
    }
}

?>

<h3>Create new product</h3>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
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
