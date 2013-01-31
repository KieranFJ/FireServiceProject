<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');

$in = $_POST;

$input = clean($in);

$query = "SELECT * FROM station WHERE 
                Address = '".$input['address']."';";

$results = sqlHandler::getDB()->select($query);

try {
    if($input['address'] == "" || $input['contactName'] == "" || $input['contactNo'] == "")
    {
        alert("Blank/Invalid Entry Not Accepted", 0);
    }
    elseif($results)
    {
        foreach($results as $row)
        {        
            if($row['Contact'] == $input['contactName'])
            {
                alert("Contact Already Exists", 0);
            }    
            if($row['Address'] == $input['address'])
            {
                alert("Address already Exists", 0);
            }
            if($row['StationNo'] == $input['stationNo'])
            {
                alert("Station Contact Number Already Exists", 0);
            }  
            if($row['MobileNo'] == $input['mobileNo'])
            {
                alert("Mobile Contact Number Already Exists", 0);
            }   
        }
    }
    else 
    {                                        
        $query = "INSERT INTO station (Contact, StationNo, Address, MobileNo)
        VALUES ('".$input['contactName']."','".$input['stationNo']."','".$input['address']."', '".$input['mobileNo']."');";

        $results = sqlHandler::getDB()->insert($query);


        alert("Entry Created", 1);        
    }
}
catch(Exception $e)
{
    alert($e, 2);
}
?>