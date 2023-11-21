# Airtag Universal Location Tracker

This project provides a simple website to watch airtag location in any device.

## Usage


1. **Airtag Location Extractor Script (`AirtagLocationExtractor.sh`)**

    - Run the script on your Mac to extract Airtag location data.
    - Configure the script with the server IP.
    - The script sends the data to the backend server via POST.

```bash
./AirtagLocationExtractor.sh
```

2. Backend Server (Laravel Project - airtag-custom-repository)

Two endpoints:

- GET /api/airtags-info: Retrieves Airtag info.
- POST /api/airtags-info: Adds Airtag info. 
- Data format for POST:

```
{
    "airtags-info": [
        {
            "identifier": "pepito",
            "name": "Sandero",
            "located_at": "2023-11-17 14:14:33",
            "latitude": "73.51334400",
            "longitude": "147.39223700"
        },
        {
            "identifier": "Panda",
            "name": "Panda",
            "located_at": "2023-11-17 14:14:33",
            "latitude": "73.51334400",
            "longitude": "147.39223700"
        }
    ]
}
```

3. Web Interface (airtag-location-website)

Simple web app to visualize Airtag locations.
Retrieves data from the Laravel backend.

Directory Structure
- AirtagLocationExtractor.sh: Bash script to get airtag info.
- airtag-custom-repository: Laravel project for storing and serving Airtag information.
- airtag-location-website: Web app for visualizing Airtag locations.

## Credits
[AirtagAlex](https://github.com/icepick3000/AirtagAlex). For providing the Airtag data extraction script.
