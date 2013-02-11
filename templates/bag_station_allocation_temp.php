<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

$query = "SELECT Level from level LIMIT 1,18446744073709551615";

$results = sqlHandler::getDB()->select($query);
?>
<div class="container">
    
    <h1>Bag Allocation</h1>
    
    <h3>Select Level</h3>
    <div class="row">
    <div class="span3">
        <form action="php/bagCreate/get_Bags_alloc.php" method="post" id="form1">
            <select id="target" data-target="upForm" class="get" name="bagLevel">        
                <?php 
                foreach($results as $row)
                {
                    echo "<option>".$row['Level']."</option>";
                }?>
            </select>
        </form>
    </div>
    </div>
    <div class="row">
        <div class="span3">
            <div id="upForm">

            </div>
        </div>
        <div class="span3">
            <select
        </div>
    </div>
</div>