<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

$_POST = array_map('trim', $_POST);
$_POST = array_map('stripslashes', $_POST);

$query = "SELECT * FROM itemcategories WHERE 
                Name = '".$_POST['name']."'
            OR  Model = '".$_POST['model']."'";

$results = sqlHandler::getDB()->select($query);

if(empty($_POST))
{
    echo "Blank/Invalid Entry Not Accepted";
}
elseif($results)
{
    foreach($results as $row)
    if($row['Name'] == $_POST['name'])
    {
        echo "Name already Exists</br>";
    }
    if($row['Model'] == $_POST['model'])
    {
        echo "Model Already Exists";
    }    
}
else 
{                                        
    $query = "INSERT INTO itemcategories (Name, Description, Model, Manufacturer, ContactNo, Address)
                VALUES ('".$_POST['name']."',
                        '".$_POST['description']."',
                        '".$_POST['model']."',
                        '".$_POST['manufacturer']."',
                        '".$_POST['contactNo']."',
                        '".$_POST['address']."');";
        
    $results = sqlHandler::getDB()->insert($query);
    
    echo "Entry Created";    
}
?>

