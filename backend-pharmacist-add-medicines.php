<?php
session_start(); // Start the session (if not already started)
include "connect.php";
try{
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Connect to the database (assuming you already have a connection)
        // ...

        // Sanitize and get form data
        $medicineName = mysqli_real_escape_string($connection, $_POST['medicineName']);
        $quantity = $_POST['quantity'];
        $unitPrice = $_POST['unitPrice'];
        $expiryDate = $_POST['expiryDate'];
        $employeeId = $_POST['employeeId'];

        //compute
        $totalPrice = $unitPrice * $quantity;


        // Insert data into the database
        $insert_query = "INSERT INTO medicines (medicineName, quantity, availableMedicines, unitPrice, totalPrice, amountLeft, pharmacistWhoCreated, expiryDate) 
                        VALUES ('$medicineName', $quantity, $quantity, $unitPrice, $totalPrice, $totalPrice, '$employeeId', '$expiryDate')";

        if (mysqli_query($connection, $insert_query)) {
            echo "Medicine added successfully!";
        } else {
            echo "Duplicate entry for medicine";
        }

        // Close the database connection
        mysqli_close($connection);
    }
}
catch (Exception $e){
    echo $e->getMessage();
}

?>
