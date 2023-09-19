<?php
include("connect.php");

// Check if the request contains an 'id' parameter
if (isset($_POST['id'])) {
    $id_to_delete = $_POST['id'];

    // Sanitize the input to prevent SQL injection
    $id_to_delete = mysqli_real_escape_string($connection, $id_to_delete);

    // Create and execute the DELETE query
    $sql = "DELETE FROM employees WHERE id = '$id_to_delete'";
    if ($connection->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $connection->error;
    }
} else {
    echo "Invalid request. Please provide an 'id' parameter.";
}

// Close the database connection
$connection->close();
?>
