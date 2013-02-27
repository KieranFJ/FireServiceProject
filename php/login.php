<?php

/*
 * Quick and dirty login system. Does not prevent any serious intrusion attempts
 * and is only used for potential accidental unauthorised access by persons
 * not trained or unsure of what they are doing.
 */
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');

session_start();

$in = $_POST;

$input = clean($in);

$username = 'fire';
$password = 'pass';

if(isset($input['username'], $input['password']))
{
    if($input['username'] != $username)
    {
        alert('Invalid Login', 0);        
    }
    elseif($input['password'] != $password)
    {
        alert('Invalid Login', 0);
    }
    else
    {
        $_SESSION['username'] = $username;
        //header("Location: ".$_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/front.php' );
        echo "<script>window.location.reload();</script>";
        //exit();
    }
}
else
{
    alert('Invalid Login', 0);
}

?>
