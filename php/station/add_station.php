<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');

$input = array_map('trim', $_POST);
$input = array_map('stripslashes', $input);

$query = "SELECT * FROM station WHERE 
                Address = '".$input['address']."';";

$results = sqlHandler::getDB()->select($query);

if($input['address'] == "" || $input['contactName'] == "" || $input['contactNo'] == "")
{
    echo "Blank/Invalid Entry Not Accepted";
}
elseif($results)
{
    foreach($results as $row)
    if($row['Address'] == $input['address'])
    {
        alert("Address already Exists", 0);
    }
    if($row['Contact'] == $input['contactName'])
    {
        alert("Contact Already Exists", 0);
    }    
    if($row['ContactNo'] == $input['contactNo'])
    {
        alert("Contact Number Already Exists", 0);
    }
}
else 
{                                        
    $query = "INSERT INTO station (Contact, ContactNo, Address)
    VALUES ('".$input['contactName']."','".$input['contactNo']."','".$input['address']."');";
        
    $results = sqlHandler::getDB()->insert($query);
    
    
    alert("Entry Created", 1);
    //echo "Entry Created";    
}
?>