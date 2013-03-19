<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');

if(@!$in)
{    
    if(isset($_POST))
    {
        
        $in = $_POST;
    }
    elseif(isser($_GET))
    {
        
        $in = $_GET;
    }
    
    //(isset($_POST) == true? $in = $_POST: $in = $_GET); 
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
    
    $query = "SELECT test.*, station.StationName
                FROM test 
                JOIN station
                ON station.StationID = test.StationID
                WHERE ItemID = '".$results[0]['ItemID']."'";
    //@TODO testrest needs sorting by entrydate
    $testRes = sqlHandler::getDB()->select($query);
    
    $query = "SELECT itemhistory.*, station.StationName, bag.BagNumber, level.Level 
                FROM itemhistory 
                JOIN station
                ON station.StationID = itemhistory.StationID
                JOIN bag
                ON bag.BagID = itemhistory.BagID
                JOIN level
                ON bag.LevelID = level.LevelID
                WHERE ItemID = '".$results[0]['ItemID']."'";
    
    $histRes = sqlHandler::getDB()->select($query);
    
    if($histRes)
    {
        usort($histRes, 'hist_compare');
    }
    
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
    <div class="span10">
        <div class="row">
            <div class="span2">
                <h4>Test History</h4>
            </div>
            <div class="span2">
                <a class="btn btn-success" href="#item_report.php?ItemID=<?php echo $results[0]['ItemID']?>">Print Test History</a>
            </div>
        </div>
        <table class="table table-condensed">
            <tr>
                <td><b>#</b></td>
                <td><b>Test Type</b></td>
                <td><b>Station</b></td>
                <td><b>Tester</b></td>
                <td><b>Originator</b></td>
                <td><b>Comment</b></td>
                <td><b>Test Date</b></td>
            </tr>
        <?php 
        if($testRes)
        {
            $i = 1;
            foreach($testRes as $row)
            {?>
            <tr><td><?php echo $i++; ?></td>
                <td><?php echo $row['TestType']; ?></td>
                <td><?php echo $row['StationName']; ?></td>
                <td><?php echo $row['Tester']; ?></td>
                <td><?php echo $row['Originator']; ?></td>
                <td><?php echo $row['Comment']; ?></td>
                <td><?php echo $row['TestDate']; ?></td>
            </tr>
            <?php           
            }
        }
        else
        {
            echo "<h4>There are test entries for this Item</h4>";
        }
        ?>
        </table>
    </div>
</div>
<div class="row">
    <div class="span10">
        <div class="row">
            <div class="span2">
                <h4>Item History</h4>
            </div>
            <div class="span2">
                <a class="btn btn-success" href="#item_report.php?ItemID=<?php echo $results[0]['ItemID']?>">Print Item History</a>
            </div>
        </div>
        <table class="table table-condensed">
            <tr>
                <td><b>#</b></td>
                <td><b>Type</b></td>
                <td><b>Station</b></td>
                <td><b>Bag No.</b></td>
                <td><b>Flag</b></td>
                <td><b>Points</b></td>
                <td><b>Entry Date</b></td>
            </tr>
        <?php 
        if($histRes)
        {
            $i = 1;
            foreach($histRes as $row)
            {?>
            <tr><td><?php echo $i++; ?></td>
                <td><?php echo $row['HistoryType']; ?></td>
                <td><?php echo $row['StationName']; ?></td>
                <td><?php echo $row['BagNumber']; ?></td>
                <td><?php echo $row['ItemFlag']; ?></td>
                <td><?php echo $row['Points']; ?></td>
                <td><?php echo $row['HistEntryDate']; ?></td>
            </tr>
        <?php
            }
        }
        else
        {
            echo "<h4>There are no history entries for this Item</h4>";
        }
        ?>
        </table>
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