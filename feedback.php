<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kiutsoapp";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the message sent from the React Native application
$message = json_decode(file_get_contents('php://input'))->message;

// Prepare and execute the SQL statement to insert the message into the database
$stmt = $conn->prepare("INSERT INTO feedback (message) VALUES (?)");
$stmt->bind_param("s", $message);
if ($stmt->execute()) {
    $response = array("status" => "success");
} else {
    $response = array("status" => "error", "message" => $conn->error);
}

// Close the database connection and send the response back to the React Native application
$stmt->close();
$conn->close();
header('Content-Type: application/json');
echo json_encode($response);

?>
