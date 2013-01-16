<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');


$query = "SELECT Name FROM itemcategories WHERE deprecated <> 1";

$result = sqlHandler::getDB()->select($query);

?>
<div class="container">
    <h1>Item Category</h1>
    
    <ul id="myTab" class="nav nav-tabs">
        <li class="active"><a href="#update" data-toggle="tab">Update</a></li>
        <li class><a href="#addNew" data-toggle="tab">Add New</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane active" id="update">
            <form action="php/itemCat/get_itemCat.php" method="post">
                <h2>Update Item Categories</h2>
                <label>Select Item Type</label>
                <select id="target" class="get" name="name">
                    <?php
                        foreach($result as $row)
                        {?>
                            <option><?php echo $row['Name'] ?></option>
                        <?php
                        }
                        ?>
                </select>
            </form>
            <form class="validate" action="php/itemCat/update_itemCat.php" method="post" id="form1">
                <div id="upForm">
                </div>
            </form> 
        </div>
        <div class="tab-pane" id="addNew"> 
            <form class="validate" action="php/itemCat/add_itemCat.php" method="post" id="form2">
                <h2>Add Category</h2>
                <label>Name</label>                
                <input class="required" name="name" type="text" placeholder="Name of Item">              
                <label>Description</label>
                <textarea class="required" rows="3" name="description" placeholder="Description of Item"></textarea>
                <label>Make/Model</label>
                <input class="required" type="text" name="model" placeholder="Make/Model"></input>
                <label>Manufacturer</label>
                <input class="required" name="manufacturer" type="text" placeholder="Manufacturer"></input>
                <label>Contact Number</label>
                <input class="required" name="contactNo" type="text" placeholder="Contact Number"></input>
                <label>Address</label>                
                <textarea class="required" rows="3" name="address" placeholder="Address"></textarea>
                <div class="message">
                    
                </div>
                <div class="form-actions">
                    <button class="btn btn-primary btn-large" type="submit">Add Category</button>
                </div>
            </form>
        </div>
    </div>
    
    
    
</div>