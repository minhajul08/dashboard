<?php 
include '../../config/database.php' ;
session_start();
 
if (isset($_POST['name_update_button'])) {
    $name = $_POST['name'];
    if ($name) {
     $id =  $_SESSION ['author_id'];
     $query = "UPDATE users SET name ='$name' WHERE id ='$id'" ;
     mysqli_query ($db, $query); 
     $_SESSION ['author_name'] = $name;
     $_SESSION ['name_update'] = 'name update successfully';
     header('location: setting.php');

    }else {
        $_SESSION ['name_error'] = 'name error';
        header('location: setting.php');
    }
}


?>