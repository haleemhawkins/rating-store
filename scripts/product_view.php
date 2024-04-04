
<!-- This page is for displaying a selected product's overview -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    // Establish database connection
    $db = new SQLite3('../store.db');

    // Retrieve ProductID from query string
    $productID = isset($_GET['product_id']) ? $_GET['product_id'] : '';

    $query = "SELECT * FROM Product WHERE ProductID = ?";
    $stmt = $db->prepare($query);
    $stmt->bindValue(1, $productID, SQLITE3_INTEGER);
    $result = $stmt->execute();

    if ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        echo "<img src='" . htmlspecialchars($row['ProductImg']) . "' alt='Product Image'>";
        echo "<div>" . htmlspecialchars($row['ProductName']) . "</div>";
        echo "<div>$" . htmlspecialchars($row['Price']) . "</div>";
    } else {
        echo "Product not found.";
    }
    // Close the database connection
    $db->close();
    ?>
    <p>Add your review here: </p>
    <textarea></textarea>
</body>
</html>
