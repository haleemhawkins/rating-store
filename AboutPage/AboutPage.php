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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Rating Store</title>
    <link href="AboutPage.css" rel="stylesheet">
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
    <header>
<!-- Navbar (sit on top) -->
<?php
        include '../scripts/navbar.php';
?>
    </header>

    <main>
        <section class="about-section">
            <h1>About Rating Store</h1>
            <p>
                Rating Store is a dynamic E-Commerce Web Application dedicated to enhancing the online shopping experience through advanced sentiment analysis. Users can view detailed product features, leave comments, and browse through feedback from other customers. 
            </p>
            <p>
                At the heart of our application is a cutting-edge Sentiment Analysis for Product Rating system. This system analyzes user comments by comparing them with a database of sentiment-based keywords, each assigned a specific positivity or negativity weight. By doing so, it accurately determines and assigns ratings to products based on user sentiments, ensuring a transparent and user-focused rating system.
            </p>
            <p>
                Additionally, the application supports administrative roles, enabling admins to seamlessly add new products and keywords, thus maintaining the relevance and accuracy of our sentiment analysis engine.
            </p>
            <p>
                Designed by a talented team of developers and designers, Rating Store aims to provide a reliable and insightful platform for both users and administrators alike.
            </p>
            <div class="team">
                <h2>Our Team</h2>
                <ul>
                    <li>Ishika Patel</li>
                    <li>Mariusz Kowalski</li>
                    <li>Haleem Hawkins</li>
                    <li>Abdullah Alharayzeh</li>
                    <li>Ben Allen</li>
                </ul>
            </div>
        </section>
    </main>

    <footer>
        <p>© 2024 Rating Store. All rights reserved.</p>
    </footer>
</body>
</html>
