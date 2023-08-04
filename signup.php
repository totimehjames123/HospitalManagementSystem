<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $newPassword = $_POST['newPassword'];
  $confirmPassword = $_POST['confirmNewPassword'];
  $gender = $_POST['gender'];
  $country = $_POST['country'];
  $profilePicture = isset($_POST['profilePicture']) ? $_POST['profilePicture'] : 'users.png';

  //Check if passwords are the same
  $password = "";
  if ($newPassword === $confirmPassword){
    $password = $connection->real_escape_string($newPassword);

    // //Check if email already exists
    $email = $connection->real_escape_string($email);
    try{
      $check_email_query = "SELECT * FROM users WHERE email = '$email'";
      $result = $connection->query($check_email_query);

      if ($result->num_rows > 0) {
          echo "User with this email already exists.";
      }
      else{
        try{
          // Escape user input to prevent SQL injection
          $username = $connection->real_escape_string($username);
          $email = $connection->real_escape_string($email);
          $password = $connection->real_escape_string($password);
          $gender = $connection->real_escape_string($gender);
          $country = $connection->real_escape_string($country);
          $profilePicture = $connection->real_escape_string($profilePicture);
      
          $insert_query = "INSERT INTO users (username, email, password, gender, country, profilePicture) 
                          VALUES ('$username', '$email', '$password', '$gender', '$country', '$profilePicture')";
      
          if ($connection->query($insert_query) === TRUE) {
              echo "User registration successful.";
          } else {
              echo "Error: " . $insert_query . "<br>" . $connection->error;
          }
        }
        catch (Exception $e){
          echo "An error occurred, Try again!";
        }
      }
    }
    catch (Exception $e) {
      echo "An error occured!";
    }
    }
    else {
      echo "Passwords dont match";
    }

  $connection->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <!-- Link to Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Link to Font Awesome CSS -->
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
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

    /* Hide default file input appearance */
    .file-input {
      display: none;
    }

    /* Style the custom file input button */
    .file-input-label {
      display: inline-block;
      padding: 8px 15px;
      border-radius: 5px;
      /* background-image: linear-gradient(to right, #3b82f6, #8b5cf6); */
      /* color: #fff; */
      color: gray;
      cursor: pointer;
    }

    /* Add hover effect to the custom file input button (optional) */
    .file-input-label:hover {
      /* background-image: linear-gradient(to right, black, #8b5cf6); */
      background: black;
      color: white;
    }
  </style>
</head>

<body>
  <div class="centered-form bg-primary">
    <div class="card p-2" style="border-radius: 50px;">
      <div class="card-body">
        <h4 class="card-title">Sign Up</h4>
        <form id="signup-form" enctype="multipart/form-data" action="signup.php" method="post">
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text btn-gradient-blue-violet"><i class="fas fa-user"></i></span>
              </div>
              <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text btn-gradient-blue-violet"><i class="fas fa-envelope"></i></span>
              </div>
              <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text btn-gradient-blue-violet"><i class="fas fa-lock"></i></span>
              </div>
              <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Password" required>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text btn-gradient-blue-violet"><i class="fas fa-lock"></i></span>
              </div>
              <input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" placeholder="Confirm New Password" required>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text btn-gradient-blue-violet"><i class="fas fa-lock"></i></span>
              </div>
              <select class="form-control" id="gender" name="gender" required>
                <option value="" disabled selected>Select your gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
              </select>
            </div>            
          </div>

          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text btn-gradient-blue-violet"><i class="fas fa-envelope"></i></span>
              </div>
              <select class="form-control" id="country" name="country" required>
                <option value="" disabled selected>Select your Country</option>
              </select>
            </div>
          </div>



          <!-- Add Image Upload Field -->

          <div class="form-group">
            <label for="profile-image" class="file-input-label w-100 border">
              <i class="fas fa-image mr-3"></i> Add a profile picture
              <input type="file" class="form-control file-input" id="profile-image" name="profilePicture" accept="image/*">
            </label>
          </div>
          
          <div class="text-center">
            <button style="border-radius: 25px; height: 45px;" name="submit" type="submit" class="btn btn-gradient-blue-violet text-white  w-25">Signup</button>
          </div>
          <p class="mt-3 text-center">Already have an account? <a href="login.html">Login here</a></p>
        </form>
      </div>
    </div>
  </div>


  <!-- Fetch and populate country list -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
  <script>
    fetch('https://restcountries.com/v3.1/all')
      .then(response => response.json())
      .then(data => {
        const countrySelect = document.getElementById('country');

        data.forEach(country => {
          const option = document.createElement('option');
          option.value = country.name.common;

          // Add a class for the flag based on the country's ISO code
          const isoCode = country.cca2.toLowerCase(); // Replace with the correct property
          option.className = `flag-icon flag-icon-${isoCode}`;

          option.text = country.name.common;
          countrySelect.appendChild(option);
        });
      })
      .catch(error => console.error('Error fetching countries:', error));

  </script>
</body>

</html>
