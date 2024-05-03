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
    <link href="../output.css" rel="stylesheet">
    <link rel="stylesheet" href="../EZ Rating_files/w3.css">
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
    <br><br><br>
    <div class="w3-content w3-padding" style="max-width:1564px">

        <div class="bg-white">

            <!-- ... other HTML code ... -->
            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                <?php
                if (empty($products)) {
                    echo $message ?? "Product not found!";
                } else {
                    foreach ($products as $product) { ?>
                        <div>
                            <a href='<?php echo $product["ProductUrl"]; ?>'>
                                <div class="w3-light-grey w3-margin-bottom">
                                    <div class='aspect-h-1 aspect-w-1 w-full overflow-hidden bg-gray-200 xl:aspect-h-8 xl:aspect-w-7'>
                                        <img src='<?php echo $product["ProductImg"]; ?>' alt='Product Image' class='w3-hover-opacity'>
                                    </div>
                                    <div class='mt-4 text-sm text-gray-700'><?php echo $product["ProductName"]; ?></div>
                                    <div class='mt-1 text-lg font-medium text-gray-900'>$<?php echo $product["Price"]; ?></div>
                                </div>
                            </a>
                        </div>
                <?php }
                }
                ?>
            </div>
        </div>
    </div>
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