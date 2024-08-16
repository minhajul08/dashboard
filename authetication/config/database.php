<?php 

$db = mysqli_connect("localhost","root","","carfiue",);

if (!$db){
   
    header("location:'/authetication/config/error/404.php");

}

?>