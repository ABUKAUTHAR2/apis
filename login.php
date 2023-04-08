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

// query to retrieve all user Credentials
$sql = "SELECT * FROM signups";

$result = $conn->query($sql);

// array to store user Credentials
$Credentials = [];

if ($result->num_rows > 0) {
    // loop through all rows and add to Credentials array
    while($row = $result->fetch_assoc()) {
        $Credentials[] = $row;
    }
} 

$conn->close();

// return Credentials array as JSON response
header('Content-Type: application/json');
echo json_encode($Credentials);

?>
