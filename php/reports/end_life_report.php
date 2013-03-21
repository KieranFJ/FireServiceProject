<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');



    $query = "SELECT SerialNo, EndLifeDate FROM items
            WHERE EndLifeDate BETWEEN (DATE_SUB(CURDATE(), INTERVAL 2 MONTH))
            AND (DATE_ADD(CURDATE(), INTERVAL 1 MONTH))
            AND Flag NOT IN ('D', 'L');";
    
    sqlHandler::getDB()->select($query);
    
    usort($endLifeRes, 'date_compare');
?>
