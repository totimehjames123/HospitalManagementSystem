<?php
// Include your database connection script
include "connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the POST request
    $patientName = $_POST['patientName'];
    $nationalID = $_POST['nationalID'];
    $employeeId = $_POST['employeeId'];
    $operationReport = $_POST['operationReport'];

    // Check if a user with the given nationalID exists
    $checkUserQuery = "SELECT * FROM operations WHERE nationalID = '$nationalID'";
    $checkUserResult = mysqli_query($connection, $checkUserQuery);

    if (mysqli_num_rows($checkUserResult) > 0) {
        // User with the given nationalID found, update the operation report
        $updateOperationQuery = "UPDATE operations SET operationReport = '$operationReport' WHERE nationalId = '$nationalID'";
        $updateOperationResult = mysqli_query($connection, $updateOperationQuery);

        if ($updateOperationResult) {
            // Operation report updated successfully
            $response = array('success' => true, 'message' => 'Operation report updated successfully.');
            echo json_encode($response);
        } else {
            // Failed to update operation report
            $response = array('success' => false, 'message' => 'Failed to update operation report.');
            echo json_encode($response);
        }
    } else {
        // No user with the given nationalID found
        $response = array('success' => false, 'message' => 'No user found with the provided National ID.');
        echo json_encode($response);
    }

    mysqli_close($connection);
} else {
    // Invalid request method
    $response = array('success' => false, 'message' => 'Invalid request method.');
    echo json_encode($response);
}
?>
