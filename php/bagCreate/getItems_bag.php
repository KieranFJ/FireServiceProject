<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');
// @TODO only display serial numbers that are not condemned or quarentined
$in = $_POST;

$query = "SELECT SerialNo FROM items            
            LEFT JOIN itemcategories
            ON items.ItemTypeID = itemcategories.ItemTypeID
            WHERE items.BagID = '0'
            AND itemcategories.Name = '".$in['itemName']."';";

$results = sqlhandler::getDB()->select($query);

if(isset($results))
{
?>
<form id="storeBag" action="php/bagCreate/update_store.php" method="post">
<label style="margin-top: 63px;">Items in Store</label>            
<select id="store" class="input-large" multiple="multiple" size="20" >
    <?php
        foreach($results as $row)
        {?>
    <option><?php echo $row['SerialNo'];?></option>
        <?php
        }
    ?>
</select> 

<?php 
}
else
{
    echo "<label style=\"margin-top: 63px;\">Items in Store</label><select id=\"store\" class=\"input-large\" multiple=\"multiple\" size=\"20\" ></select>";
    
}
?>
</form>