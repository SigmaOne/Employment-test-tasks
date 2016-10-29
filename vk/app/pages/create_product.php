<?php require_once 'util/db_util.php'; ?>                                                                                                                                                                              
<?php require_once 'util/products_crud.php'; ?>                                                                                                                                                                              
<?php require_once 'util/input_validation.php'; ?>

<?php
$name = $description = $price = $imgUrl = ""; 
// Todo: Add validation UI
// $nameError = $descriptionError = $priceError = $imgUrlEror = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Todo: add validation
    $name = format_input($_POST["name"]);
    $description = format_input($_POST["description"]);
    $price = format_input($_POST["price"]);
    $imgUrl = format_input($_POST["imgUrl"]);

    // Add new product to db
    $connection = getDbConnection(DB_NAME);
    insertProduct($connection, $name, $description, $price, $imgUrl);
    closeDbConnection($connection);

    // Todo: Add redirect to 'products/'
    echo "<h1>Success</h1>";
}

?>

<h3>Create new product</h3>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
  Name: <br/>
  <input type="text" name="name" value="<?php echo $name; ?>"/><br/>

  Description: <br/>
  <input type="text" name="description" value="<?php echo $description; ?>"/><br/>

  Price: <br/>
  <input type="text" name="price" value="<?php echo $price; ?>"/><br/>

  Image url: <br/>
  <input type="text" name="imgUrl" value="<?php echo $imgUrl; ?>"/><br/><br/>

  <input type="submit" value="Create">
</form>
