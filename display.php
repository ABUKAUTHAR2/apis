<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kiutsoapp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Fetch data from MySQL database table
$sql = "SELECT * FROM images";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Store data in an array
  $data = array();
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
  // Return data as JSON
  header('Content-type: application/json');
  echo json_encode($data);
} else {
  echo "No data found";
}

$conn->close();

?>
