/* This uses the library otifsolutions/php-sentiment-analysis.
   More documentation can be found at: 
   https://github.com/otifsolutions/php-sentiment-analysis

*/ 

<?php
include_once 'product_model.php';
require_once __DIR__ . '/../vendor/autoload.php';

use OTIFSolutions\PhpSentimentAnalysis\Sentiment;

$db = new MyDB();
$sentiment = new Sentiment();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['userComment'], $_POST['productId'])) {
    $comment = trim($_POST['userComment']);
    $productId = intval($_POST['productId']);
    $commentId = isset($_POST['commentId']) ? intval($_POST['commentId']) : NULL;

    if (!empty($comment)) {
        // Analyze the sentiment of the comment
        $result = $sentiment->analyze($comment);
        $sentimentScore = $result['score'];

        if ($commentId) {
            $stmt = $db->prepare('REPLACE INTO Comment (CommentID, Content, ProductID, SentimentScore) VALUES (?, ?, ?, ?)');
            $stmt->bindValue(1, $commentId, SQLITE3_INTEGER);
        } else {
            $stmt = $db->prepare('INSERT INTO Comment (Content, ProductID, SentimentScore) VALUES (?, ?, ?)');
        }
        $stmt->bindValue(1, $comment, SQLITE3_TEXT);
        $stmt->bindValue(2, $productId, SQLITE3_INTEGER);
        $stmt->bindValue(3, $sentimentScore, SQLITE3_TEXT);
        

        if ($stmt->execute()) {
            echo "Comment added/updated successfully!";

             // Calculate mean sentiment score
             $meanSentimentScore = $db->calculateMeanSentimentScore($productId);

             // Update product's rating in the Product table
             $updateStmt = $db->prepare('UPDATE Product SET Rating = ? WHERE ProductID = ?');
             $updateStmt->bindValue(1, $meanSentimentScore, SQLITE3_TEXT);
             $updateStmt->bindValue(2, $productId, SQLITE3_INTEGER);
             $updateStmt->execute();
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
