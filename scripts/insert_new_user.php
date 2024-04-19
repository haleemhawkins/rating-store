<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve input values from form
    $UserID = $_POST['UserID'];
    $UserName = $_POST['UserName'];
        //password is immediately saved as a hash
        //uses bCrypt hashing algorithm by default
    $Password = password_hash($_POST['Password'])
    $isAdmin= $_POST['isAdmin'];
    

    // Establish database connection
    $db = new SQLite3('../store.db');

    session_start();
    $alertMessage = '';

    $uploadOk=1

    // SQL query
    if ($uploadOk == 1) {
        $stmt = $db->prepare('INSERT INTO User (UserID, UserName, isAdmin, Password) VALUES (:UserID, :UserName, :isAdmin, :Password)');
        $stmt->bindValue(':UserID', $UserID, SQLITE3_TEXT);
        $stmt->bindValue(':UserName', $UserName, SQLITE3_TEXT);
        $stmt->bindValue(':isAdmin', $isAdmin, SQLITE3_TEXT);
        $stmt->bindValue(':Password', $Password, SQLITE3_TEXT);
       

        // Execute and check
        $result = $stmt->execute();
        if ($result) {
            echo "User added successfully";
            $_SESSION['success'] = 'User added successfully!';
            header('Location:../admin_view_page.php');
            exit;
        } else {
            echo "Error adding User: " . $db->lastErrorMsg();
            $_SESSION['failure'] .= 'User error!';
            header('Location:../admin_view_page.php');
            exit;
        }
    }

    // Close database connection
    $db->close();
}
?> 

