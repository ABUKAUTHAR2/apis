<?php

// Set database connection variables
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

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the news item ID and new likes count from the request body
  $id = $_POST['id'];
  $likes = $_POST['likes'];

  // Update the likes count in the 'news' table
  $sql = "UPDATE news SET likes = $likes WHERE id = $id";
  if ($conn->query($sql) === FALSE) {
    echo "Error updating record: " . $conn->error;
    exit;
  }

  // Output a success message
  echo "Likes count updated successfully!";
} else {
  // Retrieve all data from 'news' table
  $sql = "SELECT * FROM news";
  $result = $conn->query($sql);

  // Create an empty array to store the retrieved data
  $data = array();

  // Check if any data was retrieved
  if ($result->num_rows > 0) {
    // Loop through each row of data and store it in the array
    while($row = $result->fetch_assoc()) {
      $data[] = $row;
    }
  }

  // Convert the array to a JSON object and output it
  echo json_encode($data);
}

// Close the database connection
$conn->close();

?>
