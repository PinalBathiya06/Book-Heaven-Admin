<!-- Header inclusion -->
<?php include('../includes/header.html'); ?>
<?php include('../includes/container.html'); ?>
<?php include('../includes/container-fluid.html'); ?>
<?php include('../includes/main.html'); ?>


<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Form elements </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Forms</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Form elements</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Category</h4>
                        <!-- <p class="card-description"> Basic form elements </p> -->
                        <form class="forms-sample" action="../actions/category.php" method="POST">
                            <label for="exampleInputName1">Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Name">

                            <button type="submit" name="add" class="btn btn-primary mr-2 mt-3">Submit</button>
                            <button class="btn btn-dark mt-3">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('../includes/footer.html'); ?>
</div>