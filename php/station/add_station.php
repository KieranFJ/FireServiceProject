<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');

$in = $_POST;

$input = clean($in);

$query = "SELECT * FROM station WHERE
                    Contact = '".$input['contactName']."'
                OR  StationNumber = '".$input['stationNumber']."'                
                OR  Address = '".$input['address']."'
                OR  StationNo = '".$input['stationNo']."'
                OR  StationName = '".$input['stationName']."'
                OR  MobileNo = '".$input['mobileNo']."';";

$results = sqlHandler::getDB()->select($query);

try {
    if($input['stationName'] == "" || $input['address'] == "" || 
            $input['contactName'] == "" || $input['mobileNo'] == "" ||
            $input['stationNo'] == "")
    {
        alert("Blank/Invalid Entry Not Accepted", 0);
    }
    elseif($results)
    {
        foreach($results as $row)
        {     
            if($row['StationNumber'] == $input['stationNumber'])
            {
                alert("Station Number Already Exists", 0);
            }    
            if($row['StationName'] == $input['stationName'])
            {
                alert("Station Name Already Exists", 0);
            }    
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
        $query = "INSERT INTO station (StationName, Contact, StationNo, Address, MobileNo, StationNumber, StationLevel)
        VALUES ('".$input['stationName']."','".$input['contactName']."',
                '".$input['stationNo']."','".$input['address']."', 
                '".$input['mobileNo']."','".$input['stationNumber']."','".$input['stationLevel']."');";

        $results = sqlHandler::getDB()->insert($query);


        alert("Entry Created", 1);        
    }
}
catch(Exception $e)
{
    alert($e, 2);
}
?>