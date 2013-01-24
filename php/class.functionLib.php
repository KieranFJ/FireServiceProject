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

//function map_date_format($input)
//{
//    $date = new DateTime($input['purchDate']);
//    $output = $date->format("y/m/d");
//    
//    return $input;
//}
//?>

