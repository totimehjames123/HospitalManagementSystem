<?php
session_start();
include 'connect.php';

$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $gender = $_POST['gender'];
  $country = $_POST['country'];
  $profilePicture = "";

  // //Check if email already exists
  $email = $connection->real_escape_string($email);
  try{
    $check_email_query = "SELECT * FROM users WHERE email = '$email'";
    $result = $connection->query($check_email_query);

    if ($result->num_rows > 0) {
        $errorMessage = "user already exists";
    }
    else{
      if (trim($username) == ""){
        $errorMessage = "no username";
      }
      else{
        try{

          $uploadDir = "uploads/"; // Directory where the images will be stored
          $allowedExtensions = ["jpg", "jpeg", "png", "gif"]; // Allowed image file extensions

          // Check if the profilePictureInput field has a value (i.e., a file is uploaded)
          if (isset($_FILES["profilePicture"]["name"]) && $_FILES["profilePicture"]["name"] !== ""){
            
              // File is uploaded, proceed with the file upload process
              $fileName = $_FILES["profilePicture"]["name"];
              $fileTmpName = $_FILES["profilePicture"]["tmp_name"];
              $fileType = $_FILES["profilePicture"]["type"];
              $fileSize = $_FILES["profilePicture"]["size"];
              $fileError = $_FILES["profilePicture"]["error"];

              // Check if the uploaded file is an image
              $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
              if (!in_array($fileExtension, $allowedExtensions)) {
                  $errorMessage = "error file type";
                  exit();
              }

              // Check if there was no upload error
              if ($fileError !== 0) {
                  $errorMessage = "error uploading";
                  exit();
              }

              // Generate a unique filename to avoid overwriting existing files
              $newFileName = uniqid() . "." . $fileExtension;

              if (move_uploaded_file($fileTmpName, $uploadDir . $newFileName)){
                $profilePicture = $newFileName;
              }
          }
          elseif (!empty($_POST["defaultProfilePicture"])) {
            $profilePicture = $_POST["defaultProfilePicture"];
            echo $profilePicture;
          }

          // Escape user input to prevent SQL injection
          $username = $connection->real_escape_string($username);
          $email = $connection->real_escape_string($email);
          // $password = $connection->real_escape_string(password_hash($password, PASSWORD_BCRYPT));
          $gender = $connection->real_escape_string($gender);
          $country = $connection->real_escape_string($country);
          $profilePicture = $connection->real_escape_string($profilePicture);
      
          //Store all user details in a session
          $_SESSION["username"] = $username;
          $_SESSION["email"] = $email;
          $_SESSION["gender"] = $gender;
          $_SESSION["country"] = $country;
          $_SESSION["profilePicture"] = $profilePicture;

          
          $verificationCode = rand(100000, 900000);
          $_SESSION['verificationCode'] = $verificationCode;
          header("Location: email-verification.php");
        }
        catch (Exception $e){
          echo "An error occurred, Try again!";
        }
      }
    }
  }
  catch (Exception $e) {
    echo "An error occured!";
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

   
  </style>
</head>

<body>
  <div class="centered-form ">
    <div class="card p-2 bg-primary" style="border-radius: 50px;">
      <div class="card-body">
        <h4 class="card-title text-white">Sign Up</h4>
        <form id="signup-form" enctype="multipart/form-data" action="signup.php" method="post">

          <div>
            <small class="text-danger">
              <?php
                echo ($errorMessage == "no username") ? "Username can't contain only white spaces!" : "";
              ?>
            </small>
          </div>

          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text bg-warning"><i class="fas fa-user"></i></span>
              </div>
              <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
            </div>
          </div>

          <div>
            <small class="text-danger">
              <?php
                echo ($errorMessage == "user already exists") ? "User already exists!" : "";
              ?>
            </small>
          </div>

          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text bg-warning"><i class="fas fa-envelope"></i></span>
              </div>
              <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text bg-warning"><i class="fas fa-lock"></i></span>
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
                <span class="input-group-text bg-warning"><i class="fas fa-envelope"></i></span>
              </div>
              <select class="form-control" id="country" name="country" required>
                <option value="" disabled selected>Select your Country</option>
              </select>
            </div>
          </div>



          <!-- Add Image Upload Field -->
          <div>
            <small class="text-danger">
              <?php
                echo ($errorMessage == "error file type") ? "Error: Only JPG, JPEG, PNG, and GIF files are allowed!" : "";
                echo ($errorMessage == "error uploading") ? "Error occured while uploading image! <br> Try again" : "";
              ?>
            </small>
          </div>

          <div class="form-group">
            <label for="profile-image" class="file-input-label w-100 border bg-white">
              <i class="fas fa-image mr-3"></i> Add a profile picture
              <input type="file" class="form-control file-input" id="profile-image" name="profilePicture" accept="image/*">
            </label>
          </div>

           <!-- Hidden field to store the default image filename when no file is uploaded -->
          <input type="hidden" name="defaultProfilePicture" value="user.png">
          
          <div class="text-center">
            <button style="border-radius: 25px; height: 45px;" name="submit" type="submit" class="btn bg-warning  w-25">Next</button>
          </div>
          <p class="mt-3 text-center text-white">Already have an account? <a href="login.php" class="text-warning">Login here</a></p>
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
