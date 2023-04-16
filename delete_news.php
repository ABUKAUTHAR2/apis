<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kiutsoapp";

// Get the ID of the news article to delete from the query string
$id = $_GET['id'];

// Create connection to database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the SQL statement to delete the news article with the given ID
$sql = "DELETE FROM news WHERE id='$id'";
if ($conn->query($sql) === TRUE) {
  $response = array('status' => 'success', 'message' => 'News article deleted successfully.');
} else {
  $response = array('status' => 'error', 'message' => 'Error deleting news article: ' . $conn->error);
}

// Close the database connection
$conn->close();

// Send JSON response back to client
header('Content-Type: application/json');
echo json_encode($response);
?>
