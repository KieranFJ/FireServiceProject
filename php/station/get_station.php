<?php 

/*
 * @TODO get_station.php - proper validation
 * @TODO get_station.php - remove commented out code
 * @TODO get_station.php - proper comments
 */

require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

$input = $_POST;

$query = 'SELECT * FROM station
            WHERE Contact = "'.$input['contactSelect'].'";';

$result = sqlHandler::getDB()->select($query);


?>

    
        <label>Contact Name</label>
        <input type="text" class="required" minlength="1" name="contactName" value="<?php echo $result[0]['Contact']; ?>"></input>
        <label>Station Contact Number</label>
        <input type="text" class="required" minlength="1" name="stationNo" value="<?php echo $result[0]['StationNo']; ?>"></input>
        <label>Mobile Contact Number</label>
        <input type="text" class="required" minlength="1" name="mobileNo" value="<?php echo $result[0]['MobileNo']; ?>"></input>
        <label>Address</label>
        <textarea rows="4" name="address" class="required"><?php echo $result[0]['Address']; ?></textarea><label></label>
        <input type="hidden" name="stationID" value="<?php echo $result[0]['StationID']; ?>">
    
   
<!-- @TODO REMOVE <div class="form-actions">
    <button class="btn btn-primary btn-large">Update Entry</button>
    <a href="#removeModal" role="button" class="btn btn-danger btn-large pull-right" data-toggle="modal">Remove Entry</a>
</div>-->
<!--<div class="modal hide fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

