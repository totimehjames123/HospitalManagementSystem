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
    <script src="nurse-record.js"></script>
    
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
    <script>
        $(document).ready(function() {
            // Use AJAX to fetch wards
            $.ajax({
                url: 'backend-all-wards.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Populate the dropdown
                    var select = $('#wardName');
                    $.each(data, function(key, value) {
                        select.append('<option value="'+ value.wardName +'">' + value.wardName + '</option>');
                    });
                },
                error: function() {
                    console.log('Error fetching wards.');
                }
            });
        });
    </script>

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
                            <li class="mb-1 mt-2" style="list-style: none;"><a href="nurse-module.php" class="text-white pt-2 pb-2 pl-3 btn-block bg-primary" style="border-radius: 6px; text-decoration: none;" ><span class="fa fa-home pr-2"></span>Dashboard</a></li>
                            <li class="mb-1 mt-2" style="list-style: none;"><a href="nurse-record.php" class="text-dark pt-2 pb-2 pl-3 btn-block bg-light" style="border-radius: 6px; text-decoration: none;"><span class="fa fa-calendar pr-2" style="color: purple;"></span>Take Record</a></li>
                            <li class="mb-1 mt-2" style="list-style: none;"><a href="nurse-operation.php" class="text-dark pt-2 pb-2 pl-3 btn-block bg-light" style="border-radius: 6px; text-decoration: none;"><span class="fa fa-calendar pr-2 text-warning" ></span>Operations</a></li>
                            <li class="mb-1 mt-2" style="list-style: none;"><a href="nurse-profile.php" class="text-dark pt-2 pb-2 pl-3 btn-block bg-light" style="border-radius: 6px; text-decoration: none;"><span class="fa fa-calendar pr-2 text-warning" ></span>My Profile</a></li>
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
                                <h4 class="text-left">Take Record of Patient</h4>
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
                                        <h4>Take Record of Patient</h4>
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
                                                <label for="temperature">Temperature (&deg;C)</label>
                                                <input type="number" class="form-control" id="temperature" name="temperature" placeholder="Enter Temperature" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="bloodPressure">Blood Pressure</label>
                                                <input type="text" class="form-control" id="bloodPressure" name="bloodPressure" placeholder="Enter Blood Pressure" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="weight">Weight</label>
                                                <input type="text" class="form-control" id="weight" name="weight" placeholder="Enter Weight" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="height">Height</label>
                                                <input type="text" class="form-control" id="height" name="height" placeholder="Enter Height" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="sugarLevel">Sugar Level</label>
                                                <input type="text" class="form-control" id="sugarLevel" name="sugarLevel" placeholder="Enter Sugar Level" required>
                                            </div>
    
                                            <div class="form-group">
                                                <label for="other">Other</label>
                                                <textarea cols="30" rows="5" class="form-control" id="other" name="other" placeholder="Add others if any ..."></textarea>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="wardName">Allocate Ward & Beds?</label> <small class="text-warning">1 bed aleady assigned</small>
                                                <select class="form-control" id="wardName" name="wardName">
                                                    <option value="" disabled selected>Select a Ward</option>
                                                </select>
                                            </div>
                                            
                                            <button type="submit" class="btn btn-warning">Add Record</button>
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
                                        <th class="text-nowrap">Nurse's Employee ID</th>                                      
                                        <th class="text-nowrap">Temperature (&deg;C)</th>                                      
                                        <th class="text-nowrap">Blood Pressure</th>                                      
                                        <th class="text-nowrap">Weight</th>                                      
                                        <th class="text-nowrap">Height</th>                                      
                                        <th class="text-nowrap">Sugar Level</th>                                      
                                        <th class="text-nowrap">Other / Prescriptions</th>                                      
                                        <th class="text-nowrap">Ward Name</th>                                      
                                        <th class="text-nowrap">Medicated Status</th>                                      
                                        <th class="text-nowrap">Created On</th>                                      
                                        <th class="text-nowrap">Prescibe</th> 
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