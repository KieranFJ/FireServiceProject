<?php 

require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

$query = 'SELECT * FROM level 
            WHERE level = "'.$_POST['levelSelect'].'";';

$result = sqlHandler::getDB()->select($query);


?>
<label>Bag Level</label>
<input type="text" class="required" minlength="1" name="level" value="<?php echo $result[0]['Level']; ?>"></input>
<label>Number of Items</label>
<input class="required digits" maxlength="5" minlength="1" type="text" name="noItems" value="<?php echo $result[0]['NoItems']; ?>">
<label>Description</label>
<textarea rows="4" name="description" class="required"><?php echo $result[0]['Description']; ?></textarea><label></label>
<input type="hidden" name="levelID" value="<?php echo $result[0]['LevelID']; ?>">
</div>

