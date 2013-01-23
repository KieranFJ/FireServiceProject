<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');

$in = $_POST;

$input = clean($in);

try {
    if($input['address'] == "" || $input['contactName'] == "" || $input['contactNo'] == "")
    {
        alert("Blank/Invalid Entry - No Changes", 0);
    }
    else
    {
        $query = "SELECT * FROM station WHERE
                    Contact = '".$input['contactName']."'
                OR  Address = '".$input['address']."'
                OR  ContactNo = '".$input['contactNo']."';";

        $results = sqlHandler::getDB()->select($query);

        //if results return and levelid is wrong return error level/desc exists
        if(count($results) > 1)
        {
            foreach($results as $row)
            {
                if($row['StationID'] != $input['stationID'])
                {
                    if($row['Contact'] == $input['contactName'])
                    {
                        alert("Contact Name Already Exists", 0);
                    }
                    if($row['Address'] == $input['address'])
                    {
                        alert("Address Already Exists", 0);                
                    }                
                    if($row['ContactNo'] == $input['contactNo'])
                    {
                        alert("Contact Number Already Exists", 0);
                    }
                }

            }
        }
        else
        {
            $query = "UPDATE station SET 
                    Contact = '".$input['contactName']."',
                    ContactNo = '".$input['contactNo']."',
                    Address = '".$input['address']."'    
                    WHERE StationID = '".$input['stationID']."';";

            $results = sqlHandler::getDB()->update($query);
            if($results == 0)
            {
                alert("No Changes Made.</br> No Entries Updated", 1);
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
