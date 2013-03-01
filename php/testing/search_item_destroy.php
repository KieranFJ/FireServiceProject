<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');

$in = $_POST;


if(isset($in))
{
    $query = "SELECT * FROM items WHERE SerialNo = '".$in['search']."';";

    $result = sqlHandler::getDB()->select($query);

    $query = "SELECT Name FROM station;";

    $stations = sqlHandler::getDB()->select($query);
    
    if(isset($result))
    {?>     
    <div class="span3">    
        <input type="hidden" name="itemID" value="<?php echo $result[0]['ItemID'] ?>">
        <label>Name of Destroyer</label>
        <input class="required" type="text" name="destroyer" placeholder="Name of Destroyer">
        <div class="row">
            <div class="span1">
                <label>Flag</label>
                <select class="input-mini" name="flag" value="<?php echo $result[0]['Flag']?>">
                    <?php 
                    if($result[0]['Flag'] == 'S')
                    {
                        echo "<option selected=\"selected\">S</option><option>Q</option><option>C</option>";
                    }
                    elseif($result[0]['Flag'] == 'Q')
                    {
                        echo "<option>S</option><option selected=\"selected\">Q</option><option>C</option>";
                    }
                    elseif($result[0]['Flag'] == 'C')
                    {
                        echo "<option>S</option><option>Q</option><option selected=\"selected\">C</option>";
                    }
                    ?>
                </select>
            </div>            
        </div>
        <label>Destruction Type</label>
        <select name="destructType">
            <option>End of Life</option><option>Damage</option><option>Loss</option><option>Other</option>
        </select>
        <label>Reason for Destruction</label>
        <textarea class="required" type="text" name="comments" rows="3" placeholder="Destruction Comment"></textarea>
    </div>
    <div class="span3">
        <label>Station of Origin</label>
        <select class="" name="station">
            <?php 
                foreach($stations as $row)
                {
                    echo "<option>".$row['Name']."</option>";
                }
            ?>
        </select>
        <label>Originator</label>
        <input class="required" type="text" name="originator" placeholder="Person who Requested Destruction">
        <label>Destruction Date</label>
        <input class="datepicker required" id="dp1" type="text" name="destructionDate" value="<?php print(Date("d-m-Y"));?>">                
    </div>
        
    <script type="text/javascript">
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight: 'true',
            todayBtn: 'linked',
            forceParse: 'true'
        });
    </script>  
        <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h3 id="myModalLabel">Are You Sure?</h3>
            </div>
            <div class="modal-body">
              <p>Destruction of this item will disallow any future updates or reversals to this item</p>
              <h4>Item Details</h4>
              item type
              item serial

            </div>
            <div class="modal-footer">
              <button class="btn btn-success" data-dismiss="modal" aria-hidden="true">Go Back</button>
              <button class="btn btn-danger">Destroy Item</button>
            </div>
        </div>
    <?php
        
    }
    else
    {
        alert('Invalid Search', 0);
    }
}
?>

