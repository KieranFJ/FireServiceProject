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
    <div class="span4">    
        <input type="hidden" name="itemID" value="<?php echo $result[0]['ItemID'] ?>">
        <label>Name of Tester</label>
        <input class="required" type="text" name="tester" placeholder="Name of Tester">
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
            <div class="span1">
                <label>Points</label>
                <select class="input-mini" name="points" value="<?php echo $result[0]['Points']?>">
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
        <select class="" name="testType">
            <option>Checkup</option><option>Wear and Tear</option><option>Damages</option><option>Other</option>
        </select>
        <label>Testing Comment</label>
        <textarea class="required" type="text" name="comments" rows="3" placeholder="Testing Comment"></textarea>
    </div>
    <div class="span4">
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
        <input class="required" type="text" name="originator" placeholder="Person who requested Test">
        <label>Next Test Date</label>
        <input class="datepicker required" id="dp1" type="text" name="nextTestDate" placeholder="Date of Next Test">                
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
        alert('Invalid Search', 0);
    }
}
?>

