<?php 
include('../includes1/header.php'); 
include('../actions/book.php'); 

// Fetch language and category data from the database
$languages = $languageCollection->find();
$categories = $categoryCollection->find();
?>
<!-- Form and table styling remains unchanged -->
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
<?php
// Handle delete action if `delete_id` is set
if (isset($_GET['delete_id'])) {
    $bookCollection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($_GET['delete_id'])]);
    header("Location: add.php"); // Refresh the page after deletion
    exit();
}
?>


<!-- Form for adding a new book -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title">Add Book Details</h3>
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="container">
                    <h4 class="form-title">Add New Book</h4>
                    <form method="POST" action="../actions/book.php">
                        <!-- Other form fields remain unchanged -->
                        <label for="name" class="form-label">Book Name:</label>
                        <input type="text" id="name" name="name" class="form-input" required>

                        <label for="author" class="form-label">Book Author:</label>
                        <input type="text" id="author" name="author" class="form-input" required>

                        <label for="description" class="form-label">Description:</label>
                        <textarea id="description" name="description" class="form-textarea" required></textarea>

                        <label for="image" class="form-label">Image URL:</label>
                        <input type="text" id="image" name="image" class="form-input" required>

                        <label for="pub_date" class="form-label">Publish Date:</label>
                        <input type="date" id="pub_date" name="pub_date" class="form-input" required>

                        <!-- Dropdown for l_id (Language) -->
                        <label for="l_id" class="form-label">Select Language:</label>
                        <select id="l_id" name="l_id" class="form-input" required>
                            <?php foreach ($languages as $language) { ?>
                                <option value="<?php echo $language['_id']; ?>">
                                    <?php echo $language['name']; ?>
                                </option>
                            <?php } ?>
                        </select>

                        <!-- Dropdown for c_id (Category) -->
                        <label for="c_id" class="form-label">Select Category:</label>
                        <select id="c_id" name="c_id" class="form-input" required>
                            <?php foreach ($categories as $category) { ?>
                                <option value="<?php echo $category['_id']; ?>">
                                    <?php echo $category['c_name']; ?>
                                </option>
                            <?php } ?>
                        </select>

                        <input type="submit" name="add" value="Add Book" class="submit-btn">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Display the added books in a table (Unchanged) -->
<!-- Existing table code -->
<div class="row table-container">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Books List</h4>
                <div class="table-striped table-bordered table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Author</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Publish Date</th>
                                <th>Action</th> <!-- Added Action column -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Fetch all books from MongoDB collection
                            $books = $bookCollection->find();
                            foreach ($books as $book) {
                                echo "<tr>
                                    <td>" . htmlspecialchars($book['name']) . "</td>
                                    <td>" . htmlspecialchars($book['author']) . "</td>
                                    <td>" . htmlspecialchars($book['description']) . "</td>
                                    <td><img src='" . htmlspecialchars($book['image']) . "' alt='Book Image'></td>
                                    <td>" . htmlspecialchars($book['pub_date']) . "</td>
                                    <td>
                                        <!-- Edit and Delete buttons -->
                                        <a href='edit_book.php?id=" . $book['_id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                                     <a href='add.php?delete_id=". $book['_id']. "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this book?\")'>Delete</a>
                                    </td>
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
