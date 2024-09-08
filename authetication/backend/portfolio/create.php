<?php

include '../extends/header.php';

include '../../../public/fonts/fonts.php';


?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h1> Portfolio Add </h1>
            </div>
            <div class="card-body">
            <form action="store.php" method="POST" enctype="multipart/form-data">
            <label for="exampleInputEmail1" class="form-label my-2">Portfolio Title</label>
            <input name="title" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <label for="exampleInputEmail1" class="form-label my-2">Portfolio SubTitle</label>
            <input name="subtitle" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <label for="exampleInputEmail1" class="form-label my-2">Portfolio Description</label>
            <textarea name="description" type="text" class="form-control" rows="5" id="exampleInputEmail1" aria-describedby="emailHelp"> </textarea>
            <picture class="d-flex my-4">
                <img id="port_img" src="../../../public/uploads/default/default.png" alt="" style="width: 100%; height: 400px; object-fit: contain;">
            </picture>
            <label for="exampleInputEmail1" class="form-label my-2">Portfolio Image</label>
            <input onchange="document.querySelector('#port_img').src=window.URL.createObjectURL(this.files[0])" name="image" type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <button type="submit" name="insert" class="btn btn-primary mt-3"><i class="material-icons">add</i>Create</button>
            </form>
            </div>
        </div>
    </div>
</div>




<?php

include '../extends/footer.php'


?>