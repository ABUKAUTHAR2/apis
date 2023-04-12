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
$image =  $DecodedData['image'];
$context =  $DecodedData['context'];
$summary =  $DecodedData['summary'];
$description =  $DecodedData['description'];
$date =  $DecodedData['date'];
$time =  $DecodedData['time'];
$likes =  $DecodedData['likes'];
$important =  $DecodedData['important'];

// Prepare and execute statement
$sql = "INSERT INTO news (image, context, summary, description, date, time, likes, important) 
        VALUES ('$image', '$context', '$summary', '$description', '$date', '$time', '$likes', '$important')";
$R=mysqli_query($conn, $sql);
if ($R) {
  $message = "Data added successfully.";
} else {
  $message = "Error: " . mysqli_error($conn);
}

// Close connectionqqqqqqqqqqqqq
mysqli_close($conn);

// Output message
$response[]=array("message"=>$message);
echo json_encode($response);
?>