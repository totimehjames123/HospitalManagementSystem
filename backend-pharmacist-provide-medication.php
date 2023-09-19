<?php
session_start();
require_once('connect.php'); // Include your database connection script

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $patientName = $_POST["patientName"];
        $nationalID = $_POST["nationalID"];
        $employeeId = $_POST["employeeId"];
        $medicineName = $_POST["medicineName"];
        $quantity = $_POST["quantity"];

        if (!is_numeric($quantity)) {
            echo "Error: Quantity must be a numeric value.";
            exit(); // Stop further execution
        }

        // Query to get unitPrice from medicines table
        $sql = "SELECT unitPrice FROM medicines WHERE medicineName = '$medicineName'";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $unitPrice = (float)$row["unitPrice"]; // Cast to float
            $quantity = (int)$quantity; // Cast to integer
            $amountToBePaid = $unitPrice * $quantity;

            // Insert data into pharmacy table
            $insert_sql = "INSERT INTO pharmacy (patientName, nationalID, employeeId, medicineName, quantity, unitPrice, amountToBePaid)
                           VALUES ('$patientName', '$nationalID', '$employeeId', '$medicineName', '$quantity', '$unitPrice', '$amountToBePaid')";

            if ($connection->query($insert_sql) === TRUE) {
                echo "Record added successfully.";
            } else {
                echo "Error: " . $insert_sql . "<br>" . $connection->error;
            }
        } else {
            echo "Error: Medicine not found.";
        }

        $connection->close();
    }
} catch (Exception $e) {
    echo "An error occurred.";
}
?>
