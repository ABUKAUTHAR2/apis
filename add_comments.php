<?php
// Read the request parameters
$id = $_POST['id'];
$name = $_POST['name'];
$comment = $_POST['comment'];

/<?php
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


// Update the comment in the database
$sql = "UPDATE comments SET name='$name', comment='$comment' WHERE id=$id";
if ($conn->query($sql) === TRUE) {
  $response = array('status' => 'success', 'message' => 'Comment updated successfully');
} else {
  $response = array('status' => 'error', 'message' => 'Error updating comment: ' . $conn->error);
}

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);

// Close the database connection
$conn->close();
?>
