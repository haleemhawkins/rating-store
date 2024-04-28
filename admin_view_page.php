<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); 

?>
<!-- This is an Admin page -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="./output.css" rel="stylesheet">
    <link rel="stylesheet" href="./EZ Rating_files/w3.css">
    <title>Admin View Page</title>
</head>
<body>
<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-wide w3-padding w3-card">
    <a href="index.php" class="w3-bar-item w3-button"><b>EZ</b> Rating</a>
    <!-- Float links to the right. Hide them on small screens -->
    <div class="w3-right w3-hide-small">
      <a href="admin_view_page.php" class="w3-bar-item w3-button">Admin</a>
      <a href="#" class="w3-bar-item w3-button">Categories</a>
      <a href="/AboutPage/AboutPage.html" class="w3-bar-item w3-button">About</a>
      <a href="./Login_Signup/login.html">
      <?php
            if(isset($_SESSION['email'])) {
                echo '<a href="./Login_Signup/logout.php" class="w3-bar-item w3-button">Log off</a>';
            } else {
                echo '<a href="./Login_Signup/login.html" class="w3-bar-item w3-button">Log in / sign up</a>';
            }
            ?>
      </a>
    </div>
  </div>
</div>

<?php include './scripts/admin_controller.php'; ?>

<!-- Displaying Session Messages -->
<?php if ($successMessage): ?>
    <script>alert('<?php echo addslashes(htmlspecialchars($successMessage)); ?>');</script>
<?php elseif ($failureMessage): ?>
    <script>alert('<?php echo addslashes(htmlspecialchars($failureMessage)); ?>');</script>
<?php endif; ?>
    <form action="scripts/insert_products.php" method="POST" enctype="multipart/form-data">
            <h2>Add a New Product</h2>
            <label for="ProductID">Product ID:</label><br>
                <input type="text" id="ProductID" name="ProductID" required><br>
            <label for="ProductName">Product Name:</label><br>
            <input type="text" id="ProductName" name="ProductName" required><br>

            <label for="ProductImg">Product Image:</label><br>
            <input type="file" id="ProductImg" name="ProductImg" accept="image/*"><br>

            <label for="Tags">Tags:</label><br>
            <select id="Tags" name="Tags">
                <option value="Electronics">Electronics</option>
                <option value="office equipment">office equipment</option>
                <option value="cosmetics">cosmetics</option>
                <option value="Fashion">Fashion</option>
                <option value="Furniture">Furniture</option>
                <option value="Tools">Tools</option>
                <option value="Appliances">Appliances</option>
                <option value="Toys">Toys</option>
            </select><br>

            <label for="Stock">Stock:</label><br>
            <input type="number" id="Stock" name="Stock" required><br>

            <label for="Price">Price:</label><br>
            <input type="text" id="Price" name="Price" required><br>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 my-4 rounded">Add Product</button>
    </form>

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
    <?php include './scripts/product_controller.php'; ?>

<div class="bg-white">
    <!-- ... other HTML code ... -->
    <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
        <?php foreach ($products as $product): ?>
            <div>
                <div class='aspect-h-1 aspect-w-1 w-full overflow-hidden bg-gray-200 xl:aspect-h-8 xl:aspect-w-7'>
                    <img src='<?php echo $product["ProductImg"]; ?>' alt='Product Image' class='h-full w-full object-cover object-center group-hover:opacity-75'>
                </div>
                <div class='mt-4 text-sm text-gray-700'><?php echo $product["ProductName"]; ?></div>
                <div class='mt-4 text-sm text-gray-700'>Product id: <?php echo $product["ProductID"]; ?></div>
                <div class='mt-1 text-lg font-medium text-gray-900'>$<?php echo $product["Price"]; ?></div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html> 

