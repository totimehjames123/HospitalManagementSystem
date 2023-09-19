<?php
// Include your database connection script
include "connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the POST request
    $patientName = $_POST['patientName'];
    $nationalID = $_POST['nationalID'];
    $employeeId = $_POST['employeeId'];
    $medicineName = $_POST['medicineName'];
    $dosage = $_POST['dosage'];
    $frequency = $_POST['frequency'];
    $diseaseName = $_POST['diseaseName'];
    $notes = $_POST['notes'];
    $startDateTime = $_POST['startDateTime'];
    $endDateTime = $_POST['endDateTime'];

    // Insert medication data into the database
    $sql = "INSERT INTO medications (patientName, nationalId, employeeId, medicineName, dosage, frequency, diseaseName, notes, startDateTime, endDateTime) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($connection, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssssssss", $patientName, $nationalID, $employeeId, $medicineName, $dosage, $frequency, $diseaseName, $notes, $startDateTime, $endDateTime);

        if (mysqli_stmt_execute($stmt)) {
            // Medication data submitted successfully
            $response = array('success' => true, 'message' => 'Medication data submitted successfully.');
            echo json_encode($response);
        } else {
            // Failed to submit medication data
            $response = array('success' => false, 'message' => 'Failed to submit medication data.');
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
