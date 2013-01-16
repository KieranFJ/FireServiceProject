<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

$_POST = array_map('trim', $_POST);
$_POST = array_map('stripslashes', $_POST);

$query = "SELECT * FROM station WHERE 
                Address = '".$_POST['address']."';";

$results = sqlHandler::getDB()->select($query);

if($_POST['address'] == "" || $_POST['contactName'] == "" || $_POST['contactNo'] == "")
{
    echo "Blank/Invalid Entry Not Accepted";
}
elseif($results)
{
    foreach($results as $row)
    if($row['Address'] == $_POST['address'])
    {
        echo "Address already Exists</br>";
    }
    if($row['Contact'] == $_POST['contactName'])
    {
        echo "Contact Already Exists</br>";
    }    
    if($row['ContactNo'] == $_POST['contactNo'])
    {
        echo "Contact Number Already Exists";
    }
}
else 
{                                        
    $query = "INSERT INTO station (Contact, ContactNo, Address)
    VALUES ('".$_POST['contactName']."','".$_POST['contactNo']."','".$_POST['address']."');";
        
    $results = sqlHandler::getDB()->insert($query);
    
    echo "Entry Created";    
}
?>