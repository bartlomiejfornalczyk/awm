<?php
require("panel.php");
require("setup.php");
?>
<main class="main-dflex">
<h2 class="informacja">Wyświetlanie skali staninowej matury próbnej</h2>
<div class="formularz container">
    <form action="#" method="post" class="input-form">

       <div class="form-group">
              <input type="number" min="2012" max="2099" step="1"  name='rok' required>
              <label for="input" class="control-label">Wybierz rok, dla którego wyświetlić staninę </label><i class="bar"></i>
       </div>
       <div class="form-group">
       <select name="miesiac" id="">
            <option value="wrzesien">Wrzesień</option>
            <option value="pazdziernik">Październik</option>
            <option value="listopad">Listopad</option>
            <option value="grudzien">Grudzień</option>
            <option value="styczen">Styczeń</option>
            <option value="luty">Luty</option>
            <option value="marzec">Marzec</option>
            <option value="kwiecien">Kwiecień</option>
        </select>
       </div>
       <div class="button-container">
    <button type="submit" class="button" name="submit"><span>Wyślij</span></button>
  </div>
</form>
</div>

    <?php if(isset($_POST['submit']))
{
$rok = $_POST['rok'];
$miesiac = $_POST['miesiac'];
    ?>
    <script>
        document.querySelector(".formularz").style.display = "none";
        document.querySelector(".informacja").style.display = "none";

    </script>
    <table>
        <tr>
            <td></td>
            <th>Najniższy</th>
            <th>Bardzo niski</th>
            <th>Niski</th>
            <th>Niżej średniej</th>
            <th>Średni</th>
            <th>Wyżej średniej</th>
            <th>Wysoki</th>
            <th>Bardzo wysoki</th>
            <th>Najwyższy</th>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>0% - 14%</td>
            <td>15% - 20%</td>
            <td>21% - 32%</td>
            <td>33% - 44%</td>
            <td>45% - 60%</td>
            <td>61% - 78%</td>
            <td>79% - 90%</td>
            <td>91% - 96%</td>
            <td>97% - 100%</td>
        </tr>
        <tr>
            <td>Ilość wyników w ZSE</td>
            <?php
            $nn = $c->query("select count(wynik) from {$rok}_{$miesiac}_wyniki_klas where wynik<=0.14");
            $bn = $c->query("select count(wynik) from {$rok}_{$miesiac}_wyniki_klas where wynik>=0.15 and wynik <0.21");
            $n  = $c->query("select count(wynik) from {$rok}_{$miesiac}_wyniki_klas where wynik>=0.21 and wynik <0.33");
            $ns = $c->query("select count(wynik) from {$rok}_{$miesiac}_wyniki_klas where wynik>=0.33 and wynik <0.45");
            $s  = $c->query("select count(wynik) from {$rok}_{$miesiac}_wyniki_klas where wynik>=0.45 and wynik <0.61");
            $ws = $c->query("select count(wynik) from {$rok}_{$miesiac}_wyniki_klas where wynik>=0.61 and wynik <0.79");
            $w  = $c->query("select count(wynik) from {$rok}_{$miesiac}_wyniki_klas where wynik>=0.79 and wynik <0.91");
            $bw = $c->query("select count(wynik) from {$rok}_{$miesiac}_wyniki_klas where wynik>=0.91 and wynik <0.97");
            $nw = $c->query("select count(wynik) from {$rok}_{$miesiac}_wyniki_klas where wynik>=0.97");
            $nn=$nn->fetch_array();
            $bn=$bn->fetch_array();
            $n=$n->fetch_array();
            $ns=$ns->fetch_array();
            $s=$s->fetch_array();
            $ws=$ws->fetch_array();
            $w=$w->fetch_array();
            $bw=$bw->fetch_array();
            $nw=$nw->fetch_array();
            echo '<td>' . $nn['count(wynik)'] . '</td>';
            echo '<td>' . $bn['count(wynik)'] . '</td>';
            echo '<td>' . $n['count(wynik)'] . '</td>';
            echo '<td>' . $ns['count(wynik)'] . '</td>';
            echo '<td>' . $s['count(wynik)'] . '</td>';
            echo '<td>' . $ws['count(wynik)'] . '</td>';
            echo '<td>' . $w['count(wynik)'] . '</td>';
            echo '<td>' . $bw['count(wynik)'] . '</td>';
            echo '<td>' . $nw['count(wynik)'] . '</td>';
            ?>
        </tr>
        <tr>
            <td>% wyników</td>
            <?php
            $result=$c->query("select count(wynik) as ile from {$rok}_{$miesiac}_wyniki_klas");
            $result = $result->fetch_array();
            echo '<td>' . round($nn['count(wynik)']/$result['ile']*100, 2) . '%</td>';
            echo '<td>' . round($bn['count(wynik)']/$result['ile']*100, 2) . '%</td>';
            echo '<td>' . round($n['count(wynik)']/$result['ile']*100, 2) . '%</td>';
            echo '<td>' . round($ns['count(wynik)']/$result['ile']*100, 2) . '%</td>';
            echo '<td>' . round($s['count(wynik)']/$result['ile']*100, 2) . '%</td>';
            echo '<td>' . round($ws['count(wynik)']/$result['ile']*100, 2) . '%</td>';
            echo '<td>' . round($w['count(wynik)']/$result['ile']*100, 2) . '%</td>';
            echo '<td>' . round($bw['count(wynik)']/$result['ile']*100, 2) . '%</td>';
            echo '<td>' . round($nw['count(wynik)']/$result['ile']*100, 2) . '%</td>';
            ?>

        </tr>
        <tr>
            <td>% wyników</td>
            <?php
            $result=$c->query("select count(wynik) as ile from {$rok}_{$miesiac}_wyniki_klas");
            $result = $result->fetch_array();
            echo '<td colspan=4>' . round(($nn['count(wynik)']+$bn['count(wynik)']+$n['count(wynik)']+$ns['count(wynik)'])/$result['ile']*100, 2) . '%</td>';

        
            echo '<td>' . round($s['count(wynik)']/$result['ile']*100, 2) . '%</td>';
            echo '<td colspan=4>' . round(($ws['count(wynik)']+$w['count(wynik)']+$bw['count(wynik)']+$nw['count(wynik)'])/$result['ile']*100, 2) . '%</td>';

            ?>

        </tr>

    </table>

    <!--WYKRES-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Punkty', 'ZSE'],
                <?php  
//                    $result = $c->query("SELECT round(wynik*0.5*100) as pkt, COUNT(*) AS ilosc FROM {$rok}_{$miesiac}_wyniki_klas GROUP BY pkt ORDER BY pkt");
                echo "['0 - 14%',".$nn['count(wynik)'] . "],";         
                echo "['15% - 20%',".$bn['count(wynik)'] . "],";         
                echo "['21% - 32%',".$n['count(wynik)'] . "],";         
                echo "['33% - 44%',".$ns['count(wynik)'] . "],";         
                echo "['45% - 60%',".$s['count(wynik)'] . "],";         
                echo "['61% - 78%',".$ws['count(wynik)'] . "],";         
                echo "['79% - 90%',".$w['count(wynik)'] . "],";         
                echo "['91% - 96%',".$bw['count(wynik)'] . "],";         
                echo "['97% - 100%',".$nw['count(wynik)'] . "],";         
//                
                
                
//                while($row = mysqli_fetch_array($result))  
//                          {  
//                               echo "['".$row["pkt"]."', ".$row["ilosc"]."],";  
//                          }  
                          ?>
            ]);
            var options = {
                title: 'Wyniki matury w punktach w ZSE',
                width: 1300,
                height: 400,
                hAxis: {
                    title: 'Przedział procentowy',
                },
                vAxis: {
                    title: 'Liczebność (osób)'
                }
            };
            var chart = new google.visualization.ColumnChart(document.querySelector('.pieChart'));
            chart.draw(data, options);
        }

    </script>

    <div class="pieChart"></div>
    <!--WYKRES-->
    <!--WYKRES-->
    <script type="text/javascript">
        google.charts.load('current', {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Punkty', 'ZSE'],
                <?php  

                $result=$c->query("select count(wynik) as ile from {$rok}_{$miesiac}_wyniki_klas");
                $cke=$c->query("select *  from {$rok}_wyniki_cke");
                $result = $result->fetch_array();
                $cke = $cke->fetch_array();
                echo "['0 - 14%',"   .round($nn['count(wynik)']/$result['ile']*100, 2) .  "],";         
                echo "['15% - 20%'," .round($bn['count(wynik)']/$result['ile']*100, 2) .  "],";         
                echo "['21% - 32%'," .round($n['count(wynik)']/$result['ile']*100, 2) . "],";         
                echo "['33% - 44%'," .round($ns['count(wynik)']/$result['ile']*100, 2) .  "],";         
                echo "['45% - 60%'," .round($s['count(wynik)']/$result['ile']*100, 2) . "],";         
                echo "['61% - 78%'," .round($ws['count(wynik)']/$result['ile']*100, 2) .  "],";         
                echo "['79% - 90%'," .round($w['count(wynik)']/$result['ile']*100, 2) . "],";         
                echo "['91% - 96%'," .round($bw['count(wynik)']/$result['ile']*100, 2) .  "],";         
                echo "['97% - 100%',".round($nw['count(wynik)']/$result['ile']*100, 2) . "],";         

                          ?>
            ]);
            var options = {

                title: 'Wyniki matury w punktach w ZSE',
                width: 1400,
                height: 700,
                hAxis: {
                    title: 'Przedział procentowy',
                },
                vAxis: {
                    format: "#'%'",
                    title: '% wyników',
                    minValue: 0,
                    viewWindowMode: 'explicit',
                    viewWindow: {
                        //max: 180,
                        min: 0,
                    },
                    gridlines: {
                        count: 14,
                    }
                    //                                        ticks: [0, .1, .2, .3, .4, .5, .6]

                }
            };
            var chart = new google.visualization.ColumnChart(document.querySelector('.pieChart2'));
            chart.draw(data, options);
        }

    </script>

    <div class="pieChart2"></div>
    <!--WYKRES-->

    <div class="wnioski">
        <p class="srednia">Wyniki średnie stanowią <?php echo round($s['count(wynik)']/$result['ile']*100, 2);?>% wszystkich wyników</p>
        <p class="wsredniej">Wyniki powyżej średniego stanowią <?php echo round($ws['count(wynik)']/$result['ile']*100, 2);?>%wszystkich wyników.
        </p>
        <p class="psredniej">Wyniki poniżej średniego stanowią <?php echo round($ns['count(wynik)']/$result['ile']*100, 2);?>%wszystkich wyników.
        </p>
    </div>
</main>

<?php
}
else
{
 echo '';
}?>
