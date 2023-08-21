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
$query = "SELECT * FROM backup_reports";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    $tableRows = '';
    $complete = 0;
    $date = date('Y-m-d H:i:s');
    $date24h = date('Y-m-d H:i:s', strtotime('-24 hours'));
    $date7j = date('Y-m-d H:i:s', strtotime('-7 days'));

    while ($row = mysqli_fetch_assoc($result)) {
        $complete++;
        $class = 'red';
        if ($row['date'] > $date24h && $row['date'] < $date) {
            $class = 'green';
        } else if ($row['date'] > $date7j && $row['date'] < $date24h) {
            $class = 'orange';
        }
        $tableRows .= "<tr class=\"$class\"><td>{$row['date']}</td><td>{$row['operation']}</td><td>{$row['result']}</td><td>{$row['nameOfComputer']}</td></tr>";
    }

    $html = "<table>
            <thead><tr><th>Date</th><th>Opération</th><th>Résultat</th><th>Name Of Computer</th></tr></thead>
            <tbody>{$tableRows}</tbody>
            </table>
            <p>{$complete} backup reports found.</p>";

    echo $html;

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



    // Number of backup reports found in the last 24 hours
    $query = "SELECT * FROM backup_reports WHERE date > DATE_SUB(NOW(), INTERVAL 1 DAY)"; //
    $result24h = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($result24h)) {
        $sauve24[] = $row['nameOfComputer'];
    }
    $sauve24 = array_unique($sauve24);
    $fautif24 = array_diff($everyone, $sauve24);

    // Number of backup reports found in the last 7 days
    $query = "SELECT * FROM backup_reports WHERE date > DATE_SUB(NOW(), INTERVAL 7 DAY)";
    $result7j = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($result7j)) {
        $sauve7[] = $row['nameOfComputer'];
    }
    $sauve7 = array_unique($sauve7);
    $fautif7 = array_diff($everyone, $sauve7);


    // If we want to change the interval, we can change the number in the query
    // 1 = 24 hours, 7 = 7 days, 30 = 30 days, etc.
    // example : $query = "SELECT * FROM backup_reports WHERE date > DATE_SUB(NOW(), INTERVAL 30 DAY)";

    echo '<p>' . mysqli_num_rows($result24h) . ' number of backups found in the last 24 hours.</p>';
    echo '<p>' . mysqli_num_rows($result7j) . ' number of backups found in the last 7 days.</p>';

    $percentage24h = round(mysqli_num_rows($result24h) / $complete * 100, 2);
    $percentage7j = round(mysqli_num_rows($result7j) / $complete * 100, 2);




    // The wheel of cheese of backup last 24 hours
    echo '<div class="big-container">
            <div class="container">
                <div class="circular-progress circular-progress-24h">
                    <span class="progress-value progress-value-24h">' . $percentage24h . '%</span> 
            </div>
                <span class="text">Saves in the last 24 hours.</span>
                <button onclick="twentyfour.showModal()" class="bouton"> Show Details</button>
            </div>';


    // The wheel of cheese of backup last 7 days

    echo '<div class="container">
            <div class="circular-progress circular-progress-7d">
                <span class="progress-value progress-value-7d">' . $percentage7j . '%</span>
        </div>
            <span class="text">Saves in the last 7 days.</span>
            <button onclick="seven.showModal()" class="bouton"> Show Details</button>
            </div>
        </div>';




} else {
    echo 'No backup reports found.';
}

mysqli_close($connection);
?>


<!-- The dialog box that appears when you click on the button "Show Details"-->
<dialog id="twentyfour">
    <form method="dialog">
        <p>Those computer did not made backups in the last 24 hours:</p>
        <ul>
            <?php
            foreach ($fautif24 as $value)
                echo '<li>' . $value . '</li>';
            ?>
        </ul>
        <button class="bouton"> Close </button>
    </form>
</dialog>

<dialog id="seven">
    <form method="dialog">
        <p>Those computer did not made backups in the last 7 days:</p>
        <ul>
            <?php
            foreach ($fautif7 as $value)
                echo '<li>' . $value . '</li>';
            ?>
        </ul>
        <button class="bouton"> Close </button>
    </form>
</dialog>


<script>
    var percentage24 = <?php echo $percentage24h; ?>;
    var percentage7 = <?php echo $percentage7j; ?>;
</script>
<script src="js/script.js"></script>

</body>
</html>
