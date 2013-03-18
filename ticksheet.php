<?php

@include_once 'templates/sessionstart.php';
@include_once 'templates/header_temp.php';




require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');

$in = $_GET;

if($in)
{
    $query = "SELECT bag.BagNumber, level.Level, station.StationName, 
                     items.SerialNo, itemcategories.CatName
                FROM items 
                JOIN itemcategories
                ON   itemcategories.ItemTypeID = items.ItemTypeID
                JOIN bag
                ON   bag.BagID = items.BagID
                JOIN level 
                ON   bag.LevelID = level.LevelID
                JOIN station
                ON   station.StationID = bag.StationID
                WHERE items.BagID = '".$in['BagID']."';";
    
    $results = sqlHandler::getDB()->select($query);
    
    $i = 1;
    ?>
<div class="container">
    <div class="row">
        <div class="span4">
            <h4>Firefighter Check List</h4>
        </div>
    </div>
    <div class="row">        
        <div class="span3">            
            <h4>SWAH Level: <?php echo $results[0]['Level'] ?></h4>
        </div>
        <div>
            <h4>Station: <?php echo $results[0]['StationName'] ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="span4">
            <table class="table table-condensed">
                <tr>
                    <th>#</th><th>Item Type</th><th>Serial No</th><th>Tick</th>
                </tr>

            <?php
            foreach($results as $row)
            {?>               

                
                <tr>
                    <td width="1%"><?php echo $i++?></td>
                    <td width="20%"><?php echo $row['CatName']?></td>
                    <td width="10%"><?php echo $row['SerialNo']?></td>            
                    <td width="5%"></td>
                    
                </tr>
            <?php 
            }
            ?>   
            </table>
        </div>
    </div>
</div>
<?php
    
}
else 
{
    echo "Invalid Bag ID";
}

@include_once 'templates/footer_temp.php';
?>
