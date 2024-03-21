<?php
//http://localhost:63342/Duplicati_Monitor/backupDetails.php?id=1
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    echo "No backup ID provided";
    exit();
}
global $connection;
include_once 'LoginConnection/connection.php';
$query = "SELECT * FROM backup_reports WHERE id = $id";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Duplicati Monitor - Details</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <h1>Duplicati Monitor - Details</h1>
</header>
<main>
    <aside>
        <ol>
            <li><a href='index.php'>Overview</a></li>
            <li><a href='backUpReports.php'>Backup reports</a></li>
        </ol>
    </aside>
    <div class="wrapper">
        <table>
            <?php
            for ($i = 0; $i < count($row); $i++) {
                echo "<tr>";
                echo "<td>" . array_keys($row)[$i] . "</td>";
                echo "<td>" . array_values($row)[$i] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</main>
</body>
</html>
