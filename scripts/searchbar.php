<?php

include './product_controller.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
</head>
<body>
    <?php

if (empty($products)) {
    echo $message ?? "Product not found!";
} 
else{
        foreach($products as $product){ ?>
            <a href='<?php echo $product["ProductUrl"]; ?>'>
            <div class='aspect-h-1 aspect-w-1 w-full overflow-hidden bg-gray-200 xl:aspect-h-8 xl:aspect-w-7'>
                        <img src='<?php echo $product["ProductImg"]; ?>' alt='Product Image' class='h-full w-full object-cover object-center group-hover:opacity-75'>
                    </div>
            <h2><?php echo $product["ProductName"]; ?></h2>
            <p class='price'>$<?php echo $product["Price"]; ?></p>

        <?php }
}
    ?>
</body>
</html>

<?php
//Debuggers

//var_dump($products); 



// if(isset($_GET['search'])){
//     // $name = $_GET['search'];
//     // echo "data received from GET method: " . $name;
//     // echo "<pre>";
//     // print_r($products);
//     // echo "</pre>";

// } else {
//     echo "no data received from GET method";
// }
?>