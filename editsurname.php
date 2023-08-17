<?php
$id = $_GET['id'];
global $connection;
include 'LoginConnection/connection.php';

// Récupération des données de la base de données
$query = "SELECT * FROM backup_reports WHERE id = '$id'";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $surnom = $row['surnom'];
} else {
    echo 'Aucun rapport de sauvegarde trouvé.';
}

mysqli_close($connection);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Modification du surnom</title>
</head>
<body>
    <h1>Modification du surnom</h1>

    <form action="editsurname.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="surnom">Surnom :</label>
        <input type="text" name="surnom" id="surnom" value="<?php echo $surnom; ?>">
        <input type="submit" value="Modifier">
    </form>
</body>
</html>
<?php
if (isset($_POST['id']) && isset($_POST['surnom'])) {
    $id = $_POST['id'];
    $surnom = $_POST['surnom'];

    global $connection;
    include 'LoginConnection/connection.php';

    $query = "UPDATE backup_reports SET surnom = '$surnom' WHERE id = '$id'";
    mysqli_query($connection, $query);

    mysqli_close($connection);

    header('Location: main/index.php');
}
?>
