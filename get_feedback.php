<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kiutsoapp";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to get all feedback messages
$sql = "SELECT * FROM feedback";

// Execute query and get result
$result = mysqli_query($conn, $sql);

// Check for errors in query
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Create array to hold all feedback messages
$feedback = array();

// Loop through result set and add each feedback message to array
while ($row = mysqli_fetch_assoc($result)) {
    $feedback[] = $row;
}

// Return feedback messages as JSON data
echo json_encode($feedback);

// Close database connection
mysqli_close($conn);
?>
