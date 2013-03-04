<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');

$in = $_POST;

$input = clean($in);

try {
    if($input['stationNumber'] == "" || $input['address'] == "" || $input['contactName'] == "" || $input['stationNo'] == "")
    {
        alert("Blank/Invalid Entry - No Changes", 0);
    }
    else
    {
        $query = "SELECT * FROM station WHERE
                    Contact = '".$input['contactName']."'
                OR  StationNumber = '".$input['stationNumber']."'                
                OR  StationAddress = '".$input['address']."'
                OR  StationNo = '".$input['stationNo']."'
                OR  StationName = '".$input['stationName']."'
                OR  MobileNo = '".$input['mobileNo']."';";

        $results = sqlHandler::getDB()->select($query);

        //if results return and levelid is wrong return error level/desc exists
        if(count($results) > 1)
        {
            foreach($results as $row)
            {
                if($row['StationID'] != $input['stationID'])
                {
                    if($row['StationNumber'] == $input['stationNumber'])
                    {
                        alert("Station Number Already Exists", 0);
                    }
                    if($row['Contact'] == $input['contactName'])
                    {
                        alert("Contact Name Already Exists", 0);
                    }
                    if($row['StationName'] == $input['stationName'])
                    {
                        alert("Station Name Already Exists", 0);
                    }
                    if($row['StationAddress'] == $input['address'])
                    {
                        alert("Station Address Already Exists", 0);                
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
        }
        else
        {
            $query = "UPDATE station SET 
                    StationNumber = '".$input['stationNumber']."',
                    StationLevel = '".$input['stationLevel']."',
                    StationName = '".$input['stationName']."',
                    Contact = '".$input['contactName']."',
                    StationNo = '".$input['stationNo']."',
                    MobileNo = '".$input['mobileNo']."',
                    StationAddress = '".$input['address']."'    
                    WHERE StationID = '".$input['stationID']."';";

            $results = sqlHandler::getDB()->update($query);
            if($results == 0)
            {
                alert("No Changes Made. No Entries Updated", 1);
            }
            else
            {
                alert($results." Entries Updated", 1);
            }
        }

    }
}
catch (Exception $e)
{
    alert($e->getMessage());
}

?>
