<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

$query = "SELECT Name FROM station;";

$result = sqlHandler::getDB()->select($query);

?>

<div class="container">
    <div class="row">
        <div class="span6">
            <h3>Item Test</h3>
            <form class=".form-search" action="php/test/search_item.php" method="post" id="form-typeahead">
                <input autocomplete="off" class="input-large search-query searchGet" type="text" id="typeahead" data-provide="typeahead" name="search" placeholder="Serial Number">
                <button id="type-submit" type="submit" class="btn btn-danger" onclick="fillSearchForm('php/testing/search_item_test.php')">Search</button>
            </form>            
            <div class="row">
                <div id="searchUpForm" class="span8">
                </div>       
                <div class="message span4"> 
                </div>                            
            </div>
        </div>
    </div>    
</div>