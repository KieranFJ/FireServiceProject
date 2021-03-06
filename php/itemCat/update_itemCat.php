<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');

$in = $_POST;

$input = clean($in);


if(empty($input))
{
    alert("Blank/Invalid Entry - No Changes", 0);
}
else
{
    try
    {    
        $query = "SELECT * FROM itemcategories WHERE
                    CatName = '".$input['name']."'
                OR  Model = '".$input['model']."';";

        $results = sqlHandler::getDB()->select($query);

        //if results return and levelid is wrong return error level/desc exists
        
        if(count($results) > 1)
        {
            foreach($results as $row)
            {
                if($row['ItemTypeID'] != $input['itemTypeID'])
                {
                    if($row['CatName'] == $input['name'])
                    {
                        alert("Duplicate Category Name exists. No changes made", 0);                
                    }
                    if($row['Model'] == $input['model'])
                    {
                        alert("Duplicate Item Model exists. No changes made", 0);
                    }                    
                }                
            }                
            // more than one entry with name/model error
        }
        elseif(count($results == 1))
        {            
            
            $diff = array_diff($results[0], $input);
            // array_diff always returns an array, count array to determine
            // if there are any actual differences
            
            if(count($diff) == 0)
            {
                alert("No changes made", 1);
            }
            else
            {
                $query = "UPDATE itemcategories SET 
                        CatName = '".$input['name']."',                    
                        CatDescription = '".$input['description']."',
                        Model = '".$input['model']."',
                        Manufacturer = '".$input['manufacturer']."',
                        ContactNo = '".$input['contactNo']."',
                        CatAddress = '".$input['address']."'                    
                    WHERE ItemTypeID = '".$input['itemTypeID']."';";

                $results = sqlHandler::getDB()->update($query);
                alert($results." Entries Updated", 1);
            }
        }
    }
    catch(Exception $e)
    {
        alert($e, 2);
    }    
}      
?>
