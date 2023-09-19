var autoRefreshIntervalmedicines; // Define a variable to hold the interval ID

//Fetching medicines
function fetchmedicines(searchTerm = "") {
  $.ajax({
    url: "backend-all-medicines.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
      var html = "";
      var foundResults = false;

      $.each(data, function (index, medicine) {
        // Check if the medicinename or email contains the search term
        if (
          medicine.medicineName.toLowerCase().includes(searchTerm) ||
          medicine.id.toLowerCase().includes(searchTerm)
        ) {
          html += `
                                    <tr class="text-nowrap">
                                        <td class="text-nowrap">${medicine.id}</td>
                                        <td class="text-nowrap">${medicine.medicineName}</td>
                                        <td class="text-nowrap">${medicine.quantity}</td>
                                        <td class="text-nowrap">${medicine.availableMedicines}</td>
                                        <td class="text-nowrap">${medicine.purchasedMedicines}</td>
                                        <td class="text-nowrap">${medicine.unitPrice}</td>
                                        <td class="text-nowrap">${medicine.totalPrice}</td>
                                        <td class="text-nowrap">${medicine.amountPurchased}</td>
                                        <td class="text-nowrap">${medicine.amountLeft}</td>
                                        <td class="text-nowrap">${medicine.pharmacistWhoCreated}</td>
                                        <td class="text-nowrap">${medicine.expiryDate}</td>
                                        <td class="text-nowrap">${medicine.dateOfRegistration}</td>
                                        <td class="text-nowrap"><button data-id="${medicine.id}" data-medicinename="${medicine.medicineName}" data-quantity="${medicine.quantity}" data-unitprice="${medicine.unitPrice}" data-pharmacistwhocreated="${medicine.pharmacistWhoCreated}" data-expirydate="${medicine.expiryDate}" class="edit-medicine btn btn-primary btn-sm">Edit</button></td>
                                        <td class="text-nowrap"><button data-id="${medicine.id}" data-medicinename="${medicine.medicineName}" class="delete-medicine btn btn-danger btn-sm">Delete</button></td>
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

      $("#allmedicines").html(html);

      // Function to start the auto-refresh interval


      // Add a click event listener to delete medicines
          $(".delete-medicine").click(function () {
            var id = $(this).data("id");
            var medicineName = $(this).data("medicinename");

            var confirmDelete = confirm(
              "Are you sure you want to delete " + id +
                medicineName + "?"
            );

            if (confirmDelete) {
              deleteRecord("backend-admin-delete-medicine.php", id);
              alert("You've successfully deleted one record!");
            } else {
              alert("Cancelled delete!");
            }
            
          });

          // Add a click event listener to edit medicines
          $(".edit-medicine").click(function () {
            // <td class="text-nowrap"><button data-id="${medicine.id}" data-username="${medicine.medicineName}" data-availableMedicines="${medicine.availableMedicines}" data-purchasedMedicines="${medicine.purchasedMedicines}" data-expiryDate="${medicine.expiryDate} data-nurseid="${medicine.nurseId}" data-buildingname="${medicine.buildingName} class="edit-medicine btn btn-primary btn-sm">Edit</button></td>
            
            var id = $(this).data("id");
            var medicineName = $(this).data("medicinename");
            var quantity = $(this).data("quantity");
            var unitPrice = $(this).data("unitprice");
            var pharmacistWhoCreated = $(this).data("pharmacistwhocreated");
            var expiryDate = $(this).data("expirydate");
            


            // // Set the values in the input fields
            $('#idUpdate').val(id);
            $('#medicineNameUpdate').val(medicineName);
            $('#quantityUpdate').val(quantity);
            $('#unitPriceUpdate').val(unitPrice);
            $('#pharmacistWhoCreatedUpdate').val(pharmacistWhoCreated);
            $('#expiryDateUpdate').val(expiryDate);
            
            
            
          });

    },
    error: function () {
      console.error("Error fetching data.");
    },
  });
}


// Function to start the auto-refresh interval
function startAutoRefresh() {
  autoRefreshIntervalmedicines = setInterval(fetchmedicines, 5000);
}

// Function to stop the auto-refresh interval
function stopAutoRefresh() {
  clearInterval(autoRefreshIntervalmedicines);
}

// Function to check if the search field is empty
function isSearchFieldEmpty() {
  return $("#searchInput").val().trim() === "";
}


// Initial data load
fetchmedicines();
startAutoRefresh(); // Start the auto-refresh initially

$(document).ready(function () {
  // Add an event listener to the search input
  $("#searchInput").on("keyup", function () {
    var searchTerm = $(this).val().toLowerCase();
    fetchmedicines(searchTerm); // Pass the search term to the fetchmedicines function

    if (isSearchFieldEmpty()) {
      startAutoRefresh(); // Start the auto-refresh if the search field is empty
    } else {
      stopAutoRefresh(); // Stop the auto-refresh if the search field is not empty
    }
  });
});



$(document).ready(function() {
    $('#myForm').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: 'backend-pharmacist-add-medicines.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#result').html(response); // Display the response in the #result element
                $('#myForm')[0].reset(); // Reset the form
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                $('#result').html('Error occurred while adding medicine.');
            }
        });
    });
});

$(document).ready(function() {
    $('#updateForm').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: 'backend-pharmacy-update-medicine.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#updateResult').html(response); // Display the response in the #result element
                $('#updateForm')[0].reset(); // Reset the form
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                $('#updateResult').html('Error occurred while adding medicine.');
            }
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
