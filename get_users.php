<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "kiutsoapp";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all users from the "signups" table
$sql = "SELECT * FROM signups";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row as a JSON array
    $rows = array();
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    echo json_encode($rows);
} else {
    echo "0 results";
}

$conn->close();

