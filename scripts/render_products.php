<!-- This script displays all out the products in the database -->

<div class="bg-white">
    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
        <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
            <?php
            class MyDB extends SQLite3 {
                function __construct() {
                    $this->open(__DIR__ . '/../store.db');
                }    
            }
            $db = new MyDB();
            if(!$db) {
                echo $db->lastErrorMsg();
            } else {
                //echo "Opened database successfully\n";
            }
            $sql = file_get_contents(__DIR__ . '/../sql/qry_retrieveAll.sql');
            $results = $db->query($sql);
            
            if($results) {
                while ($row = $results->fetchArray(SQLITE3_ASSOC)){
                    // Get the ProductID and use it in the URL
                    $productId = htmlspecialchars($row['ProductID']);
                    $productUrl = "./scripts/product_view.php?product_id=$productId";

                    // Start of product container
                    echo "<div>";

                    // Product link with ProductID in the query string
                    echo "<a href='$productUrl'>";

                    // Product image
                    $productImg = htmlspecialchars($row['ProductImg']);
                    echo "<div class='aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7'>
                            <img src='$productImg' alt='Product Image' class='h-full w-full object-cover object-center group-hover:opacity-75'>
                        </div>";

                    // Product name
                    $productName = htmlspecialchars($row['ProductName']);
                    echo "<div class='mt-4 text-sm text-gray-700'>$productName</div>";

                    // Product price
                    $productPrice = htmlspecialchars($row['Price']);
                    echo "<div class='mt-1 text-lg font-medium text-gray-900'>\$$productPrice</div>";

                    // End of product link
                    echo "</a>";

                    // End of product container
                    echo "</div>";
                }
            }
            $db->close();
            ?>
        </div>
    </div>
</div>
