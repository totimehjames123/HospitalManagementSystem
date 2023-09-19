<?php
include "connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];

    // Check if the profilePicture field is empty
    if (!empty($_FILES['profilePicture']['name'])) {
        // Handle profile picture upload
        $targetDirectory = 'uploads/';
        $fileExtension = pathinfo($_FILES['profilePicture']['name'], PATHINFO_EXTENSION);
        $uniqueFilename = uniqid() . '.' . $fileExtension;
        $targetFilePath = $targetDirectory . $uniqueFilename;

        if (!move_uploaded_file($_FILES['profilePicture']['tmp_name'], $targetFilePath)) {
            http_response_code(500); // Internal Server Error
            echo json_encode(array('message' => 'Failed to upload profile picture.'));
            exit;
        }
    } else {
        // Profile picture was not chosen, set $uniqueFilename to NULL
        $uniqueFilename = NULL;
    }

    // Define your SQL query for updating the data
    $sql = "UPDATE admin SET username = ?, email = ?, gender = ?";
    
    // Add profilePicture to the query if it's not NULL
    if ($uniqueFilename !== NULL) {
        $sql .= ", profilePicture = ?";
    }

    $sql .= " WHERE id=1";

    // Execute the query
    $stmt = mysqli_prepare($connection, $sql);
    if (!$stmt) {
        http_response_code(500); // Internal Server Error
        echo json_encode(array('message' => 'Database error.'));
        exit;
    }

    // Bind parameters
    if ($uniqueFilename !== NULL) {
        mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $gender, $uniqueFilename);
    } else {
        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $gender);
    }

    if (mysqli_stmt_execute($stmt)) {
        http_response_code(200); // OK
        echo json_encode(array('message' => 'Data updated successfully.'));
    } else {
        http_response_code(500); // Internal Server Error
        echo json_encode(array('message' => 'Failed to update data.'));
    }

    // Close the database connection
    mysqli_stmt_close($stmt);
    mysqli_close($connection);
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(array('message' => 'Method not allowed.'));
}
?>
