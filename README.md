# corona stats

Simple stats page for Corona virus with Google Charts.

By default the stats for all countries is displayed but user can search for a single country.

Stats are provided by COVID-19 data API from multiple sources like like Johns Hopkins CSSE, CDC and WHO: https://rapidapi.com/Gramzivi/api/covid-19-data/details

Working example at: jukkakalenius.fi/corona

<h2>Usage</h2>

1. Register to RapidAPI
2. Get a free api-key for COVID-19 data: https://rapidapi.com/Gramzivi/api/covid-19-data/pricing
3. Insert api-key to index.php in curl_setopt_array function on defaultStats and userStats functions.
