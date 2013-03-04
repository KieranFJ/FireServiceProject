<?php 

require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

$query = 'SELECT * FROM itemcategories
            WHERE CatName = "'.$_POST['name'].'";';

$result = sqlHandler::getDB()->select($query);


?>

<div class="span3">
    <label>Category Name</label>
    <input class="required" name="name" type="text" placeholder="Category Name of Item" value="<?php echo $result[0]['CatName']; ?>"></input>
    <label>Description</label>
    <textarea class="required" rows="3" name="description" placeholder="Description of Item"><?php echo $result[0]['CatDescription']; ?></textarea>
    <label>Make/Model</label>
    <input class="required" type="text" name="model" placeholder="Make/Model" value="<?php echo $result[0]['Model']; ?>"></input>
</div>
<div class="span3">
    <label>Manufacturer</label>
    <input class="required" name="manufacturer" type="text" placeholder="Manufacturer" value="<?php echo $result[0]['Manufacturer']; ?>"></input>
    <label>Contact Number</label>
    <input class="required" name="contactNo" type="text" placeholder="Contact Number" value="<?php echo $result[0]['ContactNo']; ?>"></input>
    <label>Address</label>                
    <textarea class="required" rows="3" name="address" placeholder="Address"><?php echo $result[0]['CatAddress']; ?></textarea>
    <input type="hidden" name="itemTypeID" value="<?php echo $result[0]['ItemTypeID']; ?>">
</div>
