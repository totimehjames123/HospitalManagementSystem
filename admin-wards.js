var autoRefreshIntervalWards; // Define a variable to hold the interval ID

//Fetching Wards
function fetchWards(searchTerm = "") {
  $.ajax({
    url: "backend-all-wards.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
      var html = "";
      var foundResults = false;

      $.each(data, function (index, ward) {
        // Check if the Wardname or email contains the search term
        if (
          ward.wardName.toLowerCase().includes(searchTerm) ||
          ward.wardType.toLowerCase().includes(searchTerm)
        ) {
          html += `
                                    <tr class="text-nowrap">
                                        <td class="text-nowrap">${ward.id}</td>
                                        <td class="text-nowrap">${ward.wardName}</td>
                                        <td class="text-nowrap">${ward.wardType}</td>
                                        <td class="text-nowrap">${ward.numberOfBeds}</td>
                                        <td class="text-nowrap">${ward.availableBeds}</td>
                                        <td class="text-nowrap">${ward.occupiedBeds}</td>
                                        <td class="text-nowrap">${ward.nurseInCharge}</td>
                                        <td class="text-nowrap">${ward.nurseId}</td>
                                        <td class="text-nowrap">${ward.buildingName}</td>
                                        <td class="text-nowrap">${ward.dateOfRegistration}</td>
                                        <td class="text-nowrap"><button data-id="${ward.id}" data-wardname="${ward.wardName}" data-wardtype="${ward.wardType}" data-numberofbeds="${ward.numberOfBeds}" data-availablebeds="${ward.availableBeds}" data-occupiedbeds="${ward.occupiedBeds}" data-nurseincharge="${ward.nurseInCharge}" data-nurseid="${ward.nurseId}" data-buildingname="${ward.buildingName}" class="edit-ward btn btn-primary btn-sm">Edit</button></td>
                                        <td class="text-nowrap"><button data-id="${ward.id}" data-wardname="${ward.wardName}" class="delete-ward btn btn-danger btn-sm">Delete</button></td>
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

      $("#allWards").html(html);

      // Function to start the auto-refresh interval


      // Add a click event listener to delete Wards
          $(".delete-ward").click(function () {
            var id = $(this).data("id");
            var wardName = $(this).data("wardname");

            var confirmDelete = confirm(
              "Are you sure you want to delete " + id +
                wardName + "?"
            );

            if (confirmDelete) {
              deleteRecord("backend-admin-delete-ward.php", id);
              alert("You've successfully deleted one record!");
            } else {
              alert("Cancelled delete!");
            }
            
          });

          // Add a click event listener to edit Wards
          $(".edit-ward").click(function () {
            // <td class="text-nowrap"><button data-id="${ward.id}" data-username="${ward.wardName}" data-numberofbeds="${ward.numberOfBeds}" data-availablebeds="${ward.availableBeds}" data-nurseincharge="${ward.nurseInCharge} data-nurseid="${ward.nurseId}" data-buildingname="${ward.buildingName} class="edit-ward btn btn-primary btn-sm">Edit</button></td>

            var id = $(this).data("id");
            var wardName = $(this).data("wardname");
            var wardType = $(this).data("wardtype");
            var numberOfBeds = $(this).data("numberofbeds");
            var availableBeds = $(this).data("availablebeds");
            var occupiedBeds = $(this).data("occupiedbeds");
            var nurseInCharge = $(this).data("nurseincharge");
            var nurseId = $(this).data("nurseid");
            var buildingName = $(this).data("buildingname");


            // // Set the values in the input fields
            $('#idUpdate').val(id);
            $('#wardNameUpdate').val(wardName);
            $('#wardTypeUpdate').val(wardType);
            $('#numberOfBedsUpdate').val(numberOfBeds);
            $('#availableBedsUpdate').val(availableBeds);
            $('#occupiedBedsUpdate').val(occupiedBeds);
            $('#nurseInChargeUpdate').val(nurseInCharge);
            $('#nurseIdUpdate').val(nurseId);
            $('#buildingNameUpdate').val(buildingName);
            
            
            
          });

    },
    error: function () {
      console.error("Error fetching data.");
    },
  });
}


// Function to start the auto-refresh interval
function startAutoRefresh() {
  autoRefreshIntervalWards = setInterval(fetchWards, 5000);
}

// Function to stop the auto-refresh interval
function stopAutoRefresh() {
  clearInterval(autoRefreshIntervalWards);
}

// Function to check if the search field is empty
function isSearchFieldEmpty() {
  return $("#searchInput").val().trim() === "";
}


// Initial data load
fetchWards();
startAutoRefresh(); // Start the auto-refresh initially

$(document).ready(function () {
  // Add an event listener to the search input
  $("#searchInput").on("keyup", function () {
    var searchTerm = $(this).val().toLowerCase();
    fetchWards(searchTerm); // Pass the search term to the fetchWards function

    if (isSearchFieldEmpty()) {
      startAutoRefresh(); // Start the auto-refresh if the search field is empty
    } else {
      stopAutoRefresh(); // Stop the auto-refresh if the search field is not empty
    }
  });
});




//Submit - add new ward
$(document).ready(function () {
  // Add a submit event listener to the form
  $("#myForm").submit(function (e) {
    e.preventDefault(); // Prevent the default form submission behavior

    // Serialize the form data into a format that can be sent in the request
    var formData = $(this).serialize();

    $.ajax({
      url: "backend-admin-add-wards.php", // Replace with the actual URL to your server-side script
      type: "POST", // You can also use 'GET' if your server-side script expects GET requests
      data: formData, // The serialized form data
      success: function (response) {
        // Handle the success response from the server
        $("#result").removeClass("text-danger");
        $("#result").addClass("text-success");
        $("#result").html("Ward added successfully!");
        alert("Wards added successfully!");
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

//Submit - update ward
$(document).ready(function () {
  // Add a submit event listener to the form
  $("#updateForm").submit(function (e) {
    e.preventDefault(); // Prevent the default form submission behavior

    // Serialize the form data into a format that can be sent in the request
    var formData = $(this).serialize();

    $.ajax({
      url: "backend-admin-update-wards.php", // Replace with the actual URL to your server-side script
      type: "POST", // You can also use 'GET' if your server-side script expects GET requests
      data: formData, // The serialized form data
      success: function (response) {
        // Handle the success response from the server
        $("#updateResult").removeClass("text-danger");
        $("#updateResult").addClass("text-success");
        $("#updateResult").html("Updated successfully!");
        alert(JSON.parse(response).message);
      },
      error: function (error) {
        // Handle any errors that occur during the AJAX request
        $("#updateResult").removeClass("text-success");
        $("#updateResult").addClass("text-danger");
        $("#updateResult").html(JSON.parse(error.responseText).message);
        
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
