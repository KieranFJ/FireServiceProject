<?php 

require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

$query = "SELECT BagNumber FROM bag 
            LEFT OUTER JOIN level
            ON bag.LevelID = level.LevelID
            WHERE level.Level = '".$_POST['bagLevel']."';";

$results = sqlHandler::getDB()->select($query);
$missing = array(0 => 0);

if(isset($results))
{
    $low = min($results);
    $high = max($results);

    $outArray = array();

    for($i=0; $i < count($results); $i++)
    {
        $outArray[$i] = $results[$i]['BagNumber'];
    }

    $missing = array_values(
            array_diff(
                    range($low['BagNumber'], $high['BagNumber']), $outArray));
}
else
{
    $missing[0] = $missing[0] + 1; 
}

$query = "SELECT SerialNo FROM items
            LEFT JOIN bagcontents
            ON items.ItemID = bagcontents.ItemID
            LEFT OUTER JOIN itemcategories
            ON items.ItemTypeID = itemcategories.ItemTypeID
            WHERE bagcontents.BagID = '0'
            AND itemcategories.ItemTypeID = '2';";

$results = sqlhandler::getDB()->select($query);


?>

<label>Bag Number</label>
<input type="text" name="bagNumber" value="<?php echo $missing[0]; ?>">
<div class="row">
    <form action="php/bagCreate/add_bag.php" method="post">
        <div class="span3">        
                <label>Items in Bag</label>
                <select id="select2" class="input-large" multiple="multiple" size="20">
                </select>        
        </div>
        <div class="span2">            
                <button id="add" class="btn btn-inverse btn-large"><i class="icon-arrow-left icon-white"></i></button>
                <button id="remove" class="btn btn-inverse btn-large"><i class="icon-arrow-right icon-white"></i></button>          
        </div>
        <div class="span3">  <div style="margin-top: 50px;"></div>
                <label >Items in Store</label>            
                <select id="select1" class="input-large" multiple="multiple" size="20" >
                    <?php
                        foreach($results as $row)
                        {?>
                    <option>//<?php echo $row['SerialNo'];?></option>
                        <?php
                        }
                    ?>
                </select> 
        </div>
</div>
<div class="form-actions">
    <button class="btn btn-primary btn-large">Create Bag</button>
</div>
</form>

<script type="text/javascript">
    $().ready(function() {  

     $('#add').click(function() {  
         //console.log("add");
      return !$('#select1 option:selected').remove().appendTo('#select2');  
     });  
     $('#remove').click(function() {  
         //console.log("remove");
      return !$('#select2 option:selected').remove().appendTo('#select1');  
     });  
    });
</script>
    

