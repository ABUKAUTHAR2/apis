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

// Fetch news data from MySQL database table
$sql = "SELECT * FROM images ORDER BY id DESC";
$result = $conn->query($sql);

// Check if there are any rows returned
if ($result->num_rows > 0) {
  // Create an array to hold the news data
  $news = array();
  
  // Loop through the rows and add data to the array
  while($row = $result->fetch_assoc()) {
    $news_item = array(
      'id' => $row['id'],
      'image' => $row['image_path'],
      'text' => $row['text']
    );
    array_push($news, $news_item);
  }
  
  // Output the news data as JSON
  header('Content-Type: application/json');
  echo json_encode($news);
  
} else {
  echo "No news found";
}

$conn->close();

?>
