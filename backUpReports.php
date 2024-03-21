<?php
require_once 'LoginConnection/connection.php';

$query = "SELECT * FROM backup_reports";
$result = mysqli_query($connection, $query);
$numberOfBackup = mysqli_num_rows($result);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Duplicati Monitor - Backup Reports</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <h1>Duplicati Monitor - Backup Reports</h1>
</header>
<main>
    <aside>
        <ol>
            <li><a href='index.php'>Overview</a></li>
            <li><a href='#'>Backup reports</a></li>
        </ol>
    </aside>
    <div class="wrapper">
        <p>Number of backup reports: <?php echo $numberOfBackup; ?></p>
        <table>
            <tr>
                <th>Backup ID
                    <!--                    add a search bar for jquery-->
                    <input type="text" id="search-id" placeholder="Search for backup ID">
                </th>
                <th>Backup Name
                    <input type="text" id="search-backname" placeholder="Search for backup name">
                </th>
                <th>Backup Date
                    <input type="text" id="search-backdate" placeholder="Search for backup date">
                </th>
                <th>Backup Size
                    <input type="text" id="search-backsize" placeholder="Search for backup size">
                </th>
                <th>Backup Duration
                    <input type="text" id="search-backdur" placeholder="Search for backup duration">
                </th>
                <th>Backup Result
                    <input type="text" id="search-backres" placeholder="Search for backup result">
                </th>
                <th> Details</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['nameOfComputer']}</td>";
                echo "<td>{$row['date']}</td>";
                echo "<td>{$row['sizeOfExaminedFiles']}</td>";
                echo "<td>{$row['duration']}</td>";
                echo "<td>{$row['operation']}</td>";
                echo "<td><a href='backupDetails.php?id={$row['id']}'>Details</a></td>";
                echo "</tr>";
            }
            ?>
    </div>

</main>

</body>
<!--Jquery-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
    // get all the input search fields
    let searchId = $('#search-id');
    let searchBackName = $('#search-backname');
    let searchBackDate = $('#search-backdate');
    let searchBackSize = $('#search-backsize');
    let searchBackDur = $('#search-backdur');
    let searchBackRes = $('#search-backres');


    // get all the table body rows
    let tableRows = $('tr:not(:first)');


    function filter() {
        let id = searchId.val().toLowerCase();
        let backName = searchBackName.val().toLowerCase();
        let backDate = searchBackDate.val().toLowerCase();
        let backSize = searchBackSize.val().toLowerCase();
        let backDur = searchBackDur.val().toLowerCase();
        let backRes = searchBackRes.val().toLowerCase();

        tableRows.each(function (index, tr) {
            let row = $(tr);
            let idText = row.find('td').eq(0).text().toLowerCase();
            let backNameText = row.find('td').eq(1).text().toLowerCase();
            let backDateText = row.find('td').eq(2).text().toLowerCase();
            let backSizeText = row.find('td').eq(3).text().toLowerCase();
            let backDurText = row.find('td').eq(4).text().toLowerCase();
            let backResText = row.find('td').eq(5).text().toLowerCase();

            if (idText.includes(id) && backNameText.includes(backName) && backDateText.includes(backDate) && backSizeText.includes(backSize) && backDurText.includes(backDur) && backResText.includes(backRes)) {
                row.show();
            } else {
                row.hide();
            }
        });
    }

    searchId.on('input', filter);
    searchBackName.on('input', filter);
    searchBackDate.on('input', filter);
    searchBackSize.on('input', filter);
    searchBackDur.on('input', filter);
    searchBackRes.on('input', filter);

</script>
</html>