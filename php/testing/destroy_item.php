<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');

$in = $_POST;

$input = clean($in);

if(!isset($input))
{
    alert("Blank or Invalid Entry!", 0);
}
else
{   
    $query = "SELECT Flag FROM items WHERE ItemID = '".$input['itemID']."';";
    
    $flag = sqlHandler::getDB()->select($query);
    
    if($flag[0]['Flag'] == "D" || $flag == "L")
    {
        alert("Item already flagged as Destroyed or Lost", 0);
    }
    else
    {
        $input['Flag'] = ($input['destructType'] == "Loss" ? "L" : "D");

        $query = "UPDATE items SET
                    Flag = '".$input['Flag']."', 
                    Points = '15', 
                    DestructionDate = NOW()
                    WHERE ItemID = '".$input['itemID']."';";

        sqlHandler::getDB()->update($query);

        $query = "INSERT INTO test 
                    (ItemID, Tester, Comment, TestType, StationID, Originator) 
                    VALUES ('".$input['itemID']."',
                            '".$input['destroyer']."',
                            '".$input['comments']."',
                            '".$input['destructType']."',
                            (SELECT StationID from Station WHERE StationName = '".$input['station']."'),    
                            '".$input['originator']."'
                            );";

        $testID = sqlHandler::getDB()->insert($query);

        $query = "SELECT BagID, Points, IssueDate FROM items WHERE ItemID = '".$input['itemID']."';";

        $result = sqlHandler::getDB()->select($query);

        $query = "INSERT INTO itemhistory 
                    (ItemID, StationID, BagID, ItemFlag, TestID, Points, IssueBagDate, HistoryType) 
                    VALUES('".$input['itemID']."',
                           (SELECT StationID from Station WHERE StationName = '".$input['station']."'),
                            '".$result[0]['BagID']."',
                            '".$input['Flag']."',
                            '".$testID."',
                            '".$result[0]['Points']."',
                            '".$result[0]['IssueDate']."',
                            '".($input['destructType'] == "Loss" ? "Item Lost" : "Item Destroyed")."'
                            )";

         $ret = sqlHandler::getDB()->insert($query);

         alert("Item marked as ".($input['destructType'] == "Loss" ? "Lost" : "Destroyed"), 1);
    }
}


//check information is there

//insert flag as d or l, points as 15 into items
//insert destruction 'test' info into test
//select item details for item history and insert
//return alert that item is destroyed


?>
<script type="text/javascript">
$('#myModal').modal('hide');
</script>

