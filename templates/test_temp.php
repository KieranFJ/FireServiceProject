<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

?>

<div class="container">
    <div class="row">
        <div class="span6">
            <h3>Item Test</h3>
            <form class=".form-search" method="post" id="form-typeahead">
                <input autocomplete="off" class="input-large search-query searchGet" type="text" id="typeahead" data-provide="typeahead" name="search" placeholder="Serial Number">
                <button id="type-submit" type="submit" class="btn btn-danger" onclick="fillSearchForm('php/testing/search_item_test.php')">Search</button>
            </form>     
        </div>
    </div>        
    <div class="row">
        <div class="span12">
        <form class="validate" action="php/testing/submit_test.php" method="post" id="form2">
            <div class="row">
                <div id="searchUpForm">

                </div>
                <div class="message span4"> 
                </div>  
            </div>
            <div class="form-actions">
            <button id="dis" type="submit" class="btn btn-primary">Submit Test</button>
        </div>
        </form>                                        
        </div>
        
    </div>    
</div>