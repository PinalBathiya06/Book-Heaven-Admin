<?php include('../includes1/header.php');
include('../actions/language.php'); ?>
<!-- Form and table styling -->
<style>
    body {
        background-color: #141414;
        color: #fff;
    }

    .main-panel {
        padding: 20px;
    }

    .form-container {
        background-color: #2c2c2c;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        /* Increased width of the form */
        margin: 0 auto;
        /* Centers the form horizontally */
    }

    .form-title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #fff;
        text-align: center;
    }

    .form-label {
        font-size: 16px;
        margin-bottom: 5px;
        display: block;
        color: #ddd;
    }

    .form-input {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #555;
        border-radius: 5px;
        font-size: 14px;
        background-color: #1e1e1e;
        color: #fff;
    }

    .form-textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #555;
        border-radius: 5px;
        font-size: 14px;
        height: 100px;
        background-color: #1e1e1e;
        color: #fff;
    }

    .submit-btn {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        width: 100%;
    }

    .submit-btn:hover {
        background-color: #45a049;
    }

    .table-container {
        margin-top: 40px;
    }

    .table-responsive {
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
    }

    .table th,
    .table td {
        padding: 12px;
        text-align: left;
    }

    .table th {
        background-color: #333;
        color: #fff;
    }

    .table td {
        color: #ccc;
    }

    .table img {
        width: 100px;
        /* Increased width of images */
        border-radius: 5px;
    }
</style>

<!-- Form for adding a new Language -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Add Language Details</h3>
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <!-- <div class="form-container"> -->
                    <div class="form-container">
                    <h4 class="form-title">Add New Language</h4>
                    <form method="POST" action="../actions/language.php">
                        <label for="name" class="form-label">Language Name:</label>
                        <input type="text" id="name" name="name" class="form-input" required>

                        <input type="submit" name="add" value="Add Language" class="submit-btn">
                    </form>
                    </div>
                <!-- </div> -->
            </div>
        </div>
    </div>
</div>

<!-- Display the added Languages in a table -->
<div class="row table-container">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Language List</h4>
                <div class="table-striped table-bordered table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch all Languages from MongoDB collection
                            $languages = $languageCollection->find();
                            foreach ($languages as $language) {
                                echo "<tr>
                                    <td>" . htmlspecialchars($language['name']) . "</td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../includes1/footer.php'); ?>