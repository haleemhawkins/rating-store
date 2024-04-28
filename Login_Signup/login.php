<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve POST data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Connect to SQLite database
    $db = new SQLite3('users.db');

    // Check if user exists with the provided credentials
    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':password', $password, SQLITE3_TEXT);
    $result = $stmt->execute();

    // Check if the query returned any rows
    if ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        // User authenticated successfully
        // Start a session and store user's email
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['isAdmin'] = $row['isadmin'];

        // Redirect to home page
        header("Location: ../index.php");
        exit;
    } else {
        // Invalid credentials
        echo '<script>
                  alert("Invalid email or password. Please try again.");
                  window.location.href = "login.html"; // Reload the login page
              </script>';
    }

    // Close database connection
    $db->close();
} else {
    // Redirect to login page if accessed directly
    header("Location: login.html");
    exit;
}
?>
