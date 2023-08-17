<?php
$ip = $_SERVER['REMOTE_ADDR'];
global $connection;

include 'LoginConnection/connection.php';

// Récupération des données JSON envoyées par Duplicati
$jsonData = file_get_contents('php://input');

// le nom de l'URL à mettre dans duplicati sera de forme :
// http://Serveur/CheminVersDuplicatiMonitor/receive.php?nameOfComputer=nomDeLordinateur

$nameOfComputer = $_GET['nameOfComputer']; // Récupération du nom de l'ordinateur
if (!$nameOfComputer) {
    // Si le nom de l'ordinateur n'est pas spécifié, on arrête le script
die('Erreur : Nom de l\'ordinateur non spécifié.');
}

// Sauvegarde des données JSON dans un fichier
file_put_contents('data.json', $jsonData);



$data = json_decode($jsonData, true);

if ($data) {
    // Extraction des informations du JSON
    $operationName = $data['Data']['MainOperation'];
    $parsedResult = $data['Data']['ParsedResult'];

    // Check si IP déjà enregistrée
    $query = "SELECT * FROM backup_reports WHERE nameOfComputer = '$nameOfComputer'";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $surnom = $row['surnom'];
        // Si name déjà enregistrée, on met à jour les données
        $query = "UPDATE backup_reports SET date = NOW(), operation = '$operationName', result = '$parsedResult' WHERE nameOfComputer = '$nameOfComputer'";
    } else {
        $surnom = 'Inconnu';
        // Si name non enregistrée, on ajoute les données
        $query = "INSERT INTO backup_reports (date, operation, result, ip, surnom, nameOfComputer) VALUES (NOW(), '$operationName', '$parsedResult', '$ip', '$surnom', '$nameOfComputer')";
    }

    mysqli_query($connection, $query);


    // Affichage d'une réponse au client (Duplicati)
    echo 'OK';
} else {
    // En cas d'échec de la lecture du JSON
    echo 'Erreur : Impossible de lire le JSON.';
}

mysqli_close($connection);