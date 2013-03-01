<?php


require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');

$in = $_POST;

$input = clean($in);

$query = "SELECT * FROM level WHERE 
                Level = '".$input['level']."'
            OR  Description = '".$input['description']."'";

$results = sqlHandler::getDB()->select($query);

try
{
    if($input['level'] == "" || $input['description'] == "" || $input['noItems'] == "")
    {
        alert("Blank/Invalid Entry Not Accepted", 0);
    }
    elseif(!is_numeric($input['noItems']))
    {
        alert("Number of Items should be a number!", 0);
    }    
    elseif($results)
    {
        foreach($results as $row)
        {           
            if($row['Level'] == $input['level'])
            {
                alert("Level Already Exists", 0);
            } 
            if($row['Description'] == $input['description'])
            {
                alert("Description already Exists", 0);
            }            
        }
    }
    else 
    {                                        
        $query = "INSERT INTO level (Level, Description, NoItems)
        VALUES ('".$input['level']."','".$input['description']."', '".$input['noItems']."');";

        $results = sqlHandler::getDB()->insert($query);

        alert("Entry Created", 1);    
    }
}
catch(Exception $e)
{
    alert($e, 2);
}

?>
