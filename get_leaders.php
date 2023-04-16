<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kiutsoapp";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL query to get all leaders
$sql = "SELECT * FROM leaders";

// Execute query and get results
$result = mysqli_query($conn, $sql);

// Initialize an empty array to store leaders
$leaders = array();

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
    // Loop through results and add each leader to the array
    while ($row = mysqli_fetch_assoc($result)) {
        $leaders[] = $row;
    }
}

// Close the database connection
mysqli_close($conn);

// Return the leaders array as JSON
header('Content-Type: application/json');
echo json_encode($leaders);
?>
