<?php

function alert($message, $type)
{
    

    $out = "<script type=\"text/javascript\">
            $(\".alert\").alert();
            </script>";    

    
    if ($type == '1')
    {
        $out .= "<div class=\"span2 offset4 alert fade in\">"; 
    }
    elseif($type == '0')
    {
        $out .= "<div class=\"span2 offset4 alert alert-error fade in\">"; 
    }
    else
    {
        $out .= "<div class=\"span2 offset4 alert alert-error fade in\">"; 
    }
    
    
    $out .= "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
        <Strong>".$message."</Strong></div>";

    echo $out;



}
?>

