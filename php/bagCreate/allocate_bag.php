<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');

$in = $_POST;

$input = clean($in);

$query = "UPDATE bag 
            JOIN station ON (station.StationID = bag.StationID)
            SET 
            bag.StationID = 
                (SELECT StationID FROM station WHERE StationName = '".$input['stationName']."')
            WHERE bag.BagID = '".$input['bagID']."';";

$results = sqlHandler::getDB()->update($query);

$query = "SELECT ItemID, Flag, Points FROM items 
            WHERE BagID = '".$input['bagID']."';";

$items = sqlHandler::getDB()->select($query);

foreach($items as $row)
{
    $query = "INSERT INTO itemhistory (ItemID, StationID, BagID, ItemFlag, TestID, Points, IssueBagDate, HistoryType)
                VALUES ('".$row['ItemID']."', 
                        (SELECT StationID FROM station WHERE StationName = '".$input['stationName']."'),
                        '".$input['bagID']."',
                        '".$row['Flag']."',
                        0,
                        '".$row['Points']."',
                        NOW(),
                        'Station Changed')";
    
    $items = sqlHandler::getDB()->insert($query);
}

$query = "INSERT INTO itemhistory (ItemID, StationID, BagID, ItemFlag, TestID, Points, IssueBagDate)
            VALUES ( itemidhere, 
                
            ";

if($results == 0)
{
    alert("Bag already allocated to this station. No changes made", 0);
}
else
{
    alert("Bag allocated to ".$input['stationName']." station", 1);
    ?>
<script type="text/javascript">
$('#triggerTarget').trigger('change');    
</script>
<?php
}
?>
