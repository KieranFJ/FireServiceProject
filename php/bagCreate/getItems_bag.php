<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

$in = $_POST;

$query = "SELECT SerialNo FROM items
            LEFT JOIN bagcontents
            ON items.ItemID = bagcontents.ItemID
            LEFT OUTER JOIN itemcategories
            ON items.ItemTypeID = itemcategories.ItemTypeID
            WHERE bagcontents.BagID = '0'
            AND itemcategories.Name = '".$in['itemName']."';";

$results = sqlhandler::getDB()->select($query);
?>
<label>Items in Store</label>            
<select id="select1" class="input-large" multiple="multiple" size="20" >
    <?php
        foreach($results as $row)
        {?>
    <option><?php echo $row['SerialNo'];?></option>
        <?php
        }
    ?>
</select> 
