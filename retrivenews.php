<?php
// Database Credentials
$host = "localhost";
$username = "root";
$password = "";
$dbname = "kiutsoapp";

// Connect to database
$conn = mysqli_connect($host, $username, $password, $dbname);

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// query to retrieve all news
$sql = "SELECT * FROM news";

$result = $conn->query($sql);

// array to store news
$news = [];

if ($result->num_rows > 0) {
    // loop through all rows and add to news array
    while($row = $result->fetch_assoc()) {
        // encode image data as base64 string
        $imageData = base64_encode($row['image']);

        // create new array with image data as base64 string
        $newsItem = [
            'id' => $row['id'],
            'image' => $imageData,
            'context' => $row['context'],
            'summary' => $row['summary'],
            'description' => $row['description'],
            'date' => $row['date'],
            'time' => $row['time'],
            'likes' => $row['likes'],
            'important' => $row['important']
        ];

        // add news item to news array
        $news[] = $newsItem;
    }
} 

$conn->close();

// return news array as JSON response
header('Content-Type: application/json');
echo json_encode($news);
?>
