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
</body>
</html> 

