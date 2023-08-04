<?php
// Replace these with your actual database credentials
$db_host = "localhost";
$db_user = "root";
$db_password = "";

// Assuming 'database' is the variable containing the desired database name
$database = "hospital_management_system";

try{
    // Create a connection to MySQL server
    $connection = new mysqli($db_host, $db_user, $db_password);

    // Check the connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // SQL command to create the database using the variable 'database'
    $create_db_query = "CREATE DATABASE IF NOT EXISTS $database;";
    if ($connection->query($create_db_query) === TRUE) {
        // echo "Database '$database' created successfully or already exists.<br>";
    } else {
        echo "Error creating database: " . $connection->error;
        $connection->close();
        exit();
    }

    // Select the created database
    $connection->select_db($database);

    // SQL command to create the 'users' table
    $create_users_table_query = "CREATE TABLE IF NOT EXISTS users (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        gender VARCHAR(255) NOT NULL,
        country VARCHAR(255) NOT NULL,
        profilePicture VARCHAR(255) NOT NULL,
        dateOfRegistration DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    );";

    if ($connection->query($create_users_table_query) === TRUE) {
        // echo "Table 'users' created successfully.<br>";
    } else {
        // echo "Error creating table 'users': " . $connection->error;
        $connection->close();
        exit();
    }

}
catch (Exception $e){

}



// Close the connection
// $connection->close();
?>
