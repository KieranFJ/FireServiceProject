<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

$_POST = array_map('trim', $_POST);
$_POST = array_map('stripslashes', $_POST);

if(empty($_POST))
{
    echo "Blank/Invalid Entry - No Changes";
}
else
{
    $query = "SELECT * FROM items WHERE
                SerialNo = '".$_POST['serialNumber']."'
            OR  ItemID = '".$_POST['itemID']."';";
    
    $results = sqlHandler::getDB()->select($query);
   
    //if results return and levelid is wrong return error level/desc exists
    if(count($results) > 1)
    {
        foreach($results as $row)
        {
            if($row['ItemID'] != $_POST['itemID'])
            {
                if($row['SerialNo'] == $_POST['serialNumber'])
                {
                    echo "Serial Number Already Exists!</br>";                
                }
                if($row['Model'] == $_POST['model'])
                {
                    echo "Item ID Already Exists!";
                }
            }
            
        }
    }
    else
    {
        $date = new DateTime($_POST['purchDate']);
        $_POST['purchDate'] = $date->format("y/m/d");

        $date = new DateTime($_POST['manuDate']);
        $_POST['manuDate'] = $date->format("y/m/d");

        $date = new DateTime($_POST['endLifeDate']);
        $_POST['endLifeDate'] = $date->format("y/m/d");

        $date = new DateTime($_POST['firstUseDate']);
        $_POST['firstUseDate'] = $date->format("y/m/d");

        $date = new DateTime($_POST['nextTestDate']);
        $_POST['nextTestDate'] = $date->format("y/m/d");
        
        $query = "UPDATE items SET
                    PurchDate = '".$_POST['purchDate']."',
                    ManuDate = '".$_POST['manuDate']."',
                    EndLifeDate = '".$_POST['endLifeDate']."',
                    SerialNo = '".$_POST['serialNumber']."',
                    FirstUseDate = '".$_POST['firstUseDate']."',
                    NextTestDate = '".$_POST['nextTestDate']."',
                    CCN = '".$_POST['ccn']."',
                    Comments = '".$_POST['comments']."'                                        
                WHERE SerialNo = '".$_POST['serialNumber']."'
                AND ItemID = '".$_POST['itemID']."';";

        $results = sqlHandler::getDB()->update($query);
        echo $results." Entries Updated";
    }
    
}
?>
