<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');

$in = $_POST;

$input = clean($in);
if (isset($input['query']))
{
    $query = "SELECT SerialNo AS result 
        FROM items 
        WHERE SerialNo 
        LIKE '%".$input['query']."%'
        UNION
        SELECT ItemID AS result
        FROM items
        WHERE ItemID
        LIKE '%".$input['query']."%'";
    
    $results = sqlHandler::getDB()->select($query);
    
    $array[] = array();
    $i = 0;
    foreach($results as $row)
    {
        $array[$i] = $row['result'];
        $i++;
    }
    echo json_encode($array);
}

?>