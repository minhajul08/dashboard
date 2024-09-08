<?php

include '../extends/header.php';

$service_query = "SELECT * FROM services";
$services = mysqli_query($db,$service_query);


?>

<!-- services update start -->
<?php if (isset ( $_SESSION ['service_update'])) : ?>
<div class="row">
    <div class="col-12">
        <div class="alert alert-custom" role="alert">
            <div class="custom-alert-icon icon-success"><i class="material-icons-outlined">done</i></div>
            <div class="alert-content">
                <span class="alert-title">
                    <?= $_SESSION ['service_update'] ?>
                </span>
            </div>
        </div>
    </div>
</div>
<?php endif; unset ( $_SESSION ['service_update'])?>

<!-- services update end -->
 <!-- services delete start -->
<?php if (isset ( $_SESSION ['service_delete'])) : ?>
<div class="row">
    <div class="col-12">
        <div class="alert alert-custom" role="alert">
            <div class="custom-alert-icon icon-danger"><i class="material-icons-outlined">error</i></div>
            <div class="alert-content">
                <span class="alert-title">
                    <?= $_SESSION ['service_delete'] ?>
                </span>
            </div>
        </div>
    </div>
</div>
<?php endif; unset ( $_SESSION ['service_delete'])?>

<!-- services delete end -->

<!-- services insert start -->
<?php if (isset ( $_SESSION ['service_insert'])) : ?>
<div class="row">
    <div class="col-12">
        <div class="alert alert-custom" role="alert">
            <div class="custom-alert-icon icon-success"><i class="material-icons-outlined">done</i></div>
            <div class="alert-content">
                <span class="alert-title">
                    <?= $_SESSION ['service_insert'] ?>
                </span>
            </div>
        </div>
    </div>
</div>
<?php endif; unset ( $_SESSION ['service_insert'])?>

<!-- services insert end -->


<!-- services insert start -->
<?php if (isset ( $_SESSION ['service_status'])) : ?>
<div class="row">
    <div class="col-12">
        <div class="alert alert-custom" role="alert">
            <div class="custom-alert-icon icon-success"><i class="material-icons-outlined">done</i></div>
            <div class="alert-content">
                <span class="alert-title">
                    <?= $_SESSION ['service_status'] ?>
                </span>
            </div>
        </div>
    </div>
</div>
<?php endif; unset ( $_SESSION ['service_status'])?>

<!-- services insert end -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-end">
                <h4> Services List </h4>
                <a href="create.php" class="btn btn-primary"><i class="material-icons">add</i>Create</a>
            </div>
            <div class="card-body">
                <div class="example-content">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Icon</th>
                                <th scope="col">Title</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $num =1;
                            foreach ($services as $service) :?>
                            <tr>
                                <th scope="row">
                                    <?= $num++ ?>
                                </th>
                                <td>
                                    <i class="fa-2x <?= $service ['icon'] ?>"></i>
                                </td>
                                <td>
                                    <?= $service ['title'] ?>
                                </td>
                                <td>
                                    <a href="store.php?statusid= <?= $service ['id'] ?>" class=" <?=$service ['status'] == 'deactive' ? 'badge bg-danger' : 'badge bg-success'  ?> text-white" ><?= $service ['status'] ?></a>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around align-items-center">
                                        <a title="edit" class="text-primary fa-2x" href="edit.php?editid= <?= $service ['id'] ?>">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a class="text-danger fa-2x" href="store.php?deleteid= <?= $service ['id'] ?>">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<?php

include '../extends/footer.php'


?>