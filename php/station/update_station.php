<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');



$_POST = array_map('trim', $_POST);
$_POST = array_map('stripslashes', $_POST);


if($_POST['address'] == "" || $_POST['contactName'] == "" || $_POST['contactNo'] == "")
{
    echo "Blank/Invalid Entry - No Changes";
}
else
{
    $query = "SELECT * FROM station WHERE
                Contact = '".$_POST['contactName']."'
            OR  Address = '".$_POST['address']."'
            OR  ContactNo = '".$_POST['contactNo']."';";
    
    $results = sqlHandler::getDB()->select($query);
   
    //if results return and levelid is wrong return error level/desc exists
    if(count($results) > 1)
    {
        foreach($results as $row)
        {
            if($row['astationID'] != $_POST['stationID'])
            {
                if($row['Address'] == $_POST['address'])
                {
                    echo "Address Already Exists!</br>";                
                }
                if($row['Contact'] == $_POST['contactName'])
                {
                    echo "Contact Name Already Exists.";
                }
                if($row['ContactNo'] == $_POST['contactNo'])
                {
                    echo "Contact Number Already Exists";
                }
            }
            
        }
    }
    else
    {
        $query = "UPDATE station SET 
                Contact = '".$_POST['contactName']."',
                ContactNo = '".$_POST['contactNo']."',
                Address = '".$_POST['address']."'    
                WHERE StationID = '".$_POST['stationID']."';";

        $results = sqlHandler::getDB()->update($query);
        echo $results." Entries Updated";
    }
    
}

?>
