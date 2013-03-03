<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');

$in = $_POST;

$input = clean($in);

if(isset($input))
{
    $query = 'SELECT *, 
                DATE_FORMAT(ManuDate, \'%d-%m-%Y\') AS ManuDate, 
                DATE_FORMAT(PurchDate, \'%d-%m-%Y\') AS PurchDate, 
                DATE_FORMAT(EndLifeDate, \'%d-%m-%Y\') AS EndLifeDate,
                DATE_FORMAT(NextTestDate, \'%d-%m-%Y\') AS NextTestDate,
                DATE_FORMAT(FirstUseDate, \'%d-%m-%Y\') AS FirstUseDate
                FROM items
                WHERE SerialNo = "'.$input['search'].'";';

    $results = sqlHandler::getDB()->select($query);
    if(isset($results))
    {
        $query = 'SELECT CatName FROM itemcategories
                    WHERE ItemTypeID = '.$results[0]['ItemTypeID'].";";

        $itemCatResults = sqlHandler::getDB()->select($query);
        
        $disabled = "";
        if($results[0]['Flag'] == 'D' || $results[0]['Flag'] == 'L')
        {
            $disabled = 'disabled';
        }
        ?>
        <div class="span3">
            <input type="hidden" name="itemID" value="<?php echo $results[0]['ItemID']; ?>">
            <label>Item Type</label>
            <input class="required" type="text" name="itemCat" value="<?php echo $itemCatResults[0]['CatName']; ?>" <?php echo $disabled ?>>
            <label>Serial Number</label>
            <input class="required" type="text" name="serialNumber" value="<?php echo $results[0]['SerialNo']; ?>" <?php echo $disabled ?>>
            <div class="row">
                <div class="span1">
                    <label>Flag</label>
                    <select class="input-mini" name="flag" value="<?php echo $results[0]['Flag']?>" disabled> 
                        <option select="selected"><?php echo $results[0]['Flag']?></option>
                    </select>
                </div>
                <div class="span1">
                    <label>Points</label>
                    <select class="input-mini" name="points" value="<?php echo $results[0]['Points']?>" disabled>
                        <option select="selected"><?php echo $results[0]['Points']?></option>                        
                    </select>
                </div>
            </div>
            <label>Conformity Certificate Number</label>
            <input class="required" type="text" name="ccn" value="<?php echo $results[0]['CCN']?>" <?php echo $disabled ?>>
            <label>Comments</label>
            <textarea class="" rows="3" type="text" name="comments" <?php echo $disabled ?>><?php echo $results[0]['Comments']; ?></textarea>           
        </div>
        <div class="span3">
            <label>First Use Date</label>
            <input class="datepicker required" id="dp4" type="text" name="firstUseDate" value="<?php echo $results[0]['FirstUseDate']; ?>" <?php echo $disabled ?>>   
            <label>Purchase Date</label>
            <input class="datepicker required" id="dp1" type="text" name="purchDate" value="<?php echo $results[0]['PurchDate']; ?>" <?php echo $disabled ?>>
            <label>Manufacture Date</label>
            <input class="datepicker required" id="dp2" type="text" name="manuDate" value="<?php echo $results[0]['ManuDate']; ?>" <?php echo $disabled ?>>
            <label>End of Life Date</label>
            <input class="datepicker required" id="dp3" type="text" name="endLifeDate" value="<?php echo $results[0]['EndLifeDate']; ?>" <?php echo $disabled ?>>
            <label>Next Test Date</label>
            <input class="datepicker required" id="dp5" type="text" name="nextTestDate" value="<?php echo $results[0]['NextTestDate']; ?>" <?php echo $disabled ?>>
        </div>        
        <script type="text/javascript">
            $('#dis').each(function () {
                $(this).prop('disabled', <?php echo ($disabled == "" ? "false" : "true") ?>);
            })
            $('.datepicker').datepicker({
                format: 'dd-mm-yyyy',
                todayHighlight: 'true',
                todayBtn: 'linked',
                forceParse: 'true'
            });
        </script>                    
    <?php    
    
    }
    else
    {
        alert("Invalid Search", 0);
    }
}
?>