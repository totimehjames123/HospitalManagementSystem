<?php
session_start();
// Include your database connection file here
include 'connect.php';
include 'patient-access.php';

$nationalId = $_SESSION["nationalId"];

// Query to fetch employees records
$query = "SELECT * FROM appointments WHERE nationalId='$nationalId'";
$result = mysqli_query($connection, $query);

$employees = array();

while ($row = mysqli_fetch_assoc($result)) {
    $employees[] = $row;
}

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($employees);

// Close the database connection
mysqli_close($connection);
?>
