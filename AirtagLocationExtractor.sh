#!/bin/bash

API_URL="http://localhost:8000/api/airtags-info"
ITEMS_FILE="./Items.data"

copy_items_data() {
    echo "Creating a copy of Items.data to prevent potential file corruption"
    if ! cp -p ~/Library/Caches/com.apple.findmy.fmipcore/Items.data "$ITEMS_FILE"; then
        echo "Failed to copy Items.data file. Please ensure Terminal has 'Full Disk Access' in the 'Privacy & Security' section in macOS Preferences" >&2
        exit 1
    fi
}

post_data_to_api() {
    echo "Posting data to $API_URL"
    airtags_info='{"airtags-info": ['
    airtagsnumber=$(jq ".[].serialNumber" "$ITEMS_FILE" | wc -l)
    airtagsnumber=$((airtagsnumber-1))

    for j in $(seq 0 "$airtagsnumber"); do
        echo "Processing airtag number $j"

        datetime=$(date +"%Y-%m-%d %T")
        serialnumber=$(jq ".[$j].serialNumber" "$ITEMS_FILE")
        name=$(jq ".[$j].name" "$ITEMS_FILE")
        locationlatitude=$(jq ".[$j].location.latitude" "$ITEMS_FILE")
        locationlongitude=$(jq ".[$j].location.longitude" "$ITEMS_FILE")
        timestamp=$(jq ".[$j].location.timeStamp" "$ITEMS_FILE")
        located_at=$(date -r "$((timestamp / 1000))" +"%Y-%m-%d %T")

        airtags_info+="{ \"identifier\": $serialnumber, \"name\": $name, \"located_at\": \"$located_at\", \"latitude\": $locationlatitude, \"longitude\": $locationlongitude }"
        if [ "$j" -ne "$airtagsnumber" ]; then
            airtags_info+=','
        fi
    done
    airtags_info+=']}'

    echo "Data to be sent:"
        echo "$airtags_info"

    curl -X POST -H "Content-Type: application/json" -H "Accept: application/json" -d "$airtags_info" "$API_URL"
}

while true; do
    copy_items_data
    post_data_to_api

    echo -e "Checking again in 1 minute...\n"
    sleep 10
done
