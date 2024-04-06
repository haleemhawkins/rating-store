<?php
require_once 'product_model.php';

$db = new MyDB(); // Create an instance of MyDB

if (!function_exists('fetchAllProducts')) {
    // Function to fetch all products
    function fetchAllProducts($db) {
        global $db; // Use the global instance of MyDB
        $results = $db->getAllProducts(); // Call the method on the MyDB instance

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

// Determine which function to call based on the request
if (isset($_GET['product_id'])) {
    $productDetails = fetchProductDetails($db, $_GET['product_id']); // Pass $db as an argument
} else {
    $products = fetchAllProducts($db); // Pass $db as an argument
}
?>