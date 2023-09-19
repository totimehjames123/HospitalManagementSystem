<?php
// Include your database connection script
include "connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the laboratory ID to be canceled from the POST request
    $laboratory = $_POST['id'];

    // Update the laboratory status to 'canceled'
    $sql = "UPDATE laboratory SET requestStatus = 'Canceled' WHERE id = ?";

    $stmt = mysqli_prepare($connection, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $laboratory);

        if (mysqli_stmt_execute($stmt)) {
            // laboratory canceled successfully
            $response = array('success' => true, 'message' => 'laboratory canceled.');
            echo json_encode($response);
        } else {
            // Failed to cancel laboratory
            $response = array('success' => false, 'message' => 'Failed to cancel laboratory.');
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
