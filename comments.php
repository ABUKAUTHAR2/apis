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


// Fetch comments from the database
$sql = 'SELECT * FROM comments';
$result = $conn->query($sql);
$comments = array();
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $comments[] = $row;
  }
}

// Return the comments as JSON
header('Content-Type: application/json');
echo json_encode($comments);

// Close the database connection
$conn->close();
?>
