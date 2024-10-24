<?php 
require_once '../vendor/autoload.php';

// connect to db
$databaseConnection = new MongoDB\Client;
$myDatabase = $databaseConnection->{'Book-Heaven-DB'};
$bookCollection = $myDatabase->books;
$languageCollection = $myDatabase->languages;  // Add this for fetching languages
$categoryCollection = $myDatabase->categories; // Add this for fetching categories

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $author = $_POST['author'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    $pub_date = $_POST['pub_date'];
    $l_id = $_POST['l_id']; // Add language ID
    $c_id = $_POST['c_id']; // Add category ID

    // Create an array with the book details
    $data = array(
        "name" => $name,
        "author" => $author,
        "description" => $description,
        "image" => $image,
        "pub_date" => $pub_date,
        "l_id" => new MongoDB\BSON\ObjectId($l_id), // Reference to the language ID
        "c_id" => new MongoDB\BSON\ObjectId($c_id)  // Reference to the category ID
    );

    // Insert data into books collection
    $insert = $bookCollection->insertOne($data);

    // Redirect to the same page to show updated data in the table
    if ($insert) {
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "<h4>Insertion Failed</h4>";
    }
}
?>
