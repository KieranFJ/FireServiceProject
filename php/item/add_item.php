<?php

 require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
 
 $inputs = $_POST;
 $inputs = array_map('trim', $inputs);
 $inputs = array_map('stripslashes', $inputs);
 
 $query = "SELECT * FROM items WHERE
            SerialNo = '".$inputs['serialNumber']."';";
 
 $results = sqlHandler::getDB()->select($query);
 
 if(empty($inputs))
 {
     echo "Blank/Invalid Entry Not Accepted";
 }
 elseif($results)
 {
     foreach($results as $row)
     {
        if($row['SerialNo'] == $inputs['serialNumber'])
        {
            echo "Serial Number already Exists</br>";
        }
     }
 }
 else
 {
     
     $date = new DateTime($inputs['purchDate']);
     $inputs['purchDate'] = $date->format("y/m/d");
     
     $date = new DateTime($inputs['manuDate']);
     $inputs['manuDate'] = $date->format("y/m/d");
     
     $date = new DateTime($inputs['endLifeDate']);
     $inputs['endLifeDate'] = $date->format("y/m/d");
     
     $date = new DateTime($inputs['firstUseDate']);
     $inputs['firstUseDate'] = $date->format("y/m/d");
     
     $date = new DateTime($inputs['nextTestDate']);
     $inputs['nextTestDate'] = $date->format("y/m/d");
     
     $query = "INSERT INTO items (ItemTypeID, SerialNo, Comments, PurchDate, ManuDate, EndLifeDate, FirstUseDate, NextTestDate, CCN)
                VALUES ('".$inputs['itemTypeID']."',
                        '".$inputs['serialNumber']."',
                        '".$inputs['comments']."',
                        '".$inputs['purchDate']."',
                        '".$inputs['manuDate']."',
                        '".$inputs['endLifeDate']."',
                        '".$inputs['firstUseDate']."',
                        '".$inputs['nextTestDate']."',
                        '".$inputs['ccn']."');";
     
     sqlHandler::getDB()->insert($query);
     
     $query = "INSERT INTO bagcontents (ItemID, BagID)
                VALUES(LAST_INSERT_ID(), '0');";
     
     sqlHandler::getDB()->insert($query);
     
     echo "Entry Created";
 }
    
 

?>
