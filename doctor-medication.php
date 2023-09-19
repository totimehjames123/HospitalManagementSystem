<?php 
session_start();

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
    <title>Doctor - Create & Manage Appointment</title>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="doctor-medication.js"></script>
    
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
        
        <div class="bg-white" style="min-height: 80%; max-width: 90%; border-radius: 20px">
            <div class="container bg-white" style="height: 10vh;">
                <nav class="navbar navbar-expand-lg navbar-light bg-white pt-3">
                    <a class="navbar-brand" href="index.php">
                        <img src="logo.png" alt="Logo" style="max-height: 30px;">
                    </a>
                    <span class="form-inline mx-auto">
                
                        <div class="">
                        <div class="input-group bg-light p-1 pl-3 pr-1" style="border-radius: 18px; height: 40px; ">
                            <input class=" rounded-right border-0 bg-light no-outline" id="searchInput" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="border-0 no-outline rounded-circle bg-white text-primary" style="width: 35px; " type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        </div>
                    </span>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                        <a class=" btn text-primary  mr-3" style="border-radius: 14px; background: #C0D9E7;" href="#"><i class="fas fa-home"></i></a>
                        </li>
                        <li class="nav-item">
                        <a class="btn text-warning  mr-3" style="border-radius: 14px; background: #fff3cd;" href="#"><i class="fas fa-bell"></i></a>
                        </li>
                        <li class="nav-item">
                        <a class="btn mr-3" style="border-radius: 14px; color: purple; background: #F3E5F5;" href="#"><i class="fas fa-user"></i></a>
                        </li>
                    </ul>
                </nav>            
            </div>
            <div class="row w-100 relative" style="height: 75vh;">
                <div class="sideBarContainer  col-md-3 pt-3" style="height: 100%; ">
                    <div class="bg-white " style="height: 100%; width: 100%">
                        <div class="pl-5 text-dark">
                            <small>Menu</small>
                        </div>
                        <div style="width: 90%">
                        <ul class="" style="width: 100%; height:60vh;">
                            <li class="mb-1 mt-2" style="list-style: none;"><a href="doctor-module.php" class="text-dark pt-2 pb-2 pl-3 btn-block bg-light" style="border-radius: 6px; text-decoration: none;" ><span class="fa fa-home pr-2" style="color: purple;"></span>Dashboard</a></li>
                            <li class="mb-1 mt-2" style="list-style: none;"><a href="doctor-appointment.php" class="text-white pt-2 pb-2 pl-3 btn-block  bg-primary" style="border-radius: 6px; text-decoration: none;"><span class="fa fa-calendar pr-2" ></span>Appointment</a></li>
                            <li class="mb-1 mt-2" style="list-style: none;"><a href="doctor-medication.php" class="text-dark pt-2 pb-2 pl-3 btn-block bg-light" style="border-radius: 6px; text-decoration: none;"><span class="fa fa-calendar pr-2" style="color: pink;"></span>Medications</a></li>
                            <li class="mb-1 mt-2" style="list-style: none;"><a href="doctor-operations.php" class="text-dark pt-2 pb-2 pl-3 btn-block bg-light" style="border-radius: 6px; text-decoration: none;"><span class="fa fa-calendar pr-2 text-success" ></span>Operations</a></li>
                            <li class="mb-1 mt-2" style="list-style: none;"><a href="doctor-laboratory.php" class="text-dark pt-2 pb-2 pl-3 btn-block bg-light" style="border-radius: 6px; text-decoration: none;"><span class="fa fa-calendar pr-2 text-warning" ></span>Laboratory Services</a></li>
                            <li class="mb-1 mt-2" style="list-style: none;"><a href="doctor-profile.php" class="text-dark pt-2 pb-2 pl-3 btn-block bg-light" style="border-radius: 6px; text-decoration: none;"><span class="fa fa-calendar pr-2 text-warning" ></span>My Profile</a></li>
                        </ul>
                        </div>
                    </div>
                </div>

                <!--  -->
            <div class="mainContainer col-md-9 overflow-hidden" style="height: 73vh; background: none;">
            
                <div class="overflow-auto p-3" style="height: 100%; ">
                    <!--  -->
                    <div class="row">
                        <div class="col">
                            <div class="d-flex w-100 justify-content-between p-1">
                                <h4 class="text-left">Schedule & Manage Appointments</h4>
                                <button class="btn btn-sm bg-light">Today</button>
                            </div>
                        </div>
                    </div>

                    

                    <!--  -->
                    <div class="row pt-2">
                        <div class="col-md-8">
                            <div class="p-4 shadow-lg" style="height: 60vh; border-radius: 15px;">
                                <div class="overflow-hidden" style="height: 100%;"> 
                                    <div class="overflow-auto" style="height: 100%;">
                                        <h4>Create Medication</h4>
                                        <form id="myForm" method="post">
                                            <div id="result" class="mb-2"></div>
                                            <div class="form-group">
                                                <label for="patientName">Patient Name</label>
                                                <input type="text" class="form-control" id="patientName" name="patientName" placeholder="Enter patient's name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="nationalID">National ID</label>
                                                <input type="text" class="form-control" id="nationalID" name="nationalID" placeholder="Enter Patient's National ID number" required>
                                            </div>
                                                <input type="hidden" value="<?php echo $_SESSION["employeeId"]?>" class="form-control" id="employeeId" name="employeeId" required>

                                            <div class="form-group">
                                                <label for="medicineName">Medicine Name</label>
                                                <input type="text" class="form-control" id="medicineName" name="medicineName" placeholder="Enter medicine Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="dosage">Dosage</label>
                                                <input type="text" class="form-control" id="dosage" name="dosage" placeholder="Enter Dosage" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="frequency">Frequency</label>
                                                <input type="text" class="form-control" id="frequency" name="frequency" placeholder="Enter Frequency" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="diseaseName">Disease Name</label>
                                                <input type="text" class="form-control" id="diseaseName" name="diseaseName" placeholder="Enter Disease Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="notes">Notes</label>
                                                <textarea cols="30" rows="10" class="form-control" id="notes" name="notes" placeholder="Add some notes & Prescriptions" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="startDateTime">Start Date of Medication</label>
                                                <input type="datetime-local" class="form-control" id="startDateTime" name="startDateTime" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="endDateTime">End Date of Medication</label>
                                                <input type="datetime-local" class="form-control" id="endDateTime" name="endDateTime" required>
                                            </div>
                                            <button type="submit" class="btn btn-warning">Add medication</button>
                                        </form>
                                    </div>
                                    <div class="text-dark d-none -d-flex align-items-center justify-content-center" style="height: 100%;">
                                        <div class="">
                                            No patient selected
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" style="height: 60vh; border-radius: 15px;">
                            <div class="text-bark bg-white  p-4 shadow-lg" style="height: 60vh; border-radius: 15px;">
                                <h4>All Patients</h4>
                                <h6>Select a patient</h6>

                                <div id="allPatients" class="overflow-auto rounded p-3" style="height: 45vh; width: 100%; padding-top: 0;">
                                    
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mt-4 mb-1">Manage Medications</h5>
                        <div class="mt-3 mr-2">
                            <span>Filter By: </span>
                            <input type="text" placeholder="Name or ID" id="jobTitleFilter" name="jobTitleFilter" list="jobTitle" class="pl-2 no-outline border-0 bg-warning p-2" style="width: 110px; border-radius: 20px;">
                            <datalist id="jobTitle">
                                <option value="Mahmoud">
                                <option value="Jonathan">
                                <option value="John">
                                <option value="Emmanuel">
                                <option value="James">
                            </datalist>

                        </div>
                        
                     </div>
                    <div class="mt-3 shadow-lg"> 
                        <div class="table-responsive overflow-y-hidden" style="border-radius: 12px; height: auto;">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="text-nowrap bg-success text-white" >
                                        <th class="text-nowrap">Medication ID</th>
                                        <th class="text-nowrap">Patient's Name</th>
                                        <th class="text-nowrap">Patient's National ID</th>
                                        <th class="text-nowrap">Doctor's Employee ID</th>                                      
                                        <th class="text-nowrap">Medicine Name</th>                                      
                                        <th class="text-nowrap">Dosage</th>                                      
                                        <th class="text-nowrap">Frequency</th>                                      
                                        <th class="text-nowrap">Notes</th>                                      
                                        <th class="text-nowrap">Disease Name</th>                                      
                                        <th class="text-nowrap">Medication Starts On</th>                                      
                                        <th class="text-nowrap">Medication Ends On</th>                                      
                                        <th class="text-nowrap">Medication Created On</th>                                      
                                        <th class="text-nowrap">Delete</th> 
                                    </tr>
                                </thead>
                                <tbody id="allEmployees" class="">
                                    <tr class=" text-nowrap" style="visibility: hidden;">
                                        <td colspan="8" class="text-nowrap text-center">Wait while we load some data!</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</body>
</html>