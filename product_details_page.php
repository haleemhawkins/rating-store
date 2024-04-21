<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <link rel="stylesheet" href="./EZ Rating_files/w3.css">
    <title>Product Details</title>
</head>
<body>

    <!-- Navbar (sit on top) -->
    <div class="w3-top">
    <div class="w3-bar w3-white w3-wide w3-padding w3-card">
        <a href="index.html" class="w3-bar-item w3-button"><b>EZ</b> Rating</a>
        <!-- Float links to the right. Hide them on small screens -->
        <div class="w3-right w3-hide-small">
        <a href="#" class="w3-bar-item w3-button">Categories</a>
        <a href="#" class="w3-bar-item w3-button">About</a>
        <a href="./Login/LoginPage.html">
        <button class="w3-bar-item w3-button w3-black w3-hover-yellow w3-round-xxlarge">Log in / sign up</button>
        </a>
        </div>
    </div>
    </div>

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


        <!-- Conditions to Display Rating Letter Grade -->
    <?php
    function getRatingLetterGrade($rating) {
        if ($rating === null) {
            return 'No rating';
        } elseif ($rating >= 8) {
            return 'A';
        } elseif ($rating >= 3) {
            return 'B';
        } elseif ($rating >= 0) {
            return 'C';
        } elseif ($rating >= -3) {
            return 'D';
        } elseif ($rating <= -5) {
            return 'F';
        }
    }
    ?>

        <!-- Display comments -->
    <div class="comments-section mt-8">
        <h3 class="text-2xl font-semibold mb-4">Reviews</h3>
        <!-- Display Rating Letter Grade -->
        <?php $ratingLetter = "Overall Product Score: " . getRatingLetterGrade($productDetails['Rating']); ?>
        <h1><?php echo $ratingLetter; ?></h1><br>
        <?php if (!empty($comments)): ?>
            <ul class=space-y-4">
                <?php foreach ($comments as $comment): ?>
                    <li class="p-4 bg-white shadow-md rounded-lg border border-gray-200">
                        <!-- Display Sentiment Score Letter Grade -->
                        <?php $sentimentScoreLetter = "Review Score: " . getRatingLetterGrade($comment['SentimentScore']); ?>
                        <p class="text-gray-800 text-lg"><?= htmlspecialchars($sentimentScoreLetter); ?></p>
                        <p class="text-gray-800 text-lg"><?= htmlspecialchars($comment['Content']); ?></p>
                        <!-- Button to delete comment -->
                    <button onclick="deleteComment(<?= $comment['CommentID']; ?>)">Delete Comment</button>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="text-gray-500">No reviews yet.</p>
        <?php endif; ?>
    </div>

    <!-- JavaScript function to handle deletion -->
<script>
    function deleteComment(commentId) {
        // Confirm deletion
        if (confirm("Are you sure you want to delete this comment?")) {
            // Send AJAX request to delete_comment.php
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Reload page after successful deletion
                        location.reload();
                    } else {
                        // Handle error
                        alert("Error deleting comment.");
                    }
                }
            };
            xhr.open("POST", "./scripts/delete_comment.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("commentId=" + commentId);
        }
    }
</script>
</body>
</html>

