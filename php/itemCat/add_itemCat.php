<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');

$in = $_POST;
$input = clean($in);

$query = "SELECT * FROM itemcategories WHERE 
                CatName = '".$input['name']."'
            OR  Model = '".$input['model']."'";

$results = sqlHandler::getDB()->select($query);


if(empty($input))
{
    alert("Blank/Invalid Entry Not Accepted", 0);
}
else
{
    try 
    {


        if($results)
        {
            foreach($results as $row)
            if($row['CatName'] == $input['name'])
            {
                alert("Duplicate Category Name exists. No changes made", 0);
            }
            if($row['Model'] == $input['model'])
            {
                alert("Duplicate Item Model exists. No changes made", 0);
            }    
        }
        else 
        {                                        
            $query = "INSERT INTO itemcategories (CatName, CatDescription, Model, Manufacturer, ContactNo, CatAddress)
                        VALUES ('".$input['name']."',
                                '".$input['description']."',
                                '".$input['model']."',
                                '".$input['manufacturer']."',
                                '".$input['contactNo']."',
                                '".$input['address']."');";

            $results = sqlHandler::getDB()->insert($query);

            alert("Entry Created", 1);    
        }        
    }
    catch(Exception $e)
    {
        alert($e, 2);
    }    
}
?>

