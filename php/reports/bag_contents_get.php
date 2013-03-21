<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');

$query = "SELECT bag.BagID FROM bag
            JOIN level
            ON bag.LevelID = level.LevelID
            WHERE BagNumber = '".$_POST['bagNumber']."'
            AND level.Level = '".$_POST['level']."';";

$bagID = sqlHandler::getDB()->select($query);

$query = "SELECT station.StationAddress, station.Contact, bag.DateAssigned, 
                items.SerialNo, items.Points, items.IssueDate, items.NextTestDate,
                items.Flag, items.Comments, itemcategories.CatName
            FROM items                 
            LEFT JOIN bag
            ON bag.BagID = items.BagID  
            LEFT JOIN station
            ON bag.StationID = station.StationID  
            LEFT OUTER JOIN itemcategories
            ON itemcategories.ItemTypeID = items.ItemTypeID             
            WHERE items.BagID = '".$bagID[0]['BagID']."';";

$results = sqlHandler::getDB()->select($query);

$query = "SELECT NoItems FROM level JOIN bag ON bag.LevelID = level.LevelID WHERE bag.BagID = '".$bagID[0]['BagID']."';";

$noItems = sqlHandler::getDB()->select($query);
?>
<script type="text/javascript">
    $('#noItems').each(function() {
       $(this).text('<?php echo count($results).'/'.$noItems[0]['NoItems']; ?> Items in this Bag'); 
    });
    $('#bagid').each(function() {  
        $(this).attr('value', '<?php echo $bagID[0]['BagID']; ?>')
    })
    $('#ticksheet').each(function() {
        $(this).attr('href', 'ticksheet.php?BagID=<?php echo $bagID[0]['BagID']; ?>')
    })
    </script>

<table class="table">
    <tr>        
        <th>#</th><th>Serial Number</th><th>Item Type</th><th>Flag</th><th>Points</th><th>Next Test Date</th><th>Comment</th>   
    </tr>
    <?php
    if($results)
    {   
        aasort($results, "CatName");
        $i = 1;
        
        foreach($results as $row)
        {?>
        <tr>
            <td width="5%"><?php echo $i ?></td>
            <td width="15%"><?php echo $row['SerialNo']; ?></td>
            <td width="15%"><?php echo $row['CatName']; ?></td>
            <td width="5%"><?php echo $row['Flag']; ?></td>
            <td width="5%"><?php echo $row['Points']; ?></td>
            <td width="15%"><?php echo $row['NextTestDate']; ?></td>
            <td><?php echo $row['Comments']; ?></td>
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

