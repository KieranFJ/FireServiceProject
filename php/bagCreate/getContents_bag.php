<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');


$query = "SELECT bag.BagID, level.NoItems FROM bag
            LEFT JOIN level
            ON bag.LevelID = level.LevelID
            WHERE level.Level = '".$_POST['level']."'
            AND bag.BagNumber = '".$_POST['bagNumber']."';";

$bagID = sqlHandler::getDB()->select($query);

$query = "SELECT levelID FROM level WHERE Level = '".$_POST['level']."';";

$levelID = sqlHandler::getDB()->select($query);
//select bagid using level and bag number
//select all items with that level
if($bagID)
{
    $query = "SELECT SerialNo, itemcategories.Name FROM items 
                LEFT JOIN bag
                ON bag.BagID = items.BagID
                LEFT OUTER JOIN itemcategories
                ON items.ItemTypeID = itemcategories.ItemTypeID
                WHERE bag.BagID = '".$bagID[0]['BagID']."';";
    
    $results = sqlHandler::getDB()->select($query);
}
else
{
    //@TODO Remove commented code
    //if bag is null find out what bagids there are and 
       
    $query = "SELECT BagID FROM bag;";
    
    $bags = sqlHandler::getDB()->select($query);
    
    
//
//    $low = min($bags);
    $high = max($bags);
    $bagID[0]['BagID'] = $high['BagID'] + 1;
//    $outArray = array();
//
//    for($i=0; $i < count($bags); $i++)
//    {
//        $outArray[$i] = $bags[$i]['BagID'];
//    }
//
//    $missing = array_values(
//            array_diff(
//                    range($low['BagID'], $high['BagID']), $outArray));
//    
//    
//    $bagID[0]['BagID'] = $missing[0];
}



?>

<form id="currBag" action="php/bagCreate/update_bag.php" method="post">
<input id="bagID" type="hidden" name="bagID" value="<?php echo $bagID[0]['BagID']; ?>">
<input id="levelID" type="hidden" name="levelID" value="<?php echo $levelID[0]['levelID']; ?>">
<input id="bagNumber" type="hidden" name="bagNumber" value="<?php echo $_POST['bagNumber']; ?>">
<label>Items in Bag</label>
<?php
if(isset($results))
{
?>

<select id="bag" class="input-large" multiple="multiple" size="20">
    <?php
    
    if(isset($results))
    {
        aasort($results, "Name");
        $oldName = "";
        foreach($results as $row)
        {
            $newName = $row['Name'];
            
            if($newName != $oldName)
            {
                echo "<optgroup label=\"".$row['Name']."\">";
                echo "<option>".$row['SerialNo']."</option>";   
                $oldName = $newName;
            }
            else
            {
                echo "<option>".$row['SerialNo']."</option>";   
                $oldName = $newName;
            }
        }
    }
    ?>
</select>        

<?php
}
else
{
    ?><select id="bag" class="input-large" multiple="multiple" size="20"></select><?php
}
?>
</form>
<script type="text/javascript">
    $('#bagAmount').text("<?php echo count($results)."/".$bagID[0]['NoItems']?> Items in Bag")
</script>