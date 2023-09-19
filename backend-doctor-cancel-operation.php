<?php
// Include your database connection script
include "connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the operation ID to be canceled from the POST request
    $operationId = $_POST['id'];

    // Update the operation status to 'canceled'
    $sql = "UPDATE operations SET requestStatus = 'Canceled' WHERE id = ?";

    $stmt = mysqli_prepare($connection, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $operationId);

        if (mysqli_stmt_execute($stmt)) {
            // operation canceled successfully
            $response = array('success' => true, 'message' => 'operation canceled.');
            echo json_encode($response);
        } else {
            // Failed to cancel operation
            $response = array('success' => false, 'message' => 'Failed to cancel operation.');
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
