<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Know My Location</title>
</head>
<body>
    <button id="getLocationBtn">Know My Location</button>
    <p id="locationInfo"></p>

    <script>
        const getLocationBtn = document.getElementById('getLocationBtn');
        const locationInfo = document.getElementById('locationInfo');

        getLocationBtn.addEventListener('click', getLocation);

        function getLocation() {
            if ('geolocation' in navigator) {
                // Get user's current position
                navigator.geolocation.getCurrentPosition(
                    successCallback,
                    errorCallback,
                    { enableHighAccuracy: true } // You can adjust options here if needed
                );
            } else {
                locationInfo.textContent = "Geolocation is not available in this browser.";
            }
        }

        function successCallback(position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;

            // Reverse geocoding using Nominatim API
            fetch(`https://nominatim.openstreetmap.org/reverse?lat=${latitude}&lon=${longitude}&format=json`)
                .then(response => response.json())
                .then(data => {
                    const address = data.display_name;
                    locationInfo.textContent = `You are in: ${address}`;
                })
                .catch(error => {
                    locationInfo.textContent = `Error occurred: ${error.message}`;
                });
        }

        function errorCallback(error) {
            locationInfo.textContent = `Error occurred: ${error.message}`;
        }
    </script>
</body>
</html>
