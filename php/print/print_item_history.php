<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');


if($_GET['ItemID'] != "")
{
    $query = "SELECT *               
            FROM items
            LEFT OUTER JOIN itemcategories
            ON itemcategories.ItemTypeID = items.ItemTypeID
            LEFT OUTER JOIN bag
            ON bag.BagID = items.BagID
            LEFT OUTER JOIN station
            ON station.StationID = bag.StationID                
            LEFT OUTER JOIN level
            ON level.LevelID = bag.LevelID
            WHERE items.ItemID = '".$_GET['ItemID']."';";


    $results = sqlHandler::getDB()->select($query);
    
    if(!$results)
    {
        echo "<h3>Invalid Item</h3>";
    }
    else
    {
        $query = "SELECT itemhistory.*, station.StationName, bag.BagNumber, level.Level 
                FROM itemhistory 
                JOIN station
                ON station.StationID = itemhistory.StationID
                JOIN bag
                ON bag.BagID = itemhistory.BagID
                JOIN level
                ON bag.LevelID = level.LevelID
                WHERE ItemID = '".$results[0]['ItemID']."'";
    
        $histRes = sqlHandler::getDB()->select($query);
        
        usort($histRes, compare('HistEntryDate', 'newtop'));
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
            <h4>Item History Report</h4>
            <table class="table main">
                <tr>
                    <td><b>Serial No</b></td>
                    <td><b>Item Type</b></td>
                    <td><b>Print Date</b></td>            
                </tr>    
                <tr>
                    <td><?php echo $results[0]['SerialNo']; ?></td>
                    <td><?php echo $results[0]['CatName']; ?></td>
                    <td><?php echo date('d-m-Y'); ?></td>
                </tr>
            </table>
            <?php 
            if($histRes)
            {
                $i = 1;
            ?>
            <table class="table main">
                <tr>
                    <td><b>#</b></td>
                    <td><b>Test Type</b></td>
                    <td><b>Station</b></td>
                    <td><b>Bag No</b></td>
                    <td><b>Flag</b></td>
                    <td><b>Points</b></td>
                    <td><b>Entry Date</b></td>
                </tr>
                <?php    
                    foreach($histRes as $row)
                    {
                    ?>
                        <tr>
                            <td width="4%"><?php echo $i++; ?></td>
                            <td width="15%"><?php echo $row['HistoryType']; ?></td>
                            <td width="10%"><?php echo $row['StationName']; ?></td>
                            <td width="5%"><?php echo $row['BagNumber']; ?></td>
                            <td width="5%"><?php echo $row['ItemFlag']; ?></td>
                            <td width="5%"><?php echo $row['Points']; ?></td>  
                            <td width="15%"><?php echo $row['HistEntryDate']; ?></td>
                        </tr>
                        <?php  
                    
                        if($i % 10 == 0)
                        {?>
                        </table>
                        <div class="page-break"></div>
                        <table class="table main">
                             <tr>
                                <td><b>#</b></td>
                                <td><b>Test Type</b></td>
                                <td><b>Station</b></td>
                                <td><b>Bag No</b></td>
                                <td><b>Flag</b></td>
                                <td><b>Points</b></td>
                                <td><b>Entry Date</b></td>
                            </tr>
                        <?php
                        }
                    }
                }
                else
                {
                    echo "<h3>There are no test entries for this Item</h3>";
                }
                ?>
            </table>
            <?php 
        }
    }
    else
    {
        echo "<h3>No Item Selected</h3>";
    }
    ?>
        </div>
    </body>
</html>