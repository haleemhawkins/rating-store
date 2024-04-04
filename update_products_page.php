<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="./output.css" rel="stylesheet">
    <title>Add Product</title>
</head>
<body>
    <?php
    session_start(); // Ensure the session is started

    // Check if the success message is set
    if(isset($_SESSION['success'])) {
        // Display the success message
        echo "<script>alert('" . addslashes(htmlspecialchars($_SESSION['success'])) . "');</script>";

        // Unset the success message
        unset($_SESSION['success']);
    }
    elseif(isset($_SESSION['failure'])) {
        echo "<script>alert('" . addslashes(htmlspecialchars($_SESSION['failure'])) . "');</script>";

        // Unset the success message
        unset($_SESSION['failure']);
    }
    ?>
    <form action="scripts/insert_products.php" method="POST" enctype="multipart/form-data">
            <h2>Add a New Product</h2>
            <label for="ProductID">Product ID:</label><br>
                <input type="text" id="ProductID" name="ProductID" required><br>
            <label for="ProductName">Product Name:</label><br>
            <input type="text" id="ProductName" name="ProductName" required><br>

            <label for="ProductImg">Product Image:</label><br>
            <input type="file" id="ProductImg" name="ProductImg" accept="image/*"><br>

            <label for="Tags">Tags:</label><br>
            <input type="text" id="Tags" name="Tags"><br>

            <label for="Stock">Stock:</label><br>
            <input type="number" id="Stock" name="Stock" required><br>

            <label for="Price">Price:</label><br>
            <input type="text" id="Price" name="Price" required><br>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 my-4 rounded">Add Product</button>
    </form>

    <?php
    // Establish database connection
    $db = new SQLite3('store.db');

    // Prepare a query to fetch Product IDs
    $query = "SELECT ProductID FROM Product";
    $results = $db->query($query);

    // Create an array to hold Product IDs
    $productIDs = [];
    while ($row = $results->fetchArray()) {
        $productIDs[] = $row['ProductID'];
    }
    $db->close();
    ?>
    <h1>Delete Products</h1>
    <form action="scripts/delete_products.php" method="POST">
        <label for="ProductID">Product ID:</label><br>
        <select id="ProductID" name="ProductID" required>
        <?php foreach ($productIDs as $id): ?>
            <option value="<?php echo htmlspecialchars($id); ?>">
                <?php echo htmlspecialchars($id); ?>
            </option>
        <?php endforeach; ?>
        </select><br>
        <button type="submit" class="bg-red-700 hover:bg-red-900 text-white font-bold py-2 px-4 my-4 rounded">Delete Product</button>
    </form>

    <h1>All Products: </h1>
    <?php include __DIR__ . '/scripts/render_products.php'; ?>
</body>
</html> 

