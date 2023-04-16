<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kiutsoapp";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the id and liked value from the request body
$id = $_POST['id'];
$liked = $_POST['liked'];

// Update the likes count of the news item with the given id
$sql = "UPDATE news SET likes = likes + ($liked * 2 - 1) WHERE id = $id";

if ($conn->query($sql) === TRUE) {
  // Return a JSON object with a success message
  $response = array('status' => 'success', 'message' => 'Record updated successfully');
  echo json_encode($response);
} else {
  // Return a JSON object with an error message
  $response = array('status' => 'error', 'message' => 'Error updating record: ' . $conn->error);
  echo json_encode($response);
}

$conn->close();
?>
