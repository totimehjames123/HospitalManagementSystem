<?php
// Include your database connection file here
include 'connect.php';

// Query to fetch wards records
$query = "SELECT * FROM medicines";
$result = mysqli_query($connection, $query);

$wards = array();

while ($row = mysqli_fetch_assoc($result)) {
    $wards[] = $row;
}

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($wards);

// Close the database connection
mysqli_close($connection);
?>
