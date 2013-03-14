<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');

$in = $_POST;


if(isset($in))
{
    $query = "SELECT items.*, itemcategories.CatName FROM items 
                JOIN itemcategories
                ON items.ItemTypeID = itemcategories.ItemTypeID
                WHERE SerialNo = '".$in['search']."';";

    $result = sqlHandler::getDB()->select($query);

    $query = "SELECT StationName FROM station;";

    $stations = sqlHandler::getDB()->select($query);
    
    
    
    if(isset($result))
    {
        if($result[0]['Flag'] == 'D' || $result[0]['Flag'] == 'L')
        {
            $disabled = 'disabled';
        }
        else
        {
            $disabled = '';
        }
        
        ?>     
    <div class="span3">    
        <input type="hidden" name="itemID" value="<?php echo $result[0]['ItemID'] ?>">
        <label>Name of Destroyer</label>
        <input class="required" type="text" name="destroyer" placeholder="Name of Destroyer" <?php echo $disabled?>>
        <div class="row">
            <div class="span1">
                <label>Flag</label>
                <select class="input-mini" name="flag" value="<?php echo $result[0]['Flag']?>" disabled>
                    <option selected="selected"><?php echo $result[0]['Flag']?></option>
                    
                    
                </select>
            </div>            
        </div>
        <label>Destruction Type</label>
        <select name="destructType" <?php echo $disabled?>>
            <option>End of Life</option><option>Damage</option><option>Loss</option><option>Other</option>
        </select>
        <label>Reason for Destruction</label>
        <textarea class="required" type="text" name="comments" rows="3" placeholder="Destruction Comment" <?php echo $disabled?>></textarea>
    </div>
    <div class="span3">
        <label>Station of Origin</label>
        <select class="" name="station" <?php echo $disabled?>>
            <?php 
                foreach($stations as $row)
                {
                    echo "<option>".$row['StationName']."</option>";
                }
            ?>
        </select>
        <label>Originator</label>
        <input class="required" type="text" name="originator" placeholder="Person who Requested Destruction" <?php echo $disabled?>>
        <label>Destruction Date</label>
        <input class="datepicker required" id="dp1" type="text" name="destructionDate" value="<?php print(Date("d-m-Y"));?>" disabled>                
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
            <dl class="dl-horizontal">
                <dt>Item Type</dt><dd><?php echo $result[0]['CatName']; ?></dd>
                <dt>Item Serial</dt><dd><?php echo $result[0]['SerialNo']; ?></dd>
                <dt>Destruction Date</dt><dd><?php print(Date("d-m-Y")); ?></dd>
            </dl>
        </div>
        <div class="modal-footer">
          <button class="btn btn-success" data-dismiss="modal" aria-hidden="true">Go Back</button>
          <input type="submit" class="btn btn-danger" value="Destroy Item" <?php echo $disabled?>>              
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

