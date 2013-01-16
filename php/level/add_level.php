<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

$_POST = array_map('trim', $_POST);
$_POST = array_map('stripslashes', $_POST);

$query = "SELECT * FROM level WHERE 
                Level = '".$_POST['level']."'
            OR  Description = '".$_POST['description']."'";

$results = sqlHandler::getDB()->select($query);

if($_POST['level'] == "" || $_POST['description'] == "" || $_POST['noItems'] == "")
{
    echo "Blank/Invalid Entry Not Accepted";
}
elseif($results)
{
    foreach($results as $row)
    if($row['Description'] == $_POST['description'])
    {
        echo "Description already Exists</br>";
    }
    if($row['Level'] == $_POST['level'])
    {
        echo "Level Already Exists";
    }    
}
else 
{                                        
    $query = "INSERT INTO level (Level, Description, NoItems)
    VALUES ('".$_POST['level']."','".$_POST['description']."', '".$_POST['noItems']."');";
        
    $results = sqlHandler::getDB()->insert($query);
    
    echo "Entry Created";    
}
?>
