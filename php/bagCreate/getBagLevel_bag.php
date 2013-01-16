<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

$query = "SELECT BagNumber FROM bag 
            LEFT OUTER JOIN level
            ON bag.LevelID = level.LevelID
            WHERE level.Level = '".$_POST['bagLevel']."';";

$results = sqlHandler::getDB()->select($query);

$low = min($results);
$high = max($results);

$outArray = array();

for($i=0; $i < count($results); $i++)
{
    $outArray[$i] = $results[$i]['BagNumber'];
}

$missing = array_values(
        array_diff(
                range($low['BagNumber'], $high['BagNumber']), $outArray));

$query = "SELECT * FROM items
            LEFT OUTER JOIN bagcontents
            ON items.ItemID = bagcontents.ItemID
            WHERE bagcontents.BagID = '0';";

$results = sqlhandler::getDB()->select($query);

?>

<label>Bag Number</label>
<input type="text" name="bagNumber" value="<?php echo $missing[0]; ?>">
<div class="row">
    <div class="span4">
        <label>Items in Bag</label>
        <select class="input-xlarge" multiple="multiple" size="20">
            
        </select>
    </div>
    <div class="2">
        
    </div>
    <div class="span4">
        <label>Items in Store</label>
        <select class="input-xlarge" multiple="multiple" size="20">
            <?php
                foreach($results as $row)
                {?>
            <option><?php echo $row['SerialNo'];?></option>
                <?php
                }
            ?>
        </select>
    </div>
</div>
    

