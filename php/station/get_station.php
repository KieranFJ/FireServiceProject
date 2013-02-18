<?php 

/*
 * @TODO get_station.php - proper validation
 * @TODO get_station.php - proper comments
 */

require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

$input = $_POST;

$query = 'SELECT * FROM station
            WHERE Name = "'.$input['contactSelect'].'";';

$result = sqlHandler::getDB()->select($query);


?>

<label>Station Name</label>
<input type="text" class="required" minlength="1" name="stationName" value="<?php echo $result[0]['Name']; ?>"></input>
<label>Contact Name</label>
<input type="text" class="required" minlength="1" name="contactName" value="<?php echo $result[0]['Contact']; ?>"></input>
<label>Station Contact Number</label>
<input type="text" class="required" minlength="1" name="stationNo" value="<?php echo $result[0]['StationNo']; ?>"></input>
<label>Mobile Contact Number</label>
<input type="text" class="required" minlength="1" name="mobileNo" value="<?php echo $result[0]['MobileNo']; ?>"></input>
<label>Address</label>
<textarea rows="4" name="address" class="required"><?php echo $result[0]['Address']; ?></textarea><label></label>
<input type="hidden" name="stationID" value="<?php echo $result[0]['StationID']; ?>">

</div>

