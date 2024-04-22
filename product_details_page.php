<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
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
    
    <!-- submit comment rating -->
    <form action="./scripts/process_comment.php" method="post">
    <p>Add your review here: </p>
    <textarea name="userComment"></textarea>
    <input type="hidden" name="productId" value="<?php echo $productDetails['ProductID']; ?>">
    <button type="submit">Submit Review</button>

    <!-- Display comments -->
<div class="comments-section mt-8">
    <h3 class="text-2xl font-semibold mb-4">Reviews</h3>
    <?php if (!empty($comments)): ?>
        <ul class=space-y-4">
            <?php foreach ($comments as $comment): ?>
                <li class="p-4 bg-white shadow-md rounded-lg border border-gray-200">
                    <p class="text-gray-800 text-lg"><?= htmlspecialchars($comment['Content']); ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p class="text-gray-500">No reviews yet.</p>
    <?php endif; ?>
</div>

    <!-- Link back to the product list page or home page -->
    <p><a href="product_page.php">Back to Product List</a></p>
</body>
</html>

