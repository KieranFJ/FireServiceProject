<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');

if(@!$in)
{
    $in = $_POST;
}

$input = clean($in);

if(isset($input))
{
    
   $query = "SELECT *               
                FROM items
                LEFT OUTER JOIN itemcategories
                ON itemcategories.ItemTypeID = items.ItemTypeID
                LEFT OUTER JOIN bag
                ON bag.BagID = items.BagID
                LEFT OUTER JOIN station
                ON station.StationID = bag.StationID                
                LEFT OUTER JOIN level
                ON level.LevelID = bag.LevelID
                WHERE items.SerialNo = '".$input['search']."';";
    

    $results = sqlHandler::getDB()->select($query);
    
    $query = "SELECT * FROM itemhistory WHERE ItemID = '".$results[0]['ItemID']."'";
    
    $histRes = sqlHandler::getDB()->select($query);
    if($results)
    {?>
<script type="text/javascript">
    $('#typeahead').val("<?php echo $results[0]['SerialNo'] ?>");
</script>
<div class="row">
    <div class="span4">
        <h4>Item Details</h4>
        <dl class="dl-horizontal">
            <dt>Serial Number</dt><dd><?php echo $results[0]['SerialNo']?></dd>
            <dt>Item Type</dt><dd><?php echo $results[0]['CatName']?></dd>            
            <dt>CCN</dt><dd><?php echo $results[0]['CCN'] ?></dd>
            <dt>Next Test Date</dt><dd><?php echo $results[0]['NextTestDate'] ?></dd>
            <dt>Flag</dt><dd><?php echo $results[0]['Flag'] ?></dd>
            <dt>Points</dt><dd><?php echo $results[0]['Points'] ?></dd>
            <dt></br></dt><dd></br></dd>            
            <dt>Purchase Date</dt><dd><?php echo $results[0]['PurchDate'] ?></dd>
            <dt>Manufacture Date</dt><dd><?php echo $results[0]['ManuDate'] ?></dd>
            <dt>First Use Date</dt><dd><?php echo $results[0]['FirstUseDate'] ?></dd>
            <dt>End Life Date</dt><dd><?php echo $results[0]['EndLifeDate'] ?></dd>            
            <dt></br></dt><dd></br></dd>
            <dt>Comments</dt><dd><?php echo ($results[0]['Comments'] == '' ? 'N/A' : $results[0]['Comments'] ) ?></dd> 
        </dl>                   
        <a class="btn btn-success" href="item_report.php?ItemID=<?php echo $results[0]['ItemID']?>">Full Details</a>
    </div>  
    <div class="span4">
        <h4>Location Details</h4>
        <dl class="dl-horizontal">
            <dt>Bag Level</dt><dd><?php echo $results[0]['Level']?></dd>
            <dt>Bag Number</dt><dd><?php echo ($results[0]['BagNumber'] == '0'? 'Store' : $results[0]['BagNumber'] )?></dd>
            <dt></br></dt><dd></br></dd>
            <dt>Station Number</dt><dd><?php echo $results[0]['StationNumber'] ?></dd>
            <dt>Station Name</dt><dd><?php echo $results[0]['StationName'] ?></dd>
            <dt>Station Level</dt><dd><?php echo $results[0]['StationLevel'] ?></dd>
            <dt>Station</dt><dd><?php echo $results[0]['StationAddress']?></dd>
            <dt>Contact</dt><dd><?php echo $results[0]['Contact']?></dd>
            <dt>Station No.</dt><dd><?php echo $results[0]['StationNo']?></dd>
            <dt>Station Mob.</dt><dd><?php echo $results[0]['MobileNo']?></dd>        
        </dl>
    </div>
</div>
<div class="row">
<div class="span4">
        <h4>Category Details</h4>
        <dl class="dl-horizontal">
            <dt>Category Name</dt><dd><?php echo $results[0]['CatName']?></dd>
            <dt>Model</dt><dd><?php echo $results[0]['Model']?></dd>            
            <dt>Manufacturer</dt><dd><?php echo $results[0]['Manufacturer'] ?></dd>
            <dt>Contact No.</dt><dd><?php echo $results[0]['ContactNo'] ?></dd>
            <dt>Address</dt><dd><?php echo $results[0]['CatAddress'] ?></dd>
            <dt>Description</dt><dd><?php echo $results[0]['CatDescription'] ?></dd>          
        </dl>                           
    </div>  
</div>
<div class="row">
    <div class="span8">
        <?php 
        //foreach($results)
        ?>
    </div>
</div>
<div class="row">
    <div class="span8">
        
    </div>
</div>


    <?php
    }
    else
    {
        alert("Invalid Search", 0);
    }
}
?>