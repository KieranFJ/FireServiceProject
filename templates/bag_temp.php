<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

$query = "SELECT Level FROM level WHERE deprecated <> 1;";

$result = sqlHandler::getDB()->select($query);

$query = "SELECT Name FROM itemcategories WHERE deprecated <> 1;";

$itemTypeResult = sqlHandler::getDB()->select($query);

?>
<div class="container"> 
    <h1>Create Bag</h1>
    <div class="row">        
        <div class="span3">        
            <form action="php/bagCreate/newBag_bag.php" method="post" id="form1">
                <h2>Select Bag Level</h2>
                <select id="target" class="get" name="bagLevel">
                    <?php
                    foreach($result as $row)            
                    {?>
                        <option><?php echo $row['Level']; ?></option>
                    <?php
                    }?>            
                </select>        
            </form>            
        </div>   
        <div class="span2">
            
        </div>
        <div class="span3">
            <h2>Select Item Type</h2>
            <form action="php/bagCreate/getItems_bag.php" method="post" id="form2">
                <select id="target" class="getType" name="itemName">
                    <?php
                    foreach($itemTypeResult as $row)
                    {?>
                    <option><?php echo $row['Name']; ?></option> 
                    <?php 
                    }?>                    
                </select>
            </form>            
        </div>
    </div>
    <div class="row">
        
        <div class="span3">
            <div id="upForm">
            </div>
        </div>
        <div class="span2" style="margin-top: 220px;">   
            
            <button id="add" class="btn btn-inverse btn-large" style="margin-left: 20px;"><i class="icon-arrow-left icon-white"></i></button>
            <button id="remove" class="btn btn-inverse btn-large"><i class="icon-arrow-right icon-white"></i></button>          
            
        </div>
        <div class="span3">
            <div id="upFormType">
            </div>
        </div>
    </div>
    <div class="form-actions">
        <button class="btn btn-primary btn-large">Create Bag</button>
    </div>
</div>