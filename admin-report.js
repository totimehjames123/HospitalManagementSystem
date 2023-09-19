var autoRefreshIntervalWards; // Define a variable to hold the interval ID

//Fetching Wards
function fetchMedications(searchTerm = "") {
  $.ajax({
    url: "backend-all-medications.php",
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
  autoRefreshIntervalWards = setInterval(fetchMedications, 5000);
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
fetchMedications();
startAutoRefresh(); // Start the auto-refresh initially

$(document).ready(function () {
  // Add an event listener to the search input
  $("#searchInput").on("keyup", function () {
    var searchTerm = $(this).val().toLowerCase();
    fetchMedications(searchTerm); // Pass the search term to the fetchMedications function

    if (isSearchFieldEmpty()) {
      startAutoRefresh(); // Start the auto-refresh if the search field is empty
    } else {
      stopAutoRefresh(); // Stop the auto-refresh if the search field is not empty
    }
  });
});
