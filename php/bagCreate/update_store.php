<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');

$in = $_POST;



if(array_key_exists('serialArr', $in))
{
    $input = clean($in['serialArr']);
    
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
        VALUES ('".$results[0]['ItemID']."', '".$stationID[0]['StationID']."', '".$in['bagID']."', '".$results[0]['Flag']."', '0', '".$results[0]['Points']."', NOW(), 'Store Allocation');";
        
        sqlHandler::getDB()->insert($query);
    }
    alert("Items moved to Store", 1);
}
else 
{
    alert("Store Update Failed", 0);
}
?>
