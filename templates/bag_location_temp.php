<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

$query = "SELECT level.Level, level.NoItems, station.StationName, 
            bag.BagNumber, COUNT(items.ItemID) 
            FROM bag 
            JOIN station 
            ON bag.StationID = station.StationID
            JOIN level 
            ON level.LevelID = bag.LevelID
            LEFT JOIN items 
            ON bag.BagID = items.BagID
            GROUP BY bag.BagID
            ORDER BY station.StationName
            LIMIT 1,18446744073709551615;";

$results = sqlHandler::getDB()->select($query);    
    
$i = 1;
$lastRow = $results[0]['Level'];
?>

<div class="container">
    <h2>Bag Locations</h2>
    <div class="span4">
    <table class="table table-striped">
        <tr>
            <th>#</th>
            <th>Level</th>
            <th>Bag Number</th>
            <th>Station</th>
            <th>Item Amount</th>
        </tr>
            <?php
            foreach($results as $row)
            {
                if($lastRow != $row['Level'])
                {?>
                    </table></div>
    <div class="span4">
                    <table class="table table-striped">
        <tr>
            <th>#</th>
            <th>Level</th>
            <th>Bag Number</th>
            <th>Station</th>
            <th>Item Amount</th>
        </tr>
                <?php
                }                
                ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php $lastRow = $row['Level']; echo $row['Level']; ?></td>
                    <td><?php echo $row['BagNumber']; ?></td>
                    <td><?php echo $row['StationName']; ?></td>
                    <td><?php echo $row['COUNT(items.ItemID)']."/".$row['NoItems']; ?></td>
                </tr>
                <?php
                
            }
            ?>        
    </table>
    </div>
</div>