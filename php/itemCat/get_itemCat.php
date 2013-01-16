<?php 

require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

$query = 'SELECT * FROM itemcategories
            WHERE name = "'.$_POST['name'].'"
            AND   deprecated <> 1;';

$result = sqlHandler::getDB()->select($query);


?>

<label>Name</label>
<input class="required" name="name" type="text" placeholder="Name of Item" value="<?php echo $result[0]['Name']; ?>"></input>
<label>Description</label>
<textarea class="required" rows="3" name="description" placeholder="Description of Item"><?php echo $result[0]['Description']; ?></textarea>
<label>Make/Model</label>
<input class="required" type="text" name="model" placeholder="Make/Model" value="<?php echo $result[0]['Model']; ?>"></input>
<label>Manufacturer</label>
<input class="required" name="manufacturer" type="text" placeholder="Manufacturer" value="<?php echo $result[0]['Manufacturer']; ?>"></input>
<label>Contact Number</label>
<input class="required" name="contactNo" type="text" placeholder="Contact Number" value="<?php echo $result[0]['ContactNo']; ?>"></input>
<label>Address</label>                
<textarea class="required" rows="3" name="address" placeholder="Address"><?php echo $result[0]['Address']; ?></textarea>
<input type="hidden" name="itemTypeID" value="<?php echo $result[0]['ItemTypeID']; ?>">
<div class="message">

</div>
<div class="form-actions">
    <button class="btn btn-primary btn-large" type="submit">Update Category</button>
</div>