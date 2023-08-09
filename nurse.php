<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hospital Management System - Doctor Module</title>
  <!-- Link to Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-4">
    <!-- Doctor Information Management Section -->
    <h2>Doctor Information Management</h2>
    <div class="row">
      <div class="col-md-4">
        <form>
          <div class="form-group">
            <label for="doctorName">Doctor's Name</label>
            <input type="text" class="form-control" id="doctorName" required>
          </div>
          <div class="form-group">
            <label for="doctorSpecialty">Specialty</label>
            <input type="text" class="form-control" id="doctorSpecialty" required>
          </div>
          <!-- Add more doctor information fields here -->
          <button type="submit" class="btn btn-primary">Add Doctor</button>
        </form>
      </div>
      <div class="col-md-8">
        <!-- Display a list of doctors with their information here -->
        <ul class="list-group">
          <li class="list-group-item d-flex justify-content-between align-items-center">
            Dr. John Doe
            <span class="badge badge-primary badge-pill">Cardiologist</span>
          </li>
          <!-- Add more doctor list items here -->
        </ul>
      </div>
    </div>

    <!-- Appointment Scheduling Section -->
    <h2 class="mt-4">Appointment Scheduling</h2>
    <form>
      <div class="form-group">
        <label for="patientName">Patient's Name</label>
        <input type="text" class="form-control" id="patientName" required>
      </div>
      <div class="form-group">
        <label for="doctorSelect">Select Doctor</label>
        <select class="form-control" id="doctorSelect" required>
          <option value="" disabled selected>Select a doctor</option>
          <option value="1">Dr. John Doe (Cardiologist)</option>
          <!-- Add more doctor options here -->
        </select>
      </div>
      <div class="form-group">
        <label for="appointmentDate">Appointment Date</label>
        <input type="date" class="form-control" id="appointmentDate" required>
      </div>
      <div class="form-group">
        <label for="appointmentTime">Appointment Time</label>
        <input type="time" class="form-control" id="appointmentTime" required>
      </div>
      <!-- Add more appointment details fields here -->
      <button type="submit" class="btn btn-primary">Schedule Appointment</button>
    </form>
  </div>
</body>
</html>
     