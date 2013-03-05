<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');

$in = $_POST;

$query = "SELECT BagID FROM items WHERE SerialNo = '".$in['serialArr'][0]."';";
    
$oldBagID = sqlHandler::getDB()->select($query);

if(array_key_exists('serialArr', $in))
{
    $input = clean($in['serialArr']);
    
    $query = "UPDATE items SET
                BagID = '".$in['bagID']."'
                WHERE SerialNo IN ('".implode("','", $input)."');";
    
    sqlHandler::getDB()->update($query);
    
    foreach($input as $row)
    {       
        $query = "SELECT ItemID, Flag, Points FROM items WHERE SerialNo = '".$row."';";

        $results = sqlHandler::getDB()->select($query);

        $query = "INSERT INTO itemhistory (ItemID, StationID, BagID, ItemFlag, TestID, Points, IssueBagDate, HistoryType)
        VALUES ('".$results[0]['ItemID']."', (SELECT StationID FROM bag WHERE bag.BagID = '".$in['bagID']."'), '".$in['bagID']."', '".$results[0]['Flag']."', '0', '".$results[0]['Points']."', NOW(), 'Store Allocation');";
        
        sqlHandler::getDB()->insert($query);
    }
    
    $query = "SELECT items.ItemID, level.LevelID, level.NoItems, bag.BagID FROM bag 
        JOIN items 
        ON items.BagID = bag.BagID 
        RIGHT JOIN level 
        ON level.LevelID = bag.LevelID 
        WHERE bag.BagID = '".$oldBagID[0]['BagID']."'";
    
    $newBag = sqlHandler::getDB()->select($query);
    $noItems = $newBag[0]['NoItems'];
    $numItems = count($newBag);
    if(!$newBag)
    {
        $query = "SELECT NoItems FROM level
            JOIN bag
            ON level.LevelID = bag.LevelID
            WHERE bag.BagID = '".$oldBagID[0]['BagID']."';";
        
        $newBag = sqlHandler::getDB()->select($query);
        $noItems = $newBag[0]['NoItems'];
    }
    ?>
    <script type="text/javascript">
        $('#bagAmount').text("<?php echo $numItems."/".$noItems?> Items in Bag")
    </script>
    <?php
    alert("Items moved to Store", 1);
}
else 
{
    alert("Store Update Failed", 0);
}
?>
