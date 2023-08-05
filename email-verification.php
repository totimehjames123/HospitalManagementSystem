<?php
  session_start();
  include 'connect.php';

  echo $_SESSION['verificationCode'];
  

  if ($_SERVER["REQUEST_METHOD"] === "POST"){
    if ($_POST["emailVerificationCode"] == $_SESSION['verificationCode']){
      echo "same";
      
      

    }
    else {
      echo "not same";

    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Email verification</title>
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
        <div class="text-center p-3">
          <img src="logo.png" alt="lgog" width="80" height="80" class="pb-2">
        </div>
        <h4 class="card-title ">Email verification</h4>
        <small class="">We've sent you a 6 digit verification code through your email.</small> 
        <p class="mb-3"></p>
        <form action="email-verification.php" method="post">
          <div class="form-group">
            <div class="input-group" style="height: 45px;">
              <div class="input-group-prepend">
                <span class="input-group-text btn-gradient-blue-violet"><i class="fas fa-envelope"></i></span>
              </div>
              <input style="height: 45px;" type="number" class="form-control btn-focus" id="emailVerificationCode" name="emailVerificationCode" placeholder="Enter verification code" required>
            </div>
          </div>
          
          <div class="text-center">
            <button style="border-radius: 25px; height: 45px;" type="submit" class="btn btn-gradient-blue-violet text-white  w-25">Verify</button>
          </div>
        </form>
        <p class="mt-3 text-center">Haven't recieved any code?<a href="email-verification.php"> Resend</a></p>
      </div>
    </div>
  </div>
</body>
</html>
