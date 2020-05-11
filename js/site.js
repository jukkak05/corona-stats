$(document).ready(function() {

    // Google Pie Charts
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    // Draw charts again when screen resize
    $(window).resize(function() {
        drawChart();
    });  

});

function drawChart() {

    const confirmed = parseInt($('p.confirmed-charts').text());
    const recovered = parseInt($('p.recovered-charts').text());
    const critical =  parseInt($('p.critical-charts').text());
    const deaths = parseInt($('p.deaths-charts').text());

    var data = google.visualization.arrayToDataTable([
    ['Title', 'Stats'],
    ['Confirmed', confirmed],
    ['Recovered', recovered],
    ['Critical', critical],
    ['Deaths', deaths],
    ]);
    
    var options = {
        
        colors:['#1e3046', '#aae662', '#b30000', '#000'],
        width: '100%',
        height: '100%',
        fontName: 'Crimson text',
        chartArea: {
            left: "0%",
            top: "10%",
            height: "100%",
            width: "100%",
        }
    
    };
    
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    
    chart.draw(data, options);
}
    
