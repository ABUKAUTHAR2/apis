<?php
// Database credentials
$host = "localhost";
$username = "root";
$password = "";
$dbname = "kiutsoapp";

// Connect to database
$conn = mysqli_connect($host, $username, $password, $dbname);


// Handle GET request to retrieve comments for a specific news article
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $news_id = $_GET['news_id'];

    $sql = "SELECT * FROM comments WHERE news_id = '$news_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $comments = array();
        while($row = $result->fetch_assoc()) {
            array_push($comments, $row);
        }
        echo json_encode($comments);
    } else {
        echo "No comments found for news article ID $news_id.";
    }
}

// Handle POST request to add a new comment to the database
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'));

    $news_id = $data->news_id;
    $comment_text = $data->comment_text;

    $sql = "INSERT INTO comments (news_id, comment_text, comment_date) VALUES ('$news_id', '$comment_text', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "New comment added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

?>
