<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Link to Font Awesome CSS -->
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Admin - Wards & Beds</title>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="admin-wards.js"></script>
    
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
                                <li class="mb-1 mt-2" style="list-style: none;"><a href="admin-module.php" class="text-white pt-2 pb-2 pl-3 btn-block bg-primary" style="border-radius: 6px; text-decoration: none;" ><span class="fa fa-home pr-2"></span>Dashboard</a></li>
                                <li class="mb-1 mt-2" style="list-style: none;"><a href="admin-manage.php" class="text-dark pt-2 pb-2 pl-3 btn-block bg-light" style="border-radius: 6px; text-decoration: none;"><span class="fa fa-calendar pr-2" style="color: purple;"></span>Manage</a></li>
                                <li class="mb-1 mt-2" style="list-style: none;"><a href="admin-wards.php" class="text-dark pt-2 pb-2 pl-3 btn-block bg-light" style="border-radius: 6px; text-decoration: none;"><span class="fa fa-calendar pr-2" style="color: purple;"></span>Wards & Beds</a></li>
                                <li class="mb-1 mt-2" style="list-style: none;"><a href="admin-medication.php" class="text-dark pt-2 pb-2 pl-3 btn-block bg-light" style="border-radius: 6px; text-decoration: none;"><span class="fa fa-calendar pr-2" style="color: pink;"></span>Medications</a></li>
                                <li class="mb-1 mt-2" style="list-style: none;"><a href="admin-payment.php" class="text-dark pt-2 pb-2 pl-3 btn-block bg-light" style="border-radius: 6px; text-decoration: none;"><span class="fa fa-calendar pr-2 text-success" ></span>Payments</a></li>
                                <li class="mb-1 mt-2" style="list-style: none;"><a href="admin-reports.php" class="text-dark pt-2 pb-2 pl-3 btn-block bg-light" style="border-radius: 6px; text-decoration: none;"><span class="fa fa-calendar pr-2 text-warning" ></span>Reports</a></li>
                                <li class="mb-1 mt-2" style="list-style: none;"><a href="admin-profile.php" class="text-dark pt-2 pb-2 pl-3 btn-block bg-light" style="border-radius: 6px; text-decoration: none;"><span class="fa fa-calendar pr-2 text-warning" ></span>My Profile</a></li>
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
                                <h4 class="text-left">Manage Wards & Beds</h4>
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
                                        <h4>Add Wards & Beds</h4>
                                        <form id="myForm" method="post">
                                            <div id="result" class="mb-2"></div>
                                            <div class="form-group">
                                                <label for="wardName">Ward Name</label>
                                                <input type="text" class="form-control" id="wardName" name="wardName" placeholder="Enter ward name">
                                            </div>
                                            <div class="form-group">
                                                <label for="wardType">Wards Type</label>
                                                <input type="text" list="ward" class="form-control" id="wardType" name="wardType" placeholder="Enter ward type">
                                            </div>
                                            <div class="form-group">
                                                <label for="numberOfBeds">Number of Beds</label>
                                                <input type="number" min="0" class="form-control" id="numberOfBeds" name="numberOfBeds" placeholder="Enter number of beds">
                                            </div>
                                            <div class="form-group">
                                                <label for="nurseInCharge">Nurse In Charge</label>
                                                <input type="text" class="form-control" id="nurseInCharge" name="nurseInCharge" placeholder="Enter Nurse in charge's name">
                                            </div>
                                            <div class="form-group">
                                                <label for="nurseId">Nurse ID</label>
                                                <input type="text" class="form-control" id="nurseId" name="nurseId" placeholder="Enter Nurse ID">
                                            </div>
                                            <div class="form-group">
                                                <label for="buildingName">Building Name</label>
                                                <input type="text" class="form-control" id="buildingName" name="buildingName" placeholder="Enter Building's Name">
                                            </div>
                                            
                                            <button type="submit" class="btn btn-warning">Add Ward & Wards</button>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" style="height: 60vh; border-radius: 15px;">
                            <div title="Click on the edit button on any of the wards below." class="text-bark bg-white  p-4 shadow-lg" style="height: 60vh; border-radius: 15px;">
                                <h5>Edit Wards & Beds</h5>
      
                                <div class="overflow-auto rounded p-3" style="height: 45vh; width: 100%; padding-top: 0;">
                                    <small class="text-warning">Click on the edit button 
                                    on any of the wards below.</small>

                                    <div id="updateResult" class="mb-2"></div>
                                        <form id="updateForm" method="POST">
                                            <div class="form-group d-none">
                                                <label for="id">ID</label>
                                                <input type="number" class=" form-control" id="idUpdate" name="id" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="wardName">Ward Name</label>
                                                <input type="text" class="form-control" id="wardNameUpdate" name="wardName" placeholder="Enter ward name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="wardType">Wards Type</label>
                                                <input type="text" list="ward" class="form-control" id="wardTypeUpdate" name="wardType" placeholder="Enter ward type" required>
                                                <datalist id="ward">
                                                    <option value="Emergency Ward">
                                                    <option value="Intensive Care Unit (ICU)">
                                                    <option value="Surgery Ward">
                                                    <option value="Pediatrics Ward">
                                                    <option value="Maternity Ward">
                                                    <option value="Oncology Ward">
                                                    <option value="Cardiology Ward">
                                                    <option value="Orthopedics Ward">
                                                    <option value="Neurology Ward">
                                                    <option value="Psychiatry Ward">
                                                    <option value="Geriatrics Ward">
                                                    <option value="Radiology Department">
                                                </datalist>
                                            </div>
                                            <div class="form-group">
                                                <label for="numberOfBeds">Number of Beds</label>
                                                <input type="number" min="0" class="form-control" id="numberOfBedsUpdate" name="numberOfBeds" placeholder="Enter number of beds" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="availableBeds">Available Beds</label>
                                                <input type="number" min="0" class="form-control" id="availableBedsUpdate" name="availableBeds" placeholder="Enter number of beds" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="occupiedBeds">Occupied Beds</label>
                                                <input type="number" min="0" class="form-control" id="occupiedBedsUpdate" name="occupiedBeds" placeholder="Enter number of beds" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="nurseInCharge">Nurse In Charge</label>
                                                <input type="text" class="form-control" id="nurseInChargeUpdate" name="nurseInCharge" placeholder="Enter Nurse in charge's name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="nurseId">Nurse ID</label>
                                                <input type="text" class="form-control" id="nurseIdUpdate" name="nurseId" placeholder="Enter Nurse ID" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="buildingName">Building Name</label>
                                                <input type="text" class="form-control" id="buildingNameUpdate" name="buildingName" placeholder="Enter Building's Name" required>
                                            </div>
                                            
                                            <button type="submit" class="btn btn-sm btn-warning">Update</button>
                                        </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Manage Patient -->
                    <div>
                        <h5 class="mt-4 mb-1">Manage All Wards and Beds</h5>
                     </div>
                    <div class="mt-3 shadow-lg"> 
                        <div class="table-responsive overflow-y-hidden" style="border-radius: 12px; height: auto;">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="text-nowrap bg-success text-white" >
                                        <th class="text-nowrap">ID</th>
                                        <th class="text-nowrap">Ward Name</th>
                                        <th class="text-nowrap">Ward Type</th>
                                        <th class="text-nowrap">Number Of Beds</th>
                                        <th class="text-nowrap">Available Beds</th>
                                        <th class="text-nowrap">Occupied Beds</th>
                                        <th class="text-nowrap">Nurse In Charge</th>
                                        <th class="text-nowrap">Nurse ID</th>
                                        <th class="text-nowrap">Building Name</th>
                                        <th class="text-nowrap">Date Of Registration</th>
                                        <th class="text-nowrap">Edit</th>
                                        <th class="text-nowrap">Delete</th>                                      
                                    </tr>
                                </thead>
                                <tbody id="allWards" class="">
                                    <!-- <tr class=" text-nowrap" style="visibility: hidden;">
                                        <td colspan="8" class="text-nowrap text-center">Wait while we load some data!</td>
                                    </tr> -->
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