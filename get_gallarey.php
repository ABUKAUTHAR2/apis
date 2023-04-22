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

// Select all data from table
$sql = "SELECT * FROM gallarey ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

// Store the results in an array
$rows = array();
while($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}

// Close the database connection
mysqli_close($conn);

// Return the results as JSON
header('Content-Type: application/json');
echo json_encode($rows);
?>
