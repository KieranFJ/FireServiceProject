<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');

$in = $_POST;

$input = clean($in);

if($input['level'] == "" || $input['description'] == "" || $input['noItems'] == "")
{
    alert("Blank/Invalid Entry - No Changes", 0);
}
else
{
    $query = "SELECT * FROM level WHERE
                Level = '".$input['level']."'
            OR  Description = '".$input['description']."';";
    
    $results = sqlHandler::getDB()->select($query);
   
    //if results return and levelid is wrong return error level/desc exists
    if(count($results) > 1)
    {
        foreach($results as $row)
        {
            if($row['LevelID'] != $input['levelID'])
            {
                if($row['Level'] == $input['level'])
                {
                    alert("Level Already Exists!", 0);                
                }
                if($row['Description'] == $input['description'])
                {
                    alert("Description Already Exists. Bag Level: ".$row['Level'], 0);
                }                
            }
            
        }
    }
    else
    {
        $query = "UPDATE level SET 
                Description = '".$input['description']."',
                Level = '".$input['level']."',
                NoItems= '".$input['noItems']."'
                WHERE LevelID = '".$input['levelID']."';";

        $results = sqlHandler::getDB()->update($query);
        alert($results." Entries Updated", 1);
    }
    
}

?>
