<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

$query = "SELECT Level from level LIMIT 1,18446744073709551615";

$results = sqlHandler::getDB()->select($query);

$query = "SELECT Name FROM station;";

$stationResults = sqlHandler::getDB()->select($query);
?>
<div class="container">
    
    <h1>Bag Allocation</h1>
    
    
    <div class="row">
        <div class="span3">
            <h3>Select Level</h3>
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
        <div id="upForm" class="span3">

        </div>              
        <div class="span3">
            <h3>Select Station</h3>
            <form action="php/bagCreate/get_Station_bags.php" method="post" id="form2">                
                <select id="triggerTarget" data-target="upStationBags" class="get" name="stationName">
                    <?php
                        foreach($stationResults as $row)
                        {?>
                            <option><?php echo $row['Name'] ?></option>
                        <?php
                        }
                        ?>
                </select>
            </form>
        </div>        
    </div> 
    <form action="php/bagCreate/allocate_bag.php" method="post" id="form3">
    <div class="row">    
        <div id="upFormContents" class="span3">

        </div>        
        <div id="upStationBags" class="span3">
            
        </div><div class="span2">
        <div class="message">

        </div>    
    </div>
    </div>
        <div class="form-actions">
            <button class="btn btn-primary btn-large" type="submit">Allocate Bag</button>
        </div>
    </form>
    
</div>