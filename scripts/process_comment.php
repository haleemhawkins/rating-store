<?php
include_once 'product_model.php'; // Adjust the path as needed

$db = new MyDB();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['userComment'], $_POST['productId'])) {
    $comment = trim($_POST['userComment']);
    $productId = intval($_POST['productId']);
    $commentId = isset($_POST['commentId']) ? intval($_POST['commentId']) : NULL;

    if (!empty($comment)) {
        if ($commentId) {
            $stmt = $db->prepare('REPLACE INTO Comment (CommentID, Content, ProductID) VALUES (?, ?, ?)');
            $stmt->bindValue(1, $commentId, SQLITE3_INTEGER);
        } else {
            $stmt = $db->prepare('INSERT INTO Comment (CommentID, Content, ProductID) VALUES (?, ?, ?)');
        }
        $stmt->bindValue(1, $commentId, SQLITE3_INTEGER);
        $stmt->bindValue(2, $comment, SQLITE3_TEXT);
        $stmt->bindValue(3, $productId, SQLITE3_INTEGER);
        

        if ($stmt->execute()) {
            echo "Comment added/updated successfully!";
        } else {
            echo "Error adding/updating comment.";
        }
    } else {
        echo "Please enter a comment.";
    }
} else {
    echo "Invalid request.";
}

header('Location: ../product_details_page.php?product_id=' . $productId); // Adjust the redirect location as needed
?>
