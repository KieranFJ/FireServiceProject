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
?>
<label>Bag Number</label>
<form action="php/bagCreate/getContents_bag.php" method="post">
<input type="hidden" name="level" value="<?php echo $_POST['bagLevel'];?>">
<select id="target3"class="getContents" name="bagNumber">

<?php 
if(isset($results))
{
    sort($results);

    $resCount = count($results);
    $i = 0;
    $c = 0;    

    do
    {
        echo "<option>".$results[$i]['BagNumber']."</option>";       

        if(isset($missing[$c]))
        {
            if($results[$i]['BagNumber'] == ($missing[$c] - 1))
            {
                echo "<option class=\"text-error\">".$missing[$c]."</option>";
                $c++;
            }  
        }            
        $i++;
    }
    while ($i < $resCount);
    echo "<option class=\"text-error\">".($results[$i - 1]['BagNumber'] + 1)."</option>";
}
else
{
    echo "<option class=\"text-error\">1</option>";
}
?>       
</select>        
</form>
<script type="text/javascript">
$('.getContents').trigger('change');    
</script>

    
