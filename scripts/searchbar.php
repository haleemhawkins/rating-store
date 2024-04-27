<?php

include './product_controller.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <link rel="stylesheet" href="./EZ Rating_files/w3.css">
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
<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding w3-card">
    <a href="/index.html" class="w3-bar-item w3-button"><b>EZ</b> Rating</a>
    <!-- Float links to the right. Hide them on small screens -->
    <div class="w3-right w3-hide-small">
    <a href="/admin_view_page.php" class="w3-bar-item w3-button">Admin</a>
      <a href="#" class="w3-bar-item w3-button">Categories</a>
      <a href="/AboutPage/AboutPage.html" class="w3-bar-item w3-button">About</a>
      <a href="/Login_Signup/login.html">
      <button class="w3-bar-item w3-button w3-black w3-hover-yellow w3-round-xxlarge">Log in / sign up</button>
      </a>
    </div>
  </div>
</div>
    <?php

if (empty($products)) {
    echo $message ?? "Product not found!";
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