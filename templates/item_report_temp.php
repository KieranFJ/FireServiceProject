<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

if(isset($_GET))
{
    $in = $_GET;
    $query = "SELECT * FROM items WHERE ItemID = '".$in['ItemID']."';";

    $result = sqlHandler::getDB()->select($query);
    
    $in['search'] = $result[0]['SerialNo'];
}


?>

<div class="container">
    <h2>Item Report</h2>
    <h2>Search</h2>
    <form class=".form-search" method="get" id="form3" >
        <input autocomplete="off" class="input-large search-query searchGet" type="text" id="typeahead" data-provide="typeahead" name="search" placeholder="Serial Number or Item Number">
        <button id="type-submit" type="submit" class="btn btn-danger" onclick="fillSearchForm('php/reports/item_report.php')">Search</button>
    </form> 
    <div class="row">
    <div id="searchUpForm">
        <?php 
        if(isset($result))
        {
            @include($_SERVER['DOCUMENT_ROOT'].'\fire\FireServiceProject\php\reports\item_report.php');            
        }
        ?>
    </div>       
    <div class="message span4">
    </div>
    </div>  
</div>