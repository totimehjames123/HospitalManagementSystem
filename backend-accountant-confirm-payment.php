<?php
session_start();
require_once('connect.php'); // Include your database connection script

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = trim($_POST["id"]);
    $accountantId = trim($_POST["accountantId"]);

    // Check if either id or accountantId is empty after trimming
    if (empty($id) || empty($accountantId)) {
        echo "Error: ID or Accountant ID cannot be empty.";
        exit(); // Stop further execution
    }

    // Update payment status in the database
    $sql = "UPDATE pharmacy SET accountantID = '$accountantId', paidStatus = 'Paid' WHERE id = '$id'";
    
    if ($connection->query($sql) === TRUE) {
        echo "Payment confirmed successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }

    $connection->close();
}
?>
