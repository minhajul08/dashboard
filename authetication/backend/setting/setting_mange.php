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


if (isset($_POST['pass_update_button'])) {
    $old_pass= $_POST['old_pass'];
    $new_pass= $_POST['new_pass'];
    $confirm_pass= $_POST['confirm_pass'];


    if ($old_pass && $new_pass && $confirm_pass) {
    $encrypt = md5($old_pass);
    $id =  $_SESSION ['author_id'];
    $match_query = "SELECT COUNT(*) AS 'match' FROM users WHERE id = '$id' AND password = '$encrypt'";
    $connect = mysqli_query ($db, $match_query); 

    $match = mysqli_fetch_assoc($connect) ['match'];
    if ($match) {
       if ($new_pass == $confirm_pass) {
       $new_encrypt = md5($new_pass);
       $query = "UPDATE users SET password ='$new_encrypt' WHERE id ='$id'" ;
       mysqli_query ($db, $query);  
       $_SESSION ['pass_update'] = 'password update successfully';
       header('location: setting.php');
       }
    }
    else {
        $_SESSION ['pass_error'] = "password doesn't match";
        header('location: setting.php');
    }
    
}
    else {
        $_SESSION ['pass_error'] = 'Password error';
        header('location: setting.php');
    }
}


?>