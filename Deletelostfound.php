<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kiutsoapp";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get ID of item to delete
$id = $_GET['id'];

// Prepare and execute DELETE statement
$sql = "DELETE FROM lostitems WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
    
// Check for errors
if ($stmt->error) {
  echo "Error deleting item: " . $stmt->error;
} else {
  echo "Item deleted successfully";
}

// Close statement and connection
$stmt->close();
$conn->close();

?>
