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

?>

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
    <?php
        include 'scripts/navbar.php';
    ?>
    <br><br><br>
<div class="w3-content w3-padding" style="max-width:1564px">

    <?php include './scripts/product_controller.php'; ?>

    <h1>Product Details</h1>

    <!-- Check if product details are available -->
    <?php if (isset($productDetails) && !isset($productDetails['error'])): ?>
        <div class="product-details">
        <h2><?php echo $productDetails["ProductName"]; ?></h2>
            <p class='price'>$<?php echo $productDetails["Price"]; ?></p>
            <img src='<?php echo $productDetails["ProductImg"]; ?>' alt='Product Image' class='product-image' style="max-width:550px">
            
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
        } elseif ($rating >= 2) {
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

