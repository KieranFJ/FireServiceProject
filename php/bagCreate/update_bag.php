<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');

$in = $_POST;

//@TODO Bug - can add items from store into store bag, or a new store bag. Stop store bag from appearing in bag number dropdown

if(array_key_exists('serialArr', $in))
{
    $input = clean($in['serialArr']);
    
    $query = "SELECT * FROM bag WHERE BagID = '".$in['bagID']."';";
    
    $bagExist = sqlHandler::getDB()->select($query);
    
    if(!$bagExist)
    {
        $query = "INSERT INTO bag (BagID, StationID, BagNumber, LevelID, DateAssigned)
            VALUES ('".$in['bagID']."', 0, '".$in['bagNumber']."', '".$in['levelID']."', NOW());";
        
        sqlHandler::getDB()->insert($query);
    }
       
    $query = "UPDATE items SET
                BagID = '".$in['bagID']."'
                WHERE SerialNo IN ('".implode("','", $input)."');";

    sqlHandler::getDB()->update($query);

    foreach($input as $row)
    {
        $query = "SELECT StationID FROM bag WHERE bag.BagID = '".$in['bagID']."';";

        $stationID = sqlHandler::getDB()->select($query);

        $query = "SELECT ItemID, Flag, Points FROM items WHERE SerialNo = '".$row."';";

        $results = sqlHandler::getDB()->select($query);

        $query = "INSERT INTO itemhistory (ItemID, StationID, BagID, ItemFlag, TestID, Points, IssueBagDate, HistoryType)
        VALUES ('".$results[0]['ItemID']."', '".$stationID[0]['StationID']."', '".$in['bagID']."', '".$results[0]['Flag']."', '0', '".$results[0]['Points']."', NOW(), 'Bag Allocation');";

        sqlHandler::getDB()->insert($query);
    }
    
    $query = "SELECT items.ItemID, level.NoItems FROM items 
        JOIN bag 
        ON items.BagID = bag.BagID 
        JOIN level 
        ON level.LevelID = bag.LevelID 
        WHERE items.BagID = '".$in['bagID']."'";
    
    $results = sqlHandler::getDB()->select($query);
    ?>
    <script type="text/javascript">
        $('#bagAmount').text("<?php echo count($results)."/".$results[0]['NoItems']?> Items in Bag")
    </script>
    <?php
    alert("Items added to Bag", 1);
    
}
else 
{
    alert("Bag Update Failed", 0);
}
//insert bag id into items table

//insert history for each

?>
