<?php
include "connect.php";

// Define your SQL query to fetch data
$sql = "SELECT id, username, email, gender, profilePicture, dateOfRegistration FROM admin WHERE role = 'admin'";

// Perform the query
$result = mysqli_query($connection, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}

// Create an empty array to store the fetched data
$data = array();

// Fetch data and add it to the array
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Close the database connection
mysqli_close($connection);

// Send a JSON response
header('Content-Type: application/json');
echo json_encode($data);
?>
