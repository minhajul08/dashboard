<?php

include '../extends/header.php';


?>

<div class="row">
    <div class="col">
        <div class="page-description">
            <h1> Setting </h1>
        </div>
    </div>
</div>

<div class="row">
    <!-- name update start -->
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h4> Name Update</h4>
            </div>
             <form action="setting_mange.php" method="POST">
             <div class="card-body">
                <label for="exampleInputEmail1" class="form-label">Username</label>
                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                 <!-- name update start -->

                 <?php if (isset ($_SESSION ['name_update'])) :  ?>
                <div id="emailHelp" class="form-text text-success">
                <?= $_SESSION ['name_update'] ?>
                </div>
                 <?php endif; unset ($_SESSION ['name_update']) ; ?>

                 <!-- name update end -->
                   <!-- name error start -->

                 <?php if (isset ($_SESSION ['name_error'])) :  ?>
                <div id="emailHelp" class="form-text text-danger">
                <?= $_SESSION ['name_error'] ?>
                </div>
                 <?php endif; unset ($_SESSION ['name_error']) ; ?>
                 
                 <!-- name error end -->
                <div class="d-grid gap-2 mt-3">
                    <button class="btn btn-primary" name="name_update_button" type="submit">Name Update</button>
                </div>
            </div>
             </form>
        </div>
    </div>
  <!-- name update end -->

    <!-- email update start -->
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h4> Email Update</h4>
            </div>
             <form action="setting_mange.php" method="POST">
             <div class="card-body">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                 <!-- email update start -->

                 <?php if (isset ($_SESSION ['email_update'])) :  ?>
                <div id="emailHelp" class="form-text text-success">
                <?= $_SESSION ['email_update'] ?>
                </div>
                 <?php endif; unset ($_SESSION ['email_update']) ; ?>

                 <!-- email update end -->
                   <!-- email error start -->

                 <?php if (isset ($_SESSION ['email_error'])) :  ?>
                <div id="emailHelp" class="form-text text-danger">
                <?= $_SESSION ['email_error'] ?>
                </div>
                 <?php endif; unset ($_SESSION ['email_error']) ; ?>
                 
                 <!-- email error end -->
                
                <div class="d-grid gap-2 mt-3">
                    <button class="btn btn-primary" name="email_update_button" type="submit"> Email Update</button>
                </div>
            </div>
             </form>
        </div>
    </div>
    <!-- email update end -->

    <!-- password update start -->
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h4> Password Update</h4>
            </div>
             <form action="setting_mange.php" method="POST">
             <div class="card-body">
                <label for="exampleInputEmail1" class="form-label">Current Password</label>
                <input type="password" name="old_pass" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <label for="exampleInputEmail1" class="form-label my-2">New Password</label>
                <input type="password" name="new_pass" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <label for="exampleInputEmail1" class="form-label my-2">Confirm Password</label>
                <input type="password" name="confirm_pass" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <!-- name update start -->

                <?php if (isset ($_SESSION ['pass_update'])) :  ?>
                <div id="emailHelp" class="form-text text-success">
                <?= $_SESSION ['pass_update'] ?>
                </div>
                 <?php endif; unset ($_SESSION ['pass_update']) ; ?> 

                 <!-- pass_success end -->
                   <!-- pass_error start -->

                 <?php if (isset ($_SESSION ['pass_error'])) :  ?>
                <div id="emailHelp" class="form-text text-danger">
                <?= $_SESSION ['pass_error'] ?>
                </div>
                 <?php endif; unset ($_SESSION ['pass_error']) ; ?>
                 
                 <!-- pass_error end -->
                
                <div class="d-grid gap-2 mt-3">
                    <button class="btn btn-primary" name="pass_update_button" type="submit">Password Update</button>
                </div>
            </div>
             </form>
        </div>
    </div>
    <!-- password update end -->

     <!-- img part start -->
     <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h4> Image Update</h4>
            </div>
             <form action="setting_mange.php" method="POST" enctype="multipart/form-data">
             <div class="card-body">
                <label for="exampleInputEmail1" class="form-label">Profile Picture</label>
                <input type="file" name="image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            
                <div class="d-grid gap-2 mt-3">
                    <button class="btn btn-primary" name="image_update_button" type="submit">Image Update</button>
                </div>
            </div>
             </form>
        </div>
    </div>
  <!-- img part end -->
</div>



<?php

include '../extends/footer.php';


?>