<?php
  if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User preferred password Page</title>
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
  <div class="centered-form">
    <div class="card border-0" style="border-radius: 50px;">
      <div class="card-body">
        <div class="text-center p-4">
          <i class="fa fa-check-circle fa-3x text-success"></i>
        </div>
        <h2 class="text-center">Congratulations!!!</h2>
        <div class="text-center">
          <small class="card-title p-3 text-center">You've successfully created an account with us.
             Click on the button below to process using this system.</small>
          <br>
          <a href="#" class="btn btn-outline-success mt-4">Proceed</a>
        </div>
     </div>
   </div>
 </div>
</body>
</html>
