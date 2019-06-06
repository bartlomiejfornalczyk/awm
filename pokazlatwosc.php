<?php 
require('panel.php');
require('setup.php');
function check($x)
{
    if($x>=0.90)
    {
        echo '<td class="green">';
    }
    else if($x>=0.70)
    {
        echo '<td class="lightgreen">';
    }
    else if($x>=0.50)
    {
        echo '<td class="darkseagreen">';
    }
    else if($x>=0.20)
    {
        echo '<td class="palevioletred">';
    }
    else if($x>=0.01)
    {
        echo '<td class="darkred">';
    }
}
?>
<main style="justify-content: center; min-height: 100vh;">
<h2 class="informacja" style="text-align:center;">Wyświetlanie łatwości zadań </h2>
<div class="formularz container">
    <form action="#" method="get" class="input-form">

       <div class="form-group">
              <input type="number" min="2012" max="2099" step="1"  name='rok' required>
              <label for="input" class="control-label">Który rok wyświetlić?</label><i class="bar"></i>
       </div>
       <div class="button-container">
    <button type="submit" class="button" name="submit"><span>Wyślij</span></button>
  </div>
    </form>
</div>
    <?php
       if(isset($_GET['submit']))
    {
    $rok = $_GET['rok'];
     $c->query("create table if not exists {$rok}_latwosc_wnioski(id int, wniosek text, primary key(id))");
     $test = $c->query("select * from {$rok}_latwosc_wnioski");
    if(@$test->num_rows==0)
    {
        $c->query("insert into {$rok}_latwosc_wnioski values(1, 'Wniosek: ')");
    }
    $result = $c->query("select * from {$rok}_latwosc");
           ?>
    <script>
        document.querySelector(".formularz").style.display = "none";
        document.querySelector(".informacja").style.display = "none";

    </script>
    <div class="tabele">
        <table>

            <tbody>
                <tr>
                    <th>Numer zadania</th>
                    <th>ZSE</th>
                    <th>OKE</th>
                    <th>CKE</th>
                    <th>Standard</th>
                </tr>

                <?php
           while($r = $result->fetch_array())
           {
               echo "<tr>";
            //    $nn = $c->query("select count(zse) as wynik from {$rok}_latwosc where zse<=19");
            //    $bn = $c->query("select count(zse) as wynik from {$rok}_latwosc where zse>=20 and zse <50");
            //    $n  = $c->query("select count(zse) as wynik from {$rok}_latwosc where zse>=50 and zse <70");
            //    $ns = $c->query("select count(zse) as wynik from {$rok}_latwosc where zse>=70 and zse <90");
            //    $s  = $c->query("select count(zse) as wynik from {$rok}_latwosc where zse>=90 and zse <100");)
               
               echo "<td>" . $r['id'] . "</td>";
               check($r['zse']/100);
               echo  $r['zse']/100 . "</td>";
               check($r['oke']/100);
               echo  $r['oke']/100 . "</td>";
               check($r['cke']/100);
               echo  $r['cke']/100 . "</td>";
               echo "<td>" . $r['standard']. "</td>";
               echo '</tr>';
           }
           $result = $c->query("select azse,aoke,acke from {$rok}_latwosc where id=1");
           $result=$result->fetch_array();
       
    ?>
                <tr>
                    <td>Łatwość arkusza</td>
                    <?php 
                    check($result['azse']/100);
                     echo $result['azse']/100  . "</td>";
                    check($result['aoke']/100);
                     echo $result['aoke']/100 . "</td>";
                    check($result['acke']/100);
                     echo $result['acke']/100 . "</td>";
                     ?>
                   
                    <td></td>
                </tr>
            </tbody>
        </table>
<div class="kolorowe">
        <table class="kolor">
            <tr>
                <th>Wskaźnik łatwości</th>
                <th>Interpretacja wskaźnika</th>
            </tr>
            <tr>
                <td>0,00 - 0,19</td>
                <td>Bardzo trudne</td>
            </tr>
            <tr>
                <td>0,20 - 0,49</td>
                <td>Trudne</td>
            </tr>
            <tr>
                <td>0,50 - 0,69</td>
                <td>Umiarkowanie trudne</td>
            </tr>
            <tr>
                <td>0,70 - 0,89</td>
                <td>Łatwe</td>
            </tr>
            <tr>
                <td>0,90 - 1,00</td>
                <td>Bardzo łatwe</td>
            </tr>
        </table>

        <table class="kolor">
            <tr>
                <th>ZSE</th>
                <th>OKE</th>
                <th>CKE</th>
            </tr>

            <?php
    
            $nn = $c->query("select count(zse) as wynik from {$rok}_latwosc where zse<=19");
            $bn = $c->query("select count(zse) as wynik from {$rok}_latwosc where zse>=20 and zse <50");
            $n  = $c->query("select count(zse) as wynik from {$rok}_latwosc where zse>=50 and zse <70");
            $ns = $c->query("select count(zse) as wynik from {$rok}_latwosc where zse>=70 and zse <90");
            $s  = $c->query("select count(zse) as wynik from {$rok}_latwosc where zse>=90 and zse <100");
            
            $nn=$nn->fetch_array();
            $bn=$bn->fetch_array();
            $n=$n->fetch_array();
            $ns=$ns->fetch_array();
            $s=$s->fetch_array();
            
            $nn2 = $c->query("select count(oke) as wynik from {$rok}_latwosc where oke<=19");
            $bn2 = $c->query("select count(oke) as wynik from {$rok}_latwosc where oke>=20 and oke <50");
            $n2  = $c->query("select count(oke) as wynik from {$rok}_latwosc where oke>=50 and oke <70");
            $ns2 = $c->query("select count(oke) as wynik from {$rok}_latwosc where oke>=70 and oke <90");
            $s2  = $c->query("select count(oke) as wynik from {$rok}_latwosc where oke>=90 and oke <100");
            
            $nn2=$nn2->fetch_array();
            $bn2=$bn2->fetch_array();
            $n2=$n2->fetch_array();
            $ns2=$ns2->fetch_array();
            $s2=$s2->fetch_array();
            
            $nn3 = $c->query("select count(cke) as wynik from {$rok}_latwosc where cke<=19");
            $bn3 = $c->query("select count(cke) as wynik from {$rok}_latwosc where cke>=20 and cke <50");
            $n3  = $c->query("select count(cke) as wynik from {$rok}_latwosc where cke>=50 and cke <70");
            $ns3 = $c->query("select count(cke) as wynik from {$rok}_latwosc where cke>=70 and cke <90");
            $s3  = $c->query("select count(cke) as wynik from {$rok}_latwosc where cke>=90 and cke <100");
            
            $nn3=$nn3->fetch_array();
            $bn3=$bn3->fetch_array();
            $n3=$n3->fetch_array();
            $ns3=$ns3->fetch_array();
            $s3=$s3->fetch_array();
            
            echo '<tr><td>' . $nn['wynik'] . '</td><td>' . $nn2['wynik'] . '</td><td>' . $nn3['wynik'] . '</td></tr>';
            echo '<tr><td>' . $bn['wynik'] . '</td><td>' . $bn2['wynik'] . '</td><td>' . $bn3['wynik'] . '</td></tr>';
            echo '<tr><td>' . $n['wynik'] . '</td><td>' . $n2['wynik'] . '</td><td>' . $n3['wynik'] . '</td></tr>';
            echo '<tr><td>' . $ns['wynik'] . '</td><td>' . $ns2['wynik'] . '</td><td>' . $ns3['wynik'] . '</td></tr>';
            echo '<tr><td>' . $s['wynik'] . '</td><td>' . $s2['wynik'] . '</td><td>' . $s3['wynik'] . '</td></tr>';
        }
            ?>


        </table>
        <?php 
            if(isset($rok)){
                ?>
        <table>
        <tr>
            <th>Standard</th>
            <th>I</th>
            <th>II</th>
            <th>III</th>
            <th>IV</th>
            <th>V</th>
        </tr>

        <tr>
            <td>ZSE</td>
            <?php 
            
            @$zse = $c->query("select zse from {$rok}_standardy");
            while($r = $zse->fetch_array())
            {
                echo "<td>". $r[0] . "</td>";
            }
            ?>
        </tr>
        <tr>
            <td>CKE</td>
            <?php 
            @$zse = $c->query("select cke from {$rok}_standardy");
            while($r = $zse->fetch_array())
            {
                echo "<td>". $r[0] . "</td>";
            }
            ?>
        </tr>
        <tr>
            <td>OKE</td>
            <?php 
            @$zse = $c->query("select oke from {$rok}_standardy");
            while($r = $zse->fetch_array())
            {
                echo "<td>". $r[0] . "</td>";
            }
        }
            ?>
        </tr>
          
        </tr>
    </table>
    
    </div>
    </div>

    <!--WYKRES-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Punkty', 'ZSE', 'OKE', 'CKE'],
                <?php  
                   $result = $c->query("select * from {$rok}_latwosc");
                while($r=$result->fetch_array())
                {
                    echo "['" . $r['id'] . "'," . $r['zse']/100 .  "," . $r['oke']/100 . "," . $r['cke']/100 ."],";
 
                }

                          ?>
            ]);
            var options = {
                title: 'Wyniki matury w punktach w ZSE',
                width: 1030,
                height: 400,
                hAxis: {
                    title: 'Numer zadania',
                },
                vAxis: {
                    title: 'Łatwość'
                }
            };
            var chart = new google.visualization.ColumnChart(document.querySelector('.pieChart'));
            chart.draw(data, options);
        }

    </script>

    <div class="pieChart"></div>
    
    <div class="wlasne-wnioski">
        <h3>Własne wnioski</h3>
        <p>
        <?php
        $czy = $c->query("select * from {$rok}_latwosc_wnioski");
        @$ile_row = $czy->num_rows;
        if($ile_row>0)
        {
            $czy = $czy->fetch_array();
            echo $czy['wniosek'] ;
        }?>
       </p>
    </div>
    <form action="dodajwniosek.php" method="post">
    <div class="form-group">
      <textarea name="wnioski">
        
      </textarea>
      <label for="textarea" class="control-label">Własne wnioski</label><i class="bar"></i>
    </div>
    <input type="hidden" value='<?=$rok?>' name="rok">
    <div class="button-container">
        <button type="submit" class="button" name="wyslij"><span>Dodaj </span></button>
   <button type="submit" class="button" name="podmien"><span>Podmień całkowicie</span></button></div>
</div>
    
    </form>
</main>
