<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

$query = 'SELECT * FROM itemcategories
            WHERE CatName = "'.$_POST['itemName'].'";';

$results = sqlHandler::getDB()->select($query);
?>

<div class="span3">
    <input type="hidden" name="itemTypeID" value="<?php echo $results[0]['ItemTypeID']; ?>">
    <label>Serial Number</label>
    <input class="required" type="text" name="serialNumber" placeholder="Item Serial Number">
    <div class="row">
        <div class="span1">
            <label>Flag</label>
            <select class="input-mini" name="flag">
                <option selected=\"selected\">S</option><option>Q</option><option>C</option>
                
            </select>
        </div>
        <div class="span1">
            <label>Points</label>
            <select class="input-mini" name="points">
                <option selected=\"selected\">0</option><option>5</option><option>10</option><option>15</option>                
            </select>
        </div>
    </div>
    <label>Conformity Certificate Number</label>
    <input class="required" type="text" name="ccn" placeholder="Conformity Certificate Number">
    <label>Comments</label>
    <textarea class="" rows="3" type="text" name="comments" placeholder="Comments"></textarea>
</div>
<div class="span3">
    <label>First Use Date</label>
    <input class="datepicker required" id="dp1" type="text" name="firstUseDate" placeholder="Date of First Use">
    <label>Purchase Date</label>
    <input class="datepicker required" id="dp2" type="text" name="purchDate" placeholder="Date of Item Purchase">
    <label>Manufacture Date</label>
    <input class="datepicker required" id="dp3" type="text" name="manuDate" placeholder="Date of Item Manufacture">
    <label>End of Life Date</label>
    <input class="datepicker required" id="dp4" type="text" name="endLifeDate" placeholder="Date of Item End Life">
    <label>Next Test Date</label>
    <input class="datepicker required" id="dp5" type="text" name="nextTestDate" placeholder="Date of Next Test">
</div>



<script type="text/javascript">
$('.datepicker').datepicker({
    format: 'dd-mm-yyyy',
    todayHighlight: 'true',
    todayBtn: 'linked',
    forceParse: 'true'
});
</script>