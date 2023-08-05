<?php
  session_start();
  include "connect.php";

  if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
  }

  $errorMessage = "";
  
  try{
    if ($_SERVER["REQUEST_METHOD"] === "POST"){
      if ($_POST["newPassword"] === $_POST["confirmNewPassword"]){
  
        // Retrieve user data from session variables
        $username = $_SESSION['username'];
        $email = $_SESSION['email'];
        $password = password_hash($connection->real_escape_string($_POST["newPassword"]), PASSWORD_BCRYPT);
        $gender = $_SESSION['gender'];
        $country = $_SESSION['country'];
        $profilePicture = $_SESSION['profilePicture'];
  
        // Prepare the SQL query with placeholders
        $sql = "INSERT INTO users (username, email, password, gender, country, profilePicture)
                VALUES (?, ?, ?, ?, ?, ?)";
  
        // Prepare the statement
        $stmt = $connection->prepare($sql);
  
        // Bind parameters to the statement
        $stmt->bind_param('ssssss', $username, $email, $password, $gender, $country, $profilePicture);
  
        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to a success page or perform other actions after successful insertion
            header('Location: signup-congratulations.php');
            exit();
        } else {
            // Handle the error if the insertion fails
            $errorMessage = "Error: Failed to submit";
        }
  
        // Close the statement and connection
        $stmt->close();
        $connection->close();
        
      }
      else{
        $errorMessage = "Passwords does not match!";
      }
    }
  
  }
  catch(Exception $e){
    $errorMessage = "An error occured. Try again!" ;
  }
  

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
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
        <div class="text-center pb-3">
          <img src="logo.png" alt="lgog" width="80" height="80" >
        </div>
        <h4 class="card-title ">Set a Password</h4>
        <form action="user-set-password.php" method="post">
          <small class="text-danger">
            <?php 
              echo $errorMessage;
            ?>
          </small>
          <div class="form-group">
            <div class="input-group" style="height: 45px;">
              <div class="input-group-prepend">
                <span class="input-group-text btn-gradient-blue-violet"><i class="fas fa-lock"></i></span>
              </div>
              <input style="height: 45px;" type="password" class="form-control btn-focus" id="newpassword" name="newPassword" placeholder="Enter new password" required>
            </div>
          </div>
          <div class="form-group">
            <div class="input-group" style="height: 45px;">
              <div class="input-group-prepend">
                <span class="input-group-text btn-gradient-blue-violet"><i class="fas fa-lock"></i></span>
              </div>
              <input style="height: 45px;" type="password" class="form-control btn-focus" id="confirmpassword" name="confirmNewPassword" placeholder="Confirm new password" required>
            </div>
          </div>
          <div class="text-center">
            <button style="border-radius: 25px; height: 45px;" type="submit" class="btn btn-gradient-blue-violet text-white  w-25">Next</button>
          </div>
        </form>
        <p class="mt-3 text-center"><a href="forget-password.html">Forgot Password?</a></p>
        <p class="mt-3 text-center">Already have an account? <a href="login.php">Login</a></p>
      </div>
    </div>
  </div>
</body>
</html>
