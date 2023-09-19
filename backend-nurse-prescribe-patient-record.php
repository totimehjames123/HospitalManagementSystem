<?php
include("connect.php");

// Check if the request contains an 'id' parameter
if (isset($_POST['id'])) {
    $id_to_update = $_POST['id'];

    // Sanitize the input to prevent SQL injection
    $id_to_update = mysqli_real_escape_string($connection, $id_to_update);

    // Create and execute the UPDATE query
    $sql = "UPDATE patient_record SET medicatedStatus = 'Prescribed' WHERE id = '$id_to_update'";
    if ($connection->query($sql) === TRUE) {
        echo "Medical status updated successfully";
    } else {
        echo "Error updating medical status: " . $connection->error;
    }
} else {
    echo "Invalid request. Please provide an 'id' parameter.";
}

// Close the database connection
$connection->close();
?>
