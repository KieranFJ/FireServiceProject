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
        LIKE '%".$input['query']."%' LIMIT 10";
    
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