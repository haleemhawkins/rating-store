<?php
class MyDB extends SQLite3 {
    function __construct() {
        $this->open(__DIR__ . '/../store.db');
    }

    function getAllProducts() {
        $sqlFilePath = __DIR__ . '/../sql/qry_retrieveAll.sql';
        if (!file_exists($sqlFilePath) || !is_readable($sqlFilePath)) {
            return ["error" => "Unable to read SQL file"];
        }

        $sql = file_get_contents($sqlFilePath);
        $results = $this->query($sql); // Use $this instead of creating a new instance

        if (!$results) {
            return ["error" => "Query failed to execute"];
        }

        return $results; // Return results directly
    }

    function getProductDetails($productId) {
        $query = "SELECT * FROM Product WHERE ProductID = ?";
        $stmt = $this->prepare($query); // Use $this
        $stmt->bindValue(1, $productId, SQLITE3_INTEGER);
        $result = $stmt->execute();

        if ($result) {
            $productDetails = $result->fetchArray(SQLITE3_ASSOC);
            return $productDetails ? $productDetails : ["error" => "Product not found."];
        } else {
            return ["error" => "Query failed to execute"];
        }
    }

    function fetchProductIDs() {
        $results = $this->query("SELECT ProductID FROM Product"); // Use $this
        $productIDs = [];
        while ($row = $results->fetchArray()) {
            $productIDs[] = $row['ProductID'];
        }
        return $productIDs;
    }

    function fetchProductsByName($productName) {
        $query = "SELECT * FROM Product WHERE ProductName LIKE :productName";
        $stmt = $this->prepare($query);

        $productName = preg_replace('/\s+/', '', $productName);
        $searchTerm = '%' . $productName . '%';
        $stmt->bindValue(':productName', $searchTerm, SQLITE3_TEXT);
        $result = $stmt->execute();

        if ($result) {
            $products = [];
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $row['ProductImg'] = htmlspecialchars($row['ProductImg']);
                $row['ProductName'] = htmlspecialchars($row['ProductName']);
                $row['Price'] = htmlspecialchars($row['Price']);
                $row['ProductID'] = htmlspecialchars($row['ProductID']);
                $row['ProductUrl'] = "product_details_page.php?product_id=" . $row['ProductID'];
                array_push($products, $row);
            }
            return $products;
        } else {
            return ["error" => "Query failed to execute"];
        }
    }

    public function getCommentsByProductId($productId) {
        $stmt = $this->prepare('SELECT * FROM Comment WHERE ProductID = ?');
        $stmt->bindValue(1, $productId, SQLITE3_INTEGER);
        $result = $stmt->execute();

        $comments = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $comments[] = $row;
        }
        return $comments;
    }

    public function getCommentById($commentId) {
        $stmt = $this->prepare('SELECT * FROM Comment WHERE CommentID = ?');
        $stmt->bindValue(1, $commentId, SQLITE3_INTEGER);
        $result = $stmt->execute();

        if ($result) {
            return $result->fetchArray(SQLITE3_ASSOC);
        } else {
            return false;
        }
    }

    function calculateMeanSentimentScore($productId) {
    
        $stmt = $this->prepare('SELECT AVG(SentimentScore) AS MeanSentimentScore FROM Comment WHERE ProductID = ?');
        $stmt->bindValue(1, $productId, SQLITE3_INTEGER);
        $result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);
    
        return $result['MeanSentimentScore'];
    }
    
}


?>
