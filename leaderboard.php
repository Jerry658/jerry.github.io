<!DOCTYPE html>
<html>
<head>
    <title>Leaderboard</title>
    <style>
        body {
            background: linear-gradient(135deg, #89f7fe 0%, #66a6ff 100%);
            font-family: Arial, sans-serif;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #fff;
        }
    </style>
</head>
<body>

<?php
// CONNECT TO MySQL DATABASE
$dbc = mysqli_connect('localhost', 'bob', 'down', 'leaderboard') or die(mysqli_connect_error());
mysqli_set_charset($dbc, 'utf8');

// Select data from the 'user' table
$sql = "SELECT user_name, user_time FROM user";
$result = mysqli_query($dbc, $sql) or die("Error: " . mysqli_error($dbc));
$num_rows = mysqli_num_rows($result);

if ($num_rows == 0) {
    die("There are no users in your database table");
} else {
    echo "<h1>This is the Leaderboard</h1>";
    echo "<p>There are currently $num_rows members in the user table</p>";
    echo "<table>";
    echo "<tr><th>Name</th><th>Time</th></tr>";

    while ($row = mysqli_fetch_array($result)) {
        echo "<tr><td>" . $row['user_name'] . "</td><td>" . $row['user_time'] . "</td></tr>";
    }

    echo "</table>";
}

// Close connection
mysqli_close($dbc);
?>

</body>
</html>
