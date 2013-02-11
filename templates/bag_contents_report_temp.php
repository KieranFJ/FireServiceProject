<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

$query = "SELECT Level FROM level;";

$result = sqlHandler::getDB()->select($query);

?>

<div class="container">
    <h1>Bag Contents Report</h1>
    <div class="row">
        <div class="span3">
            <form action="php/reports/get_bags.php" method="post" id="form1">
                <h2>Select Level</h2>
                <select id="target" data-target="upForm" class="get" name="bagLevel">
                    <?php
                    foreach($result as $row)            
                    {?>
                        <option><?php echo $row['Level']; ?></option>
                    <?php
                    }?>            
                </select> 
            </form>
        </div>
    </div>
    
            <div id="upForm">

            </div>
        
    <div class="row">
    <div id="upFormContents" class="span12">
    </div>
    </div>         
</div>