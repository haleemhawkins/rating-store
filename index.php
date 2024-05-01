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

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>EZ Rating</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./EZ Rating_files/w3.css">
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
        include 'scripts/navbar.php';
?>

<!-- Header -->
<header class="w3-display-container w3-content w3-wide" style="max-width:1500px;" id="home">
  <img class="w3-image" src="./EZ Rating_files/Background.jpg" alt="Architecture" width="1500" height="800">
  <div class="w3-display-middle w3-margin-top w3-center">
    <h1 class="w3-xxlarge w3-text-white"><span class="w3-padding w3-yellow w3-opacity-min"><b>EZ</b></span> <span class="w3-hide-small w3-text-light-grey">Rating</span></h1>
    <form action="/scripts/searchbar.php" method="get">
    <p><input class="w3-input w3-border w3-round-large w3-round-xxlarge w3-opacity" type="text" name="search" placeholder="search an item..." style="width: 350px;"></p>
    </form>
  </div>
</header>

<!-- Page content -->
<div class="w3-content w3-padding" style="max-width:1564px">

  <!-- Categories Section -->
  <section class="Categories">
  <div class="w3-container w3-padding-32" id="Categories">
    <h3 class="w3-border-bottom w3-border-light-grey w3-padding-16">Categories</h3>
  </div>

  <div class="img w3-row-padding">
    <div class="w3-col l3 m6 w3-margin-bottom ">
      <a href="product_page.php?tag=Electronics">
      <div class="w3-display-container">
        <div class="w3-display-topleft w3-black w3-padding w3-hover-yellow">Electronics</div>
        <img src="./EZ Rating_files/Electronics.jpg" alt="Electronics"     style="width:99%">
      </div>
      </a>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <a href="product_page.php?tag=office equipment">
      <div class="w3-display-container">
        <div class="w3-display-topleft w3-black w3-padding w3-hover-yellow">office equipment</div>
        <img src="./EZ Rating_files/office.jpg" alt="office equipment"     style="width:99%">
      </div>
      </a>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <a href="product_page.php?tag=cosmetics">
      <div class="w3-display-container">
        <div class="w3-display-topleft w3-black w3-padding w3-hover-yellow">cosmetics</div>
        <img src="./EZ Rating_files/cosmetics.jpg" alt="cosmetics"     style="width:99%">
      </div>
      </a>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <a href="product_page.php?tag=Fashion">
      <div class="w3-display-container">
        <div class="w3-display-topleft w3-black w3-padding w3-hover-yellow">Fashion</div>
        <img src="./EZ Rating_files/Fashion.jpg" alt="Fashion"     style="width:99%">
      </div>
      </a>
    </div>
  </div>

  <div class="w3-row-padding">
    <div class="w3-col l3 m6 w3-margin-bottom">
      <a href="product_page.php?tag=Furniture">
      <div class="w3-display-container">
        <div class="w3-display-topleft w3-black w3-padding w3-hover-yellow">Furniture</div>
        <img src="./EZ Rating_files/Furniture.jpg" alt="Furniture"     style="width:99%">
      </div>
      </a>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <a href="product_page.php?tag=Tools">
      <div class="w3-display-container">
        <div class="w3-display-topleft w3-black w3-padding w3-hover-yellow">Tools</div>
        <img src="./EZ Rating_files/Tools.jpg" alt="Tools"     style="width:99%">
      </div>
      </a>
    </div>
    <div class="w3-col l3 m6 w3-margin-bottom">
      <a href="product_page.php?tag=Appliances">
      <div class="w3-display-container">
        <div class="w3-display-topleft w3-black w3-padding w3-hover-yellow">Appliances</div>
        <img src="./EZ Rating_files/Appliances.jpg" alt="House"     style="width:99%">
      </div>
      </a>
    </div>

    <div class="w3-col l3 m6 w3-margin-bottom">
      <a href="product_page.php?tag=Toys">
      <div class="w3-display-container">
        <div class="w3-display-topleft w3-black w3-padding w3-hover-yellow">Toys</div>
        <img src="./EZ Rating_files/Toys.jpg" alt="Toys"     style="width:99%">
      </div>
      </a>
    </div>
  </div>
</div>
</section>


<!-- Footer -->
<footer class="w3-center w3-black w3-padding-16">
  <p>© 2024 EZ Rating, MSU.
  </p>
</footer>


</body></html>