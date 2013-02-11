<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

$query = "SELECT BagNumber FROM bag 
            LEFT OUTER JOIN level
            ON bag.LevelID = level.LevelID
            WHERE level.Level = '".$_POST['bagLevel']."';";

$results = sqlHandler::getDB()->select($query);

?>
<label>Bag Number</label>
<form action="php/bagCreate/getContents_bag.php" method="post">
<input type="hidden" name="level" value="<?php echo $_POST['bagLevel'];?>">
<select id="target3" class="get" name="bagNumber">

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