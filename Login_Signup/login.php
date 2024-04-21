<?php
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
        echo '<script>
                alert("Login successful.");
                window.location.href = "dashboard.php"; // Redirect to dashboard
              </script>';
    } else {
        // Invalid credentials
        echo '<script>alert("Invalid email or password. Please try again.");</script>';
    }

    // Close database connection
    $db->close();
} else {
    // Redirect to login page if accessed directly
    header("Location: login.html");
    exit;
}
?>
