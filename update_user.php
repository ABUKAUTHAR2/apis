<?php

// Ensure that the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('HTTP/1.1 405 Method Not Allowed');
    exit();
  }
  
  // Ensure that the request body is valid JSON
  $input = file_get_contents('php://input');
  $data = json_decode($input, true);
  if (json_last_error() !== JSON_ERROR_NONE) {
    header('HTTP/1.1 400 Bad Request');
    exit();
  }
  
  // Connect to the database
  $mysqli = new mysqli('localhost', 'root', '', 'kiutsoapp');
  
  // Check for errors connecting to the database
  if ($mysqli->connect_error) {
    header('HTTP/1.1 500 Internal Server Error');
    exit();
  }
  
  // Prepare the SQL statement to update the user information
  $stmt = $mysqli->prepare('UPDATE signups SET first_name=?, last_name=?, email=?, phone=?, password=? WHERE id=?');
  
  // Bind the parameters to the prepared statement
  $stmt->bind_param('sssssi', $data['first_name'], $data['last_name'], $data['email'], $data['phone'],$data['password'],  $_GET['id']);
  
  // Execute the prepared statement
  if ($stmt->execute()) {
    $response = array('status' => 'success');
    header('Content-Type: application/json');
    echo json_encode($response);
  } else {
    header('HTTP/1.1 500 Internal Server Error');
    exit();
  }
  
  // Close the database connection and statement
  $stmt->close();
  $mysqli->close();
  


?>