<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

$query = "SELECT Level FROM level;";

$result = sqlHandler::getDB()->select($query);

$query = "SELECT Name FROM itemcategories;";

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
            <div id="upFormContents">                
            </div>
        </div>
        <div class="span2" style="margin-top: 180px;">
            <div id="bagAmount">
                20/20 Items in Bag
            </div>
            <div style="margin-top: 40px">               
                <button id="add" class="btn btn-inverse btn-large"><i class="icon-arrow-left icon-white"></i></button>
                <button id="remove" class="btn btn-inverse btn-large"><i class="icon-arrow-right icon-white"></i></button>             
            </div>
        </div>
        <div class="span3">
            <div id="upFormType">
            </div>
        </div>
        <div class="message span2">            
        </div>
    </div>
</div>