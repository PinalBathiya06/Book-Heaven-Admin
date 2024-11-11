<?php
include('../includes1/header.php'); 
require_once '../vendor/autoload.php';
$databaseConnection = new MongoDB\Client;
$myDatabase = $databaseConnection->{'Book-Heaven-DB'};
$bookCollection = $myDatabase->books;


// Check if book ID is provided
if (isset($_GET['id'])) {
    $bookId = $_GET['id'];

    // Fetch the book data from the database
    $book = $bookCollection->findOne(['_id' => new MongoDB\BSON\ObjectId($bookId)]);

    // If the form is submitted, update the book
    if (isset($_POST['update'])) {
        $updatedData = [
            'name' => $_POST['name'],
            'author' => $_POST['author'],
            'description' => $_POST['description'],
            'image' => $_POST['image'],
            'pub_date' => $_POST['pub_date'],
            'l_id' => new MongoDB\BSON\ObjectId($_POST['l_id']),
            'c_id' => new MongoDB\BSON\ObjectId($_POST['c_id'])
        ];

        // Update the book data in MongoDB
        $bookCollection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($bookId)],
            ['$set' => $updatedData]
        );

        // Redirect back to the main page or display success message
        header("Location: add.php");
        exit();
    }
} else {
    echo "No book ID provided.";
    exit();
}
?>
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

<!-- HTML Form to Edit Book Details -->
<div class="main-panel">
    <div class="form-container">
        <h4 class="form-title">Edit Book Details</h4>
        <form method="POST" action="edit_book.php">
            <label for="name" class="form-label">Book Name:</label>
            <input type="text" id="name" name="name" class="form-input" required value="<?php echo htmlspecialchars($book['name']); ?>">

            <label for="author" class="form-label">Book Author:</label>
            <input type="text" id="author" name="author" class="form-input" required value="<?php echo htmlspecialchars($book['author']); ?>">

            <label for="description" class="form-label">Description:</label>
            <textarea id="description" name="description" class="form-textarea" required><?php echo htmlspecialchars($book['description']); ?></textarea>

            <label for="image" class="form-label">Image URL:</label>
            <input type="text" id="image" name="image" class="form-input" required value="<?php echo htmlspecialchars($book['image']); ?>">

            <label for="pub_date" class="form-label">Publish Date:</label>
            <input type="date" id="pub_date" name="pub_date" class="form-input" required value="<?php echo htmlspecialchars($book['pub_date']); ?>">

            <input type="submit" name="update" value="Update Book" class="submit-btn">
        </form>
    </div>
</div>

<?php include('../includes1/footer.php'); ?>