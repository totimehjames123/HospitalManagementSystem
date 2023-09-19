//FETCH ALL USERS
var autoRefreshIntervalPatients; // Define a variable to hold the interval ID
var autoRefreshIntervalEmployees; // Define a variable to hold the interval ID

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
                                    
                                <div data-patientname="${patient.patientName}" data-nationalid="${patient.nationalID}" class="patient-data row p-2 rounded user-hover overflow: hidden;"  style="max-height: 50px;">
                                    <div class="flex justify-content-start align-items-center" style="width: 35px;  float: left;">
                                        <img src="uploads/${patient.profilePicture}" alt="" class="mr-2 rounded-circle" width="30" height="30">
                                    </div>
                                    <div class="text-truncate" style="overflow: hidden; max-width: 150px; float: left;">
                                        <div class="m-0" style="line-height: 15px;">
                                            <small class=""><b>${patient.patientName}</b></small>
                                        </div>
                                        <div class="text-truncate" style="line-height: 14px; overflow: ellipsis;">
                                            <small class="text-dark ">${patient.nationalID} · ${patient.id}</small>
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

      $("#allPatients").html(html);


      $(".patient-data").click(function () {
        var patientName = $(this).data("patientname");
        var nationalID = $(this).data("nationalid");

        // Set the values in the input fields
        $("#patientName").val(patientName);
        $("#nationalID").val(nationalID);

        $("#patientName1").val(patientName);
        $("#nationalID1").val(nationalID);
      });

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
          cancelOperations("backend-admin-cancel-Operations.php", patientId);
        } else {
          alert("Cancelled delete!");
        }
        // // Set the values in the input fields
        // $('#patientName').val(patientName);
        // $('#patientEmail').val(patientEmail);
      });

      // Add a click event listener to edit patients
      

    },
    error: function () {
      console.error("Error fetching data.");
    },
  });
}

//Fetching all employees (doctor, nurse, laboratorist, pharmacist, and many more...)
function fetchOperationss(searchTerm = "") {
  $.ajax({
    url: "backend-all-operations.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
      var html = "";
      var foundResults = false;

      $.each(data, function (index, operations) {
        // Check if the employeename or email contains the search term
        if (
          operations.patientName.toLowerCase().includes(searchTerm) ||
          operations.nationalId.toLowerCase().includes(searchTerm)
        ) {
          html += `
                                      <tr class="text-nowrap">
                                          <td class="text-nowrap">${operations.id}</td>
                                          <td class="text-nowrap">${operations.patientName}</td>
                                          <td class="text-nowrap">${operations.nationalId}</td>
                                          <td class="text-nowrap">${operations.employeeId}</td>
                                          <td class="text-nowrap">${operations.operationType}</td>
                                          <td class="text-nowrap ${operations.requestStatus == "Accepted" ? "text-success" : ""} ${operations.requestStatus == "Pending" ? "text-warning" : ""} ${operations.requestStatus == "Rejected" ? "text-warning" : ""} ${operations.requestStatus == "Canceled" ? "text-danger" : ""}">${operations.requestStatus}</td>
                                          <td class="text-nowrap">${operations.notes}</td>
                                          <td class="text-nowrap">${operations.createdDateTime}</td>
                                          <td class="text-nowrap">${operations.startDateTime}</td>
                                          <td class="text-nowrap"><button data-id="${operations.id}" data-patientname="${operations.patientName}" class="cancel-operations  btn btn-warning btn-sm" ${operations.requestStatus == "Canceled" ? "disabled='disabled'" : ""}>Cancel Request</button></td>
                                          <td class="text-nowrap"><button data-id="${operations.id}" data-patientname="${operations.patientName}" class="view-report btn btn-primary btn-sm" ${operations.operationReport == null ? "disabled='disabled'" : ""}>View Report</button></td>
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


      $(".view-report").click(function () {
        var id = $(this).data('id');

        // Send a POST request to index.php
        url = 'doctor-operation-report.php?id=' + id
        window.location.href = url
        
    });


      // Add a click event listener to delete employees
      $(".cancel-operations").click(function () {
        var id = $(this).data("id");
        var patientName = $(this).data("patientname");
        

        var confirmDelete = confirm(
          "Are you sure you want to cancel operations with " +
            patientName + " ?"
        );

        if (confirmDelete) {
          cancelOperations("backend-doctor-cancel-operation.php", id);
          
        } else {
          alert("Cancelled delete!");
        }
      });

      
    },
    error: function () {
      console.error("Error fetching data.");
    },
  });
}

// Function to start the auto-refresh interval
function startAutoRefresh() {
  autoRefreshIntervalPatients = setInterval(fetchPatients, 5000);
  autoRefreshIntervalEmployees = setInterval(fetchOperationss, 5000);
}

// Function to stop the auto-refresh interval
function stopAutoRefresh() {
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
fetchPatients();
fetchOperationss();
startAutoRefresh(); // Start the auto-refresh initially

$(document).ready(function () {
  // Add an event listener to the search input
  $("#searchInput").on("keyup", function () {
    var searchTerm = $(this).val().toLowerCase();
    fetchPatients(searchTerm); // Pass the search term to the fetchPatients function
    fetchOperationss(searchTerm); // Pass the search term to the fetchEmp function

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
      fetchOperationss(searchTerm); // Pass the search term to the fetchEmp function
  
      if (isFilterFieldEmpty()) {
        startAutoRefresh(); // Start the auto-refresh if the search field is empty
      } else {
        stopAutoRefresh(); // Stop the auto-refresh if the search field is not empty
      }
    });
  });



  $(document).ready(function() {
    $('#myForm').on('submit', function(e) {
        e.preventDefault();

        // Create a FormData object to handle form data
        var formData = new FormData(this);

        $.ajax({
            url: 'backend-doctor-request-operation.php', // Replace with the actual path to your PHP script
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json', // Expect JSON response
            success: function(response) {
                if (response.success) {
                    // Operation request submitted successfully
                    alert("Operation request submitted successfully")
                    $('#result').removeClass('text-danger').addClass('text-success').text('Operation request submitted successfully.');
                } else {
                    // Error submitting operation request
                    $('#result').removeClass('text-success').addClass('text-danger').text('Error: ' + response.message);
                    alert("Error submitting operation request")
                }
            },
            error: function(error) {
                $('#result').removeClass('text-success').addClass('text-danger').text('Error submitting operation request: ' + error.message);
            }
        });
    });
});

$(document).ready(function() {
    $('#reportForm').on('submit', function(e) {
        e.preventDefault();

        // Create a FormData object to handle form data
        var formData = new FormData(this);

        $.ajax({
            url: 'backend-doctor-create-report.php', // Replace with the actual path to your PHP script
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json', // Expect JSON response
            success: function(response) {
                if (response.success) {
                    // Operation report updated successfully
                    $('#resultReport').removeClass('text-danger').addClass('text-success').text(response.message);
                    alert(response.message)
                } else {
                    // Error updating operation report
                    $('#resultReport').removeClass('text-success').addClass('text-danger').text(response.message);
                    alert(response.message)
                }
            },
            error: function(error) {
                $('#resultReport').removeClass('text-success').addClass('text-danger').text('Error updating operation report: ' + error.message);
            }
        });
    });
});


//Delete any record
function cancelOperations(url, recordId) {
  $.ajax({
    type: "POST",
    url: url, // Replace with your PHP script URL
    data: { id: recordId },
    success: function (response) {
      alert("You've successfully canceled an Operations!");
    },
    error: function (error) {
      alert(error.ResponseText);
    },
  });
}

//Fetch all employees
