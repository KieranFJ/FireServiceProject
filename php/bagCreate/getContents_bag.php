<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');


$query = "SELECT BagID FROM bag
            LEFT JOIN level
            ON bag.LevelID = level.LevelID
            WHERE level.Level = '".$_POST['level']."'
            AND bag.BagNumber = '".$_POST['bagNumber']."';";

$bagID = sqlHandler::getDB()->select($query);
//select bagid using level and bag number
//select all items with that level
$query = "SELECT SerialNo FROM items 
            LEFT JOIN bag
            ON bag.BagID = items.BagID
            WHERE bag.BagID = '".$bagID[0]['BagID']."';";

$results = sqlHandler::getDB()->select($query);?>

<form id="currBag" action="php/bagCreate/update_bag.php" method="post">
<input id="bagID" type="hidden" name="bagID" value="<?php echo $bagID[0]['BagID']; ?>">
<?php
if(isset($results))
{
?>




<label>Items in Bag</label>
<select id="bag" class="input-large" multiple="multiple" size="20">
    <?php
    
    if(isset($results))
    {
        foreach($results as $row)
        {
            echo "<option>".$row['SerialNo']."</option>";
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