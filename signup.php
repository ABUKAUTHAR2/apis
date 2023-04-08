<?php
// Database credentials
$host = "localhost";
$username = "root";
$password = "";
$dbname = "kiutsoapp";

// Connect to database
$conn = mysqli_connect($host, $username, $password, $dbname);

// Retrieve data from form submitted via POST
$EncodedData = file_get_contents('php://input');
$DecodedData = json_decode($EncodedData,true);
$first_name =  $DecodedData['first_name'];
$last_name =  $DecodedData['last_name'];
$email =  $DecodedData['email'];
$phone =  $DecodedData['phone'];
$password =  $DecodedData['password'];

// Prepare and execute statement
$sql = "INSERT INTO signups (first_name, last_name, email, phone, password) 
        VALUES ('$first_name', '$last_name', '$email', '$phone', '$password')";
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
