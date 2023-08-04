<?php
include 'connect.php';

// Create databases
$databases = ['users', 'employee', 'doctors', 'nurses', 'pharmacist'];

foreach ($databases as $db) {
    $sqlCreateDatabase = "CREATE DATABASE IF NOT EXISTS $db";

    if ($conn->query($sqlCreateDatabase) === TRUE) {
        echo "Database '$db' created successfully\n";

        // Connect to the newly created database
        $dbConnection = new mysqli($servername, $username, $password, $db);

        // Check connection
        if ($dbConnection->connect_error) {
            die("Connection to database '$db' failed: " . $dbConnection->connect_error);
        }

        // Create tables for each database
        if ($db === 'users') {
            // Table for users database
            $sqlCreateTable = "CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(50) NOT NULL,
                email VARCHAR(100) NOT NULL,
                password VARCHAR(255) NOT NULL,
                gender VARCHAR(10) NOT NULL,
                country VARCHAR(50) NOT NULL,
                profile_image VARCHAR(255)
            )";
        } elseif ($db === 'employee') {
            // Table for employee database
            $sqlCreateTable = "CREATE TABLE IF NOT EXISTS employee (
                id INT AUTO_INCREMENT PRIMARY KEY,
                employee_name VARCHAR(100) NOT NULL,
                department VARCHAR(50) NOT NULL,
                employee_type VARCHAR(20) NOT NULL,
                salary DECIMAL(10, 2) NOT NULL
            )";
        } elseif ($db === 'doctors') {
            // Table for doctors database
            $sqlCreateTable = "CREATE TABLE IF NOT EXISTS doctors (
                id INT AUTO_INCREMENT PRIMARY KEY,
                doctor_name VARCHAR(100) NOT NULL,
                specialization VARCHAR(100) NOT NULL,
                experience_years INT NOT NULL
            )";
        } elseif ($db === 'nurses') {
            // Table for nurses database
            $sqlCreateTable = "CREATE TABLE IF NOT EXISTS nurses (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nurse_name VARCHAR(100) NOT NULL,
                department VARCHAR(50) NOT NULL,
                experience_years INT NOT NULL
            )";
        } elseif ($db === 'pharmacist') {
            // Table for pharmacist database
            $sqlCreateTable = "CREATE TABLE IF NOT EXISTS pharmacist (
                id INT AUTO_INCREMENT PRIMARY KEY,
                pharmacist_name VARCHAR(100) NOT NULL,
                license_number VARCHAR(50) NOT NULL,
                experience_years INT NOT NULL
            )";
        } else {
            // Handle other databases if needed
            $sqlCreateTable = ""; // Empty string if no specific table for the database
        }

        if ($dbConnection->query($sqlCreateTable) === TRUE) {
            echo "Table for '$db' database created successfully\n";
        } else {
            echo "Error creating table for '$db': " . $dbConnection->error . "\n";
        }

        // Close the connection for each database
        $dbConnection->close();
    } else {
        echo "Error creating database '$db': " . $conn->error . "\n";
    }
}

// Close the connection
$conn->close();
?>
