<?php
// Include your database connection script
include "connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the POST request
    $patientName = $_POST['patientName'];
    $nationalID = $_POST['nationalID'];
    $employeeId = $_POST['employeeId'];
    $serviceType = $_POST['serviceType'];

    // Insert operation request data into the database
    $sql = "INSERT INTO laboratory (patientName, nationalID, employeeId, serviceType) 
            VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($connection, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssss", $patientName, $nationalID, $employeeId, $serviceType);

        if (mysqli_stmt_execute($stmt)) {
            // Operation request submitted successfully
            $response = array('success' => true);
            echo json_encode($response);
        } else {
            // Failed to submit operation request
            $response = array('success' => false, 'message' => 'Failed to submit operation request.');
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
