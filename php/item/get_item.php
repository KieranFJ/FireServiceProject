<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');


$_POST = array_map('trim', $_POST);
$_POST = array_map('stripslashes', $_POST);

if(isset($_POST))
{
    $query = 'SELECT *, 
                DATE_FORMAT(ManuDate, \'%d-%m-%Y\') AS ManuDate, 
                DATE_FORMAT(PurchDate, \'%d-%m-%Y\') AS PurchDate, 
                DATE_FORMAT(EndLifeDate, \'%d-%m-%Y\') AS EndLifeDate,
                DATE_FORMAT(NextTestDate, \'%d-%m-%Y\') AS NextTestDate,
                DATE_FORMAT(FirstUseDate, \'%d-%m-%Y\') AS FirstUseDate
                FROM items
                WHERE SerialNo = "'.$_POST['search'].'"
                OR
                ItemID = "'.$_POST['search'].'"
                AND   retired <> 1;';

    $results = sqlHandler::getDB()->select($query);
    if(isset($results))
    {
        $query = 'SELECT Name FROM itemcategories
                    WHERE ItemTypeID = '.$results[0]['ItemTypeID'].";";

        $itemCatResults = sqlHandler::getDB()->select($query);
        ?>
        <div class="span4">
            <input type="hidden" name="itemID" value="<?php echo $results[0]['ItemID']; ?>">
            <label>Item Type</label>
            <input class="required" type="text" name="itemCat" value="<?php echo $itemCatResults[0]['Name']; ?>">
            <label>Serial Number</label>
            <input class="required" type="text" name="serialNumber" value="<?php echo $results[0]['SerialNo']; ?>">
            <label>Conformity Certificate Number</label>
            <input class="required" type="text" name="ccn" value="<?php echo $results[0]['CCN']?>">
            <label>Comments</label>
            <textarea class="" rows="3" type="text" name="comments"><?php echo $results[0]['Comments']; ?></textarea>           
        </div>
        <div class="span4">
            <label>First Use Date</label>
            <input class="datepicker required" id="dp4" type="text" name="firstUseDate" value="<?php echo $results[0]['FirstUseDate']; ?>">   
            <label>Purchase Date</label>
            <input class="datepicker required" id="dp1" type="text" name="purchDate" value="<?php echo $results[0]['PurchDate']; ?>">
            <label>Manufacture Date</label>
            <input class="datepicker required" id="dp2" type="text" name="manuDate" value="<?php echo $results[0]['ManuDate']; ?>">
            <label>End of Life Date</label>
            <input class="datepicker required" id="dp3" type="text" name="endLifeDate" value="<?php echo $results[0]['EndLifeDate']; ?>">
            <label>Next Test Date</label>
            <input class="datepicker required" id="dp5" type="text" name="nextTestDate" value="<?php echo $results[0]['NextTestDate']; ?>">
        </div>

        <script type="text/javascript">
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
        echo "<div class=\"span4\">Invalid Search</div>";
    }
}
?>