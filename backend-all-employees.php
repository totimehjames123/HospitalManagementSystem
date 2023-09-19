<?php
// Include your database connection file here
include 'connect.php';

// Query to fetch employees records
$query = "SELECT * FROM employees";
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
