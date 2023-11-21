document.addEventListener("DOMContentLoaded", function () {
    fetch('http://localhost:8000/api/airtags-info')
        .then(response => response.json())
        .then(data => {
            const center = calculateCenter(data);
            const map = L.map('map').setView(center, 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            data.forEach(airtag => {
                const localizedDate = new Date(airtag.located_at).toLocaleString();

                const content = `
                    <b>${airtag.name}</b><br>
                    Last location: ${localizedDate}<br>
                    Coordinates: ${airtag.latitude}, ${airtag.longitude}<br>
                    <a href="#" class="google-maps-link" data-latitude="${airtag.latitude}" data-longitude="${airtag.longitude}">Take me there</a>
                `;

                const marker = L.marker([parseFloat(airtag.latitude), parseFloat(airtag.longitude)])
                    .addTo(map)
                    .bindPopup(content);
            });

            document.querySelectorAll('.google-maps-link').forEach(link => {
                link.addEventListener('click', function (event) {
                    event.preventDefault();
                    const latitude = this.getAttribute('data-latitude');
                    const longitude = this.getAttribute('data-longitude');
                    openGoogleMaps(latitude, longitude);
                });
            });
        })
        .catch(error => console.error('Error fetching data:', error));

    function calculateCenter(points) {
        if (points.length === 0) {
            return [0, 0];
        }

        const sumLat = points.reduce((sum, point) => sum + parseFloat(point.latitude), 0);
        const sumLng = points.reduce((sum, point) => sum + parseFloat(point.longitude), 0);

        const avgLat = sumLat / points.length;
        const avgLng = sumLng / points.length;

        return [avgLat, avgLng];
    }

    function openGoogleMaps(latitude, longitude) {
        const googleMapsUrl = `https://www.google.com/maps?q=${latitude},${longitude}`;
        window.open(googleMapsUrl, '_blank');
    }
});
