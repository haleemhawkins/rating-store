<!--
    This php script is for an admin to
    update and delete products in SQL database
-->
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve input values from form
    $ProductID = $_POST['ProductID'];

    // Establish database connection
    $db = new SQLite3('../store.db');

    session_start();

    // First, fetch the image file path for the product
    $query = $db->prepare('SELECT ProductImg FROM Product WHERE ProductID = :id');
    $query->bindValue(':id', $ProductID, SQLITE3_INTEGER);
    $result = $query->execute();

    // Get the image path
    $imagePath = null;
    if ($row = $result->fetchArray()) {
        $imagePath = $row['ProductImg'];
    }

    if ($imagePath && file_exists($imagePath)) {
        // Delete the image file
        unlink($imagePath);
    }

    // Prepare a delete query
    $stmt = $db->prepare('DELETE FROM Product WHERE ProductId = :id');
    $stmt->bindValue(':id', $ProductID, SQLITE3_INTEGER);

    // Execute the query
    $result = $stmt->execute();

    // Check if the deletion was successful
    if ($result) {
        echo "Product with ID $ProductID has been deleted successfully.";
        header('Location:../update_products_page.php');
            exit;
    } else {
        echo "Error: Unable to delete the product.";
        header('Location:../update_products_page.php');
            exit;
    }

    // Close the database connection
    $db->close();
}

?>
