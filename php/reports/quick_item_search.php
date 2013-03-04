<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');

$in = $_POST;

$input = clean($in);

if(isset($input))
{
    $query = "SELECT items.SerialNo, items.ItemID, bag.BagNumber, level.Level, 
                     station.StationAddress, station.Contact, station.StationNo, 
                     station.MobileNo, itemcategories.CatName                
                FROM items
                LEFT OUTER JOIN itemcategories
                ON itemcategories.ItemTypeID = items.ItemTypeID
                LEFT OUTER JOIN bag
                ON bag.BagID = items.BagID
                LEFT OUTER JOIN station
                ON station.StationID = bag.StationID                
                LEFT OUTER JOIN level
                ON level.LevelID = bag.LevelID
                WHERE items.SerialNo = '".$input['search']."';";
    

    $results = sqlHandler::getDB()->select($query);
    if(isset($results))
    {        
        ?>
        <div class="span5">
            <dl class="dl-horizontal">
                <dt>Serial Number</dt>
                <dd><?php echo $results[0]['SerialNo']?></dd>
                <dt>Item Type</dt><dd><?php echo $results[0]['CatName']?></dd>
                <dt>Bag Level</dt><dd><?php echo $results[0]['Level']?></dd>
                <dt>Bag Number</dt><dd><?php echo ($results[0]['BagNumber'] == '0'? 'Store' : $results[0]['BagNumber'] )?></dd>
                <dt>Station</dt><dd><?php echo $results[0]['StationAddress']?></dd>
                <dt>Contact</dt><dd><?php echo $results[0]['Contact']?></dd>
                <dt>Station No.</dt><dd><?php echo $results[0]['StationNo']?></dd>
                <dt>Station Mob.</dt><dd><?php echo $results[0]['MobileNo']?></dd>
            </dl>                   
            <a class="btn btn-success" href="item_report.php?ItemID=<?php echo $results[0]['ItemID']?>">Full Details</a>
        </div>              
    <?php    
    }
    else
    {
        alert("Invalid Search", 0);
    }
}
?>
