<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

$query = "SELECT SerialNo FROM items 
            LEFT JOIN bag
            ON bag.BagID = items.BagID
            WHERE bag.BagNumber = '".$_POST['bagNumber']."';";

$results = sqlHandler::getDB()->select($query);
?>



<form>
<label>Items in Bag</label>
<select id="select2" class="input-large" multiple="multiple" size="20">
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
</form>
