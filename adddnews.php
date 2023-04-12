<?php

// Make sure that the form has been submitted
if(isset($_POST['submit'])) {

    // Check if all required fields have been filled
    if(empty($_POST['context']) || empty($_POST['summary']) || empty($_POST['description']) || empty($_POST['date'])) {
        die("Please fill all required fields.");
    }

    // Get the form data and sanitize it
    $context = htmlspecialchars($_POST['context']);
    $summary = htmlspecialchars($_POST['summary']);
    $description = htmlspecialchars($_POST['description']);
    $date = htmlspecialchars($_POST['date']);

    // Check if an image has been uploaded
    if(empty($_FILES['image']['name'])) {
        die("Please select an image file.");
    }

    // Get the image data
    $image = $_FILES['image'];
    $image_name = $image['name'];
    $image_tmp_name = $image['tmp_name'];
    $image_size = $image['size'];
    $image_error = $image['error'];
    $image_type = $image['type'];

    // Get the file extension
    $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

    // Check if the file is an image
    $allowed_exts = array("jpg", "jpeg", "png", "gif");
    if(!in_array($image_ext, $allowed_exts)) {
        die("Please select a valid image file.");
    }

    // Check if the image file size is within the limit
    $max_size = 1000000; // 1MB
    if($image_size > $max_size) {
        die("The image file size is too large. Please select a smaller image file.");
    }

    // Generate a unique filename for the image
    $image_new_name = uniqid('', true) . '.' . $image_ext;

    // Move the image to the uploads directory
    $uploads_dir = 'uploads/';
    $image_dest_path = $uploads_dir . $image_new_name;
    if(move_uploaded_file($image_tmp_name, $image_dest_path)) {

        // Connect to the database
        $conn = mysqli_connect('localhost', 'username', 'password', 'dbname');

        // Check if the connection was successful
        if(!$conn) {
            die("Could not connect to the database.");
        }

        // Prepare the insert statement
        $insert_stmt = mysqli_prepare($conn, "INSERT INTO news (context, summary, description, date, image) VALUES (?, ?, ?, ?, ?)");

        // Bind the parameters
        mysqli_stmt_bind_param($insert_stmt, "sssss", $context, $summary, $description, $date, $image_new_name);

        // Execute the statement
        if(mysqli_stmt_execute($insert_stmt)) {
            echo "News added successfully.";
        } else {
            echo "Could not add news. Please try again later.";
        }

        // Close the statement and the connection
        mysqli_stmt_close($insert_stmt);
        mysqli_close($conn);

    } else {
        die("Could not upload image. Please try again later.");
    }

} else {
    die("Invalid request.");
}
