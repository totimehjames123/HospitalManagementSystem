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
          deletepatientRecord("backend-admin-delete-patientRecord.php", patientId);
        } else {
          alert("deleteled delete!");
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
function fetchpatientRecords(searchTerm = "") {
  $.ajax({
    url: "backend-all-patient-record.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
      var html = "";
      var foundResults = false;

      $.each(data, function (index, patientRecord) {
        // Check if the employeename or email contains the search term
        if (
          patientRecord.patientName.toLowerCase().includes(searchTerm) ||
          patientRecord.nationalId.toLowerCase().includes(searchTerm)
        ) {
          html += `
                                      <tr class="text-nowrap">
                                          <td class="text-nowrap">${patientRecord.id}</td>
                                          <td class="text-nowrap">${patientRecord.patientName}</td>
                                          <td class="text-nowrap">${patientRecord.nationalId}</td>
                                          <td class="text-nowrap">${patientRecord.employeeId}</td>
                                          <td class="text-nowrap">${patientRecord.temperature}&deg;C</td>
                                          <td class="text-nowrap">${patientRecord.bloodPressure}</td>
                                          <td class="text-nowrap">${patientRecord.weight}</td>
                                          <td class="text-nowrap">${patientRecord.height}</td>
                                          <td class="text-nowrap">${patientRecord.sugarLevel}</td>
                                          <td class="text-nowrap">${patientRecord.other}</td>
                                          <td class="text-nowrap">${patientRecord.wardName}</td>
                                          <td class="text-nowrap">${patientRecord.medicatedStatus}</td>
                                          <td class="text-nowrap">${patientRecord.createdDateTime}</td>
                                          <td class="text-nowrap"><button data-id="${patientRecord.id}" data-patientname="${patientRecord.patientName}" class="prescribe-patientRecord btn btn-primary btn-sm" ${patientRecord.medicatedStatus == "none" ? "" : "disabled='disabled'"}>Done?</button></td>
                                          <td class="text-nowrap"><button data-id="${patientRecord.id}" data-patientname="${patientRecord.patientName}" class="delete-patientRecord btn btn-danger btn-sm">Delete</button></td>
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

      // Add a click event listener to delete employees
      $(".delete-patientRecord").click(function () {
        var id = $(this).data("id");
        var patientName = $(this).data("patientname");
        

        var confirmDelete = confirm(
          "Are you sure you want to delete patientRecord with " +
            patientName + " ?"
        );

        if (confirmDelete) {
          deletepatientRecord("backend-nurse-delete-patient-record.php", id);
          
        } else {
          alert("Canceled delete operation!");
        }
      });

      $(".prescribe-patientRecord").click(function () {
        var id = $(this).data("id");
        var patientName = $(this).data("patientname");
        

        var confirmDelete = confirm(
          "Are you sure you want to prescibe patientRecord with " +
            patientName + " ?"
        );

        if (confirmDelete) {
          deletepatientRecord("backend-nurse-prescribe-patient-record.php", id);
          
        } else {
          alert("Canceled prescribe operation!");
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
  autoRefreshIntervalEmployees = setInterval(fetchpatientRecords, 5000);
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
fetchpatientRecords();
startAutoRefresh(); // Start the auto-refresh initially

$(document).ready(function () {
  // Add an event listener to the search input
  $("#searchInput").on("keyup", function () {
    var searchTerm = $(this).val().toLowerCase();
    fetchPatients(searchTerm); // Pass the search term to the fetchPatients function
    fetchpatientRecords(searchTerm); // Pass the search term to the fetchEmp function

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
      fetchpatientRecords(searchTerm); // Pass the search term to the fetchEmp function
  
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

        var formData = $(this).serialize();

        $.ajax({
            url: 'backend-nurse-take-record.php',
            type: 'POST',
            data: formData,
            success: function(data) {
                $('#result').html(data);
                alert(data)
            },
            error: function() {
                $('#result').html('<div class="alert alert-danger">Error submitting form</div>');
                alert("Error while submitting")
            }
        });
    });
});

//Delete any record
function deletepatientRecord(url, recordId) {
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
