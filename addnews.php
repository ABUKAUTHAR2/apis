<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kiutsoapp";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$context = mysqli_real_escape_string($conn, $_POST['context']);
$summary = mysqli_real_escape_string($conn, $_POST['summary']);
$description = mysqli_real_escape_string($conn, $_POST['description']);
$date = mysqli_real_escape_string($conn, $_POST['date']);
$likes = 0;
$important = 0;

// File upload handling
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["image"]["tmp_name"]);
  if($check === false) {
    echo "File is not an image.";
    exit;
  }
}

// Check file size
if ($_FILES["image"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  exit;
}

// Allow only certain file formats
if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  exit;
}

// Save file to server
if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
  echo "Sorry, there was an error uploading your file.";
  exit;
}

// Save path to database
$image_path = mysqli_real_escape_string($conn, $target_file);

// Insert data into table
$sql = "INSERT INTO news (context, summary, description, likes, important, image_path)
VALUES ('$context', '$summary', '$description', $likes, $important, '$image_path')";

if (mysqli_query($conn, $sql)) {
  echo "Data added successfully.";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
