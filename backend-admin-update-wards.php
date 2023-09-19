<?php
include "connect.php";
// Check if all required fields are present in the POST data
if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
) {
    // Sanitize and validate input data
    $id = intval($_POST['id']);
    $wardName = mysqli_real_escape_string($connection, $_POST['wardName']);
    $wardType = mysqli_real_escape_string($connection, $_POST['wardType']);
    $numberOfBeds = intval($_POST['numberOfBeds']);
    $availableBeds = intval($_POST['availableBeds']);
    $occupiedBeds = intval($_POST['occupiedBeds']);
    $nurseInCharge = mysqli_real_escape_string($connection, $_POST['nurseInCharge']);
    $nurseId = mysqli_real_escape_string($connection, $_POST['nurseId']);
    $buildingName = mysqli_real_escape_string($connection, $_POST['buildingName']);

    if ($id == null){
        $response = array('status' => 'error', 'message' => 'Missing required fields.');
        echo json_encode($response);
    }
    else{
        // Update the ward's table
        $sql = "UPDATE wards SET 
        wardName = '$wardName',
        wardType = '$wardType',
        numberOfBeds = $numberOfBeds,
        availableBeds = $availableBeds,
        occupiedBeds = $occupiedBeds,
        nurseInCharge = '$nurseInCharge',
        nurseId = '$nurseId',
        buildingName = '$buildingName'
        WHERE id = $id";

        if (mysqli_query($connection, $sql)) {
        $response = array('status' => 'success', 'message' => 'Ward information updated successfully.');
        echo json_encode($response);
        } else {
        $response = array('status' => 'error', 'message' => 'Error updating ward information: ' . mysqli_error($connection));
        echo json_encode($response);
        }

    }
    
    // Close the database connectionection
    mysqli_close($connection);
} else {
    $response = array('status' => 'error', 'message' => 'Missing required fields.');
    echo json_encode($response);
}
?>
