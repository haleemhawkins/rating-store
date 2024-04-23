<?php
require_once 'product_model.php';

$db = new MyDB(); // Create an instance of MyDB

if (!function_exists('fetchAllProducts')) {
    // Function to fetch all products
    function fetchAllProducts($db, $tag = null) {
        global $db; // Use the global instance of MyDB
        $query = "SELECT * FROM Product";
        if ($tag !== null) {
            $query .= " WHERE Tags = :tag";  // Assume the category field matches the tag
        }
        $stmt = $db->prepare($query);
        if ($tag !== null) {
            $stmt->bindValue(':tag', $tag, SQLITE3_TEXT);
        }
        $results = $stmt->execute();
        if (!$results) {
            return []; // Return an empty array or handle the error as needed
        }
        $products = [];
        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
            $row['ProductImg'] = htmlspecialchars($row['ProductImg']);
            $row['ProductName'] = htmlspecialchars($row['ProductName']);
            $row['Price'] = htmlspecialchars($row['Price']);
            $row['ProductID'] = htmlspecialchars($row['ProductID']);
            $row['ProductUrl'] = "product_details_page.php?product_id=" . $row['ProductID'];
            array_push($products, $row);
        }
        return $products;
    }
}

if (!function_exists('fetchProductDetails')) {
    // Function to fetch a single product
    function fetchProductDetails($db, $productId) { // Add $db as a parameter
        return $db->getProductDetails($productId); // Use the method from MyDB instance
    }
}

if (!function_exists('fetchProductDetailsAndComments')) {
    // Function to fetch a single product and its comments
    function fetchProductDetailsAndComments($db, $productId) {
        $details = $db->getProductDetails($productId); // Fetch product details
        $comments = $db->getCommentsByProductId($productId); // Fetch comments for the product
        return ['details' => $details, 'comments' => $comments];
    }
}

if (!function_exists('fetchProductsByName')) {
    // Function to fetch products by name
    function fetchProductsByName($db, $productName) {
        return $db->fetchProductsByName($productName);
    }
}

$tag = isset($_GET['tag']) ? $_GET['tag'] : '';
if (isset($_GET['product_id'])) {
    $result = fetchProductDetailsAndComments($db, $_GET['product_id']);
    $productDetails = $result['details'];
    $comments = $result['comments'];
} elseif (isset($_GET['search'])) {
    $products = fetchProductsByName($db, $_GET['search']);
} elseif (!empty($tag)) {
    $products = fetchAllProducts($db, $tag);
} else {
    $products = fetchAllProducts($db);
}

?>