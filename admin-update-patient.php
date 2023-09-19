<?php

include("connect.php");
session_start(); // Start the session
$error = "";
$success = "";

try{
    if (isset($_GET['patientId'])){
        $patientId = $_GET['patientId'];
        $patientName = $_GET['patientName'];
        $patientEmail = $_GET['patientEmail'];
        $mobileNumber = $_GET['mobileNumber'];
        $nationalID = $_GET['nationalID'];
    
        $_SESSION['patientID'] = $patientId;
        $_SESSION['patientName'] = $patientName;
        $_SESSION['patientEmail'] = $patientEmail;
        $_SESSION['mobileNumber'] = $mobileNumber;
        $_SESSION['nationalID'] = $nationalID;
    }
    
    if (isset($_POST['submit'])) {
        $patientID = $_SESSION['patientID'];
        $patientName = $_POST['patientName']; 
        $patientEmail = $_POST['patientEmail']; 
        $mobileNumber = $_POST['mobileNumber']; 
        $nationalID = $_POST['nationalID']; 
    
        // Construct the SQL query with a single SET clause to update multiple columns
        $query = "UPDATE patients SET patientName = '$patientName', patientEmail = '$patientEmail', mobileNumber = '$mobileNumber', nationalID = '$nationalID' WHERE id = $patientID";
    
        // Execute the query
        if (mysqli_query($connection, $query)) {
            $success = "Record updated successfully";

            // Define the SELECT query to fetch data
            $selectQuery = "SELECT patientName, patientEmail, mobileNumber, nationalID FROM patients WHERE id = $patientID";

            // Execute the SELECT query
            $result = mysqli_query($connection, $selectQuery);

            if ($result) {
                // Fetch the row from the result set
                $row = mysqli_fetch_assoc($result);

                // Store the fetched data in session variables
                $_SESSION['patientName'] = $row['patientName'];
                $_SESSION['patientEmail'] = $row['patientEmail'];
                $_SESSION['mobileNumber'] = $row['mobileNumber'];
                $_SESSION['nationalID'] = $row['nationalID'];

            } else {
                    // Handle any errors that occur during the query execution
                $error = "Error: " . mysqli_error($connection);
            }

        } else {
            $error =  "Error updating record: " . mysqli_error($connection);
        }
    
        // Close the database connection
        mysqli_close($connection);
    } else {
    }

    
    
}

catch (Exception $e){
    $error = "error" . $e->getMessage();
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
        <h4 class="card-title">Update Patient</h4>
        <div class="mb-2 <?php echo ($success) ? 'text-success' : 'text-danger'?>">
                <?php echo ($success) ? $success : $error ?>
          </div>
        <form id="signup-form" action="admin-update-patient.php" method="post">
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text btn-gradient-blue-violet"><i class="fas fa-user"></i></span>
              </div>
              <input type="text" value="<?php echo $_SESSION['patientName']?>" class="form-control" id="nationalID" name="patientName" placeholder="Patient's Name" required>
            </div>
          </div>

          <div>
            <small class="text-danger">
              <?php
              
              ?>
            </small>
          </div>

          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text btn-gradient-blue-violet"><i class="fas fa-envelope"></i></span>
              </div>
              <input type="email" class="form-control" value="<?php echo $_SESSION['patientEmail']?>" id="email" name="patientEmail" placeholder="Patient's Email" required>
            </div>
          </div>


          <div>
            <small class="text-danger">
            </small>
          </div>

          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text btn-gradient-blue-violet"><i class="fas fa-user"></i></span>
              </div>
              <input type="text" class="form-control" value="<?php echo $_SESSION['mobileNumber']?>" id="mobileNumber" name="mobileNumber" placeholder="Mobile Number" required>
            </div>
          </div>

          <div>
            <small class="text-danger">
            </small>
          </div>

          <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text btn-gradient-blue-violet"><i class="fas fa-user"></i></span>
              </div>
              <input type="text" class="form-control" value="<?php echo $_SESSION['nationalID']?>" id="nationalID" name="nationalID" placeholder="Patient's Name" required>
            </div>
          </div>
          
          <div class="text-center">
            <button style="border-radius: 25px; height: 45px;" name="submit" type="submit" class="btn btn-gradient-blue-violet text-white  w-25">Update</button>
          </div>
          <p class="mt-3 text-center">Are you done? <a href="admin-manage.php">Go back</a></p>
        </form>
      </div>
    </div>
  </div>
</body>

</html>
