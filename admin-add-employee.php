<?php
session_start();
include 'connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["employeeProfilePicture"])) {
    // Function to sanitize and validate input data
    function sanitize_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Function to generate a unique filename
    function generateUniqueFilename($filename)
    {
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        return uniqid() . '.' . $extension;
    }

    function generatePassword($length = 12)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_=+';
        $password = '';
        $charLength = strlen($chars) - 1;

        for ($i = 0; $i < $length; $i++) {
            $password .= $chars[mt_rand(0, $charLength)];
        }

        return $password;
    }



    // File upload directory
    $uploadDir = 'uploads/';
    $employeeProfilePicture = $_FILES["employeeProfilePicture"];
    $fileTempName = $employeeProfilePicture["tmp_name"];

    // Check if a file was uploaded
    if (!empty($fileTempName)) {
        // Get the original filename
        $originalFilename = basename($employeeProfilePicture["name"]);

        // Generate a unique filename
        $uniqueFilename = generateUniqueFilename($originalFilename);

        // Final file path
        $filePath = $uploadDir . $uniqueFilename;

        // Check if the file is an image (optional, you can remove this check if not needed)
        $imageInfo = getimagesize($fileTempName);
        if (!$imageInfo) {
            echo "Error: The uploaded file is not an image.";
            exit;
        }

        // Move the uploaded file to the upload directory with the unique filename
        if (move_uploaded_file($fileTempName, $filePath)) {

            // Get form data and validate/sanitize inputs
            $employeeStudentId = sanitize_input($_POST["employeeStudentId"]);
            $employeeEmail = sanitize_input($_POST["employeeEmail"]);
            $employeeJobTitle = sanitize_input($_POST["employeeJobTitle"]);
            $employeeNationalId = sanitize_input($_POST["employeeNationalId"]);

            if (empty($employeeStudentId) || empty($employeeEmail) || empty($employeeNationalId)) {
              echo "Error: All fields are required. Please fill in all the details.";
            } else {
              // Check if any of the fields already exists in the table
              $sql = "SELECT * FROM employees WHERE employeeStudentId = '$employeeStudentId' OR employeeEmail = '$employeeEmail' OR employeeNationalId = '$employeeNationalId'";
              $result = $connection->query($sql);
          
              if ($result->num_rows > 0) {
                  // If any of the fields exist in the table, show an error
                  $existingFields = array();
                  while ($row = $result->fetch_assoc()) {
                      if ($row['employeeStudentId'] === $employeeStudentId) {
                          $existingFields[] = "Employee Student ID";
                      }
                      if ($row['employeeEmail'] === $employeeEmail) {
                          $existingFields[] = "Employee Email";
                      }
                      
                      if ($row['employeeNationalId'] === $employeeNationalId) {
                          $existingFields[] = "Employee National ID";
                      }
                  }
          
                  $errorMessage = "Error: The following field(s) already exist in the table: " . implode(", ", $existingFields);
                  echo $errorMessage;
              }
              else{
                // Prepare and bind parameters to prevent SQL injection
                $stmt = $connection->prepare("INSERT INTO employees (employeeId, employeePassword, employeeName, employeeStudentId, employeeEmail, country, employeeHomeAddress, employeeGender, employeeJobTitle, employeeWorkStatus, employeeTertiaryCompleted, employeeNationalId, employeePhoneNumber, employeeProfilePicture) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssssssssss", $employeeId, $employeePassword, $employeeName, $employeeStudentId, $employeeEmail, $country, $employeeHomeAddress, $employeeGender, $employeeJobTitle, $employeeWorkStatus, $employeeTertiaryCompleted, $employeeNationalId, $employeePhoneNumber, $uniqueFilename);

                // Get form data and validate/sanitize inputs
                $employeeName = sanitize_input($_POST["employeeName"]);
                $employeeStudentId = sanitize_input($_POST["employeeStudentId"]);
                $employeeEmail = sanitize_input($_POST["employeeEmail"]);
                $country = sanitize_input($_POST["country"]);
                $employeeHomeAddress = sanitize_input($_POST["employeeHomeAddress"]);
                $employeeJobTitle = sanitize_input($_POST["employeeJobTitle"]);
                $employeeGender = sanitize_input($_POST["employeeGender"]);
                $employeeWorkStatus = sanitize_input($_POST["employeeWorkStatus"]);
                $employeeTertiaryCompleted = sanitize_input($_POST["employeeTertiaryCompleted"]);
                $employeeNationalId = sanitize_input($_POST["employeeNationalId"]);
                $employeePhoneNumber = sanitize_input($_POST["employeePhoneNumber"]);

                //Generating employee Id and employee password
                $sql = "SELECT id FROM employees ORDER BY id DESC LIMIT 1";
                $result = $connection->query($sql);

                // Step 2: Extract the id value from the fetched row
                $lastId = 0;
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $lastId = $row['id'];
                }

                // Step 3: Add the desired number to the id value
                $employeeId = substr($employeeJobTitle, 0, 3) . sprintf('%03d', $lastId);

                // Generate a 12-character password
                $generatedPassword = generatePassword();
                $employeePassword = password_hash($generatedPassword, PASSWORD_BCRYPT);
              
                
                echo $generatedPassword;
              }

            }
            
          }

            // Check for empty fields or fields with leading/lagging spaces
            if (empty($employeeName) || empty($employeeStudentId) || empty($employeeEmail) || empty($country) || empty($employeeHomeAddress) || empty($employeeGender) || empty($employeeWorkStatus) || empty($employeeTertiaryCompleted) || empty($employeeNationalId) || empty($employeePhoneNumber)) {
                echo "Error: All fields are required. Please fill in all the details.";
            } else {
                // Execute the statement
                if ($stmt->execute()) {
                    // Success message
                    echo "Employee added successfully!";
                } else {
                    // Error message
                    echo "Error: " . $stmt->error;
                }
            }

            // Close statement and connection
           
        } else {
            echo "Error: Failed to move uploaded file.";
        }
    } else {
        // echo "Error: No file was uploaded.";
    }

    // Close the database connection
    $connection->close();
    

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Employee</title>
  <!-- Link to Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Link to Font Awesome CSS -->
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">

  <link rel="stylesheet" href="style.css">
  <style>

    /* Custom CSS to center the form */
    .centered-form {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    /* Custom CSS for the grid layout */
    .form-columns {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
    }

    .centered-form .card {
      width: 100%;
      max-width: 80%; /* Adjust the width as needed */
      border-radius: 50px;
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
  <div class="centered-form bg-light">
    <div class="card p-3 border-0 bg-primary text-white">
      <div class="card-body">
        <h4 class="card-title">Add Employee</h4>
        <form action="admin-add-employee.php" method="post" enctype="multipart/form-data">
          <span class="form-columns">
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-warning text-dark"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" class="form-control" id="username" name="employeeName" placeholder="Employee Name" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-warning text-dark"><i class="fas fa-lock"></i></span>
                </div>
                <input type="text" class="form-control" id="password" name="employeeStudentId" placeholder="Employee's Student ID" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-warning text-dark"><i class="fas fa-envelope"></i></span>
                </div>
                <input type="email" class="form-control" id="email" name="employeeEmail" placeholder="Employee's Email" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-warning text-dark"><i class="fas fa-envelope"></i></span>
                </div>
                <select class="form-control" id="country" name="country" required>
                  <option value="" disabled selected>Select your Country</option>
              </select>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-warning text-dark"><i class="fas fa-lock"></i></span>
                </div>
                <input type="text" class="form-control" name="employeeHomeAddress" placeholder="Employee's Home address" required>
              </div>
            </div>
            
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-warning text-dark"><i class="fas fa-lock"></i></span>
                </div>
                <select class="form-control" name="employeeJobTitle" required>
                  <option value="" disabled selected>Select your Job Title</option>
                  <option value="Doctor">Doctors</option>
                  <option value="Nurse">Nurse</option>
                  <option value="Pharmacist">Pharmacist</option>
                  <option value="Laboratorist">Laboratorist</option>
                  <option value="Accountant">Accountant</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-warning text-dark"><i class="fas fa-lock"></i></span>
                </div>
                <select class="form-control" name="employeeWorkStatus" required>
                  <option value="" disabled selected>Select Work Status</option>
                  <option value="full-time">Full-Time Worker</option>
                  <option value="part-time">Part-Time Worker</option>
                  <option value="contract">Contract Worker</option>
                  <option value="contract">Internship/Attachment</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-warning text-dark"><i class="fas fa-graduation-cap"></i></span>
                </div>
                <input type="text" class="form-control" name="employeeTertiaryCompleted" placeholder="Tertiary Institution Completed" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-warning text-dark"><i class="fas fa-graduation-cap"></i></span>
                </div>
                <input type="text" class="form-control"  name="employeeNationalId" placeholder="National ID Card Number" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-warning text-dark"><i class="fas fa-graduation-cap"></i></span>
                </div>
                <input type="tel" class="form-control" name="employeePhoneNumber" placeholder="Phone Number" required>
              </div>
            </div>

            

            <!-- Add Image Upload Field -->

            <div class="form-group">
              <label for="profile-image" class="file-input-label w-100 bg-white">
                <i class="fas fa-image mr-3"></i> Add profile picture
                <input type="file" class="form-control file-input" name="employeeProfilePicture" id="profile-image" accept="image/*">
              </label>
            </div>

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-warning text-dark"><i class="fas fa-lock"></i></span>
                </div>
                <select class="form-control" name="employeeGender" required>
                  <option value="" disabled selected>Gender</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                  <option value="Other">Other</option>
                </select>
              </div>
            </div>
            
          </span>

          <div class="text-center">
              <button style="border-radius: 25px; height: 45px;" type="submit" class="btn btn-warning w-25">Add Employee</button>
          </div>         
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
