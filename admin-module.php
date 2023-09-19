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
            background-color: red;
        }
    </style>
</head>
<body>
    <div class="mainBody d-flex align-items-center justify-content-center bg-light" style="min-height: 100vh; height: 100vh">
        <div class="bg-white" style="min-height: 80%; max-width: 90%; border-radius: 20px">
            <div class="container bg-white" style="height: 10vh;">
            <nav class="navbar navbar-expand-lg navbar-light bg-white pt-3">
                <a class="navbar-brand" href="index.php">
                    <img src="logo.png" alt="Logo" style="max-height: 30px;">
                    <!-- <span class="pl-2 text-primary font-weight-bold">Ayao</span> -->
                    <!-- <span class="text-warning font-weight-bold">Medical</span>
                    <span class="text-dark font-weight-bold">Center</span> -->
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
            <div class="row w-100 relative" style="height: 75vh">
                <div class="sideBarContainer  col-md-3 pt-3" style="height: 100%;">
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
                <div class="mainContainer col-md-9">
                    <div class="row">
                        <div class="col">
                        <div class="d-flex w-100 justify-content-between p-1">
                            <h4 class="text-left">Overview</h4>
                            <button class="btn btn-sm bg-light">Today</button>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="text-dark p-3 shadow-lg" style="height: 25vh; border-radius: 15px; background: #C0D9E7;">
                                <div class="" style="height: 30vh;">
                                    <h6 class="text-primary">Total Doctors</h6>
                                    <h1 class="text-center pt-2">23</h1>
                                    <div class="text-right">
                                        <small class="p-2 bg-white rounded">active</small>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="text-warning p-3 shadow-lg" style="height: 25vh; border-radius: 15px; background: #FFEBF3;">
                                <div class="" style="height: 30vh;">
                                    <h6 class="text">Total Doctors</h6>
                                    <h1 class="text-center text-dark pt-2">23</h1>
                                    <div class="text-right">
                                        <small class="p-2 bg-white rounded">active</small>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                            <div class="text-success p-3 shadow-lg" style="height: 25vh; border-radius: 15px; background: #e1f0ff;">
                                <div class="" style="height: 30vh;">
                                    <h6 class="text-success">Total Doctors</h6>
                                    <h1 class="text-center text-dark pt-2">23</h1>
                                    <div class="text-right">
                                        <small class="p-2 bg-white rounded">active</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row pt-4">
                        <div class="col-md-8">
                            <div class="text-white bg-warning p-4 shadow-lg" style="height: 35vh; border-radius: 15px;">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div style="height: 100%" class="pt-2 d-flex justify-content-center">
                                            <img src="doctor.png" alt="">
                                        </div>
                                    </div>
                                    <div class="col">
                                    <h4>Vaccines</h4>
                                        <span>Remember to take the vacine Lorem ipsum dolor
                                            , sit amet consectetur adipisicing elit. Cumq
                                            ue accusantium accusamus minus iusto voluptates
                                                sapiente est laboriosam voluptatibus quos sun
                                                
                                        </span>
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                        <div class="col-md-4" style="height: 25vh; border-radius: 15px;">
                            <div class="text-bark bg-white  p-4 shadow-lg" style="height: 35vh; border-radius: 15px;">
                                <h4>Review</h4>
                                <span>
                                    Lorem ipsum dolor sit. Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                                </span>
                            </div>
                        </div>
                    </div>

            </div>
        </div>  
    </div>
    
</body>
</html>