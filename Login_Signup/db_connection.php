<?php
// Database connection parameters
$database_file = "user.db";

try {
    // Connect to SQLite database
    $db = new SQLite3($database_file);
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>
