<?php
session_start();
if(isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    $sql = "SELECT * FROM patients WHERE patientEmail='$email'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        // User exists in the database
    } else {
        // User does not exist in the database
        header("Location: user-register-as-patient.php");
        exit();
    }
} else {
    // User does not exist in the database
        header("Location: index.php");
        exit();
    // Email is not set in session, handle this case as needed
}

?>