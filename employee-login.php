<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include 'connect.php';

function getEmployeeDataAndStoreInSession($employeeId, $connection) {

    // Define the SQL query to fetch employee data
    $sql = "SELECT id, employeeId, employeeName, employeeStudentId, employeeEmail, country, 
            employeeHomeAddress, employeeGender, employeeJobTitle, employeeWorkStatus, 
            employeeTertiaryCompleted, employeeNationalId, employeePhoneNumber, 
            employeeProfilePicture, dateOfRegistration 
            FROM employees WHERE employeeId = ?";

    // Prepare the SQL statement
    $stmt = mysqli_prepare($connection, $sql);

    if ($stmt) {
        // Bind the parameter and execute the statement
        mysqli_stmt_bind_param($stmt, "s", $employeeId);
        if (mysqli_stmt_execute($stmt)) {
            // Bind the result variables
            mysqli_stmt_bind_result($stmt, $id, $employeeId, $employeeName, $employeeStudentId, 
                $employeeEmail, $country, $employeeHomeAddress, $employeeGender, 
                $employeeJobTitle, $employeeWorkStatus, $employeeTertiaryCompleted, 
                $employeeNationalId, $employeePhoneNumber, $employeeProfilePicture, 
                $dateOfRegistration);

            // Fetch the data
            if (mysqli_stmt_fetch($stmt)) {
                // Store the fetched data in a session
                session_start();
                $_SESSION['employeeId'] = $employeeId;
                $_SESSION['employeeName'] = $employeeName;
                $_SESSION['employeeStudentId'] = $employeeStudentId;
                $_SESSION['employeeEmail'] = $employeeEmail;
                $_SESSION['country'] = $country;
                $_SESSION['employeeHomeAddress'] = $employeeHomeAddress;
                $_SESSION['employeeGender'] = $employeeGender;
                $_SESSION['employeeJobTitle'] = $employeeJobTitle;
                $_SESSION['employeeWorkStatus'] = $employeeWorkStatus;
                $_SESSION['employeeTertiaryCompleted'] = $employeeTertiaryCompleted;
                $_SESSION['employeeNationalId'] = $employeeNationalId;
                $_SESSION['employeePhoneNumber'] = $employeePhoneNumber;
                $_SESSION['employeeProfilePicture'] = $employeeProfilePicture;
                $_SESSION['dateOfRegistration'] = $dateOfRegistration;
                
                // Close the statement
                mysqli_stmt_close($stmt);
                mysqli_close($connection);

                return true; // Data retrieved and stored successfully
            } else {
                // No data found for the given employeeId
                mysqli_stmt_close($stmt);
                mysqli_close($connection);

                return false;
            }
        } else {
            // Database error
            mysqli_stmt_close($stmt);
            mysqli_close($connection);

            return false;
        }
    } else {
        // Statement preparation error
        mysqli_close($connection);

        return false;
    }
}



try {
    // Assuming you have a 'login' PHP file that handles the login form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the submitted form data and sanitize inputs
        $employeeId = trim($_POST["employeeId"]);
        $employeePassword = $_POST["employeePassword"];
        echo $employeeId . " " . $employeePassword;

        // Check if the employeeId is not empty
        if (!empty($employeeId)) {
            // Prepare the SQL query to check if the employee exists in the database
            $sql = "SELECT * FROM employees WHERE employeeId = '$employeeId'";

            // Execute the query
            $result = $connection->query($sql);

            // Check if there is a matching row
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $storedPasswordHash = $row["employeePassword"];

                // Use password_verify to check if the entered password matches the hashed password
                if (password_verify($employeePassword, $storedPasswordHash)) {

                  $employeeJobTitle = $row["employeeJobTitle"];
                    

                  switch ($employeeJobTitle) {
                    case 'Doctor':
                      getEmployeeDataAndStoreInSession($employeeId, $connection);
                      header("Location: doctor-module.php");
                      break;
                    
                    case 'Nurse':
                      getEmployeeDataAndStoreInSession($employeeId, $connection);
                      header("Location: nurse-module.php");                    
                      break;

                    case 'Pharmacist':
                      getEmployeeDataAndStoreInSession($employeeId, $connection);
                      header("Location: pharmacist-module.php");
                      break;

                    case 'Laboratorist':
                      getEmployeeDataAndStoreInSession($employeeId, $connection);
                      header("Location: laboratorist-module.php");                     
                      break;
                    
                    case 'Accountant':
                      getEmployeeDataAndStoreInSession($employeeId, $connection);
                      header("Location: accountant-module.php");
                      break;
                     
                    default:
                      header("Location: login.php");
                      
                      break;
                  }

                  $_SESSION["employeeId"] = $employeeId;
                  $_SESSION["employeeName"] = $row["employeeName"];
                  $_SESSION["employeeEmail"] = $row["employeeEmail"];
                

                    echo "Login successful! Welcome back, " . $employeeId . "!";
                } else {
                    // Login failed, incorrect credentials
                    echo "Invalid login credentials. Please try again.";
                }
            } else {
                // Login failed, employee not found
                echo "Employee not found. Please check your credentials.";
            }
        } else {
            // Login failed, empty employeeId
            echo "Employee ID cannot be empty. Please provide a valid Employee ID.";
        }

        // Close the connection
        $connection->close();
    }
} catch (Exception $e) {
    echo "An error occurred. Try again!";
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee Login Page</title>
  <!-- Link to Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Link to Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="style.css">
  <style>
    /* Custom CSS for the gradient button */
    .btn-gradient-blue-violet {
      background-image: linear-gradient(to right, #3b82f6, #8b5cf6);
      color: #fff;
      border-color: #3b82f6;
    }

    .btn-gradient-blue-violet:hover {
      background-image: linear-gradient(to right, #3b82f6, #8b5cf6);
      color: #fff;
      border-color: #3b82f6;
    }

    /* Custom CSS to center the form */
    .centered-form {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh; /* Set the minimum height to the viewport height */
    }

    .centered-form .card {
      width: 100%;
      max-width: 400px;
    }
    .btn-focus {
      outline: none;
    }
  </style>
</head>
<body>
  <div class="centered-form bg-primary ">
    <div class="card border-none" style="border-radius: 50px;">
      <div class="card-body">
        <div class="text-center">
          <img src="logo.png" alt="lgog" width="80" height="80" class="pb-2">
        </div>
        <h2>Employee</h2>
        <h6 class="card-title">Login as an Employee</h6>
        <form action="employee-login.php" method="POST">
          <div class="form-group">
            <div class="input-group" style="height: 45px;">
              <div class="input-group-prepend">
                <span class="input-group-text btn-gradient-blue-violet"><i class="fas fa-envelope"></i></span>
              </div>
              <input style="height: 45px;" type="text" name="employeeId" class="form-control btn-focus" id="email" placeholder="Enter employee id" required>
            </div>
          </div>
          <div class="form-group">
            <div class="input-group" style="height: 45px;">
              <div class="input-group-prepend">
                <span class="input-group-text btn-gradient-blue-violet"><i class="fas fa-lock"></i></span>
              </div>
              <input style="height: 45px;" type="password" name="employeePassword" class="form-control btn-focus" id="password" placeholder="Enter your password" required>
            </div>
          </div>
          <div class="text-center">
            <button style="border-radius: 25px; height: 45px;" type="submit" class="btn btn-gradient-blue-violet text-white  w-25">Login</button>
          </div>
        </form>
    </div>
   
      
        <p class="mt-3 text-center">Not an employee? <a href="signup.html">Click here</a></p>
    </div>
  </div>
</body>
</html>
