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

    $create_admin_table_query = "CREATE TABLE IF NOT EXISTS admin (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        gender VARCHAR(255) NOT NULL,
        profilePicture VARCHAR(255) NOT NULL,
        role VARCHAR(255) DEFAULT 'admin',
        dateOfRegistration DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    );";

    if ($connection->query($create_admin_table_query) === TRUE) {
        // echo "Table 'users' created successfully.<br>";
    } else {
        // echo "Error creating table 'users': " . $connection->error;
        $connection->close();
        exit();
    }

    // SQL command to create the 'users' table
    $create_patients_table_query = "CREATE TABLE IF NOT EXISTS patients (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        patientName VARCHAR(50) NOT NULL,
        nationalID VARCHAR(255) NOT NULL UNIQUE,
        patientEmail VARCHAR(255) UNIQUE,
        mobileNumber VARCHAR(255),
        appointmentStatus ENUM('Requested', 'Not Requested') NOT NULL DEFAULT 'Not Requested',
        profilePicture VARCHAR(225) DEFAULT 'user.png',
        dateOfRegistration DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    );";

    if ($connection->query($create_patients_table_query) === TRUE) {
        // echo "Table 'patients' created successfully.<br>";
    } else {
        // echo "Error creating table 'patients': " . $connection->error;
        $connection->close();
        exit();
    }
    $create_appointments_table_query = "CREATE TABLE IF NOT EXISTS appointments (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        patientName VARCHAR(50) NOT NULL,
        nationalId VARCHAR(255) NOT NULL,
        employeeId VARCHAR(255),
        appointmentDateTime DATETIME NOT NULL,
        appointmentStatus ENUM('Scheduled', 'Canceled') NOT NULL DEFAULT 'Scheduled',
        createdDateTime DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    );";

    if ($connection->query($create_appointments_table_query) === TRUE) {
        // echo "Table 'patients' created successfully.<br>";
    } else {
        // echo "Error creating table 'patients': " . $connection->error;
        $connection->close();
        exit();
    }

    $create_medications_table_query = "CREATE TABLE IF NOT EXISTS medications (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        patientName VARCHAR(50) NOT NULL,
        nationalId VARCHAR(255) NOT NULL,
        employeeId VARCHAR(255),
        medicineName VARCHAR(255),
        dosage VARCHAR(255),
        frequency VARCHAR(255),
        notes VARCHAR(255),
        diseaseName VARCHAR(255),
        startDateTime DATETIME NOT NULL,
        endDateTime DATETIME NOT NULL,
        createdDateTime DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    );";

    if ($connection->query($create_medications_table_query) === TRUE) {
        // echo "Table 'patients' created successfully.<br>";
    } else {
        // echo "Error creating table 'patients': " . $connection->error;
        $connection->close();
        exit();
    }

    $create_patient_record_table_query = "CREATE TABLE IF NOT EXISTS patient_record (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        patientName VARCHAR(50) NOT NULL,
        nationalId VARCHAR(255) NOT NULL,
        employeeId VARCHAR(255),
        temperature VARCHAR(255),
        bloodPressure VARCHAR(255),
        weight VARCHAR(255),
        height VARCHAR(255),
        sugarLevel VARCHAR(255),
        other VARCHAR(255),
        wardName VARCHAR(255),
        medicatedStatus VARCHAR(255) DEFAULT 'none',
        createdDateTime DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    );";

    if ($connection->query($create_patient_record_table_query) === TRUE) {
        // echo "Table 'patients' created successfully.<br>";
    } else {
        // echo "Error creating table 'patients': " . $connection->error;
        $connection->close();
        exit();
    }
    $create_operation_record_table_query = "CREATE TABLE IF NOT EXISTS operation_record (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        patientName VARCHAR(50) NOT NULL,
        nationalId VARCHAR(255) NOT NULL,
        employeeId VARCHAR(255),
        operationType VARCHAR(255),
        record VARCHAR(255),
        createdDateTime DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    );";

    if ($connection->query($create_operation_record_table_query) === TRUE) {
        // echo "Table 'patients' created successfully.<br>";
    } else {
        // echo "Error creating table 'patients': " . $connection->error;
        $connection->close();
        exit();
    }

    $create_operations_table_query = "CREATE TABLE IF NOT EXISTS operations (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        patientName VARCHAR(50) NOT NULL,
        nationalId VARCHAR(255) NOT NULL,
        employeeId VARCHAR(255),
        operationType VARCHAR(255),
        requestStatus ENUM('Pending', 'Accepted', 'Rejected', 'Canceled') NOT NULL DEFAULT 'Pending',
        notes VARCHAR(255),
        operationReport TEXT,
        startDateTime DATETIME NOT NULL,
        createdDateTime DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    );";

    if ($connection->query($create_operations_table_query) === TRUE) {
        // echo "Table 'patients' created successfully.<br>";
    } else {
        // echo "Error creating table 'patients': " . $connection->error;
        $connection->close();
        exit();
    }

    $create_laboratory_table_query = "CREATE TABLE IF NOT EXISTS laboratory (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        patientName VARCHAR(50) NOT NULL,
        nationalId VARCHAR(255) NOT NULL,
        employeeId VARCHAR(255),
        serviceType VARCHAR(255),
        requestStatus ENUM('Pending', 'Accepted', 'Rejected', 'Canceled') NOT NULL DEFAULT 'Pending',
        diagnosticsDetails TEXT,
        diagnosticsReport TEXT,
        laboratoristId VARCHAR(255),
        createdDateTime DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    );";

    if ($connection->query($create_laboratory_table_query) === TRUE) {
        // echo "Table 'patients' created successfully.<br>";
    } else {
        // echo "Error creating table 'patients': " . $connection->error;
        $connection->close();
        exit();
    }

    $create_pharmacy_table_query = "CREATE TABLE IF NOT EXISTS pharmacy (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        patientName VARCHAR(50) NOT NULL,
        nationalId VARCHAR(255) NOT NULL,
        employeeId VARCHAR(255),
        medicineName VARCHAR(255),
        quantity INT NOT NULL,
        unitPrice DECIMAL(10, 2) DEFAULT 0.00,
        amountToBePaid DECIMAL(10, 2) DEFAULT 0.00,
        accountantId VARCHAR(255),
        paidStatus ENUM('Not Paid', 'Paid') NOT NULL DEFAULT 'Not Paid',
        createdDateTime DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    );";

    if ($connection->query($create_pharmacy_table_query) === TRUE) {
        // echo "Table 'patients' created successfully.<br>";
    } else {
        // echo "Error creating table 'patients': " . $connection->error;
        $connection->close();
        exit();
    }

    $create_wards_table_query = "CREATE TABLE IF NOT EXISTS wards (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        wardName VARCHAR(50) NOT NULL UNIQUE,
        wardType VARCHAR(255) NOT NULL,
        numberOfBeds INT NOT NULL,
        availableBeds INT DEFAULT 0,
        occupiedBeds INT DEFAULT 0,
        nurseInCharge VARCHAR(255) NOT NULL,
        nurseId VARCHAR(255) NOT NULL,
        buildingName VARCHAR(255) NOT NULL,
        dateOfRegistration DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    );";

    if ($connection->query($create_wards_table_query) === TRUE) {
        // echo "Table 'patients' created successfully.<br>";
    } else {
        // echo "Error creating table 'patients': " . $connection->error;
        $connection->close();
        exit();
    }

    $create_medicines_table_query = "CREATE TABLE IF NOT EXISTS medicines (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        medicineName VARCHAR(50) NOT NULL UNIQUE,
        quantity INT NOT NULL,
        availableMedicines INT DEFAULT 0,
        purchasedMedicines INT DEFAULT 0,
        unitPrice DECIMAL(10, 2) NOT NULL DEFAULT 0.00, 
        totalPrice DECIMAL(10, 2) DEFAULT 0.00,
        amountPurchased DECIMAL(10, 2) DEFAULT 0.00,
        amountLeft DECIMAL(10, 2) DEFAULT 0.00,
        pharmacistWhoCreated VARCHAR(255) NOT NULL,
        expiryDate DATE NOT NULL,
        dateOfRegistration DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    );";
    
    
    try {
        // Create the medicines table
        if ($connection->query($create_medicines_table_query) === TRUE) {
            // echo "Table 'medicines' created successfully.<br>";
        } else {
            // echo "Error creating table 'medicines': " . $connection->error;
        }

    
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    $create_employee_table_query = "CREATE TABLE IF NOT EXISTS employees (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        employeeId VARCHAR(255) UNIQUE NOT NULL,
        employeePassword VARCHAR(255) NOT NULL,
        employeeName VARCHAR(255) NOT NULL,
        employeeStudentId VARCHAR(20) UNIQUE NOT NULL,
        employeeEmail VARCHAR(255) UNIQUE NOT NULL,
        country VARCHAR(100) NOT NULL,
        employeeHomeAddress VARCHAR(255) NOT NULL,
        employeeGender VARCHAR(20) NOT NULL,
        employeeJobTitle VARCHAR(255) NOT NULL,
        employeeWorkStatus VARCHAR(50) NOT NULL,
        employeeTertiaryCompleted VARCHAR(255) NOT NULL,
        employeeNationalId VARCHAR(50) UNIQUE NOT NULL,
        employeePhoneNumber VARCHAR(20) NOT NULL,
        employeeProfilePicture VARCHAR(255) NOT NULL,
        dateOfRegistration DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
    )";
    
    if ($connection->query($create_employee_table_query) === TRUE) {
        // echo "Table 'employees' created successfully!";
    } else {
        // echo "Error creating table: " . $conn->error;
    }

}
catch (Exception $e){
    echo $e;
}



// Close the connection
// $connection->close();
?>
