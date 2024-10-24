<?php 
require_once '../vendor/autoload.php';

// connect to db
$databaseConnection = new MongoDB\Client;
$myDatabase = $databaseConnection->{'Book-Heaven-DB'};
$languageCollection = $myDatabase->languages;

if (isset($_POST['add'])) {
    $name = $_POST['name'];

    // Create an array with the Language details
    $data = array(
        "name" => $name,
    );

    // Insert data into Languages collection
    $insert = $languageCollection->insertOne($data);

    // Redirect to the same page to show updated data in the table
    if ($insert) {
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "<h4>Insertion Failed</h4>";
    }
}
?>