<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

$query = "SELECT BagNumber FROM bag 
            LEFT OUTER JOIN level
            ON bag.LevelID = level.LevelID
            WHERE level.Level = '".$_POST['bagLevel']."';";

$results = sqlHandler::getDB()->select($query);
$missing = array(0 => 0);

if(isset($results))
{
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
}
else
{
    $missing[0] = $missing[0] + 1; 
}

?>

<label>Bag Number</label>
<input type="text" name="bagNumber" value="<?php echo $missing[0]; ?>">


            
<label>Items in Bag</label>
<select id="select2" class="input-large" multiple="multiple" size="20">
</select>        

    
