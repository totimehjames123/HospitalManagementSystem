<?php
session_start();
include "connect.php";

$error = "";

if (isset($_GET['employeeId'])){
  $_SESSION["editID"] = $_GET['employeeId'];
  $editID = $_SESSION["editID"];
  // Define the SELECT query to fetch data
  $selectQuery = "SELECT * FROM employees WHERE id = $editID";

  // Execute the SELECT query
  $result = mysqli_query($connection, $selectQuery);

  if ($result) {
      // Fetch the row from the result set
      $row = mysqli_fetch_assoc($result);

      // Store the fetched data in session variables
      $_SESSION['employeeName'] = $row['employeeName'];
      $_SESSION['employeeStudentId'] = $row['employeeStudentId'];
      $_SESSION['employeeEmail'] = $row['employeeEmail'];
      $_SESSION['country'] = $row['country'];
      $_SESSION['employeeHomeAddress'] = $row['employeeHomeAddress'];
      $_SESSION['employeeGender'] = $row['employeeGender'];
      $_SESSION['employeeJobTitle'] = $row['employeeJobTitle'];
      $_SESSION['employeeWorkStatus'] = $row['employeeWorkStatus'];
      $_SESSION['employeeTertiaryCompleted'] = $row['employeeTertiaryCompleted'];
      $_SESSION['employeeNationalId'] = $row['employeeNationalId'];
      $_SESSION['employeePhoneNumber'] = $row['employeePhoneNumber'];
      $_SESSION['employeeProfilePicture'] = $row['employeeProfilePicture'];

  } else {
          // Handle any errors that occur during the query execution
      $error = "Error: " . mysqli_error($connection);
  }
  
}

if (isset($_POST['submit'])) {
  $editID = $_SESSION['editID'];

  // Get form data
  $employeeName = $_POST["employeeName"];
  $employeeStudentId = $_POST["employeeStudentId"];
  $employeeEmail = $_POST["employeeEmail"];
  $country = $_POST["country"];
  $employeeHomeAddress = $_POST["employeeHomeAddress"];
  $employeeGender = $_POST["employeeGender"];
  $employeeJobTitle = $_POST["employeeJobTitle"];
  $employeeWorkStatus = $_POST["employeeWorkStatus"];
  $employeeTertiaryCompleted = $_POST["employeeTertiaryCompleted"];
  $employeeNationalId = $_POST["employeeNationalId"];
  $employeePhoneNumber = $_POST["employeePhoneNumber"];


   // Handle image upload
   $profilePicture = $_FILES["employeeProfilePicture"];
   $targetDirectory = "uploads/"; // Define the directory where you want to store uploaded images
   $originalFileName = basename($profilePicture["name"]);
   $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
   $uniqueFileName = uniqid() . '_' . time() . '.' . $fileExtension; // Add a timestamp and a unique identifier
   
   $targetFileName = $targetDirectory . $uniqueFileName;
   
   if (move_uploaded_file($profilePicture["tmp_name"], $targetFileName)) {
       echo "Image uploaded successfully!";
       $editID = $_SESSION['editID'];
    // Construct the SQL query with a single SET clause to update multiple columns
    $query = "UPDATE employees SET employeeName = '$employeeName', employeeStudentId = '$employeeStudentId', employeeEmail = '$employeeEmail', country = '$country' , employeeHomeAddress = '$employeeHomeAddress', employeeGender = '$employeeGender', employeeJobTitle = '$employeeJobTitle', employeeWorkStatus = '$employeeWorkStatus', employeeTertiaryCompleted = '$employeeTertiaryCompleted', employeeNationalId = '$employeeNationalId', employeePhoneNumber = '$employeePhoneNumber', employeeProfilePicture = '$uniqueFileName' WHERE id = $editID";

    // Execute the query
    if (mysqli_query($connection, $query)) {
        $success = "Record updated successfully";

        // Define the SELECT query to fetch data
        $selectQuery = "SELECT * FROM employees WHERE id = $editID";

        // Execute the SELECT query
        $result = mysqli_query($connection, $selectQuery);

        if ($result) {
            // Fetch the row from the result
            $row = mysqli_fetch_assoc($result);

            // Store the fetched data in session variables
            $_SESSION['employeeName'] = $row['employeeName'];
            $_SESSION['employeeStudentId'] = $row['employeeStudentId'];
            $_SESSION['employeeEmail'] = $row['employeeEmail'];
            $_SESSION['country'] = $row['country'];
            $_SESSION['employeeHomeAddress'] = $row['employeeHomeAddress'];
            $_SESSION['employeeGender'] = $row['employeeGender'];
            $_SESSION['employeeJobTitle'] = $row['employeeJobTitle'];
            $_SESSION['employeeWorkStatus'] = $row['employeeWorkStatus'];
            $_SESSION['employeeTertiaryCompleted'] = $row['employeeTertiaryCompleted'];
            $_SESSION['employeeNationalId'] = $row['employeeNationalId'];
            $_SESSION['employeePhoneNumber'] = $row['employeePhoneNumber'];
            $_SESSION['employeeProfilePicture'] = $row['employeeProfilePicture'];

        } else {
                // Handle any errors that occur during the query execution
            $error = "Error: " . mysqli_error($connection);
        }
      } else {
        $error =  "Error updating record: " . mysqli_error($connection);
      }
  
   } else {
       echo "Image upload failed.";
       $profilePicture = $_SESSION['employeeProfilePicture'];


       $editID = $_SESSION['editID'];
       // Construct the SQL query with a single SET clause to update multiple columns
       $query = "UPDATE employees SET employeeName = '$employeeName', employeeStudentId = '$employeeStudentId', employeeEmail = '$employeeEmail', country = '$country' , employeeHomeAddress = '$employeeHomeAddress', employeeGender = '$employeeGender', employeeJobTitle = '$employeeJobTitle', employeeWorkStatus = '$employeeWorkStatus', employeeTertiaryCompleted = '$employeeTertiaryCompleted', employeeNationalId = '$employeeNationalId', employeePhoneNumber = '$employeePhoneNumber', employeeProfilePicture = '$profilePicture' WHERE id = $editID";
   
       // Execute the query
       if (mysqli_query($connection, $query)) {
           $success = "Record updated successfully";
   
           // Define the SELECT query to fetch data
           $selectQuery = "SELECT * FROM employees WHERE id = $editID";
   
           // Execute the SELECT query
           $result = mysqli_query($connection, $selectQuery);
   
           if ($result) {
               // Fetch the row from the result
               $row = mysqli_fetch_assoc($result);
   
               // Store the fetched data in session variables
               $_SESSION['employeeName'] = $row['employeeName'];
               $_SESSION['employeeStudentId'] = $row['employeeStudentId'];
               $_SESSION['employeeEmail'] = $row['employeeEmail'];
               $_SESSION['country'] = $row['country'];
               $_SESSION['employeeHomeAddress'] = $row['employeeHomeAddress'];
               $_SESSION['employeeGender'] = $row['employeeGender'];
               $_SESSION['employeeJobTitle'] = $row['employeeJobTitle'];
               $_SESSION['employeeWorkStatus'] = $row['employeeWorkStatus'];
               $_SESSION['employeeTertiaryCompleted'] = $row['employeeTertiaryCompleted'];
               $_SESSION['employeeNationalId'] = $row['employeeNationalId'];
               $_SESSION['employeePhoneNumber'] = $row['employeePhoneNumber'];
               $_SESSION['employeeProfilePicture'] = $row['employeeProfilePicture'];
   
           } else {
                   // Handle any errors that occur during the query execution
               $error = "Error: " . mysqli_error($connection);
           }
         } else {
           $error =  "Error updating record: " . mysqli_error($connection);
         }

   }

  
    

  // Close the database connection
  mysqli_close($connection);
} else {
}


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
        <form action="admin-update-employee.php" method="post" enctype="multipart/form-data">
          <span class="form-columns">
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-warning text-dark"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" class="form-control" value="<?php echo $_SESSION["employeeName"]?>" id="username" name="employeeName" placeholder="Employee Name" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-warning text-dark"><i class="fas fa-lock"></i></span>
                </div>
                <input type="text" class="form-control" value="<?php echo $_SESSION["employeeStudentId"]?>" id="password" name="employeeStudentId" placeholder="Employee's Student ID" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-warning text-dark"><i class="fas fa-envelope"></i></span>
                </div>
                <input type="email" value="<?php echo $_SESSION["employeeEmail"]?>" class="form-control" id="email" name="employeeEmail" placeholder="Employee's Email" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-warning text-dark"><i class="fas fa-envelope"></i></span>
                </div>
                <select class="form-control" id="country" name="country" value="<?php echo $_SESSION["country"]?>"  required>
                  <option value="<?php echo $_SESSION["country"]?>"  selected><?php echo $_SESSION["country"]?></option>
              </select>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-warning text-dark"><i class="fas fa-lock"></i></span>
                </div>
                <input type="text" value="<?php echo $_SESSION["employeeHomeAddress"]?>" class="form-control" name="employeeHomeAddress" placeholder="Employee's Home address" required>
              </div>
            </div>
            
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-warning text-dark"><i class="fas fa-lock"></i></span>
                </div>
                <select class="form-control" value="<?php echo $_SESSION["employeeJobTitle"]?>" name="employeeJobTitle" required>
                  <option value="<?php echo $_SESSION["employeeJobTitle"]?>"   selected><?php echo $_SESSION["employeeJobTitle"]?></option>
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
                <select class="form-control" value="<?php echo $_SESSION["employeeJobTitle"]?>" name="employeeWorkStatus" required>
                  <option value="<?php echo $_SESSION["employeeJobTitle"]?>"  selected><?php echo $_SESSION["employeeJobTitle"]?></option>
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
                <input value="<?php echo $_SESSION["employeeTertiaryCompleted"]?>" type="text" class="form-control" name="employeeTertiaryCompleted" placeholder="Tertiary Institution Completed" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-warning text-dark"><i class="fas fa-graduation-cap"></i></span>
                </div>
                <input type="text" value="<?php echo $_SESSION["employeeNationalId"]?>" class="form-control"  name="employeeNationalId" placeholder="National ID Card Number" required>
              </div>
            </div>

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-warning text-dark"><i class="fas fa-graduation-cap"></i></span>
                </div>
                <input type="tel" class="form-control" value="<?php echo $_SESSION["employeePhoneNumber"]?>" name="employeePhoneNumber" placeholder="Phone Number" required>
              </div>
            </div>

            

            <!-- Add Image Upload Field -->

            <div class="form-group">
              <label for="profile-image" class="file-input-label w-100 bg-white">
                <i class="fas fa-image mr-3"></i> Add profile picture
                <input type="file" value="<?php echo $_SESSION["employeeProfilePicture"]?>" class="form-control file-input" name="employeeProfilePicture" id="profile-image" accept="image/*">
              </label>
            </div>

            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-warning text-dark"><i class="fas fa-lock"></i></span>
                </div>
                <select class="form-control" value="<?php echo $_SESSION["employeeGender"]?>" name="employeeGender" required>
                  <option value="<?php echo $_SESSION["employeeGender"]?>" selected><?php echo $_SESSION["employeeGender"]?></option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                  <option value="Other">Other</option>
                </select>
              </div>
            </div>
            
          </span>

          <div class="text-center">
              <button style="border-radius: 25px; height: 45px;" name="submit" type="submit" class="btn btn-warning w-25">Update Employee</button>
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
