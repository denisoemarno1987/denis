<?php

$koneksi   	= mysqli_connect("localhost", "root", "", "admin");
$event 		= mysqli_query($koneksi, "SELECT idEvent FROM rsvp WHERE idEvent='3' order by idRsvp asc");
$rsvp  		= mysqli_query($koneksi, "SELECT idRsvp FROM rsvp WHERE idEvent='3' order by idRsvp asc");


?>
<html>
    <head>
        <title>Belajarphp.net - ChartJS</title>
        <script src="../bootstrap/Chart.js/Chart.bundle.js"></script>
 
        <style type="../bootstrap/Chart.js/text/css">
            .container {
                width: 50%;
                margin: 15px auto;
            }
        </style>
    </head>

<div class="container">

                                <canvas id="myChart" width="10" height="10"></canvas>
                         </div>
                                <script>
                                    var ctx = document.getElementById("myChart");
                                    var myChart = new Chart(ctx, {
                                        type: 'bar',
                                        data: {
                                            labels: [<?php while ($b = mysqli_fetch_array($event)) { echo '"' . $b['idEvent'] . '",';}?>],
                                            datasets: [{
                                                    label: '# of Votes',
                                                    data: [<?php while ($p = mysqli_fetch_array($rsvp)) { echo '"' . $p['idRsvp'] . '",';}?>],
                                                    backgroundColor: [
                                                        'rgba(255, 99, 132, 0.2)',
                                                        'rgba(54, 162, 235, 0.2)',
                                                        'rgba(255, 206, 86, 0.2)',
                                                        'rgba(75, 192, 192, 0.2)',
                                                        'rgba(153, 102, 255, 0.2)',
                                                        'rgba(255, 159, 64, 0.2)',
                                                        'rgba(255, 99, 132, 0.2)',
                                                        'rgba(54, 162, 235, 0.2)',
                                                        'rgba(255, 206, 86, 0.2)',
                                                        'rgba(75, 192, 192, 0.2)',
                                                        'rgba(153, 102, 255, 0.2)',
                                                        'rgba(255, 159, 64, 0.2)'
                                                    ],
                                                    borderColor: [
                                                        'rgba(255,99,132,1)',
                                                        'rgba(54, 162, 235, 1)',
                                                        'rgba(255, 206, 86, 1)',
                                                        'rgba(75, 192, 192, 1)',
                                                        'rgba(153, 102, 255, 1)',
                                                        'rgba(255, 159, 64, 1)',
                                                        'rgba(255, 99, 132, 0.2)',
                                                        'rgba(54, 162, 235, 0.2)',
                                                        'rgba(255, 206, 86, 0.2)',
                                                        'rgba(75, 192, 192, 0.2)',
                                                        'rgba(153, 102, 255, 0.2)',
                                                        'rgba(255, 159, 64, 0.2)'
                                                    ],
                                                    borderWidth: 1
                                                }]
                                        },
                                        options: {
                                            scales: {
                                                yAxes: [{
                                                        ticks: {
                                                            beginAtZero: true
                                                        }
                                                    }]
                                            }
                                        }
                                    });
                                </script>