<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');


$query = "SELECT CatName FROM itemcategories";

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
                <select id="target" data-target="upForm" class="get" name="name">
                    <?php
                        foreach($result as $row)
                        {?>
                            <option><?php echo $row['CatName'] ?></option>
                        <?php
                        }
                        ?>
                </select>
            </form>
            <form class="validate" action="php/itemCat/update_itemCat.php" method="post" id="form1">
                <div class="row">
                    <div id="upForm">
                    </div>
                    <div class="message span2">
                    </div>
                </div>  
                <div class="form-actions">
                    <button class="btn btn-primary btn-large" type="submit">Update Entry</button>
                </div>
            </form> 
        </div>
        <div class="tab-pane" id="addNew"> 
            <form class="validate" action="php/itemCat/add_itemCat.php" method="post" id="form2">
                <h2>Add Category</h2>
                <div class="row">
                    <div class="span3">
                        <label>Category Name</label>                
                        <input class="required" name="name" type="text" placeholder="Category Name of Item">              
                        <label>Description</label>
                        <textarea class="required" rows="3" name="description" placeholder="Description of Item"></textarea>
                        <label>Make/Model</label>
                        <input class="required" type="text" name="model" placeholder="Make/Model"></input>
                        
                    </div>
                    <div class="span3">
                        <label>Manufacturer</label>
                        <input class="required" name="manufacturer" type="text" placeholder="Manufacturer"></input>
                        <label>Contact Number</label>
                        <input class="required" name="contactNo" type="text" placeholder="Contact Number"></input>
                        <label>Address</label>                
                        <textarea class="required" rows="3" name="address" placeholder="Address"></textarea></div>
                    <div class="span2 message">
                    </div>
                </div>
                <div class="form-actions">
                    <button class="btn btn-primary btn-large" type="submit">Add Category</button>
                </div>
            </form>
        </div>
    </div>
</div>