<table>
    <tr>
        <th>ProductID</th>
        <th>ProductName</th>
        <th>ProductImg</th>
        <th>Tags</th>
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
        $data = array();
        while ($row = $results->fetchArray(SQLITE3_ASSOC)){
            echo "<tr>";
            echo "<td>" . $row['ProductID'] . "</td>";
            echo "<td>" . $row['ProductName'] . "</td>";
            echo "<td>" . $row['ProductImg'] . "</td>";
            echo "<td>" . $row['Tags'] . "</td>";
            echo "</tr>";
        }
    }
    //echo "Operation done successfully\n";
    $db->close();
    ?>
</table>