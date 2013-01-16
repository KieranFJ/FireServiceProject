<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');



$_POST = array_map('trim', $_POST);
$_POST = array_map('stripslashes', $_POST);


if($_POST['level'] == "" || $_POST['description'] == "" || $_POST['noItems'] == "")
{
    echo "Blank/Invalid Entry - No Changes";
}
else
{
    $query = "SELECT * FROM level WHERE
                Level = '".$_POST['level']."'
            OR  Description = '".$_POST['description']."';";
    
    $results = sqlHandler::getDB()->select($query);
   
    //if results return and levelid is wrong return error level/desc exists
    if(count($results) > 1)
    {
        foreach($results as $row)
        {
            if($row['LevelID'] != $_POST['levelID'])
            {
                if($row['Level'] == $_POST['level'])
                {
                    echo "Level Already Exists!</br>";                
                }
                if($row['Description'] == $_POST['description'])
                {
                    echo "Description Alread Exists. Bag Level: ".$row['Level'];
                }                
            }
            
        }
    }
    else
    {
        $query = "UPDATE level SET 
                Description = '".$_POST['description']."',
                Level = '".$_POST['level']."',
                NoItems= '".$_POST['noItems']."'
                WHERE LevelID = '".$_POST['levelID']."';";

        $results = sqlHandler::getDB()->update($query);
        echo $results." Entries Updated";
    }
    
}

?>
