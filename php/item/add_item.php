<?php

 require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
 require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');

 $in = $_POST;
 
 $inputs = clean($in);
 
 $query = "SELECT * FROM items WHERE
            SerialNo = '".$inputs['serialNumber']."';";
 
 $results = sqlHandler::getDB()->select($query);
 
 if(empty($inputs))
 {
     alert("Blank/Invalid Entry Not Accepted", 2);
 }
 else
 {
    try
    {
        if($results)
        {
            foreach($results as $row)
            {
               if($row['SerialNo'] == $inputs['serialNumber'])
               {
                   alert("Serial Number already exists", 0);
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

            alert("Entry Created", 1);
        }
    }
    catch(Exception $e)
    {
        alert($e, 2);
    }
 }
  
?>
