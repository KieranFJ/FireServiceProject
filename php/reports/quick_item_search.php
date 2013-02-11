<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');

$in = $_POST;

$input = clean($in);

if(isset($input))
{
    $query = "SELECT items.SerialNo, bag.BagNumber, level.Level, 
                     station.Address, station.Contact, station.StationNo, 
                     station.MobileNo, itemcategories.Name                
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
            <table class="table table-bordered">
                <tr>
                    <th>Serial Number</th><th>Item Type</th>
                </tr>
                <tr>
                    <td><?php echo $results[0]['SerialNo']?></td><td><?php echo $results[0]['Name']?></td>
                </tr>
                <tr>
                    <th>Level</th><th>Bag Number</th>
                </tr>
                <tr>
                    <td><?php echo $results[0]['Level']?></td><td><?php echo ($results[0]['BagNumber'] == '0'? 'Store' : $results[0]['BagNumber'] )?></td>
                </tr>
                <tr>
                    <th>Station</th><th>Contact</th>
                </tr>
                <tr>
                    <td><?php echo $results[0]['Address']?></td><td><?php echo $results[0]['Contact']?></td>
                </tr>
                <tr>
                    <th>Station No.</th><th>Mobile No.</th>
                </tr>
                <tr>
                    <td><?php echo $results[0]['StationNo']?></td><td><?php echo $results[0]['MobileNo']?></td>
                </tr>
            </table>            
        </div>              
    <?php    
    }
    else
    {
        alert("Invalid Search", 0);
    }
}
?>
