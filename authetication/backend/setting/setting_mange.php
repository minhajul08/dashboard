<?php 
include '../../config/database.php' ;
session_start();

// name update start
 
 
if (isset($_POST['name_update_button'])) {
    $update_name_regex = "/^[a-zA-Z\s]+$/";
    $name = $_POST['name'];

    if (!preg_match($update_name_regex, $name)) {
        $_SESSION['name_error'] = "Name can only contain letters and spaces!";
        header('location: setting.php');
    } elseif (empty($name)) {
        $_SESSION['name_error'] = "Name cannot be empty!";
        header('location: setting.php');
    } else {
        $id = $_SESSION['author_id'];
        $query = "UPDATE users SET name ='$name' WHERE id ='$id'";
        mysqli_query($db, $query);
        $_SESSION['author_name'] = $name;
        $_SESSION['name_update'] = 'Name updated successfully';
        header('location: setting.php');
    }
}


// name update end

// email update start

if (isset($_POST['email_update_button'])) {
    $email = $_POST['email'];
    $email_regex = "/^[\w\-\.]+@[a-zA-Z\d\-]+(\.[a-zA-Z\d\-]+)*\.[a-zA-Z]{2,7}$/";

    if (!preg_match($email_regex, $email)) {
        $_SESSION['email_error'] = "Invalid email format!";
        header('location: setting.php');
    } elseif (empty($email)) {
        $_SESSION['email_error'] = "Email cannot be empty!";
        header('location: setting.php');
    } else {
        $id = $_SESSION['author_id'];

        // Check if the email is the same as the current email
        $query_check = "SELECT email FROM users WHERE id ='$id'";
        $result = mysqli_query($db, $query_check);
        $current_email = mysqli_fetch_assoc($result)['email'];

        if ($current_email == $email) {
            $_SESSION['email_error'] = "The new email is the same as the current email.";
            header('location: setting.php');
        } else {
            $query_update = "UPDATE users SET email ='$email' WHERE id ='$id'";
            mysqli_query($db, $query_update);
            $_SESSION['author_email'] = $email;
            $_SESSION['email_update'] = 'Email updated successfully';
            header('location: setting.php');
        }
    }
}



// email update end

// pass update start

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



// pass update end

// image update start

if (isset ($_POST ['image_update_button'])) {

    $image = $_FILES['image']['name'];
    $tmp_path = $_FILES['image']['tmp_name'];
   
   if ($image){
    $id =  $_SESSION ['author_id'];
    $name =  $_SESSION ['author_name'];
    $explode = explode('.', $image);
    $extension = end($explode);
    $new_name = $id . "-" . $name."-".date("d-m-y"). '.' . $extension;
    $local_path = "../../../public/uploads/profile/".$new_name;

    if (move_uploaded_file($tmp_path, $local_path)) {
        $query = "UPDATE users SET image ='$new_name' WHERE id ='$id'";
        mysqli_query($db, $query);
        header('location: setting.php');
    } else {
        echo "vlo na";
    }
   }
}

?>