<?php
session_start();
include "connect.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Link to Font Awesome CSS -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Admin - Wards & Beds</title>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="admin-manage.js"></script>
    
    <style>
        .no-outline:focus{
            outline: none!important;
        }
        *::-webkit-scrollbar{
            width: 0px;
        }
        .user-hover:hover{
            background: lightgray;
        }

    </style>

</head>
<body>
    
    <div class="mainBody d-flex align-items-center justify-content-center bg-light" style="min-height: 100vh; height: 100vh; min-width: 100%;">
        
        <!--  -->
        
            <div class="p-4 shadow-lg w-50" style="height: 60vh; border-radius: 15px">
                <div class="overflow-hidden" style="height: 100%;"> 
                    <div class="overflow-auto" style="height: 100%;">
                        <h4>Register as Patient</h4>
                        <div class="text-warning">Make sure you enter right details</div>
                        <form id="myForm" method="post">
                            <div id="result" class="mb-2"></div>
                            <div class="form-group">
                                <label for="patientName">Patient Name</label>
                                <input type="text" class="form-control" id="patientName" name="patientName" placeholder="Enter patient's name" required>
                            </div>
                            <div class="form-group">
                                <label for="nationalID">National ID</label>
                                <input type="text" class="form-control" id="nationalID" name="nationalID" placeholder="Enter National ID number" required>
                            </div>
                            <div class="form-group">
                                <label for="mobileNumber">Mobile Number</label>
                                <input type="tel" class="form-control" id="mobileNumber" name="mobileNumber" placeholder="Enter patient's mobile number" required>
                                <input type="hidden" value="user.png" class="form-control" id="patientProfilePicture" name="patientProfilePicture" placeholder="Enter patient's mobile number">
                            </div>
                            <div class="form-group">
                                <label for="patientEmail">Email</label>
                                <input type="email" class="form-control" id="patientEmail" name="patientEmail" placeholder="Enter patient's email" required>
                            </div>
                            <button type="submit" class="btn btn-warning mr-5">Add as patient</button>
                            <a href="patient-module.php" class="text-success">Go your Patient's Module</a>
                            <div class="mt-2 text-center">
                                <a href="index.php">Go back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        
        
    </div>
</body>
</html>