<!DOCTYPE html>
<html>
<head>
  <title>Ayao Medical Center</title>
  <!-- Add the Bootstrap CSS link -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <style>
   .gradient-background {
        /* Fallback background color in case gradients are not supported */
        background-color: #007bff;
        background-image: linear-gradient(175deg, white, white, lightblue, #007bff);
        
        background-size: cover;
    }

    .text-primary {
  color: #007bff;
}

/* Keyframe animation for typing forward effect */
@keyframes typing {
  0% {
    width: 0; /* Start with no width */
  }
  50% {
    width: 100%; /* Gradually fill the width */
  }
  100% {
    width: 100%; /* Keep the width full */
  }
}

/* Keyframe animation for erasing effect */
@keyframes erasing {
  0% {
    width: 100%; /* Start with full width */
  }
  50% {
    width: 0; /* Gradually reduce the width to erase */
  }
  100% {
    width: 0; /* Keep the width erased */
  }
}

/* Apply typing animation to the .typing-text class with different delays */
.typing-text {
  display: inline-block;
  white-space: nowrap; /* Prevent text from wrapping to the next line */
  overflow: hidden; /* Hide overflow text while typing */
  width: 100%; /* Initially set the width to 100% */
  animation-duration: 5s; /* Adjust duration as needed */
  animation-timing-function: linear; /* Use linear timing function for consistency */
  animation-iteration-count: infinite; /* Repeat the animation infinitely */
}

.typing-text:nth-child(2) {
  animation-name: typing;
  animation-delay: 0s; /* Delay for the first country */
}

.typing-text:nth-child(3) {
  animation-name: typing;
  animation-delay: 5s; /* Delay for the second country after the first one finishes */
}

.typing-text:nth-child(4) {
  animation-name: typing;
  animation-delay: 10s; /* Delay for the third country after the second one finishes */
}

.typing-text:nth-child(5) {
  animation-name: typing;
  animation-delay: 15s; /* Delay for the fourth country after the third one finishes */
}

/* Apply erasing animation with delays */
.typing-text:nth-child(6) {
  animation-name: erasing;
  animation-delay: 20s; /* Delay for erasing the first country after all countries finish typing */
}

.typing-text:nth-child(7) {
  animation-name: erasing;
  animation-delay: 25s; /* Delay for erasing the second country after the first one erases */
}

.typing-text:nth-child(8) {
  animation-name: erasing;
  animation-delay: 30s; /* Delay for erasing the third country after the second one erases */
}

.typing-text:nth-child(9) {
  animation-name: erasing;
  animation-delay: 35s; /* Delay for erasing the fourth country after the third one erases */
}



  </style>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-light ">
    <div class="container">
      <!-- Logo on the left -->
      <a class="navbar-brand" href="#">
        <img src="logo.png" alt="Logo" style="max-height: 30px;">
        <span class="pl-2 text-primary font-weight-bold">Ayao</span>
        <span class="text-warning font-weight-bold">Medical</span>
        <span class="text-dark font-weight-bold">Center</span>
      </a>

      <!-- Toggle button for mobile navigation -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <!-- Links at the center -->
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>
          <!-- Add more links as needed -->
        </ul>

        <!-- Button on the right -->
        <div class="ml-auto">
          <a href="#" class="btn bg-dark text-warning pl-4 pr-4" style="border-radius: 20px;">Premium</a>
        </div>
      </div>
    </div>    
  </nav>

  <!-- MAIN BODY -->

  <!-- Main Content with Divided Layout -->
  <div class="container-fluid d-flex flex-column justify-content-center align-items-center gradient-background" style="height: calc(100vh - 56px);"> <!-- 56px is the height of the header, adjust as needed -->
    <div class="row">
      <!-- Left Column with Text and Buttons -->
      <div class="col-md-6 text-center">
        <!-- Your text here -->
        <h1>
          <span class="" style="max-height: 90px">
            <span>Number One Medical System In </span><br>
            <span class="text-primary typing-text">Ghana.</span><br>
          </span>
        </h1>



        <!-- Buttons -->
        <div class="mt-4">
          <a href="signup.php" class="btn btn-warning mr-2 pl-4 pr-4 p-2 font-weight-bold" style="border-radius: 20px;">Get Started</a>
          <a href="login.php" class="btn btn-outline-dark pl-5 pr-5 p-2 font-weight-bold" style="border-radius: 20px;">Signin</a>
        </div>
      </div>
      <!-- Right Column with Image -->
      <div class="col-md-6 d-flex justify-content-center">
        <img src="health.png" alt="Image" >
      </div>
    </div>
  </div>

  <!-- Services -->
  <div class="services">
    some services
  </div>

  <!-- Add the Bootstrap JS and Popper.js scripts (optional, but may be required for some Bootstrap components) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
