<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kiutsoapp";

// Get feedback ID from GET data
$feedback_id = $_GET['id'];

// Create database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check for errors in connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to delete feedback message with specific ID
$sql = "DELETE FROM feedback WHERE id = $feedback_id";

// Execute query and get result
$result = mysqli_query($conn, $sql);

// Check for errors in query
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Return success message
echo json_encode(array('status' => 'success'));

// Close database connection
mysqli_close($conn);
?>
