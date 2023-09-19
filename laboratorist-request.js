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
          cancellaboratory("backend-doctor-accept-laboratory.php", patientId);
        } else {
          alert("Cancelled!");
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
function fetchlaboratorys(searchTerm = "") {
  $.ajax({
    url: "backend-all-laboratory.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
      var html = "";
      var foundResults = false;

      $.each(data, function (index, laboratory) {
        // Check if the employeename or email contains the search term
        if (
          laboratory.patientName.toLowerCase().includes(searchTerm) ||
          laboratory.nationalId.toLowerCase().includes(searchTerm)
        ) {
          html += `
                                      <tr class="text-nowrap">
                                          <td class="text-nowrap">${laboratory.id}</td>
                                          <td class="text-nowrap">${laboratory.patientName}</td>
                                          <td class="text-nowrap">${laboratory.nationalId}</td>
                                          <td class="text-nowrap">${laboratory.employeeId}</td>
                                          <td class="text-nowrap">${laboratory.serviceType}</td>
                                          <td class="text-nowrap ${laboratory.requestStatus == "Accepted" ? "text-success" : ""} ${laboratory.requestStatus == "Pending" ? "text-warning" : ""} ${laboratory.requestStatus == "Rejected" ? "text-warning" : ""} ${laboratory.requestStatus == "Canceled" ? "text-danger" : ""}">${laboratory.requestStatus}</td>
                                          <td class="text-nowrap">${laboratory.laboratoristId == null ? "": laboratory.laboratoristId}</td>
                                          <td class="text-nowrap">${laboratory.createdDateTime}</td>
                                          <td class="text-nowrap"><button data-id="${laboratory.id}" data-patientname="${laboratory.patientName}" data-nationalid="${laboratory.nationalId}" class="accept-laboratory btn btn-primary btn-sm" ${laboratory.requestStatus == "Accepted" ? "disabled='disabled'" : ""} ${laboratory.requestStatus == "Canceled" ? "disabled='disabled'" : ""}>Accept Request</button></td>
                                          <td class="text-nowrap"><button data-id="${laboratory.id}" data-patientname="${laboratory.patientName}" data-nationalid="${laboratory.nationalId}" class="reject-laboratory btn btn-danger btn-sm" ${laboratory.requestStatus == "Rejected" ? "disabled='disabled'" : ""} ${laboratory.requestStatus == "Canceled" ? "disabled='disabled'" : ""}>Reject Request</button></td>
                                          <td class="text-nowrap"><button data-id="${laboratory.id}" data-patientname="${laboratory.patientName}" data-nationalid="${laboratory.nationalId}" class="view-report btn btn-warning btn-sm" ${laboratory.diagnosticsDetails == null ? "disabled='disabled'" : ""}>View Report</button></td>
                                          <td class="text-nowrap"><button data-id="${laboratory.id}" data-patientname="${laboratory.patientName}" data-nationalid="${laboratory.nationalId}" class="create-report btn ${laboratory.diagnoticsDetails == null ? "btn-dark" : "btn-secondary"} btn-sm">${laboratory.diagnoticsDetails == null ? "Create Report" : "Update Report"}</button></td>
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


    $(".create-report").click(function () {
        var id = $(this).data('id');
        var patientName = $(this).data("patientname");
        var nationalID = $(this).data("nationalid");

        // Set the values in the input fields
        $("#id").val(id);
        $("#patientName").val(patientName);
        $("#nationalID").val(nationalID);
        
    });

    $(".view-report").click(function () {
        var id = $(this).data('id');

        // Send a POST request to index.php
        url = 'doctor-laboratory-report.php?id=' + id
        window.location.href = url
        
    });


      // Add a click event listener to delete employees
      $(".accept-laboratory").click(function () {
        var id = $(this).data("id");
        var patientName = $(this).data("patientname");
        
        var confirmDelete = confirm(
          "Are you sure you want to accept laboratory with " +
            patientName +" ?"
        );

        if (confirmDelete) {
          cancellaboratory("backend-laboratorist-accept-laboratory.php", id);
          
        } else {
          alert("Cancelled!");
        }
      });
      // Add a click event listener to delete employees
      $(".reject-laboratory").click(function () {
        var id = $(this).data("id");
        var patientName = $(this).data("patientname");
        
        var confirmDelete = confirm(
          "Are you sure you want to reject laboratory with " +
            patientName +" ?"
        );

        if (confirmDelete) {
          cancellaboratory("backend-laboratorist-reject-laboratory.php", id);
          
        } else {
          alert("Cancelled!");
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
  autoRefreshIntervalEmployees = setInterval(fetchlaboratorys, 5000);
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
fetchlaboratorys();
startAutoRefresh(); // Start the auto-refresh initially

$(document).ready(function () {
  // Add an event listener to the search input
  $("#searchInput").on("keyup", function () {
    var searchTerm = $(this).val().toLowerCase();
    fetchPatients(searchTerm); // Pass the search term to the fetchPatients function
    fetchlaboratorys(searchTerm); // Pass the search term to the fetchEmp function

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
      fetchlaboratorys(searchTerm); // Pass the search term to the fetchEmp function
  
      if (isFilterFieldEmpty()) {
        startAutoRefresh(); // Start the auto-refresh if the search field is empty
      } else {
        stopAutoRefresh(); // Stop the auto-refresh if the search field is not empty
      }
    });
  });


$(document).ready(function() {
    $('#myForm').submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: 'backend-laboratorist-create-report.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                $('#result').html(data);
            },
            error: function() {
                $('#result').html('<div class="alert alert-danger">Error submitting form</div>');
            }
        });
    });
});



//Delete any record
function cancellaboratory(url, recordId) {
  $.ajax({
    type: "POST",
    url: url, // Replace with your PHP script URL
    data: { id: recordId },
    success: function (response) {
    },
    error: function (error) {
      alert(error.ResponseText);
    },
  });
}

//Fetch all employees
