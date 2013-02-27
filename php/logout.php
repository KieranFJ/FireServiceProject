<?php

session_start();

unset($_SESSION['username']);

session_destroy();

$location = 'Location: '.$_SERVER['DOCUMENT_ROOT'].'/fire/FireServiceProject/index.php';

header("Location: ../index.php");
exit();
?>
