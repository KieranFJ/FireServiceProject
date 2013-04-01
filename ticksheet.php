<?php

@include_once 'templates/sessionstart.php';





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
    <h3>Firefighter Check List</h3>
    <table class="table main">
        <tr>
            <td>SWAH Level</td>
            <td>Station</td>
        </tr>
        <tr>
            <td><?php echo $results[0]['Level'] ?></td>
            <td><?php echo $results[0]['StationName'] ?></td>
        </tr>
    </table>    
    <table class="table main">
        <tr>
            <th>#</th><th>Item Type</th><th>Serial No</th><th>Tick</th>
        </tr>

    <?php    
    foreach($results as $row)
        
    {?>               


        <tr>
            <td width="100px"><?php echo $i++?></td>
            <td width="200px"><?php echo $row['CatName']?></td>
            <td width="100px"><?php echo $row['SerialNo']?></td>            
            <td width="50px"></td>

        </tr>
    <?php 
        if($i % 15 == 0)
        {?>
        </table>
        <div class="page-break"></div>
        <table class="table main">
            <tr>
                <td width="100px"><?php echo $i++?></td>
                <td width="200px"><?php echo $row['CatName']?></td>
                <td width="100px"><?php echo $row['SerialNo']?></td>            
                <td width="50px"></td>

            </tr>
        <?php 
        }
    }
    ?>   
    </table>

</div>
<?php
    
}
else 
{
    echo "Invalid Bag ID";
}

@include_once 'templates/footer_temp.php';
?>
