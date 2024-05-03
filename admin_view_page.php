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

if (!isset($_SESSION['email']) || $_SESSION['isAdmin'] != 1) {
    // Redirect to a different page or display an error message
    echo "Access Denied";
    exit;
}
?>
<!-- This is an Admin page -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="./output.css" rel="stylesheet">
    <link rel="stylesheet" href="./EZ Rating_files/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Admin View Page</title>
</head>
<body>
<!-- Navbar (sit on top) -->
<?php
        include 'scripts/navbar.php';
?>
<br><br><br>
<div class="w3-content w3-padding" style="max-width:1564px">
<div class="w3-half">

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
                <input class="w3-hover-light-grey" type="text" id="ProductID" name="ProductID" required><br>
            <label for="ProductName">Product Name:</label><br>
            <input class="w3-hover-light-grey" type="text" id="ProductName" name="ProductName" required><br>

            <label for="ProductImg">Product Image:</label><br>
            <input type="file" id="ProductImg" name="ProductImg" accept="image/*"><br>

            <label for="Tags">Tags:</label><br>
            <select class="w3-hover-light-grey" id="Tags" name="Tags">
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
            <input class="w3-hover-light-grey" type="number" id="Stock" name="Stock" required><br>

            <label for="Price">Price:</label><br>
            <input class="w3-hover-light-grey" type="text" id="Price" name="Price" required><br><br>

            <button type="submit" class="w3-bar-item w3-button w3-black w3-hover-yellow w3-round-xxlarge" style="width: 210.5px;">Add Product</button>
    </form>
    </div>
    <h1>Delete Products</h1>
    <form action="scripts/delete_products.php" method="POST">
        <label for="ProductID">Product ID:</label><br>
        <select id="ProductID" name="ProductID" required>
        <?php foreach ($productIDs as $id): ?>
            <option value="<?php echo htmlspecialchars($id); ?>">
                <?php echo htmlspecialchars($id); ?>
            </option>
        <?php endforeach; ?>
        </select><br><br>
        <button type="submit" class="w3-bar-item w3-button w3-black w3-hover-yellow w3-round-xxlarge" style="width: 210.5px;" >Delete Product &nbsp <i class="fa fa-trash"></i></button>
    </form>

    <div class="w3-container w3-padding-32">
    <h1>All Products: </h1>
    <?php include './scripts/product_controller.php'; ?>

<div class="bg-white">
    <!-- ... other HTML code ... -->
    <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
        <?php foreach ($products as $product): ?>
            <div class="w3-light-grey w3-margin-bottom">
                <div class='aspect-h-1 aspect-w-1 w-full overflow-hidden bg-gray-200 xl:aspect-h-8 xl:aspect-w-7'>
                    <img src='<?php echo $product["ProductImg"]; ?>' alt='Product Image' >
                </div>
                <div> 
                <div class="w3-container">
                <div class='mt-4 text-sm text-gray-700'><?php echo $product["ProductName"]; ?></div>
                <div class='mt-4 text-sm text-gray-700'>Product id: <?php echo $product["ProductID"]; ?></div>
                <div class='mt-1 text-lg font-medium text-gray-900'>$<?php echo $product["Price"]; ?></div>
                </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</div>
</div>
</body>
</html> 

