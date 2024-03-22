<table>
    <tr>
        <th>ProductID</th>
        <th>ProductName</th>
        <th>ProductImg</th>
        <th>Tags</th>
        <th>Stock</th>
        <th>Price</th>
    </tr>
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
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['ProductID']) . "</td>";
            echo "<td>" . htmlspecialchars($row['ProductName']) . "</td>";
            // Display image
            echo "<td><img src='" . htmlspecialchars($row['ProductImg']) . "' alt='Product Image' style='width:100px;'></td>";
            echo "<td>" . htmlspecialchars($row['Tags']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Stock']) . "</td>";
            echo "<td>" . "$" . htmlspecialchars($row['Price']) . "</td>";
            echo "</tr>";
        }
    }
    $db->close();
    ?>
</table>
