<?php 
require_once '../vendor/autoload.php';

// connect to db
$databaseConnection = new MongoDB\Client;
$myDatabase = $databaseConnection->{'Book-Heaven-DB'};
$categoryCollection = $myDatabase->categories;

if (isset($_POST['add'])) {
    $c_name = $_POST['c_name'];

    // Create an array with the category details
    $data = array(
        "c_name" => $c_name,
    );

    // Insert data into categorys collection
    $insert = $categoryCollection->insertOne($data);

    // Redirect to the same page to show updated data in the table
    if ($insert) {
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "<h4>Insertion Failed</h4>";
    }
}
?>