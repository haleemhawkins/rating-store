<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href=" " rel="stylesheet">
    <title>Product Details</title>
</head>
<body>
    <!-- Include the PHP Controller -->
    <?php include './scripts/product_controller.php'; ?>

    <h1>Product Details</h1>
    
    <!-- Check if product details are available -->
    <?php if (isset($productDetails) && !isset($productDetails['error'])): ?>
        <div class="product-details">
            <img src='<?php echo $productDetails["ProductImg"]; ?>' alt='Product Image' class='product-image'>
            <h2><?php echo $productDetails["ProductName"]; ?></h2>
            <p class='price'>$<?php echo $productDetails["Price"]; ?></p>
            <!-- Other product details can be added here -->
        </div>
    <?php else: ?>
        <!-- Display error message or 'product not found' -->
        <p>Product not found or error in loading product details.</p>
    <?php endif; ?>

    <p>Add your review here: </p>
    <textarea></textarea>

    <!-- Link back to the product list page or home page -->
    <p><a href="product_page.php">Back to Product List</a></p>
</body>
</html>

