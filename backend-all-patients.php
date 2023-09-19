<?php
// Include your database connection file here
include 'connect.php';

// Query to fetch patients records
$query = "SELECT * FROM patients";
$result = mysqli_query($connection, $query);

$patients = array();

while ($row = mysqli_fetch_assoc($result)) {
    $patients[] = $row;
}

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($patients);

// Close the database connection
mysqli_close($connection);
?>
