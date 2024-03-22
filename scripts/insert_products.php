<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve input values from form
    $ProductID = $_POST['ProductID'];
    $ProductName = $_POST['ProductName'];
    $Tags = $_POST['Tags'];
    $Stock = $_POST['Stock'];
    $Price = $_POST['Price'];

    // Establish database connection
    $db = new SQLite3('../store.db'); // Goes one level up to find store.db


    // Handle Product Image File Upload
    $uploadDir = '../product_images/'; // Directory where images will be saved
    $uploadedFile = $uploadDir . basename($_FILES['ProductImg']['name']);
    $imageFileType = strtolower(pathinfo($uploadedFile, PATHINFO_EXTENSION));
    $uploadOk = 1;

    // Check if image file is a actual image or fake image
    if(isset($_FILES["ProductImg"])) {
        $check = getimagesize($_FILES["ProductImg"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check file size (for example, max 5MB)
    if ($_FILES["ProductImg"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["ProductImg"]["tmp_name"], $uploadedFile)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["ProductImg"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // SQL query
    if ($uploadOk == 1) {
        $stmt = $db->prepare('INSERT INTO Product (ProductID, ProductName, ProductImg, Tags, Stock, Price) VALUES (:ProductID, :ProductName, :ProductImg, :Tags, :Stock, :Price)');
        $stmt->bindValue(':ProductID', $ProductID, SQLITE3_TEXT);
        $stmt->bindValue(':ProductName', $ProductName, SQLITE3_TEXT);
        $stmt->bindValue(':ProductImg', $uploadedFile, SQLITE3_TEXT); // Save the path instead of the image content
        $stmt->bindValue(':Tags', $Tags, SQLITE3_TEXT);
        $stmt->bindValue(':Stock', $Stock, SQLITE3_INTEGER);
        $stmt->bindValue(':Price', $Price, SQLITE3_FLOAT);

        // Execute and check
        $result = $stmt->execute();
        if ($result) {
            echo "Product added successfully";
        } else {
            echo "Error adding product: " . $db->lastErrorMsg();
        }
    }

    // Close database connection
    $db->close();
}
?>

