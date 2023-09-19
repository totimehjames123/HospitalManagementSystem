<?php
session_start();
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $patientName = $_POST["patientName"];
    $nationalID = $_POST["nationalID"];
    $employeeId = $_POST["employeeId"];
    $diagnosticsDetails = $_POST["diagnosticsDetails"];
    
    // Upload Diagnostic Report
    $target_dir = "uploads/";
    $originalFileName = basename($_FILES["diagnosticsReport"]["name"]);
    $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
    $newFileName = uniqid() . '_' . time() . '.' . $fileExtension; // Unique file name
    
    $diagnosticsReport = $newFileName;
    move_uploaded_file($_FILES["diagnosticsReport"]["tmp_name"], $target_dir . $newFileName);

    // Update record in the database
    $sql = "UPDATE laboratory SET diagnosticsReport='$diagnosticsReport', diagnosticsDetails='$diagnosticsDetails', laboratoristId='$employeeId' WHERE id='$id'";
    
    if ($connection->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $connection->error;
    }
}

$connection->close();
?>
