<?php 

/*
 * @TODO get_station.php - proper validation
 * @TODO get_station.php - proper comments
 */

require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

$input = $_POST;

$query = 'SELECT * FROM station
            WHERE StationName = "'.$input['contactSelect'].'";';

$result = sqlHandler::getDB()->select($query);


?>
<div class="span3">
    <label>Station Number</label>
    <input class="required" name="stationNumber" type="text" value="<?php echo $result[0]['StationNumber']; ?>">                      
    <label>Station Name</label>
    <input type="text" class="required" minlength="1" name="stationName" value="<?php echo $result[0]['StationName']; ?>"></input>
    <label>Station Level</label>
    <input class="required" name="stationLevel" type="text" value="<?php echo $result[0]['StationLevel']; ?>">                                   
    <label>Address</label>
<textarea rows="4" name="address" class="required"><?php echo $result[0]['Address']; ?></textarea>  
</div>
<div class="span3">
    <label>Contact Name</label>
    <input type="text" class="required" minlength="1" name="contactName" value="<?php echo $result[0]['Contact']; ?>"></input>
    <label>Station Contact Number</label>
    <input type="text" class="required" minlength="1" name="stationNo" value="<?php echo $result[0]['StationNo']; ?>"></input>
    <label>Mobile Contact Number</label>
    <input type="text" class="required" minlength="1" name="mobileNo" value="<?php echo $result[0]['MobileNo']; ?>"></input>
</div>
<input type="hidden" name="stationID" value="<?php echo $result[0]['StationID']; ?>">


