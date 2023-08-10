<?php
session_start(); // Start or resume the session

function generateVerificationCode($length = 4) {
    $characters = '0123456789';
    $code = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $code;
}

$verificationCode = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Generate a four-digit verification code
    $verificationCode = generateVerificationCode();

    // Store the verification code in the session
    $_SESSION["verification_code"] = $verificationCode;

    // Assuming you have a function to send an email
    $to = $_POST["email"];
    $subject = "Forgot Password Verification Code";
    $message = "Your verification code is: " . $verificationCode;
    $from = "your_email@example.com"; // Change this to a valid sender email
    mail($to, $subject, $message, "From: $from");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password</title>
  <!-- Link to Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Link to Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="style.css">
  <style>
  /* Custom CSS for the gradient button */
  /* ... (your existing CSS styles) ... */

  /* Custom CSS to center the form */
  .centered-form {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-image: url('background.webp');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    position: relative; /* Add this to make sure child elements are positioned relative to this container */
  }

  /* Transparent overlay div */
  .transparent {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7); /* Set the background color to transparent black */
  }

  .centered-form .card {
    width: 100%;
    max-width: 400px;
  }
</style>


</head>

<body>
  <div class="transparent">
  <div class="centered-form">
    <div class="card bg-primary"  style="border-radius: 30px;">
      <div class="card-body ">
        <div class="text-center pb-4 ">
          <img src="logo.png" alt="logo" width="80" height="80">
        </div>
        <h4 class="card-title text-white">Forgot Password?</h4>
        <form>
          <div class="form-group ">
            <div class="input-group" style="height: 45px;">
              <div class="input-group-prepend ">
                <span class="input-group-text bg-warning text-dark"><i class="fas fa-user"></i></span>
              </div>
              <input type="text" style="height: 45px; " class="form-control" id="username" placeholder="Enter your username" required>
            </div>
          </div>
          <div class="form-group">
            <div class="input-group" style="height: 45px">
              <div class="input-group-prepend">
                <span class="input-group-text bg-warning"><i class="fas fa-envelope"></i></span>
              </div>
              <input type="email" style="height: 45px;" class="form-control" id="email" placeholder="Enter your email" required>
            </div>
          </div>
          <div class="text-center">
            <button style="border-radius: 25px; height: 45px;" type="submit" class="btn btn-warning text-white  w-25">Submit</button>
          </div>
        </form>
        <p class="mt-3 text-center "><a href="login.php" class="text-warning" >Back to Login</a></p>
        <p class="mt-3 text-center text-white ">Don't have an account? <a href="signup.php" class="text-warning">Sign up here</a></p>
      </div>
    </div>
  </div>
  </div>
</body>

</html>
