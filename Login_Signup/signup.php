<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve POST data
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];

    // Connect to SQLite database
    $db = new SQLite3('users.db');

    // Check if user already exists with the provided email
    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $result = $stmt->execute();

    // Check if the query returned any rows
    if ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        // User already exists with the provided email
        echo '<script>alert("User already exists. Please try again with a different email.");</script>';
    } else {
        // Insert new user into the database
        $stmt = $db->prepare("INSERT INTO users (email, name, password) VALUES (:email, :name, :password)");
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':name', $name, SQLITE3_TEXT);
        $stmt->bindValue(':password', $password, SQLITE3_TEXT);
        $result = $stmt->execute();

        if ($result) {
            // User signed up successfully
            echo '<script>
                    alert("User signed up successfully.");
                    window.location.href = "login.html"; // Redirect to login page
                  </script>';
        } else {
            // Unable to sign up user
            echo '<script>alert("Unable to sign up. Please try again.");</script>';
        }
    }

    // Close database connection
    $db->close();
} else {
    // Redirect to login page if accessed directly
    header("Location: login.html");
    exit;
}
?>
