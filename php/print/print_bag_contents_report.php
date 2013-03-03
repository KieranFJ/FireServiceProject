<?php

@require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

$in = $_GET;

$query = "SELECT station.Address, station.Contact, bag.DateAssigned, bag.BagNumber,
                items.SerialNo, items.Points, items.IssueDate, items.NextTestDate,
                itemcategories.CatName, level.Level, items.Flag
            FROM items                  
            LEFT JOIN bag
            ON bag.BagID = items.BagID  
            LEFT JOIN station
            ON bag.StationID = station.StationID  
            LEFT OUTER JOIN itemcategories
            ON itemcategories.ItemTypeID = items.ItemTypeID 
            LEFT JOIN level
            ON level.LevelID = bag.LevelID
            WHERE items.BagID = '".$in['BagID']."';";

$res = sqlHandler::getDB()->select($query);

$i = 0;

//@TODO add station details to first page
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Gloucestershire Fire Service</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="print.css" rel="stylesheet">
        <style type="text/css">
            .main {
                
                border-collapse: separate;
            }
            .main td {
                padding: 5px;
                border: 1px solid #dddddd;
            }
            .page-break  { display: block; page-break-before: always; }
        </style>
    </head>
    <body>
        <div class="container">  
            
            <table class="table main">
                <tr><td><h3>Fire And Rescue Service</h3></td><td><h5><?php echo date("d-m-Y"); ?></h5></td></tr>
                <tr><td><h5>Safe Working At Height</h5></td><td><h5><?php echo $res[0]['Level']?></h5></td></tr>
                <tr><td><h5>Bag Number</h5></td><td><h5><?php echo $res[0]['BagNumber']?></h5></td></tr>
                <tr><td><h5>Vehicle Fleet</h5></td><td><h5><?php echo $in['vehicleFleet'] ?></h5></td>
            </table>   
            
            <table class="table main">    
                <tr>
                    <td>#</td>
                    <td><h5>Item Type</h4></td>
                    <td><h5>Serial No</h4></td>
                    <td><h5>Flag</h4></td>
                    <td><h5>Points</h4></td>
                    <td><h5>Comments</h4></td>
                </tr>
                <?php 
            foreach ($res as $row)
            {?>
                <tr>
                    <td width="30px"><?php echo $i+1 ?></td>
                    <td width="200px"><?php echo $row['CatName']?></td>
                    <td width="150px"><?php echo $row['SerialNo']?></td>
                    <td width="50px"><?php echo $row['Flag']?></td>
                    <td width="50px"><?php echo $row['Points']?></td>
                    <td></td>
                </tr>
                <?php 
                $i++;
                
                if($i == 20 || $i==40 || $i==60)
                {?>
                    </table>
            <table class="table main">
                <tr>
                    <td width="200px"><h5>Competent Person</h5></td>
                    <td width="200px"><h5><?php echo $in['competentPerson']?></h5></td>
                    <td style="border-bottom:0px"></td>
                </tr>
                <tr>
                    <td width="200px"><h5>Brigade Number</h5></td>
                    <td width="200px"><h5><?php echo $in['brigadeNo']?></h5></td>
                    <td style="border-top:0px">Signed __________________________________________</td>
                </tr>
            </table><div class="page-break"></div> 
                    <table class="table main">
                <tr><td><h3>Fire And Rescue Service</h3></td><td><h5><?php echo date("d-m-Y"); ?></h5></td></tr>
                <tr><td><h5>Safe Working At Height</h5></td><td><h5><?php echo $res[0]['Level']?></h5></td></tr>
                <tr><td><h5>Bag Number</h5></td><td><h5><?php echo $res[0]['BagNumber']?></h5></td></tr>
                <tr><td><h5>Vehicle Fleet</h5></td><td><h5><?php echo $in['vehicleFleet'] ?></h5></td>
            </table>
                    <table class="table main">
                <?php        
                }
                
                }?>
            </table>            
            <table class="table main">
                <tr>
                    <td width="200px"><h5>Competent Person</h5></td>
                    <td width="200px"><h5><?php echo $in['competentPerson']?></h5></td>
                    <td style="border-bottom:0px"></td>
                </tr>
                <tr>
                    <td width="200px"><h5>Brigade Number</h5></td>
                    <td width="200px"><h5><?php echo $in['brigadeNo']?></h5></td>
                    <td style="border-top:0px">Signed __________________________________________</td>
                </tr>
            </table>
           
        </div>
        
    </body>
</html>