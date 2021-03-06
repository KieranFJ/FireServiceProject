<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');


$in = $_POST;

$query = "SELECT items.*, test.* FROM test
            JOIN items
            ON items.ItemID = test.ItemID
            JOIN station
            ON station.StationID = test.StationID
            WHERE station.StationName = '".$in['stationName']."'
            AND items.Flag IN ('D', 'L');";

$results = sqlHandler::getDB()->select($query);

$i = 1;



if($results)
{
    usort($results, compare('TestDate', 'newtop'));
?>
<table class="table table-condensed">
    <tr>
        <th>#</th>
        <th>Serial No</th>
        <th>Test ID</th>
        <th>Flag</th>
        <th>Date of Test</th>
        <th>Test Type</th>
        <th>Test Comment</th>
    </tr>
    <?php 
    
    foreach($results as $row)
    {
    ?>
    <tr>
        <td width="5%"><?php echo $i++; ?></td>
        <td width="10%"><?php echo $row['SerialNo']; ?></td>
        <td width="5%"><?php echo $row['TestID']; ?></td>
        <td width="5%"><?php echo $row['Flag']; ?></td>
        <td width="15%"><?php echo $row['TestDate']; ?></td>
        <td width="10%"><?php echo $row['TestType']; ?></td>
        <td><?php echo $row['Comment']; ?></td>
    </tr>
    <?php 
    }
    }
    else
    {
        echo "<h3>No Destroyed Items for this Station</h3>";
    }
    ?>
</table>