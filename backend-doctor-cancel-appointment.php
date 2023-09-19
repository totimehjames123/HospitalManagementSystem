<?php
// Include your database connection script
include "connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the appointment ID to be canceled from the POST request
    $appointmentId = $_POST['id'];

    // Update the appointment status to 'canceled'
    $sql = "UPDATE appointments SET appointmentStatus = 'canceled' WHERE id = ?";

    $stmt = mysqli_prepare($connection, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $appointmentId);

        if (mysqli_stmt_execute($stmt)) {
            // Appointment canceled successfully
            $response = array('success' => true, 'message' => 'Appointment canceled.');
            echo json_encode($response);
        } else {
            // Failed to cancel appointment
            $response = array('success' => false, 'message' => 'Failed to cancel appointment.');
            echo json_encode($response);
        }
        mysqli_stmt_close($stmt);
    } else {
        // Statement preparation error
        $response = array('success' => false, 'message' => 'Database error.');
        echo json_encode($response);
    }
    mysqli_close($connection);
} else {
    // Invalid request method
    $response = array('success' => false, 'message' => 'Invalid request method.');
    echo json_encode($response);
}
?>
