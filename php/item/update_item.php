<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');

$in = $_POST;

$input = clean($in);

if(empty($input))
{
    alert("Blank/Invalid Entry - No Changes", 0);
}
else
{
    $query = "SELECT * FROM items WHERE
                SerialNo = '".$input['serialNumber']."'
            OR  ItemID = '".$input['itemID']."';";
    
    $results = sqlHandler::getDB()->select($query);
   
    //if more theres a duplicate serial number, error message duplicate
    if(count($results) > 1)
    {
        foreach($results as $row)
        {
            if($row['ItemID'] != $input['itemID'])
            {
                if($row['SerialNo'] == $input['serialNumber'])
                {
                    alert("Duplicate Serial Number already exists. No changes made", 0);                
                }
            }
            
        }
    }
    elseif(count($results == 1)) //if only one result then check if any changes are actually made
    {
        unset($results[0]['Retired']);
        unset($results[0]['ItemTypeID']);
        unset($input['itemCat']);
        
        //@TODO Better way to do this? Research!
        
        $date = new DateTime($input['purchDate']);
        $input['purchDate'] = $date->format("y/m/d");

        $date = new DateTime($input['manuDate']);
        $input['manuDate'] = $date->format("y/m/d");

        $date = new DateTime($input['endLifeDate']);
        $input['endLifeDate'] = $date->format("y/m/d");

        $date = new DateTime($input['firstUseDate']);
        $input['firstUseDate'] = $date->format("y/m/d");

        $date = new DateTime($input['nextTestDate']);
        $input['nextTestDate'] = $date->format("y/m/d");
        
        $date = new DateTime($results[0]['PurchDate']);
        $results[0]['PurchDate'] = $results[0]['PurchDate'] = $date->format("y/m/d");
        
        $date = new DateTime($results[0]['ManuDate']);
        $results[0]['ManuDate'] = $results[0]['ManuDate'] = $date->format("y/m/d");
        
        $date = new DateTime($results[0]['EndLifeDate']);
        $results[0]['EndLifeDate'] = $results[0]['EndLifeDate'] = $date->format("y/m/d");
        
        $date = new DateTime($results[0]['FirstUseDate']);
        $results[0]['FirstUseDate'] = $results[0]['FirstUseDate'] = $date->format("y/m/d");
        
        $date = new DateTime($results[0]['NextTestDate']);
        $results[0]['NextTestDate'] = $results[0]['NextTestDate'] = $date->format("y/m/d");
        
        
        $a = array_keys($results[0]);
        $a = array_map('strtolower', $a);
        $b = array_values($results[0]);
        
        $res = array_combine($a, $b);        
        
        $c = array_keys($input);
        $c = array_map('strtolower', $c);
        $d = array_values($input);
        
        $inp = array_combine($c, $d);
        
        $diff = array_diff($res, $inp);
        
        if(count($diff) == 0)
        {
            alert("No changes made", 1);
        }
        else
        {            

            $query = "UPDATE items SET
                        PurchDate = '".$input['purchDate']."',
                        ManuDate = '".$input['manuDate']."',
                        EndLifeDate = '".$input['endLifeDate']."',
                        SerialNo = '".$input['serialNumber']."',
                        FirstUseDate = '".$input['firstUseDate']."',
                        NextTestDate = '".$input['nextTestDate']."',
                        CCN = '".$input['ccn']."',
                        Comments = '".$input['comments']."',
                        Flag = '".$input['flag']."',
                        Points = '".$input['points']."'
                    WHERE
                     ItemID = '".$input['itemID']."';";
            sqlHandler::getDB()->update($query);
            
            $query = "SELECT bag.StationID, items.BagID, items.IssueDate FROM items                
                JOIN bag ON bag.BagID = items.BagID
                WHERE items.ItemID = '".$input['itemID']."';";
            
            $results = sqlHandler::getDB()->select($query);
            
            $query = "INSERT INTO itemhistory (ItemID, StationID, BagID, ItemFlag, TestID, Points, IssueBagDate, HistoryType)
                VALUES ('".$input['itemID']."', '".$results[0]['StationID']."', 
                    '".$results[0]['StationID']."', '".$input['flag']."', 0, '".$input['points']."', '".$results[0]['IssueDate']."', 'Item Updated');";
            
            sqlHandler::getDB()->insert($query);
            
            alert("Entry updated", 1);
        }  
    }
}
?>
