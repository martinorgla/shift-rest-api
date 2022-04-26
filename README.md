# Shift REST API (Laravel/MySQL/PHP8)
Author: Martin Orgla

### Building & Running the application
`docker-compose up --build` - Exposes port 8008

### Import data from file
`docker exec -i shift-rest-api  php artisan command:import-shifts < data.json`

### Usage
Application introduces three endpoints

endpoint | description | example curl command
--- | --- | ---
/api/create | Create shifts | `curl --location --request POST 'localhost:8008/api/create' --header 'Content-Type: application/json' --data-raw '{  "shifts": [{   "type": "shift",   "start": "2018-01-01T06:45:00+00:00",   "end": "2018-01-01T19:00:00+00:00",   "user_name": null,   "user_email": "dummy+296@dummy.com",   "location": "All Saints Church",   "event": null,   "rate": 11.5,   "charge": 17.8,   "area": null,   "departments": null  }] }'`
/api/search | Search shifts | `curl --location --request POST 'localhost:8008/api/search' --header 'Content-Type: application/json' --data-raw '{  "location": "All Saints Church",  "start": "2018-01-01T06:45:00+00:00",  "end": "2020-01-02T19:00:00+00:00" }'`
/api/delete | Delete all data | `curl --location --request POST 'localhost:8008/api/delete'`
