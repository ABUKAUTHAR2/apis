<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "dbname";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the posted data
$context = $_POST["context"];
$summary = $_POST["summary"];
$description = $_POST["description"];
$date = $_POST["date"];

// Check if image file was uploaded
if(isset($_FILES["image"])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if file is an actual image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        // Allow only JPG, JPEG, PNG file formats
        if($imageFileType == "jpg" || $imageFileType == "jpeg" || $imageFileType == "png") {
            // Move uploaded file to target directory
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image_url = "http://localhost/uploads/" . basename($_FILES["image"]["name"]);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Sorry, only JPG, JPEG, PNG files are allowed.";
        }
    } else {
        echo "File is not an image.";
    }
}

// Prepare and bind the SQL statement
$stmt = $conn->prepare("INSERT INTO news (context, summary, description, date, image) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $context, $summary, $description, $date, $image_url);

// Execute the statement and check for errors
if ($stmt->execute() === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
