<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

$query = "SELECT CatName FROM itemcategories";

$result = sqlHandler::getDB()->select($query);
?>

<div class="container">
    <h1>Item</h1>
    <ul id="myTab" class="nav nav-tabs">
        <li class><a href="#update" data-toggle="tab">Update</a></li>
        <li class="active"><a href="#addNew" data-toggle="tab">Add New</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane" id="update">
            <h2>Update Item</h2>
            <h2>Search</h2>
            <form class=".form-search" method="post" id="form3" >
                <input autocomplete="off" class="input-large search-query searchGet" type="text" id="typeahead" data-provide="typeahead" name="search" placeholder="Serial Number or Item Number">
                <button id="type-submit" type="submit" class="btn btn-danger" onclick="fillSearchForm('php/item/get_item.php')">Search</button>
            </form> 
            <form class="validate" action="php/item/update_item.php" method="post" id="form1">
                <div class="row">
                    <div id="searchUpForm">
                    </div>       
                    <div class="message span4"> 
                    </div>                            
                </div>                                     
                <div class="form-actions">
                    <button id="dis" class="btn btn-primary btn-large" type="submit">Update Item</button>
                </div>                        
            </form>    
        </div> 
        <div class="tab-pane active" id="addNew">
            <h2>Add Item</h2>                                               
            <form action="php/item/get_itemCat.php" method="post">
                <label>Item Type</label>
                <select id="target" data-target="upForm" class="get" name="itemName">
                    <?php 
                    foreach($result as $row)
                    {?>
                        <option><?php echo $row['CatName']; ?></option>
                    <?php 
                    }?>
                </select>
            </form> 
            <form class="validate" action="php/item/add_item.php" method="post" id="form2">
                <div class="row">
                    <div id="upForm">
                    </div>  
                    <div class="message span4">
                    </div>                          
                </div>
                <div class="form-actions">
                    <button class="btn btn-primary btn-large" type="submit">Add Item</button>
                </div>       
            </form>     
        </div>
    </div>          
 </div>  