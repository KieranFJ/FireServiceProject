 <?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');


$query = "SELECT Level FROM level WHERE deprecated <> 1";

$result = sqlHandler::getDB()->select($query);


foreach($result as $row)
{
    echo "<option>".$row['Level']."</option>";

}


?>