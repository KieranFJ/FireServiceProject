<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

$query = "SELECT BagNumber FROM bag 
            LEFT OUTER JOIN level
            ON bag.LevelID = level.LevelID
            WHERE level.Level = '".$_POST['bagLevel']."';";

$results = sqlHandler::getDB()->select($query);
$missing = array(0 => 0);


?>
<label class="form-label">Bag Number</label>
<div class="row">
    
<div class="span3">

<form action="php/reports/bag_contents_get.php" method="post">
<input type="hidden" name="level" value="<?php echo $_POST['bagLevel'];?>">
<select id="target" class="getContents" name="bagNumber">

<?php 
if(isset($results))
{
    sort($results);

    $resCount = count($results);
    $i = 0;    

    do
    {
        echo "<option>".$results[$i]['BagNumber']."</option>";       

            
        $i++;
    }
    while ($i < $resCount);

}

?>       
</select>        
</form>
</div>
<div class="span2 offset6">
            <a class="btn btn-success btn-large" href="php/reports/print_bag_contents.php&BagID=">Print Report <i class="icon-print icon-white"></i></a>
        </div>
<script type="text/javascript">
$('.getContents').trigger('change');    
</script>
</div>