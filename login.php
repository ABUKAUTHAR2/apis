<?php
// Database credentials
$host = "localhost";
$username = "root";
$password = "";
$dbname = "kiutsoapp";

// Connect to database
$conn = mysqli_connect($host, $username, $password, $dbname);

// Retrieve username and lastname from form submitted via POST
$EncodedData = file_get_contents('php://input');
$DecodedData = json_decode($EncodedData,true);
$username =  $DecodedData['username'];
$lastname =  $DecodedData['lastname'];

// Prepare and execute statement
$sql = "INSERT INTO users (username, lastname) VALUES ('$username', '$lastname')";
$R=mysqli_query($conn, $sql);
if ($R) {
  $message = "Data added successfully.";
} else {
  $message = "Error: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);

// Output message
$response[]=array("message"=>$message);
echo json_encode($response);
?>
