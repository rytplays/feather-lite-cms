<?php 
session_start();
session_destroy();
setcookie("password","",time()-(86400*30),"/");
header("Location:index.php");
?>