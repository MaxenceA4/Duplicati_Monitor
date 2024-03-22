<?php
global $connection;
include '../private_duplicati/LoginConnection/connection.php';
$query = "SELECT * FROM backup_reports";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
// Part for the graph
    $numberOfBackupsPerDay = array_fill(0, 7, 0); // Initialize array with zeros for each day of the week

    while ($row = mysqli_fetch_assoc($result)) {
        $date = date('c', strtotime($row['date'])); // Convert date to ISO 8601 format with UTC timezone
        $dayOfWeek = date('N', strtotime($date)); // Get day of the week (1 - 7)
        $dayIndex = ($dayOfWeek + 5) % 7; // Convert to array index (0 - 6), Monday to Sunday
        $numberOfBackupsPerDay[$dayIndex]++;
    }

    $max = max($numberOfBackupsPerDay); // Find the maximum number of backups
    $dataPoints = array();

    for ($i = 6; $i >= 0; $i--) {
        $date = strtotime("-$i days");
        $formattedDate = date('d-m-Y', $date); // Format date in DD-MM-YYYY

        $dayIndex = (date('N', $date) + 5) % 7;
        $dataPoints[] = array(
            "label" => $formattedDate, // Use "label" for custom X-axis display
            "y" => $numberOfBackupsPerDay[$dayIndex]
        );
    }


// Part for the circles
    $queryNumberOfBackups = "SELECT * FROM backup_reports";
    $resultNumberOfBackups = mysqli_query($connection, $queryNumberOfBackups);
    $numberOfBackup = mysqli_num_rows($resultNumberOfBackups);

    $toDate = date('Y-m-d');
    $date24h = date('Y-m-d', strtotime('-1 day'));
    $date7j = date('Y-m-d', strtotime('-7 days'));

    $queryUnique = "SELECT DISTINCT nameOfComputer FROM backup_reports";
    $resultUnique = mysqli_query($connection, $queryUnique);
    $numberOfUnique = mysqli_num_rows($resultUnique);

    $queryUnique24h = "SELECT DISTINCT nameOfComputer FROM backup_reports WHERE DATE(date) BETWEEN '$date24h' AND '$toDate'";
    $resultUnique24h = mysqli_query($connection, $queryUnique24h);
    $numberOfUnique24h = mysqli_num_rows($resultUnique24h);


    $queryUnique7j = "SELECT DISTINCT nameOfComputer FROM backup_reports WHERE DATE(date) BETWEEN '$date7j' AND '$toDate'";
    $resultUnique7j = mysqli_query($connection, $queryUnique7j);
    $numberOfUnique7j = mysqli_num_rows($resultUnique7j);

    // Part for the modal
    $queryListComp = "SELECT DISTINCT nameOfComputer FROM backup_reports";
    $result = mysqli_query($connection, $queryListComp);
    $computerList = '';
    while ($row = mysqli_fetch_assoc($result)) {
        $arrayComputerList[] = $row['nameOfComputer'];
        $computerList .= "<li>{$row['nameOfComputer']}</li>";
    }

    $arrayComputerList24 = array();

    $queryList24 = "SELECT DISTINCT nameOfComputer FROM backup_reports WHERE DATE(date) BETWEEN '$date24h' AND '$toDate'";
    $result24 = mysqli_query($connection, $queryList24);
    $computerList24 = '';// This list is all computer that did theire backup in the last 24h
    // we have to do a difference between the list of all computer and the list of computer that did theire backup in the last 24h
    while ($row = mysqli_fetch_assoc($result24)) {
        $arrayComputerList24[] = $row['nameOfComputer'];
    }

    $arrayComputerList7 = array();

    $queryList7 = "SELECT DISTINCT nameOfComputer FROM backup_reports WHERE DATE(date) BETWEEN '$date7j' AND '$toDate'";
    $result7 = mysqli_query($connection, $queryList7);
    $computerList7 = '';
    while ($row = mysqli_fetch_assoc($result7)) {
        $arrayComputerList7[] = $row['nameOfComputer'];
    }

    // Part for the % of backup
    $percent24h = round(($numberOfUnique24h / $numberOfUnique) * 100, 1);
    $percent7j = round(($numberOfUnique7j / $numberOfUnique) * 100, 1);

    //Diff
    $computerList24 = array_diff($arrayComputerList, $arrayComputerList24);
    $computerList7 = array_diff($arrayComputerList, $arrayComputerList7);


    //We roll back the array to a <li> list
    $computerList24 = array_reduce($computerList24, function ($carry, $item) {
        return $carry . "<li>$item</li>";
    }, '');
    $computerList7 = array_reduce($computerList7, function ($carry, $item) {
        return $carry . "<li>$item</li>";
    }, '');




} else {
    echo "No backup reports found.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duplicati Monitor</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</head>
<body>
<header>
    <h1>Duplicati Monitor - Overview</h1>
</header>
<main>

    <aside>
        <ol>
            <li><a href='#'>Overview</a></li>
            <li><a href='backUpReports.php'>Backup reports</a></li>
        </ol>
    </aside>
    <div class="wrapper">
        <div class="text">There is a total of&nbsp;<b><?php echo $numberOfBackup ?></b>&nbsp;backups registered in the
            database
        </div>
    </div>

    <div class="container-wheels">
        <div class="wheel">
            <div class="wheel__circle">
                <div class="wheel__circle__inner">
                    <div class="wheel__circle__inner__text "><?php echo $numberOfUnique ?></div>
                    <div class="wheel__circle__inner__label">Unique saves</div>
                </div>
            </div>
            <button onclick="computerList.showModal()">View</button>
        </div>



        <div class="wheel">
            <div class="wheel__circle">
                <div class="circular-progress circular-progress-24h">
                    <span class="progress-value progress-value-24h"></span>
                </div>
            </div>
            <span class="wheel__circle__inner__label">Saves in the last 24 hours.</span>
            <button onclick="twentyFour.showModal()">View</button>
        </div>



        <div class="wheel">
            <div class="wheel__circle">
                <div class="circular-progress circular-progress-7d">
                    <span class="progress-value progress-value-7d"></span>
                </div>
            </div>
            <span class="wheel__circle__inner__label">Saves in the last 7 days.</span>
            <button onclick="seven.showModal()">View</button>
        </div>



    </div>

    <div class="container-graph">
        <div class="graph">
            <div id="chartContainer" style="height: 370px; width: 90%;"></div>
        </div>
    </div>
</main>

<dialog id="computerList">
    <form method="dialog">
        <p>Here is the list with the names of the backups:</p>
        <br>
        <ul>
            <?php echo $computerList; ?>
        </ul>
        <button class="bouton"> Close</button>
    </form>
</dialog>
<dialog id="twentyFour">
    <form method="dialog">
        <p>Those computer did not made backups in the last 24 hours:</p>
        <br>
        <ul>
            <?php echo $computerList24; ?>
        </ul>
        <button class="bouton"> Close</button>
    </form>
</dialog>
<dialog id="seven">
    <form method="dialog">
        <p>Those computer did not made backups in the last 7 days:</p>
        <br>
        <ul>
            <?php echo $computerList7; ?>
        </ul>
        <button class="bouton"> Close</button>
    </form>
</dialog>


<script>
    window.onload = function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Backup Reports"
            },
            axisX: {
                title: "Date" // Title for the X-axis
            },
            axisY: {
                title: "Number of Backups"
            },
            data: [{
                type: "column",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?> // Pass the data points
            }]
        });
// write in console the dataPoints
        console.log(<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>);
        // Render the chart
        chart.render();
    }

    var percentage24 = <?php echo $percent24h; ?>;
    var percentage7 = <?php echo $percent7j; ?>;
</script>
<script src="js/script.js"></script>

</body>
</html>