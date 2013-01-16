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
    $query = "SELECT * FROM itemcategories WHERE
                Name = '".$_POST['name']."'
            OR  Model = '".$_POST['model']."';";
    
    $results = sqlHandler::getDB()->select($query);
   
    //if results return and levelid is wrong return error level/desc exists
    if(count($results) >= 1)
    {
        foreach($results as $row)
        {
            if($row['ItemTypeID'] != $_POST['itemTypeID'])
            {
                if($row['Name'] == $_POST['name'])
                {
                    echo "Name Already Exists!</br>";                
                }
                if($row['Model'] == $_POST['model'])
                {
                    echo "Model Already Exists!";
                }
            }
            
        }
    }
    else
    {
        $query = "UPDATE itemcategories SET 
                    Name = '".$_POST['name']."',                    
                    Description = '".$_POST['description']."',
                    Model = '".$_POST['model']."',
                    Manufacturer = '".$_POST['manufacturer']."',
                    ContactNo = '".$_POST['contactNo']."',
                    Address = '".$_POST['address']."'                    
                WHERE ItemTypeID = '".$_POST['itemTypeID']."';";

        $results = sqlHandler::getDB()->update($query);
        echo $results." Entries Updated";
    }
    
}
?>
