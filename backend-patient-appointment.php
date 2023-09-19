<?php
include("connect.php");

// Check if the request contains an 'id' parameter
if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Sanitize the input to prevent SQL injection
    $email = mysqli_real_escape_string($connection, $email);

    // Create and execute the DELETE query
    $sql = "UPDATE patients SET appointmentStatus='Requested' WHERE patientEmail = '$email'";
    if ($connection->query($sql) === TRUE) {
        echo "Appointment made successfully";
    } else {
        echo "Error appointment " . $connection->error;
    }
} else {
    echo "Invalid request. Please provide an 'id' parameter.";
}

// Close the database connection
$connection->close();
?>
