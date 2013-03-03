<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');

$in = $_POST;

$input = clean($in);

if($input)
{    

    $query = "SELECT * FROM items WHERE ItemID = '".$input['itemID']."';";

    $result = sqlHandler::getDB()->select($query);

    if(empty($result))
    {
        alert('That Serial Number does not exist.', 0);
    }
    else
    {
        try
        {
            if(count($result) > 1)
            {
                alert('Duplicate Serial Numbers exist!', 0);            
            }
            else
            {   
                $query = "INSERT INTO test (ItemID, Tester, Comment, TestType, StationID, Originator)
                        VALUES ('".$input['itemID']."', '".$input['tester']."', '".$input['comments']."',
                                '".$input['testType']."', (SELECT StationID FROM station WHERE StationName = '".$input['station']."'),
                                '".$input['originator']."');";

                $sqlRes = sqlHandler::getDB()->insert($query);

                $query = "SELECT items.Flag, items.Points, bag.BagID, bag.BagNumber, level.Level 
                            FROM items
                            JOIN bag 
                            ON bag.BagID = items.BagID
                            JOIN level 
                            ON level.LevelID = bag.LevelID                        
                            WHERE items.ItemID = '".$input['itemID']."';";

                $itemRes = sqlHandler::getDB()->select($query);            

                $query = "INSERT INTO itemhistory (ItemID, StationID, BagID, ItemFlag, TestID, Points, IssueBagDate, HistoryType)
                            VALUES ('".$input['itemID']."',
                                    (SELECT StationID FROM station WHERE StationName = '".$input['station']."'),
                                    (SELECT BagID FROM items WHERE ItemID = '".$input['itemID']."'),
                                    '".$input['flag']."',
                                    '".$sqlRes."',
                                    '".$input['points']."',
                                    NOW(),
                                    'Item Test');";
                
                sqlHandler::getDB()->insert($query);                
                
                $date = new DateTime($input['nextTestDate']);
                $input['nextTestDate'] = $date->format("y/m/d");
                
                $query = "UPDATE items SET NextTestDate = '".$input['nextTestDate']."'
                            WHERE ItemID = '".$input['itemID']."';";
                
                sqlHandler::getDB()->update($query);
                
                alert('Test Entry created', 1);
                
                //@TODO history update when an item is removed from bag when flag is changed (Entry reason - flag change)
                if($itemRes[0]['Flag'] != $input['flag'] || $itemRes[0]['Points'] != $input['points'] )
                {
                    if( $input['flag'] == 'S')
                    {
                        $query = "UPDATE items SET 
                                Flag = '".$input['flag']."', 
                                Points = '".$input['points']."'
                                WHERE ItemID = '".$input['itemID']."';";
                        
                        sqlHandler::getDB()->update($query);     
                        
                        alert('Flag \''.$itemRes[0]['Flag'].'\' to \''.$input['flag'].'\'</br>
                            Points \''.$itemRes[0]['Points'].'\' to \''.$input['points'].'\'</br>
                            Item servicable, not removed from Bag.</br> Bag Level: '
                            .$itemRes[0]['Level'].' </br>Bag Number: '
                            .$itemRes[0]['BagNumber'], 1);
                        
                        
                    }
                    else
                    {
                         $query = "UPDATE items SET 
                                BagID = '0' , 
                                Flag = '".$input['flag']."', 
                                Points = '".$input['points']."'
                                WHERE ItemID = '".$input['itemID']."';";
                         
                         sqlHandler::getDB()->update($query);
                         
                         //bag change
                         $query = "INSERT INTO itemhistory (ItemID, StationID, BagID, ItemFlag, TestID, Points, IssueBagDate, HistoryType)
                                    VALUES ('".$input['itemID']."',
                                    (SELECT StationID FROM station WHERE StationName = '".$input['station']."'),
                                    (SELECT BagID FROM items WHERE ItemID = '".$input['itemID']."'),
                                    '".$input['flag']."',
                                    '".$sqlRes."',
                                    '".$input['points']."',
                                    NOW(),
                                    'Test Bag Change');";
                         sqlHandler::getDB()->insert($query);
                         
                         
                         
                         alert('Flag \''.$itemRes[0]['Flag'].'\' to \''.$input['flag'].'\'</br>
                             Points \''.$itemRes[0]['Points'].'\' to \''.$input['points'].'\'</br>
                            Item removed from Bag.</br> Bag Level: '
                            .$itemRes[0]['Level'].' </br>Bag Number: '
                            .$itemRes[0]['BagNumber'], 1); 
                    }              
                    // flag change
                    $query = "INSERT INTO itemhistory (ItemID, StationID, BagID, ItemFlag, TestID, Points, IssueBagDate, HistoryType)
                               VALUES ('".$input['itemID']."',
                               (SELECT StationID FROM station WHERE StationName = '".$input['station']."'),
                               (SELECT BagID FROM items WHERE ItemID = '".$input['itemID']."'),
                               '".$input['flag']."',
                               '".$sqlRes."',
                               '".$input['points']."',
                               NOW(),
                               'Flag Change');";
                    
                    sqlHandler::getDB()->insert($query);  
                }            
            }   
        }
        catch(Exception $e)
        {
            alert($e, 0);
        }
    }
}
?>
