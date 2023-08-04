<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Capture form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $gender = $_POST["gender"];
    $country = $_POST["country"];

    // Image upload handling
    $profileImage = null;
    if ($_FILES["profile-image"]["error"] === UPLOAD_ERR_OK) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["profile-image"]["name"]);
        move_uploaded_file($_FILES["profile-image"]["tmp_name"], $targetFile);
        $profileImage = $targetFile;
    }

    // Insert data into the database
    $servername = "your_servername";
    $username_db = "your_username";
    $password_db = "your_password";
    $dbname = "my_database";

    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO users (username, email, password, gender, country, profile_image)
            VALUES ('$username', '$email', '$password', '$gender', '$country', '$profileImage')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
