<?php 
/** 
 * Corona virus info page
**/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="Corona (COVID-19)">
    <meta property="og:description" content="Search for the latest Corona virus stats by country.">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type ="text/javascript" src="js/site.js"></script>
    <title>Corona (COVID-19)</title>
</head>

<body>

    <main class="content">

        <section class="corona-search">

            <div class="frame">

                <div class="form-area">

                    <header>

                        <h1> Corona (Covid-19) </h1>

                    </header>

                    <form action="index.php" method="post">

                        <p><label for="team">Country: </label>
                        <input type="text" name="country" id="country"></p>
                        <input type="submit" value="Get stats">

                    </form>

                </div>

            </div>
        
        </section>

        <section class="results-area">

            <article class="results">

                <div class="numbers">

                    <?php if (!isset($_POST['country'])) 
                    {
                        defaultStats();
                    }
                    else
                    {
                        userStats();
                    }
                    ?>     

                </div>

                <div class="charts">
                    
                    <div id="piechart"></div>

                </div>
                
            </article>

        </section>

    </main>

    <footer>

            <h2> Stay informed and safe </h2>

            <ul>

                <li><a href="https://www.who.int/emergencies/diseases/novel-coronavirus-2019" target="_blank">World Health Organization</a></li>
                <li><a href="https://www.cdc.gov/coronavirus/2019-nCoV/index.html" target="_blank">Centers for Disease Control and Prevention</a></li>
                <li><a href="https://ec.europa.eu/info/live-work-travel-eu/health/coronavirus-response_en" target="_blank">European Commission</a></li>
                <li><a href="https://www.unicef.org/coronavirus/covid-19" target="_blank">Unicef</a></li>
                <li><a href="https://coronavirus.jhu.edu/" target="_blank">Johns Hopkins</a></li>   
                <li><a href="https://www.gatesfoundation.org/TheOptimist/coronavirus" target="_blank">Bill & Melinda Gates Foundation</a></li>   
                <li><a href="https://www.nih.gov/health-information/coronavirus" target="_blank">U.S. National Institutes of Health</a></li>
                <li><a href="https://www.hsph.harvard.edu/coronavirus/covid-19-news-and-resources/" target="_blank">Harvard School of Public Health</a></li>
                
            </ul>

    </footer>
            
</body>
</html>

<?php 

function defaultStats() {

    echo '<h2>All countries</h2>';

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://covid-19-data.p.rapidapi.com/totals?format=json",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "x-rapidapi-host: covid-19-data.p.rapidapi.com",
            "x-rapidapi-key: "
        ),
    ));
    
    $err = curl_error($curl);

    if ($err) 
    {
        echo "Request error #:" . $err;
    }
    else 
    {

        $results = curl_exec($curl);
        $results = json_decode($results, true);

        $confirmed_display = number_format($results[0]['confirmed']);
        $recovered_display = number_format($results[0]['recovered']);
        $critical_display = number_format($results[0]['critical']);
        $deaths_display = number_format($results[0]['deaths']);
    
        $confirmed_charts = $results[0]['confirmed'];
        $recovered_charts = $results[0]['recovered'];
        $critical_charts = $results[0]['critical'];
        $deaths_charts = $results[0]['deaths'];

        echo  '<p class="confirmed-charts hidden">' . $confirmed_charts . '</p>';
        echo  '<p class="recovered-charts hidden">' . $recovered_charts . '</p>';
        echo  '<p class="critical-charts hidden">' . $critical_charts . '</p>';
        echo  '<p class="deaths-charts hidden">' . $deaths_charts . '</p>';

        echo '<p class="confirmed"><strong>Confirmed: </strong><span>' . $confirmed_display . '</span></p>';
        echo '<p class="recovered"><strong>Recovered: </strong><span>' . $recovered_display . '</span></p>';
        echo '<p class="critical"><strong>Critical: </strong><span>' . $critical_display . '</span></p>';
        echo '<p class="deaths"><strong>Deaths: </strong><span>' . $deaths_display . '</span></p>';

        echo '<p class="stats-api">Stats provided by: <a href="https://rapidapi.com/Gramzivi/api/covid-19-data/details" target="_blank">COVID-19 data API</a></p>';
    }

    curl_close($curl);

}


function userStats() {

    $country = filter_var($_POST['country'], FILTER_SANITIZE_STRING);

    switch (strtolower($country)) 
    {
        case 'united kingdom':
            $country = 'uk';
            echo '<h2>' . strtoupper($country) . '</h2>';
            break;

        case 'uk':
            echo '<h2>' . strtoupper($country) . '</h2>';
            break;

        case 'united states':
            $country = 'usa';
            echo '<h2>' . strtoupper($country) . '</h2>';
            break;

        case 'usa':
            echo '<h2>' . strtoupper($country) . '</h2>';
            break;

        case 'united arab emirates':
            $country = 'uae';
            echo '<h2>' . strtoupper($country) . '</h2>';
            break;

        case 'uae':
            echo '<h2>' . strtoupper($country) . '</h2>';
            break;

        default:
            echo '<h2>' . ucfirst($country) . '</h2>';
            break;         
    }

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://covid-19-data.p.rapidapi.com/country?format=undefined&name=$country",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "x-rapidapi-host: covid-19-data.p.rapidapi.com",
            "x-rapidapi-key: "
        ),
    ));
    
    $err = curl_error($curl);

    $results = curl_exec($curl);
    $results = json_decode($results, true);
    
    if ($err) 
    {
        echo "Request error: " . $err;
    } 
    else if (!isset($results[0]))
    {
        echo '<p>Sorry, no results found. </p>'; 
    }
    else 
    {
        
        $confirmed_display = number_format($results[0]['confirmed']);
        $recovered_display = number_format($results[0]['recovered']);
        $critical_display = number_format($results[0]['critical']);
        $deaths_display = number_format($results[0]['deaths']);
    
        $confirmed_charts = $results[0]['confirmed'];
        $recovered_charts = $results[0]['recovered'];
        $critical_charts = $results[0]['critical'];
        $deaths_charts = $results[0]['deaths'];

        echo  '<p class="confirmed-charts hidden">' . $confirmed_charts . '</p>';
        echo  '<p class="recovered-charts hidden">' . $recovered_charts . '</p>';
        echo  '<p class="critical-charts hidden">' . $critical_charts . '</p>';
        echo  '<p class="deaths-charts hidden">' . $deaths_charts . '</p>';

        echo '<p class="confirmed"><strong>Confirmed: </strong><span>' . $confirmed_display . '</span></p>';
        echo '<p class="recovered"><strong>Recovered: </strong><span>' . $recovered_display . '</span></p>';
        echo '<p class="critical"><strong>Critical: </strong><span>' . $critical_display . '</span></p>';
        echo '<p class="deaths"><strong>Deaths: </strong><span>' . $deaths_display . '</span></p>';

        echo '<p class="stats-api">Stats provided by: <a href="https://rapidapi.com/Gramzivi/api/covid-19-data/details" target="_blank">COVID-19 data API</a></p>';

    }

    curl_close($curl);

}

?>