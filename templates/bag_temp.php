<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

$query = "SELECT Level from level WHERE deprecated <> 1;";

$result = sqlHandler::getDB()->select($query);
?>

<div class="container">    
    <h1>Create Bag</h1>
    <form action="php/bagCreate/getBagLevel_Bag.php" method="post" id="form1">
        <h2>Select Bag Level</h2>
        <select id="target" class="get" name="bagLevel">
            <?php
            foreach($result as $row)            
            {?>
                <option><?php echo $row['Level']; ?></option>
            <?php
            }?>            
        </select>        
    </form>
        <div id="upForm">
            
        </div>  
</div>