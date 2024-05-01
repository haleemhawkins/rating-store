<?php
// Start output buffering to prevent headers already sent error
ob_start();

// Start the session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve input values from form
    $ProductID = $_POST['ProductID'];

    // Establish database connection
    $db = new SQLite3('../store.db');

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
        // Redirect to admin view page
        header('Location:../admin_view_page.php');
        exit;
    } else {
        // Redirect to admin view page with error message
        header('Location:../admin_view_page.php?error=1');
        exit;
    }

    // Close the database connection
    $db->close();
}

// Flush the output buffer and send content to the browser
ob_end_flush();
?>
