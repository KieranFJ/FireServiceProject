<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

?>

<div class="container">
    <div class="row">
        <div class="span6">
            <h3>Destroy Item</h3>
            <form class=".form-search" action="php/test/search_item.php" method="post" id="form-typeahead">
                <input autocomplete="off" class="input-large search-query searchGet" type="text" id="typeahead" data-provide="typeahead" name="search" placeholder="Serial Number">
                <button id="type-submit" type="submit" class="btn btn-danger" onclick="fillSearchForm('php/testing/search_item_destroy.php')">Search</button>
            </form>     
        </div>
    </div>        
    <div class="row">
        <div class="span12">
        <form class="validate" action="php/testing/destroy_item.php" method="post" id="form2">
            <div class="row">
                <div id="searchUpForm">

                </div>
                <div class="message span4"> 
                </div>  
            </div>      
            <div class="form-actions">
                <a href="#myModal" role="button" class="btn btn-primary" data-toggle="modal">Submit</a>
            </div>
        </form>                                        
        </div>
        
    </div>    
</div>