<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form data
    $wardName = isset($_POST['wardName']) ? trim($_POST['wardName']) : '';
    $wardType = isset($_POST['wardType']) ? trim($_POST['wardType']) : '';
    $numberOfBeds = isset($_POST['numberOfBeds']) ? trim($_POST['numberOfBeds']) : '';
    $nurseInCharge = isset($_POST['nurseInCharge']) ? trim($_POST['nurseInCharge']) : '';
    $nurseId = isset($_POST['nurseId']) ? trim($_POST['nurseId']) : '';
    $buildingName = isset($_POST['buildingName']) ? trim($_POST['buildingName']) : '';

    // Define an array of required fields
    $requiredFields = [
        'wardName',
        'wardType',
        'numberOfBeds',
        'nurseInCharge',
        'nurseId',
        'buildingName'
    ];

    // Initialize an array to store any missing fields
    $missingFields = [];

    // Check each field for emptiness
    foreach ($requiredFields as $field) {
        if (empty($$field)) {
            $missingFields[] = $field;
        }
    }

    // If there are missing fields, return an error response
    if (!empty($missingFields)) {
        $response = [
            'status' => 'error',
            'message' => 'Please fill in all required fields: ' . implode(', ', $missingFields)
        ];
        http_response_code(400); // Bad Request
        echo json_encode($response);
        exit;
    }



    // Include your database connection code from "connect.php"
    include "connect.php";

    try {
        // Prepare the SQL query with placeholders
        $sql = "INSERT INTO wards (wardName, wardType, numberOfBeds, availableBeds, nurseInCharge, nurseId, buildingName)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

        // Prepare the statement
        $stmt = $connection->prepare($sql);

        if (!$stmt) {
            throw new Exception("Error preparing statement: " . $connection->error);
        }

        // Bind parameters to the statement
        $stmt->bind_param('sssssss', $wardName, $wardType, $numberOfBeds, $numberOfBeds, $nurseInCharge, $nurseId, $buildingName);

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
