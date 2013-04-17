<?php
@session_start();

if (isset($_SESSION['username']))
{
     header("Location: front.php");
}

@include_once 'templates/header_temp.php';
@include_once 'templates/navigation_temp.php'; 
@include_once 'assets/help.php';

require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.sqlHandler.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/php/class.functionLib.php');

?>
<div class="container">
    <h2>Inventory System Login</h2>
<!--    <h3>Temp Username: fire Password: pass</h3>-->
    <form class="form-horizontal" action="php/login.php" method="post" id="form1">
        <div class="control-group">
            <label class="control-label" for="Username">Username</label>
            <div class="controls">
                <input class="required" type="text" name="username" placeholder="Username">
            </div>
        </div> 
        <div class="control-group">
            <label class="control-label" for="Password">Password</label>
            <div class="controls">
                <input class="required" type="password" name="password" placeholder="Password">
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
            <button type="submit" class="btn btn-primary">Sign In</button>
            </div>
        </div>  
        <div class="message"></div>
    </form>
</div>
    
<?php

@include_once 'templates/footer_temp.php';    

?>

   
