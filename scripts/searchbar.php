<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); 
function isAdmin() {
  // Check if the session variable 'isadmin' is set and equals 1
  if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1) {
      return true;
  } else {
      return false;
  }
}

?>
<?php

include './product_controller.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <link rel="stylesheet" href="/EZ Rating_files/w3.css">
    <title>Search Bar</title>
    <style>
        .Categories img{
        width: 319px; 
        height: 200px; 
        object-fit: fill;
        }
    </style>
</head>

<body>
<!-- Navbar (sit on top) -->
<?php
        include 'navbar.php';
?>
    <?php

if (empty($products)) {
    echo str_repeat("<br>", 3) . ($message ?? "Product not found!");
}
else{
        foreach($products as $product){ ?>
            <a href='<?php echo $product["ProductUrl"]; ?>'>
            <div class='aspect-h-1 aspect-w-1 w-full overflow-hidden bg-gray-200 xl:aspect-h-8 xl:aspect-w-7'>
                        <img src='<?php echo $product["ProductImg"]; ?>' alt='Product Image' class='h-full w-full object-cover object-center group-hover:opacity-75'>
                    </div>
            <h2><?php echo $product["ProductName"]; ?></h2>
            <p class='price'>$<?php echo $product["Price"]; ?></p>

        <?php }
}
    ?>
</body>
</html>

<?php
//Debuggers

//var_dump($products); 



// if(isset($_GET['search'])){
//     // $name = $_GET['search'];
//     // echo "data received from GET method: " . $name;
//     // echo "<pre>";
//     // print_r($products);
//     // echo "</pre>";

// } else {
//     echo "no data received from GET method";
// }
?>