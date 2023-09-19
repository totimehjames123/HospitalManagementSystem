<?php
session_start();
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patientName = $_POST["patientName"];
    $nationalID = $_POST["nationalID"];
    $employeeId = $_POST["employeeId"];
    $operationType = $_POST["operationType"];
    $record = $_POST["record"];
    
    
    // Insert data into patient_record table
    $sqlInsert = "INSERT INTO operation_record (patientName, nationalId, employeeId, operationType, record) 
    VALUES ('$patientName', '$nationalID', '$employeeId', '$operationType', '$record')";

    if ($connection->query($sqlInsert) === TRUE) {
        echo "Submitted successfully";
    }
}

$connection->close();
?>
