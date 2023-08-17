<?php
$ip = $_SERVER['REMOTE_ADDR'];
global $connection;

include 'LoginConnection/connection.php'; // Connexion to the database
$jsonData = file_get_contents('php://input'); // Retrieve the JSON data sent by Duplicati

// URL should be like this:
// http://Serveur/PathToDuplicatiMonitor/receive.php?nameOfComputer=nomDeLordinateur

$nameOfComputer = $_GET['nameOfComputer']; // Retrieve the name of the computer from the URL
if (!$nameOfComputer) {
    // if no nameOfComputer is specified, we stop the script
die('Error : No nameOfComputer specified.');
}

// Save the JSON data in a file
file_put_contents('data.json', $jsonData);



$data = json_decode($jsonData, true);

if ($data) {
    // If the JSON data is successfully read, we retrieve the operation name and the result
    $operationName = $data['Data']['MainOperation'];
    $parsedResult = $data['Data']['ParsedResult'];


    // Check if the nameOfComputer is already in the database
    $query = "SELECT * FROM backup_reports WHERE nameOfComputer = '$nameOfComputer'";
    $result = mysqli_query($connection, $query);
    if ($operationName != 'Backup') {
        die('Error : Operation name is not "Backup".');
    }

    if (mysqli_num_rows($result) > 0) { // If the nameOfComputer is already in the database, we update the data
        $row = mysqli_fetch_assoc($result);
        $query = "UPDATE backup_reports SET date = NOW(), operation = '$operationName', result = '$parsedResult' WHERE nameOfComputer = '$nameOfComputer'";
    } else { // If the nameOfComputer is not in the database, we insert the data
        $query = "INSERT INTO backup_reports (date, operation, result, nameOfComputer) VALUES (NOW(), '$operationName', '$parsedResult', '$nameOfComputer')";
    }

    mysqli_query($connection, $query);


    // Send back a response to Duplicati (is this really necessary?)
    echo 'OK';
}

mysqli_close($connection);