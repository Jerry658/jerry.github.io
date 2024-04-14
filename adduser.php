<?php
// CONNECT TO DATABASE
$dbc = @mysqli_connect('localhost', 'bob', 'down', 'leaderboard')
  // If the connection fails, show an error message and exit
  OR die(mysqli_connect_error());
mysqli_set_charset($dbc, 'utf8');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$userName = $_POST['username'];
	$userTime = $_POST['elapsedTime'];

    
    // Build the SQL query
    $sql = "INSERT INTO `user`(`user_name`, `user_time`) VALUES ('$userName', '$userTime')";
    
    // Execute the query
    $result = @mysqli_query($dbc, $sql);
    
    // Check if the query was successful
    if ($result) {
        echo "<p>User added successfully!</p>";
    } else {
        echo "<p>Error adding user: " . mysqli_error($dbc) . "</p>";
    }
}

// Close the database connection
mysqli_close($dbc);
?>
