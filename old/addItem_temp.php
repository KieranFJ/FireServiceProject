<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

$query = "SELECT Name FROM itemcategories";

$result = sqlHandler::getDB()->select($query);
?>
<div class="container">
    <h2>Add Item</h2>
    <form action="php/item/get_itemCat.php" method="post">
        <label>Item Type</label>
        <select id="target" class="get" name="itemName">
            <?php 
            foreach($result as $row)
            {?>
                <option><?php echo $row['Name']; ?></option>
            <?php 
            }?>
        </select>
    </form>
    <form class="validate" action="php/php.php" method="post" id="form2">
        <div class="row">
            <div id="upForm">

            </div>
            <div class="message span4">
            </div>
        </div>
        <div class="form-actions">
            <button class="btn btn-primary btn-large" type="submit">Add Item</button>
        </div>       
    </form>     
    
</div>