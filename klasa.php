<?php
require("panel.php");
require("setup.php");
$klasa = $_GET['klasa'];
echo $klasa;
$rok = substr($klasa, 0, 4);
$result = $c->query("select * from $klasa");
?>
<main class="dflex">
    <h1 style="text-transform:uppercase; font-size:1em;"><?=$klasa?></h1>
    <?php
$przed = $c->query("select * from {$klasa}");
// $po = $c->query("select * from {$rok}_{$miesiac2}_wyniki_{$klasa}");  
    $przed = $przed->fetch_array();
    // $po = $po->fetch_array();
    // echo "<h1>Zestawienie dla klasy $klasa</h1>";
?>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            <?php 
          $ile = $c->query("select count(wynik) as ile from {$klasa} where wynik > 0.29");
          $ile2 = $c->query("select count(wynik) as ile from {$klasa} where wynik < 0.3");
          $ile = $ile->fetch_array();
          $ile2 = $ile2->fetch_array();
        //          $ile2 = $c->query("select count(wynik) as ile from {$rok}_{$miesiac2}_wyniki_{$klasa} where wynik > 0.29");
        //   $ile2 = $ile2->fetch_array();
          ?>
            var data = google.visualization.arrayToDataTable([
                ['Zdałoby', 'Nie zdałoby'],
                <?php 
                    echo "['Zdałoby', ". $ile['ile'] . "],";
                    echo "['Nie zdałoby', ". $ile2['ile'] . "],";
                    // echo "[". $ile['ile'] .  "," . $ile2['ile'] . "],";
                    // echo "['" . $miesiac2 ."', ". $ile2['ile'] .  "],";
        ;?>
            ]);
            var options = {
                title: 'Zdawalność w klasie',
                slices: {
                 0: { color: 'green', offset: 0.05 },
                 1: {color: 'red'}
                }
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }

    </script>

    <div id="piechart" style="width: 900px; height: 500px;"></div>



    <table class="klasy" width="40%">
        <tr>
            <th>Numer</th>
            <th>Wynik</th>
        </tr>
    

<?php
while($r = $result->fetch_array())
{
    if($r['wynik']*100 < 30)
{
    echo '<tr style="background-color:indianred;">';
}
else{
    echo '<tr style="background-color:lightgreen;">';
}
    echo '<td>';
    echo $r['id'];
    echo '</td>';
    echo '<td>';
    echo $r['wynik'] * 100 . '%';
    
    echo '</td>';
    echo '</tr>';
}
?>
</table>


   
</main>