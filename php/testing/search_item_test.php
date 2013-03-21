<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');

$in = $_POST;


if(isset($in))
{
    $query = "SELECT * FROM items WHERE SerialNo = '".$in['search']."';";

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
        <label>Name of Tester</label>
        <input class="required" type="text" name="tester" placeholder="Name of Tester" <?php echo $disabled?>>
        <div class="row">
            <div class="span1">
                <label>Flag</label>
                <select class="input-mini" name="flag" value="<?php echo $result[0]['Flag']?>" <?php echo $disabled?>>
                    <?php 
                    if($result[0]['Flag'] == 'S')
                    {
                        echo "<option selected=\"selected\">S</option><option>M</option><option>Q</option><option>C</option>";
                    }
                    if($result[0]['Flag'] == 'M')
                    {
                        echo "<option>S</option><option selected=\"selected\">M</option><option>Q</option><option>C</option>";
                    }
                    elseif($result[0]['Flag'] == 'Q')
                    {
                        echo "<option>S</option><option>M</option><option selected=\"selected\">Q</option><option>C</option>";
                    }
                    elseif($result[0]['Flag'] == 'C')
                    {
                        echo "<option>S</option><option>M</option><option>Q</option><option selected=\"selected\">C</option>";
                    }
                    elseif($result[0]['Flag'] == 'D')
                    {
                        echo "<option selected=\"selected\">D</option>";
                    }
                    elseif($result[0]['Flag'] == 'L')
                    {
                        echo "<option selected=\"selected\">L</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="span1">
                <label>Points</label>
                <select class="input-mini" name="points" value="<?php echo $result[0]['Points']?>" <?php echo $disabled?>>
                    <?php
                    if($result[0]['Points'] == '0')
                    {
                        echo "<option selected=\"selected\">0</option><option>5</option><option>10</option><option>15</option>";
                    }
                    elseif($result[0]['Points'] == '5')
                    {
                        echo "<option>0</option><option selected=\"selected\">5</option><option>10</option><option>15</option>";
                    }
                    elseif($result[0]['Points'] == '10')
                    {
                        echo "<option>0</option><option>5</option><option selected=\"selected\">10</option><option>15</option>";
                    }
                    elseif($result[0]['Points'] == '15')
                    {
                        echo "<option>0</option><option>5</option><option>10</option><option selected=\"selected\">15</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <label>Test Type</label>
        <select class="" name="testType" <?php echo $disabled?>>
            <option>Checkup</option><option>Wear and Tear</option><option>Damages</option><option>Other</option>
        </select>
        <label>Testing Comment</label>
        <textarea class="required" type="text" name="comments" rows="3" placeholder="Testing Comment" <?php echo $disabled?>></textarea>
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
        <input class="required" type="text" name="originator" placeholder="Person who requested Test" <?php echo $disabled?>>
        <label>Next Test Date</label>
        <input class="datepicker required" id="dp1" type="text" name="nextTestDate" placeholder="Date of Next Test" <?php echo $disabled?>>                
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
        alert('Invalid Search', 0);
    }
}
?>

