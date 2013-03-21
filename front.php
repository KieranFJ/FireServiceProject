<?php
session_start();

if (!isset($_SESSION['username']))
{
    header("Location: index.php" );
}

@include_once 'templates/header_temp.php';
@include_once 'templates/navigation_temp.php'; 

require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');

$query = "SELECT SerialNo, NextTestDate FROM items 
            WHERE NextTestDate BETWEEN (DATE_SUB(CURDATE(), INTERVAL 12 MONTH))
            AND (DATE_ADD(CURDATE(), INTERVAL 1 MONTH))
            AND Flag NOT IN ('D', 'L');";

$results = sqlHandler::getDB()->select($query);

if($results)
{
    usort($results, 'date_compare');
}


$query = "SELECT SerialNo, EndLifeDate FROM items
            WHERE EndLifeDate BETWEEN (DATE_SUB(CURDATE(), INTERVAL 12 MONTH))
           AND (DATE_ADD(CURDATE(), INTERVAL 1 MONTH))
            AND Flag NOT IN ('D', 'L');";
    
$endLifeRes = sqlHandler::getDB()->select($query);

if($endLifeRes)
{
  usort($endLifeRes, 'end_compare');  
}

?>

<div class="container">
    <div class="row">
        <div class="span5">
            <h3>Quick Item Search</h3>
            <form class=".form-search" method="post" id="form-typeahead">
                <input autocomplete="off" class="input-large search-query searchGet" type="text" id="typeahead" data-provide="typeahead" name="search" placeholder="Serial Number">
                <button id="type-submit" type="submit" class="btn btn-danger" onclick="fillSearchForm('php/reports/quick_item_search.php')">Search</button>
            </form>            
            <div class="row">
                <div id="searchUpForm">
                </div>       
                <div class="message span4"> 
                </div>                            
            </div>
        </div>
        <div class="span5">
                <div class="row">
                <div class="span5">
                    <h3>Upcoming End of Life (30 Days)</h3>
                    <?php 
                    if($endLifeRes)
                    {
                    ?>
                    <table class="table table-bordered">
                        <tr>
                            <th>Serial Number</th><th>Next Test Date</th>
                        </tr>
                        <tr>
                            <?php 
                            
                                foreach($endLifeRes as $row)
                                {
                                    $date = strtotime($row['EndLifeDate']);

                                    if($date < strtotime('+7days'))
                                    {
                                        echo "<tr class=\"error\"><td>".$row['SerialNo']."</td><td>".$row['EndLifeDate']."</td></tr>";
                                    }
                                    elseif($date > strtotime('+7days') && $date < strtotime('+14days'))
                                    {
                                        echo "<tr class=\"warning\"><td>".$row['SerialNo']."</td><td>".$row['EndLifeDate']."</td></tr>";
                                    }
                                    elseif($date > strtotime('+14days') && $date < strtotime('+21days'))
                                    {
                                        echo "<tr class=\"info\"><td>".$row['SerialNo']."</td><td>".$row['EndLifeDate']."</td></tr>";
                                    }
                                    else
                                    {
                                        echo "<tr><td>".$row['SerialNo']."</td><td>".$row['EndLifeDate']."</td></tr>";
                                    }
                                }
                                                        
                            ?>

                        </tr>
                    </table>
                    <?php 
                    }
                    else 
                    { 
                        echo "<h4>No Items current approaching their End of Life</h4>";
                    }
                    ?>
                    
                </div>

                <div class="span5">
                    <h3>Upcoming Tests (30 Days)</h3>
                    <?php 
                    if($results)
                    {
                    ?>
                    <table class="table table-bordered">
                        <tr>
                            <th>Serial Number</th><th>Next Test Date</th>
                        </tr>
                        <tr>
                            <?php 
                            foreach($results as $row)
                            {
                                $date = strtotime($row['NextTestDate']);

                                if($date < strtotime('+7days'))
                                {
                                    echo "<tr class=\"error\"><td>".$row['SerialNo']."</td><td>".$row['NextTestDate']."</td></tr>";
                                }
                                elseif($date > strtotime('+7days') && $date < strtotime('+14days'))
                                {
                                    echo "<tr class=\"warning\"><td>".$row['SerialNo']."</td><td>".$row['NextTestDate']."</td></tr>";
                                }
                                elseif($date > strtotime('+14days') && $date < strtotime('+21days'))
                                {
                                    echo "<tr class=\"info\"><td>".$row['SerialNo']."</td><td>".$row['NextTestDate']."</td></tr>";
                                }
                                else
                                {
                                    echo "<tr><td>".$row['SerialNo']."</td><td>".$row['NextTestDate']."</td></tr>";
                                }
                            }
                            ?>

                        </tr>
                    </table>
                    <?php 
                    }
                    else 
                    { 
                        echo "<h4>No Items current approaching their Next Test Dates</h4>";
                    }
                    ?>
                </div>    
            </div>
        </div>
    </div>
</div> <!-- /container -->
    
<?php

@include_once 'templates/footer_temp.php';    

?>

   
