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




function safe($var, $type = 'string')
{
    switch ($type)
    { 
    case 'string':
            return "'".mysql_escape_string($var)."'";
            break;

    case 'int':
            return (int)$var;
            break;

    case 'float':
            return (float)$var;
            break; 

    default:
            return "'".mysql_escape_string($var)."'";
            break;
    } 
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
    $array=$ret;
}

?>

