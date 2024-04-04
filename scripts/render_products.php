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
            echo "<div>";
            //echo "<div>" . htmlspecialchars($row['ProductID']) . "</div>";
            // Display image
            echo "<div class='aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7'>
                <img src='" . htmlspecialchars($row['ProductImg']) . "' alt='Product Image' 
                class='h-full w-full object-cover object-center group-hover:opacity-75'>
            </div>";
            echo "<div class='mt-4 text-sm text-gray-700'>" . htmlspecialchars($row['ProductName']) . "</div>";
            //echo "<div>" . htmlspecialchars($row['Tags']) . "</div>";
            //echo "<div>" . htmlspecialchars($row['Stock']) . "</div>";
            echo "<div class='mt-1 text-lg font-medium text-gray-900'>" . "$" . htmlspecialchars($row['Price']) . "</div>";
            echo "</div>";
        }
    }
    $db->close();
    ?>
    </div>
    </div>
</div>
