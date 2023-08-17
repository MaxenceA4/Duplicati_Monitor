<!DOCTYPE html>
<html>
<head>
    <title>Duplicati Monitor</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="main/styleindex.css">
</head>
<body>
<h1>Backup report</h1>

<?php
global $connection;
include 'LoginConnection/connection.php';
// Retrieve all the data from the "example" table
$query = "SELECT * FROM backup_reports";
$result = mysqli_query($connection, $query);


if (mysqli_num_rows($result) > 0) {
    echo '<table>';
    echo '<thead><tr></th><th>Date</th><th>Opération</th><th>Résultat</th>><th>Name Of Computer</th></tr></thead>';
    echo '<tbody>';

    $complete = 0;

    $date = date('Y-m-d H:i:s');
    $date24h = date('Y-m-d H:i:s', strtotime('-24 hours'));
    $date7j = date('Y-m-d H:i:s', strtotime('-7 days'));


    while ($row = mysqli_fetch_assoc($result)) {
        $complete++;
        // si la date rowdate est comprise entre ajd et il y a 24h, on affiche le rapport en vert
        if ($row['date'] > $date24h && $row['date'] < $date) {
            echo '<tr class="green">';
        } else if ($row['date'] > $date7j && $row['date'] < $date24h) {
            echo '<tr class="orange">';
        } else {
            echo '<tr class="red">';
        }

        echo '<td>' . $row['date'] . '</td>';
        echo '<td>' . $row['operation'] . '</td>';
        echo '<td>' . $row['result'] . '</td>';
        echo '<td>' . $row['nameOfComputer'] . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '<p>' . $complete . ' rapport(s) de sauvegarde trouvé(s).</p>';
    $everyone = [];
    $sauve24 = [];
    $sauve7 = [];
    $fautif24 = [];
    $fautif7 = [];
    $query = "SELECT * FROM backup_reports";
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $everyone[] = $row['nameOfComputer'];
    }


    // Nombre de rapports de sauvegarde trouvés dans les dernières 24 heures
    $query = "SELECT * FROM backup_reports WHERE date > DATE_SUB(NOW(), INTERVAL 1 DAY)"; //
    $result24h = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($result24h)) {
        $sauve24[] = $row['nameOfComputer'];
    }
    $sauve24 = array_unique($sauve24);
    $fautif24 = array_diff($everyone, $sauve24);


    // Nombre de rapports de sauvegarde trouvés dans les dernières 7 jours
    $query = "SELECT * FROM backup_reports WHERE date > DATE_SUB(NOW(), INTERVAL 7 DAY)";
    $result7j = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($result7j)) {
        $sauve7[] = $row['nameOfComputer'];
    }
    $sauve7 = array_unique($sauve7);
    $fautif7 = array_diff($everyone, $sauve7);


    // si on veut changer l'intervalle de temps, il faut changer le chiffre 1 dans la ligne ci-dessus
    // 1 = 24 heures, 7 = 7 jours, 30 = 30 jours, etc.
    // exemple : $query = "SELECT * FROM backup_reports WHERE date > DATE_SUB(NOW(), INTERVAL 30 DAY)";

    echo '<p>' . mysqli_num_rows($result24h) . ' rapport(s) de sauvegarde trouvé(s) dans les dernières 24 heures.</p>';
    // Nombre de rapports de sauvegarde trouvés dans les dernières 7 jours
    echo '<p>' . mysqli_num_rows($result7j) . ' rapport(s) de sauvegarde trouvé(s) dans les derniers 7 jours.</p>';

    $percentage24h = round(mysqli_num_rows($result24h) / $complete * 100, 2);
    $percentage7j = round(mysqli_num_rows($result7j) / $complete * 100, 2);

    // Nombre de rapports dans les dernières 24 heures sur nombre total de rapports

    echo '<dialog id="d">
            <form method="dialog">';
    if (is_array($fautif24) || is_object($fautif24))
        echo '<p>Les ordinateurs suivants n\'ont pas envoyé de rapport de sauvegarde dans les dernières 24 heures :</p>
<ul>';
    foreach ($fautif24 as $value)
        echo '<li>' . $value . '</li>';
    echo '</ul>';
    if (is_array($fautif7) || is_object($fautif7))
        echo '<p>Les ordinateurs suivants n\'ont pas envoyé de rapport de sauvegarde dans les dernières 7 jours :</p>
<ul>';
    foreach ($fautif7 as $value)
        echo '<li>' . $value . '</li>';
    echo '</ul>';


    echo '<button class="bouton"> Close </button>
            </form>
        </dialog>';
    echo '<button onclick="d.showModal()" class="bouton"> Montrer les fautifs</button>';
    // Nombre de rapports dans les dernières 7 jours sur nombre total de rapports

    echo '<div class="big-container">';
    echo '<div class="container">';
    echo '<div class="circular-progress">';
    echo '<span class="progress-value">' . $percentage24h . '%</span>';
    echo '</div>';

    echo '<span class ="text">Sauvegarde dans les dernières 24 heures.</span>';

    echo '</div>';
    echo '</div>';


} else {
    echo 'Aucun rapport de sauvegarde trouvé.';
}

mysqli_close($connection);
?>

<script>
    var percentage24 = <?php echo $percentage24h; ?>;
    var percentage7 = <?php echo $percentage7j; ?>;
</script>
<script src="js/script.js"></script>

</body>
</html>
