<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');

$in = $_POST;

$query = "SELECT level.Level, bag.BagNumber FROM bag
            JOIN level 
            ON bag.LevelID = level.LevelID
            JOIN station 
            ON bag.StationID = station.StationID
            WHERE station.Name = '".$in['stationName']."';";

$results = sqlHandler::getDB()->select($query);
        
if($results)
{
    ?>
<div class="span3">
    <input type="hidden" name="stationName" value="<?php echo $in['stationName'] ?>">
    <label>Bags at Station</label>
    <select class="input-large uneditable-input" multiple="multiple" size="20"><?php
    
    
    if(isset($results))
    {
        aasort($results, "Level");
        $oldName = "";
        foreach($results as $row)
        {
            $newName = $row['Level'];
            
            if($newName != $oldName)
            {
                echo "<optgroup label=\"".$row['Level']."\">";
                echo "<option>".$row['BagNumber']."</option>";   
                $oldName = $newName;
            }
            else
            {
                echo "<option>".$row['BagNumber']."</option>";   
                $oldName = $newName;
            }
        }
    }
    
    
?>
    </select>
</div>
<?php
}
else
{
    echo "<input type=\"hidden\" name=\"stationName\" value=\"".$in['stationName']."\">";
    alert("No Bags at this station", 0);
}
    ?>
