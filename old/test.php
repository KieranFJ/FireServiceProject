
<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

$query = "SELECT Name FROM itemcategories";

$result = sqlHandler::getDB()->select($query);
?>

<div class="container">
    <h1>Item</h1>
    <ul id="myTab" class="nav nav-tabs">
        <li class="active"><a href="#add" data-toggle="tab">Add New</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
 
        </div>
        <div class="tab-pane active" id="add">
            <h2>Add Item</h2>                                               
            <form action="php/item/get_itemCat.php" method="post" id="form3">
                <label>Item Type</label>
                <select id="target" class="get" name="itemName">
                    <?php 
                    foreach($result as $row)
                    {?>
                        <option><?php echo $row['Name']; ?></option>
                    <?php 
                    }?>
                </select>
            </form> 
            <form action="php/item/add_item.php" method="post" id="form2">
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


