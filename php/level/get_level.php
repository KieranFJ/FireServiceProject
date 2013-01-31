<?php 

require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

$query = 'SELECT * FROM level 
            WHERE level = "'.$_POST['levelSelect'].'";';

$result = sqlHandler::getDB()->select($query);


?>
<label>Bag Level</label>
<input type="text" class="required" minlength="1" name="level" value="<?php echo $result[0]['Level']; ?>"></input>
<label>Number of Items</label>
<input class="required" maxlength="5" minlength="1" type="text" name="noItems" value="<?php echo $result[0]['NoItems']; ?>">
<label>Description</label>
<textarea rows="4" name="description" class="required"><?php echo $result[0]['Description']; ?></textarea><label></label>
<input type="hidden" name="levelID" value="<?php echo $result[0]['LevelID']; ?>">

<!-- @TODO REMOVE <div class="modal hide fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Entry Removal</h3>
    </div>
    <div id="modalMessage" class="modal-body">
        <h4>Warning</h4>
        <p>Are you sure you want to remove this entry?</p>
        <p>Removal may have a serious effect upon existing bags using this level.</p>
    </div>
    <div class="modal-footer">
        <a href="#" id="removeEntry" class="btn btn-danger btn-large">Yes Remove</a>
        <a href="#" class="btn btn-primary btn-large" data-dismiss="modal">No/Close</a>
    </div>
    <script>
        $("#removeEntry").click(function() {
            console.log("stuff");
           $("#modalMessage").load('php/level/remove_level.php', $(this).parents('form').serialize());
        });
    </script>-->
</div>

