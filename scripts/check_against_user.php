<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve input values from form
    $UserName = $_POST['UserName'];
        //password is immediately saved as a hash
        //uses bCrypt hashing algorithm by default
    $Password = password_hash($_POST['Password'])
    

    // Establish database connection
    $db = new SQLite3('../store.db');

    session_start();
    $alertMessage = '';
    

    $query = $db->prepare("SELECT Password FROM User WHERE UserName LIKE :pass");
    $query->bindValue(':pass', $UserName, SQLITE3_TEXT);
    $query->execute();

    $SQLResult = $query->execute();
    var_dump($SQLResult->fetchArray());

        $passwordMatch=False
    if($SQLResult==$Password){
        $passwordMatch=True
        }

        // Close database connection
    $db->close();

        // Returns True if Password from HTML Matches SQLite PW for this UserName
    return $passwordMatch
    
}
?> 

