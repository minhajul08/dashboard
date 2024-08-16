<?php 
include '../authetication/config/database.php';
session_start();
if (isset($_POST['registerBtn'])) {
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    $flag = false;

    $email_regex = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    $name_regex = "/^[a-zA-Z\s]+$/";
    $pass_regex_upper ="/^(?=.*?[A-Z])/";
    $pass_regex_lower ="/^(?=.*?[a-z])/";
    $pass_regex_num ="/^(?=.*?[0-9])/";
    $pass_regex_special = "/^(?=.*?[#?!@$%^&*-])/";
    $pass_regex_length = "/^.{8,}/";
    

    if (!$name) {
        $flag = true;
        $_SESSION['name_error'] = "Name field is required!";
        header("location: register.php");
    } elseif (!preg_match($name_regex, $name)) {
        $flag = true;
        $_SESSION['name_error'] = "Name can only contain letters and spaces!";
        header("location: register.php");
    }
    else {
        $_SESSION ['old_name'] = $name;
        header ('location: register.php');
    }

    if (!$email) {
        $flag = true;
        $_SESSION['email_error'] = "Email field is required!";
        header("location: register.php");

    } elseif (!preg_match($email_regex, $email)) {
        $flag = true;
        $_SESSION['email_error'] = "Email is invalid!";
        header("location: register.php");
    }
    else {
        $_SESSION ['old_email'] = $email;
        header ("location: register.php");
    }
    
    // Add other validations and logic as needed
    

if (!$password) {
    $flag = true;
    $_SESSION['password_error'] = "Password field is required!";
    header("location: register.php");

}
elseif (!preg_match($pass_regex_upper,$password)){
    $flag = true;
    $_SESSION ['password_error'] = "At least one upper case";
    header("location:register.php");
}
elseif (!preg_match($pass_regex_lower,$password)){
    $flag = true;
    $_SESSION ['password_error'] = "At least one lower case";
    header("location:register.php");
}
elseif (!preg_match($pass_regex_num,$password)){
    $flag = true;
    $_SESSION ['password_error'] = "At least one numerical case";
    header("location:register.php");
}
elseif (!preg_match($pass_regex_special,$password)){
     $flag = true;
    $_SESSION ['password_error'] = "At least one special character";
    header("location:register.php");
}

elseif (!preg_match($pass_regex_length,$password)){
    $flag = true;
    $_SESSION ['password_error'] = "Minimum eight in length";
    header("location:register.php");
}
else {
    $_SESSION ['old_password'] = $password;
    header("location: register.php");
}


if (!$c_password) {
    $flag = true;
    $_SESSION['c_password_error'] = "Confirm password field is required!";
    header("location: register.php");
}

elseif ($password != $c_password) {
    $flag = true;
    $_SESSION['c_password_error'] = "password & confirm password field is doesn't match";
    header("location: register.php");
}
else {
    $_SESSION ['old_c_password'] = $c_password;
    header("location: register.php");
}


if ($flag == false){
    $encrypt =md5($password);
    $create_query = "INSERT INTO users (name,email,password) VALUES ('$name','$email','$encrypt')";
    mysqli_query($db,$create_query);
    $_SESSION ['register_complete'] = "Registration complete";
    $_SESSION ['register_name'] = $name;
    $_SESSION ['register_email'] = $email;
    header ("location: login.php");
}




}


// login validation start

if (isset ($_POST ['login_btn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $flag = false;


    $email_regex = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    $name_regex = "/^[a-zA-Z\s]+$/";
    $pass_regex_upper ="/^(?=.*?[A-Z])/";
    $pass_regex_lower ="/^(?=.*?[a-z])/";
    $pass_regex_num ="/^(?=.*?[0-9])/";
    $pass_regex_special = "/^(?=.*?[#?!@$%^&*-])/";
    $pass_regex_length = "/^.{8,}/";


    if (!$email) {
        $flag = true;
        $_SESSION['email_error'] = "Email field is required!";
        header("location: login.php");

    } elseif (!preg_match($email_regex, $email)) {
        $flag = true;
        $_SESSION['email_error'] = "Email is invalid!";
        header("location: login.php");
    }
    // else {
    //     $_SESSION ['old_email'] = $email;
    //     header ("location: register.php");
    // }
    
    // Add other validations and logic as needed
    

if (!$password) {
    $flag = true;
    $_SESSION['password_error'] = "Password field is required!";
    header("location: login.php");

}
elseif (!preg_match($pass_regex_upper,$password)){
    $flag = true;
    $_SESSION ['password_error'] = "At least one upper case";
    header("location:login.php");
}
elseif (!preg_match($pass_regex_lower,$password)){
    $flag = true;
    $_SESSION ['password_error'] = "At least one lower case";
    header("location:login.php");
}
elseif (!preg_match($pass_regex_num,$password)){
    $flag = true;
    $_SESSION ['password_error'] = "At least one numerical case";
    header("location:login.php");
}
elseif (!preg_match($pass_regex_special,$password)){
     $flag = true;
    $_SESSION ['password_error'] = "At least one special character";
    header("location:login.php");
}

elseif (!preg_match($pass_regex_length,$password)){
    $flag = true;
    $_SESSION ['password_error'] = "Minimum eight in length";
    header("location:login.php");
}



if (!$flag) {
  $encrypt = md5( $password);
  $query = "SELECT COUNT(*) AS 'validate' FROM users WHERE email='$email' AND password = '$encrypt'";
  $connect = mysqli_query($db, $query);
  $result = mysqli_fetch_assoc($connect);
  if ($result ['validate'] ==1){
    $query = "SELECT * FROM users WHERE email='$email'";
    $connect = mysqli_query($db, $query);
    $author = mysqli_fetch_assoc($connect);
    $_SESSION ['author_id'] = $author ['id'];
    $_SESSION ['author_name'] = $author ['name'];
    $_SESSION ['temp_name'] = $author ['name'];
    $_SESSION ['author_email'] = $author ['email'];
    header ("location: backend/home/home.php");

  }
  else {
    $_SESSION['login_unsuccess_error'] = "Credential doesn't match!";
    header("location: login.php");
  }
}



// else {
//     $_SESSION ['old_password'] = $password;
//     header("location: login.php");
// }

}


// login validation end

// else {
//     header('location:register.php');
// }



?>
