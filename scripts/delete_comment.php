<?php
include_once 'product_model.php';
// Check if the commentId is provided
if (isset($_POST['commentId'])) {
    
     // Establish database connection
     $db = new MyDB();
    
    // Get the commentId from the POST data
    $commentId = $_POST['commentId'];
    
    // Get the productId associated with the comment being deleted
    $comment = $db->getCommentById($commentId);
    $productId = $comment['ProductID'];


    // Prepare the SQL statement to delete the comment
    $stmt = $db->prepare('DELETE FROM Comment WHERE CommentID = ?');
    $stmt->bindValue(1, $commentId, SQLITE3_INTEGER);
    
    // Execute the SQL statement
    if ($stmt->execute()) {
        // Recalculate mean sentiment score after comment deletion
        $meanSentimentScore = $db->calculateMeanSentimentScore($productId);
        echo $meanSentimentScore;
        // Return the mean sentiment score as a response
        http_response_code(200);
        echo $meanSentimentScore;
    } else {
        // Return an error message
        http_response_code(500);
        echo "Error deleting comment.";
    }
    } else {
    // If commentId is not provided, return a bad request error
    http_response_code(400);
    echo "Bad request: commentId is missing.";
}
?>
