//FETCH ALL USERS
var autoRefreshIntervalUsers; // Define a variable to hold the interval ID
var autoRefreshIntervalPatients; // Define a variable to hold the interval ID
var autoRefreshIntervalEmployees; // Define a variable to hold the interval ID

function fetchUsers(searchTerm = "") {
  $.ajax({
    url: "backend-all-users.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
      var html = "";
      var foundResults = false;

      $.each(data, function (index, user) {
        // Check if the username or email contains the search term
        if (
          user.username.toLowerCase().includes(searchTerm) ||
          user.email.toLowerCase().includes(searchTerm)
        ) {
          html += `
                                <div data-username="${user.username}" data-email="${user.email}" data-profilepicture="${user.profilePicture}" class="user-data row p-2 rounded user-hover overflow: hidden;"  style="max-height: 50px;">
                                    <div class="flex justify-content-start align-items-center" style="width: 35px;  float: left;">
                                        <img src="./uploads/${user.profilePicture}" alt="" class="mr-2 rounded-circle" width="30" height="30">
                                    </div>
                                    <div class="text-truncate" style="overflow: hidden; max-width: 150px; float: left;">
                                        <div class="m-0" style="line-height: 15px;">
                                            <small class=""><b>${user.username}</b></small>
                                        </div>
                                        <div class="text-truncate" style="line-height: 14px; overflow: ellipsis;">
                                            <small class="text-dark ">${user.email}</small>
                                        </div>
                                    </div>
                                </div>
                            `;

          foundResults = true;
        }
      });

      if (!foundResults) {
        html = `
                                <div class="text-center">
                                    No search results for <br> <b>'${searchTerm}'</b>
                                </div>
                                `;
      }

      $("#allUsers").html(html);

      // Function to start the auto-refresh interval
      
      // Add a click event listener to the .user-data elements
      $(".user-data").click(function () {
        var username = $(this).data("username");
        var email = $(this).data("email");
        var profilePicture = $(this).data("profilepicture");

        // Set the values in the input fields
        $("#patientName").val(username);
        $("#patientEmail").val(email);
        $("#patientProfilePicture").val(profilePicture);
      });
    },
    error: function () {
      console.error("Error fetching data.");
    },
  });
}

//Fetching patients
function fetchPatients(searchTerm = "") {
  $.ajax({
    url: "backend-all-patients.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
      var html = "";
      var foundResults = false;

      $.each(data, function (index, patient) {
        // Check if the patientname or email contains the search term
        if (
          patient.patientName.toLowerCase().includes(searchTerm) ||
          patient.nationalID.toLowerCase().includes(searchTerm)
        ) {
          html += `
                                    <tr class="text-nowrap">
                                        <td class="text-nowrap">${patient.id}</td>
                                        <td class="text-nowrap">${patient.patientName}</td>
                                        <td class="text-nowrap">${patient.nationalID}</td>
                                        <td class="text-nowrap">${patient.patientEmail}</td>
                                        <td class="text-nowrap">${patient.mobileNumber}</td>
                                        <td class="text-nowrap">${patient.dateOfRegistration}</td>
                                        <td class="text-nowrap"><button data-userid="${patient.id}" data-username="${patient.patientName}" data-email="${patient.patientEmail}" data-number="${patient.mobileNumber}" data-nationalid="${patient.nationalID}" class="edit-patient btn btn-primary btn-sm">Edit</button></td>
                                        <td class="text-nowrap"><button data-userid="${patient.id}" data-username="${patient.patientName}" data-email="${patient.patientEmail}" class="delete-patient btn btn-danger btn-sm">Delete</button></td>
                                    </tr>
                            `;

          foundResults = true;
        }
      });

      if (!foundResults) {
        html = `
                                    <tr class="text-nowrap text-center">
                                        <td colspan="8" class="text-nowrap">No search results for '<b>${searchTerm}<b>'</td>
                                    </tr>
                                `;
      }

      $("#allPatients").html(html);

      // Function to start the auto-refresh interval

      // Add a click event listener to delete patients
      $(".delete-patient").click(function () {
        var patientId = $(this).data("userid");
        var patientName = $(this).data("username");
        var patientEmail = $(this).data("email");

        var confirmDelete = confirm(
          "Are you sure you want to delete " +
            patientName +
            " with email of " +
            patientEmail +
            " ?"
        );

        if (confirmDelete) {
          deleteRecord("backend-admin-delete-patient.php", patientId);
          alert("You've successfully deleted one record!");
        } else {
          alert("Cancelled delete!");
        }
        // // Set the values in the input fields
        // $('#patientName').val(patientName);
        // $('#patientEmail').val(patientEmail);
      });

      // Add a click event listener to edit patients
      $(".edit-patient").click(function () {
        var patientId = $(this).data("userid");
        var patientName = $(this).data("username");
        var patientEmail = $(this).data("email");
        var mobileNumber = $(this).data("number");
        var nationalID = $(this).data("nationalid");

        // Construct the URL with GET parameters
        var url =
          "admin-update-patient.php?patientId=" +
          patientId +
          "&patientName=" +
          patientName +
          "&patientEmail=" +
          patientEmail +
          "&mobileNumber=" +
          mobileNumber +
          "&nationalID=" +
          nationalID;

        // Redirect to the PHP page
        window.location.href = url;
      });

    },
    error: function () {
      console.error("Error fetching data.");
    },
  });
}

//Fetching all employees (doctor, nurse, laboratorist, pharmacist, and many more...)
function fetchEmployees(searchTerm = "") {
  $.ajax({
    url: "backend-all-employees.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
      var html = "";
      var foundResults = false;

      $.each(data, function (index, employee) {
        // Check if the employeename or email contains the search term
        if (
          employee.employeeName.toLowerCase().includes(searchTerm) ||
          employee.employeeId.toLowerCase().includes(searchTerm)
        ) {
          html += `
                                      <tr class="text-nowrap">
                                          <td class="text-nowrap">${employee.id}</td>
                                          <td class="text-nowrap"><img src="uploads/${employee.employeeProfilePicture}" width="50" height="50" class="rounded-circle"></td>
                                          <td class="text-nowrap">${employee.employeeId}</td>
                                          <td class="text-nowrap">${employee.employeeName}</td>
                                          <td class="text-nowrap">${employee.employeeStudentId}</td>
                                          <td class="text-nowrap">${employee.employeeEmail}</td>
                                          <td class="text-nowrap">${employee.country}</td>
                                          <td class="text-nowrap">${employee.employeeHomeAddress}</td>
                                          <td class="text-nowrap">${employee.employeeGender}</td>
                                          <td class="text-nowrap">${employee.employeeJobTitle}</td>
                                          <td class="text-nowrap">${employee.employeeWorkStatus}</td>
                                          <td class="text-nowrap">${employee.employeeTertiaryCompleted}</td>
                                          <td class="text-nowrap">${employee.employeeNationalId}</td>
                                          <td class="text-nowrap">${employee.employeePhoneNumber}</td>
                                          <td class="text-nowrap">${employee.dateOfRegistration}</td>
                                          <td class="text-nowrap"><button data-userid="${employee.id}" data-username="${employee.employeeName}" data-email="${employee.employeeEmail}" data-number="${employee.mobileNumber}" data-nationalid="${employee.nationalID}" class="edit-employee btn btn-primary btn-sm">Edit</button></td>
                                          <td class="text-nowrap"><button data-userid="${employee.id}" data-employeeid="${employee.employeeId}" data-username="${employee.employeeName}" data-email="${employee.employeeEmail}" class="delete-employee btn btn-danger btn-sm">Delete</button></td>
                                      </tr>
                              `;

          foundResults = true;
        }
      });

      if (!foundResults) {
        html = `
                                      <tr class="text-nowrap text-center">
                                          <td colspan="8" class="text-nowrap">No search results for '<b>${searchTerm}<b>'</td>
                                      </tr>
                                  `;
      }

      $("#allEmployees").html(html);

      // Function to start the auto-refresh interval

      // Add a click event listener to delete employees
      $(".delete-employee").click(function () {
        var id = $(this).data("userid");
        var employeeName = $(this).data("username");
        var employeeId = $(this).data("employeeid");

        var confirmDelete = confirm(
          "Are you sure you want to delete " +
            employeeName +
            " with Id of " +
            employeeId +
            " ?"
        );

        if (confirmDelete) {
          deleteRecord("backend-admin-delete-employee.php", id);
          alert("You've successfully deleted one record!");
        } else {
          alert("Cancelled delete!");
        }
      });

      $(".edit-employee").click(function () {
        var employeeId = $(this).data("userid");
        var employeeName = $(this).data("username");
        var employeeEmail = $(this).data("email");
        var mobileNumber = $(this).data("number");
        var nationalID = $(this).data("nationalid");

        // Construct the URL with GET parameters
        var url =
          "admin-update-employee.php?employeeId=" +
          employeeId
          

        // Redirect to the PHP page
        window.location.href = url;
      });
    },
    error: function () {
      console.error("Error fetching data.");
    },
  });
}

// Function to start the auto-refresh interval
function startAutoRefresh() {
  autoRefreshIntervalUsers = setInterval(fetchUsers, 5000);
  autoRefreshIntervalPatients = setInterval(fetchPatients, 5000);
  autoRefreshIntervalEmployees = setInterval(fetchEmployees, 5000);
}

// Function to stop the auto-refresh interval
function stopAutoRefresh() {
  clearInterval(autoRefreshIntervalUsers);
  clearInterval(autoRefreshIntervalPatients);
  clearInterval(autoRefreshIntervalEmployees);
}

// Function to check if the search field is empty
function isSearchFieldEmpty() {
  return $("#searchInput").val().trim() === "";
}

function isFilterFieldEmpty() {
    return $("#jobTitleFilter").val().trim() === "";
}

// Initial data load
fetchUsers();
fetchPatients();
fetchEmployees();
startAutoRefresh(); // Start the auto-refresh initially

$(document).ready(function () {
  // Add an event listener to the search input
  $("#searchInput").on("keyup", function () {
    var searchTerm = $(this).val().toLowerCase();
    fetchUsers(searchTerm); // Pass the search term to the fetchUsers function
    fetchPatients(searchTerm); // Pass the search term to the fetchPatients function
    fetchEmployees(searchTerm); // Pass the search term to the fetchEmp function

    if (isSearchFieldEmpty()) {
      startAutoRefresh(); // Start the auto-refresh if the search field is empty
    } else {
      stopAutoRefresh(); // Stop the auto-refresh if the search field is not empty
    }
  });
});

$(document).ready(function () {
    // Add an event listener to the search input
    $("#jobTitleFilter").on("keyup", function () {
      var searchTerm = $(this).val().toLowerCase();
      fetchEmployees(searchTerm); // Pass the search term to the fetchEmp function
  
      if (isFilterFieldEmpty()) {
        startAutoRefresh(); // Start the auto-refresh if the search field is empty
      } else {
        stopAutoRefresh(); // Stop the auto-refresh if the search field is not empty
      }
    });
  });



//Submit - add new patient
$(document).ready(function () {
  // Add a submit event listener to the form
  $("#myForm").submit(function (e) {
    e.preventDefault(); // Prevent the default form submission behavior

    // Trim and validate required fields
    var patientName = $("#patientName").val().trim();
    var nationalID = $("#nationalID").val().trim();

    if (patientName === "" || nationalID === "") {
      // Display an error message if any required field is empty
      $("#result").removeClass("text-success");
      $("#result").addClass("text-danger");
      $("#result").html("Please fill in all required fields.");
      
      return;
    }

    // Serialize the form data into a format that can be sent in the request
    var formData = $(this).serialize();

    $.ajax({
      url: "backend-admin-create-patient.php", // Replace with the actual URL to your server-side script
      type: "POST", // You can also use 'GET' if your server-side script expects GET requests
      data: formData, // The serialized form data
      success: function (response) {
        // Handle the success response from the server
        $("#result").removeClass("text-danger");
        $("#result").addClass("text-success");
        $("#result").html("Patient added successfully!");
        alert("Patient added successfully!");
      },
      error: function (error) {
        // Handle any errors that occur during the AJAX request
        $("#result").removeClass("text-success");
        $("#result").addClass("text-danger");
        $("#result").html(JSON.parse(error.responseText).message);
        
        alert(JSON.parse(error.responseText).message);
      },
    });
  });
});

//Delete any record
function deleteRecord(url, recordId) {
  $.ajax({
    type: "POST",
    url: url, // Replace with your PHP script URL
    data: { id: recordId },
    success: function (response) {
      $("#result").html(response);
    },
    error: function (error) {
      alert(error.ResponseText);
    },
  });
}

//Fetch all employees
