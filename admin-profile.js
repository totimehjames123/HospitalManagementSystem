// Function to fetch user profile data
function fetchProfile() {
    $.ajax({
        url: 'backend-admin-profile.php', // Replace with the actual path to your PHP script
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            // Handle the user profile data here
            if (response.length > 0) {
                // Assuming there's only one profile for the current user
                var admin = response[0];
                var profileHtml = '<p>ID: ' + admin.id + '</p>' +
                    '<p>Username: ' + admin.username + '</p>' +
                    '<p>Email: ' + admin.email + '</p>' +
                    '<p>Gender: ' + admin.gender + '</p>' +
                    '<p>Date of Registration: ' + admin.dateOfRegistration + '</p>';

                $('.username').html(admin.username);
                $('.email').html(admin.email);
                $('.gender').html(admin.gender);
                $('.role').html(admin.role);
                $('.profilePicture').attr('src', 'uploads/' + admin.profilePicture);

                $('#username').val(admin.username);
                $('#email').val(admin.email);
                $('#gender').val(admin.gender);
                $('#role').val(admin.role);
                $('#profilePicture').attr('src', 'uploads/' + admin.profilePicture);

            } else {
                $('#profilePicture').attr('alt', 'No profile data found.');
            }
        },
        error: function() {
            $('#profilePicture').attr('alt', 'Error fetching profile data.');
        }
    });
}

$(document).ready(function() {
    
    // Call the function to fetch user profile data when the page loads
    fetchProfile();
});



$(document).ready(function() {
    $('#updateProfile').on('submit', function(e) {
        e.preventDefault();

        // Create a FormData object to handle file upload
        var formData = new FormData(this);

        $.ajax({
            url: 'backend-admin-update-profile.php', // Replace with the actual path to your PHP script
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json', // Expect JSON response
            success: function(response) {
                if (response.message) {
                    $('#updateMessage').removeClass("text-danger");
                    $('#updateMessage').addClass("text-success");
                    $('#updateMessage').text(response.message);
                    fetchProfile();
                } else {
                    // Data was updated successfully
                    $('#updateMessage').removeClass("text-success");
                    $('#updateMessage').addClass("text-danger");
                    $('#updateMessage').text(response.message);
                }
            },
            error: function(error) {
                $('#updateMessage').removeClass("text-success");
                $('#updateMessage').addClass("text-danger");
                $('#updateMessage').text('Error updating profile: ' + error.message);
            }
        });
    });
});


