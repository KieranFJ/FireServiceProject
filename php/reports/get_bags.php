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
    <!-- @TODO create the printable version of the bag contents report -->
<div class="span4 offset5">
    <form class="validate" action="php/print/print_bag_contents_report.php" method="get">
        <input id="bagid" type="hidden" name="BagID" value="">
        <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h3 id="myModalLabel">Are You Sure?</h3>
            </div>
            <div class="modal-body">
                <label>Vehicle Fleet</label>
                <input class="required" type="text" name="vehicleFleet" placeholder="Vehicle Fleet">
                <label>Competent Person</label>
                <input class="required" type="text" name="competentPerson" placeholder="Competent Person">   
                <label>Brigade Number</label>
                <input class="required" type="text" name="brigadeNo" placeholder="Brigade Number">
            </div>
            <div class="modal-footer">
              <button class="btn btn-success" data-dismiss="modal" aria-hidden="true">Go Back</button>
              <!-- @TODO validation does not work using <input type=submit> <button> in this sense does not work in IE7 (modal issue) no work around atm 
              http://rommelsantor.com/clog/2012/03/12/fixing-the-ie7-submit-value/
              -->
              <input type="submit" class="btn btn-primary" value="Next">
            </div>
        </div>
        <a id="ticksheet" class="btn btn-success btn-large" role="button" href="/php/reports/tick_sheet.php?BagID=<?php ?>">Print Ticksheet <i class="icon-print icon-white"></i></a>
        <a class="btn btn-success btn-large" role="button" data-toggle="modal" href="#myModal">Print Report <i class="icon-print icon-white"></i></a>
        <div class="message"></div>
    </form>    
</div>
<script type="text/javascript">
    $("form").validate();
$('.getContents').trigger('change');    
</script>
</div>