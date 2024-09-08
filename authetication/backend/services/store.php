<?php

include '../../config/database.php';
session_start();


if (isset($_POST['insert'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $icon = $_POST['icon'];


    if ($title && $description && $icon) {
        $query = "INSERT INTO services (title,description,icon) VALUES ('$title', '$description', '$icon')";
        mysqli_query($db, $query);
        $_SESSION['service_insert'] = 'Services insert successfully complete';
        header("location: services.php");
    }
}


if (isset($_GET['statusid'])) {
    $id = $_GET['statusid'];

    $get_query = "SELECT * FROM services WHERE id ='$id'";
    $connect = mysqli_query($db, $get_query);
    $service = mysqli_fetch_assoc($connect);


    if ($service['status'] == 'deactive') {
        $update_query = "UPDATE services SET status ='active' WHERE id ='$id'";
        mysqli_query($db, $update_query);
        $_SESSION['service_status'] = 'Services status updated successfully';
        header("location: services.php");
    } else {
        $update_query = "UPDATE services SET status ='deactive' WHERE id ='$id'";
        mysqli_query($db, $update_query);
        $_SESSION['service_status'] = 'Services status updated successfully';
        header("location: services.php");
    }
}


if (isset($_POST['updateBtn'])) {
    if (isset($_GET['update'])) {
        $id = $_GET['update'];

        $title = $_POST['title'];
        $description = $_POST['description'];
        $icon = $_POST['icon'];

        if ($title && $description && $icon) {
            $query = "UPDATE services SET title ='$title', description='$description', icon ='$icon' WHERE id ='$id'";
            mysqli_query($db, $query);
            $_SESSION['service_update'] = 'Services Update successfully complete';
            header("location: services.php");
        }
    }
}

if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];
    $delete_query = "DELETE FROM services WHERE id ='$id'";
    mysqli_query($db, $delete_query);
    $_SESSION['service_delete'] = 'Services Deleted successfully';
    header("location: services.php");
}
