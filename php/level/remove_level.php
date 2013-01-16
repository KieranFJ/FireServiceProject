<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');

$query = "UPDATE level SET
                Deprecated = 1 
            WHERE
                LevelID = '".$_GET['levelID']."';";

$results = sqlHandler::getDB()->update($query);

echo $results." Entries Removed";

?>
