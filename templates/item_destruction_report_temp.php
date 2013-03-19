<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

$query = "SELECT StationName FROM station;";

$results = sqlHandler::getDB()->select($query);

?>

<div class="container">
    <h1>Destruction Report</h1>
    <div class="row">
        <div class="span3">
            <form action="php/reports/item_destruction_report.php" method="post" id="form1">
                <h2>Select Station</h2>
                <select id="target" data-target="upForm" class="get" name="stationName">
                    <?php
                    foreach($results as $row)            
                    {?>
                        <option><?php echo $row['StationName']; ?></option>
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