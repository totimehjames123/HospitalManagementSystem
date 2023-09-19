<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form data
    $patientName = isset($_POST['patientName']) ? trim($_POST['patientName']) : '';
    $nationalID = isset($_POST['nationalID']) ? trim($_POST['nationalID']) : '';
    $patientEmail = isset($_POST['patientEmail']) ? trim($_POST['patientEmail']) : '';
    $mobileNumber = isset($_POST['mobileNumber']) ? trim($_POST['mobileNumber']) : '';
    $patientProfilePicture = isset($_POST['patientProfilePicture']) ? trim($_POST['patientProfilePicture']) : '';

    // Validate required fields
    if (empty($patientName)){
        // Return an error response
        $response = [
            'status' => 'error',
            'message' => 'Please fill in all required fields.'
        ];
        http_response_code(400); // Bad Request
        echo json_encode($response);
        exit;
    }

    

    // Include your database connection code from "connect.php"
    include "connect.php";

    if (!empty($patientEmail)){
        try {
            // Prepare the SQL query with placeholders
            $sql = "INSERT INTO patients (patientName, nationalID, patientEmail, mobileNumber, profilePicture)
            VALUES (?, ?, ?, ?, ?)";
    
            // Prepare the statement
            $stmt = $connection->prepare($sql);
    
            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $connection->error);
            }
    
            // Bind parameters to the statement
            $stmt->bind_param('sssss', $patientName, $nationalID, $patientEmail , $mobileNumber, $patientProfilePicture);
    
            // Execute the statement
            if ($stmt->execute()) {
                // Return a success response
                $response = [
                    'status' => 'success',
                    'message' => 'Form submitted successfully!'
                ];
                echo json_encode($response);
            } else {
                throw new Exception("Error executing statement: " . $stmt->error);
            }
    
            // Close the statement and connection
            $stmt->close();
            $connection->close();
        } catch (Exception $e) {
            // Handle exceptions and return an error response
            $response = [
                'status' => 'error',
                'message' => 'An error occurred while submitting the form: ' . $e->getMessage()
            ];
            http_response_code(500); // Internal Server Error
            echo json_encode($response);
        }
    }
    else{
        try {
            // Prepare the SQL query with placeholders
            $sql = "INSERT INTO patients (patientName, nationalID, mobileNumber, profilePicture)
            VALUES (?, ?, ?, ?)";
    
            // Prepare the statement
            $stmt = $connection->prepare($sql);
    
            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $connection->error);
            }
    
            // Bind parameters to the statement
            $stmt->bind_param('ssss', $patientName, $nationalID , $mobileNumber, $patientProfilePicture);
    
            // Execute the statement
            if ($stmt->execute()) {
                // Return a success response
                $response = [
                    'status' => 'success',
                    'message' => 'Form submitted successfully!'
                ];
                echo json_encode($response);
            } else {
                throw new Exception("Error executing statement: " . $stmt->error);
            }
    
            // Close the statement and connection
            $stmt->close();
            $connection->close();
        } catch (Exception $e) {
            // Handle exceptions and return an error response
            $response = [
                'status' => 'error',
                'message' => 'An error occurred while submitting the form: ' . $e->getMessage()
            ];
            http_response_code(500); // Internal Server Error
            echo json_encode($response);
        }
    }
} else {
    // Return an error for invalid request method
    $response = [
        'status' => 'error',
        'message' => 'Invalid request method.'
    ];
    http_response_code(405); // Method Not Allowed
    echo json_encode($response);
}
?>
