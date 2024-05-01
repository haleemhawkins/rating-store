<?php
require_once 'product_model.php';

// Create an instance of MyDB
$db = new MyDB(); 

// Start the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Handle session messages
$successMessage = isset($_SESSION['success']) ? $_SESSION['success'] : '';
$failureMessage = isset($_SESSION['failure']) ? $_SESSION['failure'] : '';
unset($_SESSION['success'], $_SESSION['failure']);

// Function to fetch all products
if (!function_exists('fetchAllProducts')) {
    function fetchAllProducts($db) {
        $results = $db->getAllProducts(); 

        if (!$results) {
            return []; // Return an empty array or handle the error as needed
        }

        $products = [];
        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
            // Process each row
            array_push($products, array(
                'ProductImg' => htmlspecialchars($row['ProductImg']),
                'ProductName' => htmlspecialchars($row['ProductName']),
                'Price' => htmlspecialchars($row['Price']),
                'ProductID' => htmlspecialchars($row['ProductID']),
                'ProductUrl' => "product_details_page.php?product_id=" . $row['ProductID']
            ));
        }

        return $products;
    }
}

if (!function_exists('fetchProductDetails')) {
    // Function to fetch a single product's details
    function fetchProductDetails($db, $productId) {
        $productDetails = $db->getProductDetails($productId);

        if (!isset($productDetails["error"])) {
            // Sanitize the data if the product is found
            return array(
                'ProductImg' => htmlspecialchars($productDetails['ProductImg']),
                'ProductName' => htmlspecialchars($productDetails['ProductName']),
                'Price' => htmlspecialchars($productDetails['Price'])
                // Add more fields if needed
            );
        }

        return [];
    }
}
// Fetch product IDs for deletion form
$productIDs = $db->fetchProductIDs();

// Determine which function to call based on the request
$products = [];
$productDetails = [];
if (isset($_GET['product_id'])) {
    // Fetch details for a single product
    $productDetails = fetchProductDetails($db, $_GET['product_id']);
} else {
    // Fetch all products for listing
    $products = fetchAllProducts($db);
}
?>

