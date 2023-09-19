<?php
// Include your database connection file here
include 'connect.php';

// Query to fetch people records
$query = "SELECT * FROM patient_record";
$result = mysqli_query($connection, $query);

$people = array();

while ($row = mysqli_fetch_assoc($result)) {
    $people[] = $row;
}

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($people);

// Close the database connection
mysqli_close($connection);
?>
