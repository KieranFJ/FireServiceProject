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
        $message = "Unknown Error (func alert line 36)";
    } 
    $out .= "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
        <Strong>".$message."</Strong></div>";

    echo $out;
}

function mysql_escape_mimic($inp) { 
    if(is_array($inp)) 
        return array_map(__METHOD__, $inp); 

    if(!empty($inp) && is_string($inp)) { 
        return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp); 
    } 

    return $inp; 
} 

function clean($arr)
{ 
//    require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
//
//    mysql_real_escape_string($arr);
   
//    $trimmedArr = array_map('trim', $arr); 
//    $output = mysql_escape_mimic($trimmedArr);
//    
    //$output = filter_var_array($trimmedArr, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
//    $input = array_map(function ($arr)
//                        {
//                            return trim(
//                                filter_var_array($arr, FILTER_SANITIZE_STRING,  
//                                        FILTER_FLAG_STRIP_LOW) 
//                            );
//                        }, $arr);
    $arr = array_map('trim', $arr);
    $output = array_map('stripslashes', $arr);
    return $output;
}
?>

