<?php
global $connection;
include 'LoginConnection/connection.php'; // Connection to the database
$jsonData = file_get_contents('php://input'); // Retrieve the JSON data sent by Duplicati

$nameOfComputer = $_GET['nameOfComputer']; // Retrieve the name of the computer from the URL
if (!$nameOfComputer) {
    die('Error : No nameOfComputer specified.');
}

file_put_contents('data.json', $jsonData);
$data = json_decode($jsonData, true);

// if everything is ok, return 200 and delete the data.json file
// if not, return 400
if ($data) {
    $now = date('Y-m-d H:i:s');
    $operationName = $data['Extra']['OperationName'];
    $extraResult = $data['Extra']['ParsedResult'];
    $duration = $data['Data']['Duration'];
    $deletedFiles = $data['Data']['DeletedFiles'];
    $deletedFolders = $data['Data']['DeletedFolders'];
    $modifiedFiles = $data['Data']['ModifiedFiles'];
    $examinedFiles = $data['Data']['ExaminedFiles'];
    $openedFiles = $data['Data']['OpenedFiles'];
    $addedFiles = $data['Data']['AddedFiles'];
    $sizeOfModifiedFiles = $data['Data']['SizeOfModifiedFiles'];

    // Insert the data into the database
    $stmt = $connection->prepare("INSERT INTO backup_reports (date, operation, extraResult, duration, nameOfComputer, deletedFiles, deletedFolders, modifiedFiles, examinedFiles, openedFiles, addedFiles, sizeOfModifiedFiles) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssiiisiii", $now, $operationName, $extraResult, $duration, $nameOfComputer, $deletedFiles, $deletedFolders, $modifiedFiles, $examinedFiles, $openedFiles, $addedFiles, $sizeOfModifiedFiles);

    $execResult = $stmt->execute();

    if ($execResult) {
        http_response_code(200);
        unlink('data.json');
    } else {
        http_response_code(400);
    }
}
mysqli_close($connection);
