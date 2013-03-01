<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');

$query = "SELECT bag.BagID FROM bag
            JOIN level
            ON bag.LevelID = level.LevelID
            WHERE BagNumber = '".$_POST['bagNumber']."'
            AND level.Level = '".$_POST['level']."';";

$bagID = sqlHandler::getDB()->select($query);

$query = "SELECT station.Address, station.Contact, bag.DateAssigned, 
                items.SerialNo, items.Points, items.IssueDate, items.NextTestDate,
                itemcategories.Name
            FROM items                  
            LEFT JOIN bag
            ON bag.BagID = items.BagID  
            LEFT JOIN station
            ON bag.StationID = station.StationID  
            LEFT OUTER JOIN itemcategories
            ON itemcategories.ItemTypeID = items.ItemTypeID 
            WHERE items.BagID = '".$bagID[0]['BagID']."';";

$results = sqlHandler::getDB()->select($query);


//Station Name, Station Contact, Item Type, Item Serials, Test Date, Bag Number, Bag Level
?>
<script type="text/javascript">
    $('#bagid').each(function() {  
        $(this).attr('value', '<?php echo $bagID[0]['BagID']; ?>')
    })
    </script>

<table class="table">
    <tr>        
        <th>#</th><th>Serial Number</th><th>Item Type</th><th>Points</th><th>Next Test Date</th>   
    </tr>
    <?php
    if($results)
    {   
        aasort($results, "Name");
        $i = 1;
        
        foreach($results as $row)
        {?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $row['SerialNo']; ?></td>
            <td><?php echo $row['Name']; ?></td>
            <td><?php echo $row['Points']; ?></td>
            <td><?php echo $row['NextTestDate']; ?></td>
        </tr>
        <?php
        $i++;
        }?>
    </table>
    <?php
    }
    else
    {
    ?>   
<h1>No Items Exist in Bag</h1>
<?php
    }

