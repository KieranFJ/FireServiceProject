<?php

/**
 * Function Library
 * 
 */

/**
 * alert Function
 * 
 * Function to deal with return messages from server to the client.
 * 
 * $messages (string)
 * $type (int) 
 * 
 */

function alert($message, $type)
{
    $out = "<script type=\"text/javascript\">
            $(\".alert\").alert();
            </script>";    

    
    if ($type == '1')
    {
        $out .= "<div class=\"span2  alert fade in\">"; 
    }
    elseif($type == '0')
    {
        $out .= "<div class=\"span2  alert alert-error fade in\">"; 
    }
    else
    {
        $out .= "<div class=\"span2  alert alert-error fade in\">"; 
        $message = "Unknown Error (Func Alert line 36)".$message;
    } 
    $out .= "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
        <Strong>".$message."</Strong></div>";
        
    $out .= "<script type=\"text/javascript\">
                $('.alert').fadeOut(3000);  
            </script>";
    echo $out;
}



function clean($arr)
{ 
    /**
     * Dunno wtf im doing here :(
     */
    //$pattern = "";
    //$replacement = "";
    
    
    $arr = array_map('trim', $arr);
    $arr = array_map('stripslashes', $arr);
    //$arr = preg_replace(,$replacement,$arr);
    return $arr;
}

function aasort (&$array, $key) {
    $sorter=array();
    $ret=array();
    reset($array);
    foreach ($array as $ii => $va) {
        $sorter[$ii]=$va[$key];
    }
    asort($sorter);
    foreach ($sorter as $ii => $va) {
        $ret[$ii]=$array[$ii];
    }
    $array = $ret;
}

//@TODO remove this code if no breaks
//function date_compare($a, $b)
//{
//    $t1 = strtotime($a['NextTestDate']);
//    $t2 = strtotime($b['NextTestDate']);
//    return $t1 - $t2;
//}   
//
//function testdate_compare($a, $b)
//{
//    $t1 = strtotime($a['TestDate']);
//    $t2 = strtotime($b['TestDate']);
//    return $t1 - $t2;
//}   
//
//function end_compare($a, $b)
//{
//    $t1 = strtotime($a['EndLifeDate']);
//    $t2 = strtotime($b['EndLifeDate']);
//    return $t1 - $t2;
//}   
//
//function hist_compare($a, $b)
//{
//    $t1 = strtotime($b['HistEntryDate']);
//    $t2 = strtotime($a['HistEntryDate']);
//    return $t1 - $t2;
//}

/* function compare
 * 
 * Date sorter function to be used with usort() $key is the array key to sort by
 * 
 * $order is the order 
 * 'newtop' newest date on top oldest bottom 
 * 'oldtop' oldest date on top newest bottom
 * 
 * @param $key - String
 * @param $order - String
 * @return array
 * 
 */
function  compare($key, $order)
{
    return function($a, $b) use ($key, $order){
        $t1 = strtotime($a[$key]);
        $t2 = strtotime($b[$key]);
        if($order == 'newtop')
        {
            return $t2 - $t1;
        }
        elseif($order == 'oldtop')
        {
            return $t1 - $t2;
        }       
    };    
}
?>

