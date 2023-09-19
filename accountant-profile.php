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
    <title>Doctor Module</title>

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

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
   

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
                    <form class="form-inline mx-auto">
                
                        <div class="">
                        <div class="input-group bg-light p-1 pl-3 pr-1" style="border-radius: 18px; height: 40px; ">
                            <input class=" rounded-right border-0 bg-light no-outline" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                            <button class="border-0 no-outline rounded-circle bg-white text-primary" style="width: 35px; " type="button">
                                <i class="fas fa-search"></i>
                            </button>
                            </div>
                        </div>
                        </div>
                    </form>
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
                                <li class="mb-1 mt-2" style="list-style: none;"><a href="accountant-module.php" class="text-white pt-2 pb-2 pl-3 btn-block bg-primary" style="border-radius: 6px; text-decoration: none;" ><span class="fa fa-home pr-2"></span>Dashboard</a></li>
                                <li class="mb-1 mt-2" style="list-style: none;"><a href="accountant-payment.php" class="text-dark pt-2 pb-2 pl-3 btn-block bg-light" style="border-radius: 6px; text-decoration: none;"><span class="fa fa-calendar pr-2" style="color: purple;"></span>Payments</a></li>
                                <li class="mb-1 mt-2" style="list-style: none;"><a href="accountant-invoice.php" class="text-dark pt-2 pb-2 pl-3 btn-block bg-light" style="border-radius: 6px; text-decoration: none;"><span class="fa fa-calendar pr-2" style="color: purple;"></span>Invoice</a></li>
                                <li class="mb-1 mt-2" style="list-style: none;"><a href="accountant-profile.php" class="text-dark pt-2 pb-2 pl-3 btn-block bg-light" style="border-radius: 6px; text-decoration: none;"><span class="fa fa-calendar pr-2 text-warning" ></span>My Profile</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!--  -->
            <div class="mainContainer col-md-9 overflow-hidden" style="height: 73vh; background: none;">
                <div class=" p-3" style="height: 100%; ">
                    <!--  -->
                    <div class="row">
                        <div class="col">
                            <div class="d-flex w-100 justify-content-between p-1">
                                <h4 class="text-left">Dr. {Nana Yaw's} Profile (Me)</h4>
                                <button class="btn btn-sm bg-light">Today</button>
                            </div>
                        </div>
                    </div>

                    <!--  -->
                    <div class="row pt-2">
                        <div class="col-md-4" style="height: 60vh; border-radius: 15px;">
                            <div class="text-bark bg-light  p-4 shadow-lg" style="height: 100%; border-radius: 15px;">
                                <div class="rounded p-3" style="height: 100%; width: 100%; padding-top: 0;">
                                    <div class="p-2 rounded text-center">
                                        <img src="images.jpeg" class="rounded-circle border border-warning" alt="" width="150" height="150">
                                        <h4 class="mt-3">Dr. Nana Yaw</h4>
                                        <span class="fa fa-calendar mr-2"></span>1982-12-23 <b>·</b> <span>Male</span>
                                        <button class="btn btn-danger btn-block mt-1 mb-1">Logout</button>
                                        <a href="">Change Password?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="p-4 shadow-lg" style="height: 60vh; border-radius: 15px;">
                                <div class="overflow-hidden" style="height: 100%;"> 
                                    <div class="overflow-auto" style="height: 100%;">
                                        <h5>Update Your Profile</h5>
                                        <form>
                                            <div class="form-group">
                                                <label for="patientName">Patient Name</label>
                                                <input type="text" class="form-control" id="patientName" placeholder="Enter patient's name">
                                            </div>
                                            <div class="form-group">
                                                <label for="patientName">Patient Name</label>
                                                <input type="text" class="form-control" id="patientName" placeholder="Enter patient's name">
                                            </div>
                                            <div class="form-group">
                                                <label for="patientName">Patient Name</label>
                                                <input type="text" class="form-control" id="patientName" placeholder="Enter patient's name">
                                            </div>
                                            <div class="form-group">
                                                <label for="patientName">Patient Name</label>
                                                <input type="text" class="form-control" id="patientName" placeholder="Enter patient's name">
                                            </div>
                                            <div class="form-group">
                                                <label for="patientName">Patient Name</label>
                                                <input type="text" class="form-control" id="patientName" placeholder="Enter patient's name">
                                            </div>
                                            <div class="form-group">
                                                <label for="patientName">Patient Name</label>
                                                <input type="text" class="form-control" id="patientName" placeholder="Enter patient's name">
                                            </div>
                                            <div class="form-group">
                                                <label for="patientName">Patient Name</label>
                                                <input type="text" class="form-control" id="patientName" placeholder="Enter patient's name">
                                            </div>

                                            <button type="submit" class="btn btn-warning">Update Profile</button>
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
                        
                    </div>

                    
                    <div class="mt-3 shadow-lg w-100 visibility-hidden"> 
                        <div class="table-responsive overflow-y-hidden" style="border-radius: 12px; height: 56vh;">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="text-nowrap bg-success text-white" >
                                        <th class="text-nowrap">Patient's ID</th>
                                        <th class="text-nowrap">Patient's Name</th>
                                        <th class="text-nowrap">Patient's Email</th>
                                        <th class="text-nowrap">Patient's Role</th>
                                        <th class="text-nowrap">Name</th>
                                        <th class="text-nowrap">Email</th>
                                        <th class="text-nowrap">Role</th>
                                        
                                    </tr>
                                </thead>
                                <tbody class="">
                                    <tr class="text-nowrap">
                                        <td class="text-nowrap">1</td>
                                        <td class="text-nowrap">John Doe somenameof </td>
                                        <td class="text-nowrap">johndoe@example.com</td>
                                        <td class="text-nowrap">User</td>
                                        <td class="text-nowrap">John Doe</td>
                                        <td class="text-nowrap">johndoe@example.com</td>
                                        <td class="text-nowrap">User</td>
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