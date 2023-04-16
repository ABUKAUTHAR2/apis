<?php 
// Database credentials
$host = "localhost";
$username = "root";
$password = "";
$dbname = "kiutsoapp";

// Connect to database
$conn = mysqli_connect($host, $username, $password, $dbname);

// Retrieve data from form submitted via POST
$image = $_FILES['image']['name'];
$context =  $_POST['context'];
$summary =  $_POST['summary'];
$description =  $_POST['description'];
$date =  $_POST['date'];
$time =  $_POST['time'];
$likes =  $_POST['likes'];
$important =  $_POST['important'];

// File upload handling
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["image"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    $message = "Error: File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  $message = "Error: File already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["image"]["size"] > 5000000) {
  $message = "Error: File is too large.";
  $uploadOk = 0;
}

// Allow only certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  $message = "Error: Only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  $message = "Error: File was not uploaded.";
// If everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    $message = "File ". htmlspecialchars( basename( $_FILES["image"]["name"])). " uploaded successfully.";

    // Prepare and execute statement
    $sql = "INSERT INTO news (image, context, summary, description, date, time, likes, important) 
            VALUES ('$image', '$context', '$summary', '$description', '$date', '$time', '$likes', '$important')";
    $R=mysqli_query($conn, $sql);
    if ($R) {
      $message .= " Data added successfully.";
    } else {
      $message .= " Error: " . mysqli_error($conn);
    }
  } else {
    $message = "Error: File was not uploaded.";
  }
}

// Close connection
mysqli_close($conn);

// Output message
echo $message;
?>