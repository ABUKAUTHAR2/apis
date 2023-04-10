<?php
// connect to the database
$conn = mysqli_connect("localhost", "root", "", "kiutsoapp");

// retrieve the image data for all rows in the news table
$sql = "SELECT image FROM news";
$result = mysqli_query($conn, $sql);

// loop through the results and display each image
while ($row = mysqli_fetch_assoc($result)) {
  $image_data = $row['images'];
  header("Content-type: image/jpeg");
  echo $image_data;
}
?>
