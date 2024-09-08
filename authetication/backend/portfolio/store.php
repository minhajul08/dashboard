<?php

include '../../config/database.php';
session_start();
if (isset($_POST['insert'])) {
    $id = $_SESSION['author_id'];
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
    $explode = explode('.', $image);
    $extension = end($explode);
    $tmp_name = $_FILES['image']['tmp_name'];



    if ($title && $subtitle && $description && $image) {
        $newname = $id . '-' . $title . '-' . date('d-m-y') . '-' . rand(0, 9999) . '.' . $extension;
        $localPath = '../../../public/uploads/portfolio/' . $newname;

        if (move_uploaded_file($tmp_name, $localPath)) {
            $insert_query = "INSERT INTO portfolios (title,subtitle,description,image) VALUES ('$title', '$subtitle','$description','$newname')";

            mysqli_query($db, $insert_query);
            $_SESSION['post_success'] = 'New portfolio insert successfully';
            header('location: portfolios.php');
        }
    }
}

if (isset($_GET['deleteid'])) {

    $id = $_GET['deleteid'];

    $select_port = "SELECT * FROM portfolios WHERE id='$id'";
    $connectdb = mysqli_query($db, $select_port);
    $port = mysqli_fetch_assoc($connectdb);

    if ($port['image']) {
        $old_img = $port['image'];
        $old_path = "../../../public/uploads/portfolio/" . $old_img;
        if (file_exists($old_path)) {
            unlink($old_path);
        }
        $query = "DELETE FROM portfolios WHERE id='$id'";

        mysqli_query($db, $query);
        $_SESSION['post_success'] = 'portfolio delete successfully';
        header('location: portfolios.php');
    }
}

if (isset($_POST['update'])) {
    if (isset($_GET['updateid'])) {
        $id = $_GET['updateid'];
        $title = $_POST['title'];
        $subtitle = $_POST['subtitle'];
        $description = $_POST['description'];
        $image = $_FILES['image']['name'];


        if ($image) {
            $image_tmp = $_FILES['image']['tmp_name'];
            $explode = explode('.', $image);
            $extension = end($explode);
            $new_name = $id . '_' . $title . '_' . date('Y') . rand(0, 9999) . '.' . $extension;
            $local_path = "../../../public/uploads/portfolio/" . $new_name;
            $old_img_query = "SELECT * FROM portfolios WHERE id='$id'";
            $connect =  mysqli_query($db, $old_img_query);
            $portfolio = mysqli_fetch_assoc($connect);

            if ($portfolio['image']) {
                $oldpath = "../../../public/uploads/portfolio/" . $portfolio['image'];
                if (file_exists($oldpath)) {
                    unlink($oldpath);
                }
            }
            if (move_uploaded_file($image_tmp, $local_path)) {
                $update_query = "UPDATE portfolios SET title='$title', subtitle='$subtitle', description='$description', image='$new_name' WHERE id='$id'";
                mysqli_query($db, $update_query);
                $_SESSION['post_success'] = 'portfolio Update successfully';
                header('location: portfolios.php');
            }
        } else {
            $update_query = "UPDATE portfolios SET title='$title', subtitle='$subtitle', description='$description' WHERE id='$id'";
            mysqli_query($db, $update_query);
            $_SESSION['post_success'] = 'portfolio Update successfully';
            header('location: portfolios.php');
        }
    }
}


if (isset($_GET['statusid'])) {
    $id = $_GET ['statusid'];
    $statusquery = "SELECT * FROM portfolios WHERE id='$id'";
    $connect =  mysqli_query($db, $statusquery);
    $portfolio = mysqli_fetch_assoc($connect);

    if ($portfolio['status']  == 'deactive') {
        $update_query = "UPDATE portfolios SET status='active' WHERE id='$id'";
        mysqli_query($db, $update_query);
        $_SESSION['post_success'] = 'Portfolio Status Change successfully';
        header('location: portfolios.php');
    }else {
        $update_query = "UPDATE portfolios SET status='deactive' WHERE id='$id'";
        mysqli_query($db, $update_query);
        $_SESSION['post_success'] = 'Portfolio Status Change successfully';
        header('location: portfolios.php');
    }
}
