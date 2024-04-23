<?php

include './product_controller.php';

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
</head>
<body>
    <?php
        foreach($products as $product){ ?>
        
            <img src='<?php echo $product["ProductImg"]; ?>' alt='Product Image' class='product-image'>
            <h2><?php echo $product["ProductName"]; ?></h2>
            <p class='price'>$<?php echo $product["Price"]; ?></p>

        <?php }
    ?>
</body>
</html>





<?php
/*

include './'

$search = $_GET['search'] ? '' : null; 
$db = new PDO('sqlite:/sql/store.db'); 

$query = $db->prepare("SELECT * FROM products WHERE name LIKE :search");
$query->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
$query->execute();

$results = $query->fetchAll(PDO::FETCH_ASSOC);

echo '<div style="padding: 20px;">';
if ($results) {
    foreach ($results as $row) {
        // Display the product details
        echo '<div style="margin-bottom: 20px; border: 1px solid #ccc; padding: 10px;">';
        echo '<img src="' . htmlspecialchars($row['ProductImg']) . '" alt="' . htmlspecialchars($row['ProductName']) . '" style="width: 100px; height: auto;">';
        echo '<h4>' . htmlspecialchars($row['ProductName']) . '</h4>';
        echo '<p>Price: $' . number_format($row['Price'], 2) . '</p>';
        echo '<p>Stock: ' . htmlspecialchars($row['Stock']) . '</p>';
        echo '<p>Tags: ' . htmlspecialchars($row['Tags']) . '</p>';
        echo '</div>';
    }
} else {
    echo '<p>No results found.</p>';
}
echo '</div>';*/
?>