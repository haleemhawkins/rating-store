<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
</head>
<body>
    <h1>Add a New Product</h1>
    <form action="scripts/insert_products.php" method="POST" enctype="multipart/form-data">
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

        <input type="submit" value="Add Product">
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
        <input type="submit" value="Delete Product">
    </form>

    <h1>All Products: </h1>
    <?php include __DIR__ . '/scripts/render_products.php'; ?>
</body>
</html> 

