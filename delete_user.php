<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "kiutsoapp";

// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get ID parameter from URL
$id = $_GET['id'];

// Construct SQL query to delete user
$sql = "DELETE FROM signups WHERE id = $id";

// Execute query and check for errors
if (mysqli_query($conn, $sql)) {
  $response = array('status' => 'success');
} else {
  $response = array('status' => 'error', 'message' => mysqli_error($conn));
}

// Close connection
mysqli_close($conn);

// Send response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
