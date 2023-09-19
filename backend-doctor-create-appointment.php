<?php
// Include your database connection script
include "connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the POST request
    $patientName = $_POST['patientName'];
    $nationalID = $_POST['nationalID'];
    $employeeId = $_POST['employeeId'];
    $appointmentDateTime = $_POST['appointmentDateTime'];

    // Set the appointment status (e.g., 'scheduled')
    $appointmentStatus = 'Scheduled';

    // Insert appointment data into the database
    $sql = "INSERT INTO appointments (patientName, nationalID, employeeId, appointmentDateTime, appointmentStatus) 
            VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($connection, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssss", $patientName, $nationalID, $employeeId, $appointmentDateTime, $appointmentStatus);

        if (mysqli_stmt_execute($stmt)) {
            // Appointment submitted successfully
            $response = array('success' => true);
            echo json_encode($response);
        } else {
            // Failed to submit appointment
            $response = array('success' => false, 'message' => 'Failed to submit appointment.');
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
