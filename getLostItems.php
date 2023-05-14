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

// Retrieve lost items from database
$sql = "SELECT * FROM Lostitems";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // Convert result set to JSON
  $lostItems = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $lostItems[] = $row;
  }
  echo json_encode($lostItems);
} else {
  echo "No lost items found.";
}

mysqli_close($conn);

?>
