<?php
require("panel.php");
require("setup.php");

?>
<main class="main-dflex">
    <h1 class="warn">Można porównywać tylko te same klasy!</h1>
<h2 class="informacja">Generowanie raportu dla matury próbnej</h2>
<div class="formularz container">
    <form action="#" method="post" class="input-form">

       <div class="form-group">
              <input type="number" min="2012" max="2099" step="1"  name='rok' required>
              <label for="input" class="control-label">Wpisz rok</label><i class="bar"></i>
       </div>

       <div class="form-group">
              <input type="text" name='klasa' required>
              <label for="input" class="control-label">Klasa</label><i class="bar"></i>
       </div>
      <div class="form-group">
      <select name="miesiac">
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
      <span>Porównaj z:</span>
      <div class="form-group">
      <select name="miesiac2">
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


<!-- <main>
    <form action="#" method="post">
        <label>
            Wybierz rok, dla którego wygenerować raport
            <input type="number" min="2012" max="2099" step="1" value="2018" name='rok'>
        </label>
        <label> Klasa
            <input type="text" name="klasa"></label>
        <select name="miesiac">
            <option value="wrzesien">Wrzesień</option>
            <option value="pazdziernik">Październik</option>
            <option value="listopad">Listopad</option>
            <option value="grudzien">Grudzień</option>
            <option value="styczen">Styczeń</option>
            <option value="luty">Luty</option>
            <option value="marzec">Marzec</option>
            <option value="kwiecien">Kwiecień</option>
        </select>
        <br>
        Z którym miesiącem porównać?
        <select name="miesiac2">
            <option value="wrzesien">Wrzesień</option>
            <option value="pazdziernik">Październik</option>
            <option value="listopad">Listopad</option>
            <option value="grudzien">Grudzień</option>
            <option value="styczen">Styczeń</option>
            <option value="luty">Luty</option>
            <option value="marzec">Marzec</option>
            <option value="kwiecien">Kwiecień</option>
        </select>

        <button type="submit" name="submit">Wyślij</button>
    </form> -->
    <div class="klasy">
        <p>Dostępne klasy</p>
        <?php
        $result = $c->query("SHOW TABLES WHERE `Tables_in_matura` NOT LIKE '20%_wyniki_%p' and `Tables_in_matura` not like '%wnioski' and `Tables_in_matura` not like '%wyniki_klas' and `Tables_in_matura` not like 'use%' and `Tables_in_matura` not like '20___wyniki__%___r' and `Tables_in_matura` not like 'xd%' and `Tables_in_matura` not like '20%_cke' and `Tables_in_matura` not like '20%_oke' and `Tables_in_matura` not like '20___wyniki_klas' and `Tables_in_matura` not like '_wyniki_klas' and `Tables_in_matura` not like 'wnioski' and `Tables_in_matura` not like '20%_latwosc'");
echo "<ul>";
    while ($r = $result->fetch_array())  {
        echo "<li class='list-item'><a href='klasa.php?klasa=$r[0]'>{$r[0]}</a></li>";
    }
echo '</ul>';
?>
    </div>
    <?php if(isset($_POST['submit']))
{
$rok = $_POST['rok'];
$klasa = $_POST['klasa'];
$miesiac = $_POST['miesiac'];
$miesiac2 = $_POST['miesiac2'];
?>
    <script>
        document.querySelector(".formularz").style.display = "none";
        document.querySelector(".klasy").style.display = "none";
        document.querySelector(".informacja").style.display = "none";

    </script>
    <?php
$przed = $c->query("select * from {$rok}_{$miesiac}_wyniki_{$klasa}");
$po = $c->query("select * from {$rok}_{$miesiac2}_wyniki_{$klasa}");  
    $przed = $przed->fetch_array();
    $po = $po->fetch_array();
    echo "<h1>Zestawienie dla klasy $klasa</h1>";
}?>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            <?php 
          $ile = $c->query("select count(wynik) as ile from {$rok}_{$miesiac}_wyniki_{$klasa} where wynik > 0.29");
          $ile = $ile->fetch_array();
                 $ile2 = $c->query("select count(wynik) as ile from {$rok}_{$miesiac2}_wyniki_{$klasa} where wynik > 0.29");
          $ile2 = $ile2->fetch_array();
          ?>
            var data = google.visualization.arrayToDataTable([
                ['Miesiąc', 'Ilość osób'],
                <?php 
                    echo "['" . $miesiac ."', ". $ile['ile'] . "],";
                    echo "['" . $miesiac2 ."', ". $ile2['ile'] .  "],";
        ;?>
            ]);
            var options = {
                title: 'Ilość osób z wynikiem powyżej 30%'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }

    </script>

    <div id="piechart" style="width: 900px; height: 500px;"></div>

</main>
