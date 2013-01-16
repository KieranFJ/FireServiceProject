<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

if (isset($_POST['query']))
{
    $query = "SELECT SerialNo AS result 
        FROM items 
        WHERE SerialNo 
        LIKE '%".$_POST['query']."%'
        UNION
        SELECT ItemID AS result
        FROM items
        WHERE ItemID
        LIKE '%".$_POST['query']."%'";
    
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