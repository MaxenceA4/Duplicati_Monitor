<?php
global $connection;
// Informations de connexion à la base de données
$db_servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "duplicati_monitoring";

// Établir la connexion à la base de données
$connection = mysqli_connect($db_servername, $db_username, $db_password, $db_name);

// Vérification de la connexion
if (!$connection) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}
