<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

$query = "SELECT BagNumber FROM bag 
            LEFT OUTER JOIN level
            ON bag.LevelID = level.LevelID
            WHERE level.Level = '".$_POST['bagLevel']."';";

$results = sqlHandler::getDB()->select($query);

?>
<h3>Select Bag Number</h3>
<form action="php/bagCreate/getContents_allocbag.php" method="post" id="form4">
<input type="hidden" name="level" value="<?php echo $_POST['bagLevel'];?>">
<select id="target3" class="getContents" name="bagNumber">

<?php 

foreach($results as $row)
{
    echo "<option>".$row['BagNumber']."</option>";
}?>

</select>        
</form>
<script type="text/javascript">
$('.getContents').trigger('change');    
</script>