<?php
session_start();
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patientName = $_POST["patientName"];
    $nationalID = $_POST["nationalID"];
    $employeeId = $_POST["employeeId"];
    $temperature = $_POST["temperature"];
    $bloodPressure = $_POST["bloodPressure"];
    $weight = isset($_POST["weight"]) ? $_POST["weight"] : null;
    $height = isset($_POST["height"]) ? $_POST["height"] : null;
    $sugarLevel = isset($_POST["sugarLevel"]) ? $_POST["sugarLevel"] : null;
    $other = isset($_POST["other"]) ? $_POST["other"] : null;
    $wardName = isset($_POST["wardName"]) ? $_POST["wardName"] : null;

    if (!empty($wardName)) {
        // Insert data into patient_record table
        $sqlInsert = "INSERT INTO patient_record (patientName, nationalID, employeeId, temperature, bloodPressure, weight, height, sugarLevel, other, wardName) 
                      VALUES ('$patientName', '$nationalID', '$employeeId', '$temperature', '$bloodPressure', '$weight', '$height', '$sugarLevel', '$other', '$wardName')";
        
        if ($connection->query($sqlInsert) === TRUE) {
            // Update wards table
            $sqlUpdate = "UPDATE wards SET availableBeds = availableBeds - 1, occupiedBeds = numberOfBeds - availableBeds WHERE wardName = '$wardName'";
            
            if ($connection->query($sqlUpdate) === TRUE) {
                echo "Record added successfully";
            } else {
                echo "Error updating wards table: " . $connection->error;
            }
        } else {
            echo "Error adding record: " . $connection->error;
        }
    } else {
        $sqlInsert = "INSERT INTO patient_record (patientName, nationalID, employeeId, temperature, bloodPressure, weight, height, sugarLevel, other, wardName) 
                      VALUES ('$patientName', '$nationalID', '$employeeId', '$temperature', '$bloodPressure', '$weight', '$height', '$sugarLevel', '$other', '$wardName')";
                      if ($connection->query($sqlInsert) === TRUE) {
                        echo "Submitted with no ward or bed.";
                      }
                      else{
                        echo "Couln't update.";
                      }
    }
}

$connection->close();
?>
