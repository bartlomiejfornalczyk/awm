<?php
require("panel.php");
require("setup.php");
$rok = $_GET['rok'];
$c->query("create table if not exists {$rok}_rozszerzenie_wnioski(id int, wniosek text, primary key(id))");
     $test = $c->query("select * from {$rok}_rozszerzenie_wnioski");
    if(@$test->num_rows==0)
    {
        $c->query("insert into {$rok}_rozszerzenie_wnioski values(1, 'Wniosek: ')");
    }
$name = $c->query("show tables like '{$rok}%r'");

if($name->num_rows == 0){echo "<main> Błąd. Wybierz poprawny rok";}
else{

$c->query("drop table {$rok}_wyniki_klas_r");
$name = $c->query("show tables like '{$rok}%r'");

$i=0;
?>
<main>
    <table>
        <tr>
            <th></th>

            <?php
            $select = null;
        while ($klas_ra = $name->fetch_array())  {
        $result[$i]= $c->query("select * from $klas_ra[0] where wynik<0.3");
        $overall[$i] = $c->query("select id from $klas_ra[0]");
            
        $select .= $klas_ra[0]." ";
        echo "<th>";
        echo substr($klas_ra[0], 12);
        echo "</th>";
        $i++;
        }
            
            
            $sel = explode(" ", $select);
            $ile = count($sel);
//            $c->query("create table if not exists wyniki_klas_r(wynik float)");
            
            $sql = "create table {$rok}_wyniki_klas_r(id int not null auto_increment primary key, wynik float) ";
//            $c->query($sql);
        
            for($i = 0; $i<$ile-1; $i++)
            {
                $sql.="select wynik from $sel[$i] union all ";
                
            }
            $sql = substr($sql, 0, -10);
//            echo $sql;
//            echo $sql.'<br>';
//            echo $sql;
            $c->query($sql);

            
        
        ?>
            <th>ZSE</th>
            <th>OKE Łódź</th>
            <th>technikum</th>
            <th>Kraj</th>
            <th>technikum</th>

        </tr>
        <tr>
            <td>Zdało</td>

            <?php
        for($j = 0; $j<$i; $j++)
        {
            $x[$j] = $result[$j]->num_rows;
            $y[$j] = $overall[$j]->num_rows;
            $pro[$j] = round(($x[$j]/$y[$j])*100, 1);
            echo "<td>";
            echo 100-$pro[$j];
            echo "%</td>";
        }
        ?>
            <?php
            $result = $c->query("select count(wynik) as result from {$rok}_wyniki_klas_r where wynik<0.3");
            $overall = $c->query("select count(wynik) as overall from {$rok}_wyniki_klas_r");
            $result = $result->fetch_array();
            $overall = $overall->fetch_array();
            $wynik = round(($result['result']/$overall['overall']*100), 2);
        
               echo "<td>";
                echo 100-$wynik ;
                echo "%</td>"; 
            
            $oke = $c->query("select * from {$rok}_oke");
            while($row = $oke->fetch_assoc())
            {
            
                
                echo "<td>";
                echo $row['oke'];
                echo "%</td>"; 
                
                echo "<td>";
                echo $row['ote'];
                echo "%</td>";
                
                echo "<td>";
                echo $row['kraj'];
                echo "%</td>";
                        
                echo "<td>";
                echo $row['krajt'];
                echo "%</td>";
            }
        ?>
        </tr>
        <tr>
            <td>Nie zdało</td>
            <?php for($j = 0; $j<$i; $j++)
        {
            echo "<td>";
            echo $pro[$j];
            echo "%</td>";
        }
        ?>

            <?php
            $zse = 100-$wynik;
                echo "<td>";
                
                echo $wynik;
                echo "%</td>";

            $oke = $c->query("select * from {$rok}_oke");
            while($row = $oke->fetch_assoc())
            {

                
                echo "<td>";
                $ok = $row['oke'];
                echo 100-$row['oke'];
                echo "%</td>"; 
                
                echo "<td>";
                echo 100-$row['ote'];
                echo "%</td>";
                
                echo "<td>";
                $kraj = $row['kraj'];
                echo 100-$row['kraj'];
                echo "%</td>";
                        
                echo "<td>";
                $krajt = $row['krajt'];
                echo 100-$row['krajt'];
                echo "%</td>";
                
                
//                $podst = $row['podst'];
    // $roz = $row['rozsz'];
            }
        ?>
        </tr>
    </table>
    <?php
    #############################################   Wnioski
    if($zse > $ok){
        echo '<p class="wniosek zdawalnosc">Zdawalność uczniów technikum ZSE jest wyższa w porównaniu z wynikami matury uczniów wszystkich szkół w województwie łódzkim';
            if($zse > $kraj)
            {
                echo ' jak i w kraju</p>';
                echo '<p class="roznica"> W porównaniu z wynikami uczniów z technikum w kraju - o ';
                echo $zse-$krajt."% wyższa zdawalność</p>";
            }
        
    }
    else
    {
        echo '<p>Zdawalność uczniów technikum ZSE jest niższa w porównaniu z wynikami matury uczniów wszystkich szkół w województwie łódzkim';
        if($kraj > $zse)
            {
                echo ' jak i w kraju</p>';
                echo '<p class="roznica"> W porównaniu z wynikami uczniów z technikum w kraju - różnica o ';
                echo $zse-$krajt."%</p>";
            }
    }
    ############################################
    ?>

    <br>
     
    <br>
    <?php 
    ############################################
//    echo "Do egzaminu maturalnego  z  matematyki  na  poziomie rozszerzonym w ZSE przystąpiło $roz uczniów. Wynik  z poziomu  rozszerzonego  nie decydował o zdawalności egzaminu maturalnego.";								
    ############################################
    ?>

    <table>
        <tr>
            <th></th>

            <?php
            #####################
            $i=0;
            $name = $c->query("show tables like '{$rok}%r'");
                while ($k = $name->fetch_array())  {
                    $result = $c->query("select round(avg(wynik), 4) as avg from $k[0]");    
                    $x[$i] = $result->fetch_assoc();
            
                    echo "<th>";
                    echo substr($k[0], 12, -2);
                    echo "</th>";
                    $i++; 
        }  
            #####################
        ?>

            <th>ZSE</th>
            <th>OKE Łódź</th>
            <th>technikum</th>
            <th>Kraj</th>
            <th>technikum</th>

        </tr>
        <tr>
            <td>Poziom podstawowy</td>
            <?php
            
        for($j = 0; $j<$i; $j++)
        {
            echo '<td>';
           
            print_r($x[$j]['avg'] * 100);
             echo '%</td>';
        }

            $xdd = $c->query("select round(avg(wynik), 4) as avg from {$rok}_wyniki_klas_r");
            while($row = $xdd->fetch_array())
            {
            $zse = $row['avg'];
            echo "<td>" . 100*$row['avg'] . "%</td>";
            }
            $oke = $c->query("select * from {$rok}_oke");
            while($row = $oke->fetch_assoc())
            {
                
                echo "<td>";
                echo $row['aoke'];
               
                echo "%</td>"; 
                
                echo "<td>";
                $ao = $row['aote'];
                echo $row['aote'];
                echo "%</td>";
                
                echo "<td>";
              
                echo $row['akraj'];
                echo "%</td>";
                        
                echo "<td>";
             
                echo $row['akrajt'];
                $ak = $row['akrajt'];
                echo "%</td>";
                
                
            
            }
        ?>

        </tr>
       
    </table>
    <br><br>
     
    <br>
    <table>
        <tr>
            <th></th>

            <?php
            #####################
            $i=0;
            $name = $c->query("show tables like '{$rok}%r'");
                while ($k = $name->fetch_array())  {
                    $result = $c->query("select round(avg(wynik), 4) as avg from $k[0]");    
                    $x[$i] = $result->fetch_assoc();
            
                    echo "<th>";
                    echo substr($k[0], 12, -2);
                    echo "</th>";
                    $i++; 
        }  
            #####################
        ?>

            <th>ZSE</th>
            <th>OKE Łódź</th>
            <th>technikum</th>
            <th>Kraj</th>
            <th>technikum</th>

        </tr>
        <tr>
            <td>Poziom podstawowy</td>
            <?php
            
        for($j = 0; $j<$i; $j++)
        {
            echo '<td>';
           
            print_r($x[$j]['avg'] * 100 * 0.5);
             echo '</td>';
        }

            $xdd = $c->query("select round(avg(wynik), 4) as avg from {$rok}_wyniki_klas_r");
            while($row = $xdd->fetch_array())
            {
                
                echo "<td>" . 50*$row['avg'] . "</td>";
            }
            $oke = $c->query("select * from {$rok}_oke");
            while($row = $oke->fetch_assoc())
            {
                
                echo "<td>";
                echo 0.5 * $row['aoke'];
               
                echo "</td>"; 
                
                echo "<td>";
                echo 0.5 * $row['aote'];
                echo "</td>";
                
                echo "<td>";
              
                echo 0.5 * $row['akraj'];
                echo "</td>";
                        
                echo "<td>";
             
                echo 0.5 * $row['akrajt'];
                echo "</td>";
                
                
            
            }
        ?>
        </tr>
       
    </table>

    <p>
        <?php
        $zse= 100*$zse;
       $x = $zse - $ao;
       $y = $zse - $ak;
        
        echo 'Średnie wyniki egzaminu na poziome podstawowym w naszym technikum są o '.$x .'% i '. $y .'%';
            if($zse > $ao && $zse > $ak)
            {
                echo ' wyższe w porównaniu z wynikami wszystkich szkół technikum na terenie OKE w Łodzi oraz w całym kraju.';
            }
        else if ($zse > $ao)
        {
            echo ' wyższe w porównaniu z wynikami wszystkich szkół technikum na terenie OKE w Łodzi i niższe niż w całym kraju';
        }
        else if ($zse > $ak)
        {
            echo ' niższe w porównaniu z wynikami wszystkich szkół technikum na terenie OKE w Łodzi i wyższe niż w całym kraju';
        }
        else
        {
            echo ' niższe w porównaniu z wynikami wszystkich szkół technikum na terenie OKE w Łodzi oraz w całym kraju';
        }
//                Natomiast są porównywalne z wynikami wszystkich szkół średnich na terenie OKE w Łodzi i w całym kraju.';
        ?>



    </p>
    <br><br>
     
    <br><br>






    <!--WYKRES-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Punkty', 'Osoby'],
                <?php  
                    $result = $c->query("SELECT round(wynik*0.5*100) as pkt, COUNT(*) AS ilosc FROM {$rok}_wyniki_klas_r GROUP BY pkt ORDER BY pkt");
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["pkt"]."', ".$row["ilosc"]."],";  
                          }  
                          ?>
            ]);
            var options = {
                title: 'Wyniki matury w punktach w ZSE',
                width: 1000,
                height: 400,
                hAxis: {
                    title: 'Liczba punktów',
                },
                vAxis: {
                    title: 'Liczebność'
                }
            };
            var chart = new google.visualization.ColumnChart(document.querySelector('.pieChart'));
            chart.draw(data, options);
        }

    </script>
    <div class="pieWrap">
    <div class="pieChart"></div>
    </div>
    <!--WYKRES-->
    <br>
    <br>
     
    <table>
        <tr>
            <th></th>

            <?php
            #####################
            $i=0;
            $w = null;
            $name = $c->query("show tables like '{$rok}%r'");
                while ($k = $name->fetch_array())  {
                    $result = $c->query("select round(avg(wynik), 4) as avg from $k[0]");    
                    $w[$i] = $result->fetch_assoc();
            
                    echo "<th>";
                    echo substr($k[0], 12, -2);
                    echo "</th>";
                    $i++; 
        }  
            #####################
        ?>

            <th>ZSE</th>
            <th>OKE Łódź</th>
            <th>technikum</th>
            <th>Kraj</th>
            <th>technikum</th>

        </tr>
        <tr>
            <td>Średnia</td>
            <?php
            
        for($j = 0; $j<$i; $j++)
        {
            echo '<td>';
           
            print_r($w[$j]['avg'] * 100 * 0.5);
             echo '</td>';
        }
            $sel = explode(" ", $select);
            $ile = count($sel);
//            $c->query("create table if not exists wyniki_klas_r(wynik float)");
           
           $c->query("use {$rok}_wyniki_klas_r");
        
            for($i = 0; $i<$ile-1; $i++)
            {
                $sql.="select wynik from $sel[$i] union all ";
            }
            $sql = substr($sql, 0, -10);
            $c->query($sql);
//            $xd = $result->fetch_array();
            $xdd = $c->query("select round(avg(wynik), 4) as avg from {$rok}_wyniki_klas_r");
            while($row = $xdd->fetch_array())
            {
                
                echo "<td>" . 50*$row['avg'] . "</td>";
            }
            $oke = $c->query("select * from {$rok}_oke");
            while($row = $oke->fetch_assoc())
            {
                
                echo "<td>";
                echo 0.5 * $row['aoke'];
               
                echo "</td>"; 
                
                echo "<td>";
                echo 0.5 * $row['aote'];
                echo "</td>";
                
                echo "<td>";
              
                echo 0.5 * $row['akraj'];
                echo "</td>";
                        
                echo "<td>";
             
                echo 0.5 * $row['akrajt'];
                echo "</td>";
                
                
            
            }
        ?>
        </tr>
        <tr>
            <td>Mediana</td>


            <?php
            #####################
            
            $name = $c->query("show tables like '{$rok}%r'");
                while ($k = $name->fetch_array())  {
                    echo '<td>';
                    $result = $c->query("select median(wynik) from $k[0]");    
                    $result= $result->fetch_array();
                    $mediana = $result['median(wynik)'];
                    echo round($mediana * 0.5 * 100, 3);
                    echo '</td>';
                }  
            #####################
            $wklas_r = $c->query("select median(wynik) as md from {$rok}_wyniki_klas_r");
            while($row = $wklas_r->fetch_array())
            {
                echo '<td>';
                $mediana = $row['md'];
                    echo round($mediana * 0.5 * 100, 3);
                 echo '</td>';
            }
            $oke = $c->query("select * from {$rok}_oke");
            while($row = $oke->fetch_assoc())
            {
                
                echo "<td>";
                echo 0.5 * $row['moke'];
               
                echo "</td>"; 
                
                echo "<td>";
                echo 0.5 * $row['mote'];
                echo "</td>";
                
                echo "<td>";
              
                echo 0.5 * $row['mkraj'];
                echo "</td>";
                        
                echo "<td>";
             
                echo 0.5 * $row['mkrajt'];
                echo "</td>";
                
                
            
            }
            ?>

        </tr>
        <tr>
            <td>Dominanta</td>


            <?php
            #####################
            
            $name = $c->query("show tables like '{$rok}%r'");
                while ($k = $name->fetch_array())  {
                    echo '<td>';
                    $result = $c->query("SELECT stats_mode(wynik) from $k[0]");    
                    $result= $result->fetch_array();
                    $mediana = $result['stats_mode(wynik)'];
                    echo round($mediana * 0.5  *100, 3);
                    echo '</td>';
                }  
            #####################
            $wklas_r = $c->query("select stats_mode(wynik) from {$rok}_wyniki_klas_r");
            while($row = $wklas_r->fetch_array())
            {
                echo '<td>';
                 $mediana = $row['stats_mode(wynik)'];
                    echo round($mediana * 0.5  * 100, 3);
                 echo '</td>';
            }
                        $oke = $c->query("select * from {$rok}_oke");
            while($row = $oke->fetch_assoc())
            {
                
                echo "<td>";
                echo 0.5 * $row['doke'];
               
                echo "</td>"; 
                
                echo "<td>";
                echo 0.5 * $row['dote'];
                echo "</td>";
                
                echo "<td>";
              
                echo 0.5 * $row['dkraj'];
                echo "</td>";
                        
                echo "<td>";
             
                echo 0.5 * $row['dkrajt'];
                echo "</td>";
                
                
            
            }
            ?>

        </tr>
        <tr>
            <td>Rozstęp</td>


            <?php
            #####################
            
            $name = $c->query("show tables like '{$rok}%r'");
                while ($k = $name->fetch_array())  {
                    echo '<td>';
                    $result = $c->query("select round(max(wynik),2) - round(min(wynik),2) as rozstep from $k[0]");    
                    $result= $result->fetch_array();
                    $mediana = $result['rozstep'];
                    echo round($mediana * 0.5  *100, 3);
                    echo '</td>';
                }  
            #####################

            $wklas_r = $c->query("select round(max(wynik),2) - round(min(wynik),2) as rozstep from {$rok}_wyniki_klas_r");
            while($row = $wklas_r->fetch_array())
            {
                echo '<td>';
                 $mediana = $row['rozstep'];
                    echo round($mediana * 0.5  * 100, 3);
                 echo '</td>';
            }
                                    $oke = $c->query("select * from {$rok}_oke");
            while($row = $oke->fetch_assoc())
            {
                
                echo "<td>";
                echo 0.5 * $row['roke'];
               
                echo "</td>"; 
                
                echo "<td>";
                echo 0.5 * $row['rote'];
                echo "</td>";
                
                echo "<td>";
              
                echo 0.5 * $row['rkraj'];
                echo "</td>";
                        
                echo "<td>";
             
                echo 0.5 * $row['rkrajt'];
                echo "</td>";
                
                
            
            }
            ?>
        </tr>

        <td>Maksimum</td>
        <?php
            #####################
            $i=0;
            $name = $c->query("show tables like '{$rok}%r'");
                while ($k = $name->fetch_array())  {
                    $result = $c->query("select round(max(wynik), 2) as max from $k[0]");    
                    $l[$i] = $result->fetch_assoc();
                    $i++; 
        }  
            #####################
           
            
            for($j = 0; $j<$i; $j++)
        {
            echo '<td>';
                $max = explode(".", ($l[$j]['max'] * 0.5 * 100));
//                $max = substr(($l[$j]['max'] * 0.5 * 100), 0, 2);
                print_r($max[0]);
             echo '</td>';
        }
            $zse = $c->query("select round(max(wynik), 2) as max from {$rok}_wyniki_klas_r");
            while($row = $zse->fetch_array())
            {
                $max = explode(".", 50*$row['max']);
                echo "<td>";
                print_r($max[0]);
                echo "</td>";
            }
                                $oke = $c->query("select * from {$rok}_oke");
            while($row = $oke->fetch_assoc())
            {
                
                echo "<td>";
                echo 0.5 * $row['maxoke'];
               
                echo "</td>"; 
                
                echo "<td>";
                echo 0.5 * $row['maxote'];
                echo "</td>";
                
                echo "<td>";
              
                echo 0.5 * $row['maxkraj'];
                echo "</td>";
                        
                echo "<td>";
             
                echo 0.5 * $row['maxkrajt'];
                echo "</td>";
                
                
            
            }
            ?>

        </tr>
        <tr>
            <td>Minimum</td>
            <?php
            #####################
            $i=0;
            $name = $c->query("show tables like '{$rok}%r'");
                while ($k = $name->fetch_array())  {
                    $result = $c->query("select round(min(wynik), 2) as max from $k[0]");    
                    $l[$i] = $result->fetch_assoc();
                    $i++; 
        }  
            #####################
        ?>
            <?php
            
            for($j = 0; $j<$i; $j++)
        {
            echo '<td>';
           
                $max = explode(".", ($l[$j]['max'] * 0.5 * 100));
                print_r($max[0]);
             echo '</td>';
        }
            $zse = $c->query("select round(min(wynik), 2) as max from {$rok}_wyniki_klas_r");
            while($row = $zse->fetch_array())
            {
                
                echo "<td>" . substr(50*$row['max'], 0, 2) . "</td>";
            }
            
                                            $oke = $c->query("select * from {$rok}_oke");
            while($row = $oke->fetch_assoc())
            {
                
                echo "<td>";
                echo 0.5 * $row['minoke'];
               
                echo "</td>"; 
                
                echo "<td>";
                echo 0.5 * $row['minote'];
                echo "</td>";
                
                echo "<td>";
              
                echo 0.5 * $row['minkraj'];
                echo "</td>";
                        
                echo "<td>";
             
                echo 0.5 * $row['minkrajt'];
                echo "</td>";
                
                
            
            }
                ?>
        </tr>
        <tr>
            <td>Odchylenie standardowe</td>


            <?php
            #####################
            
            $name = $c->query("show tables like '{$rok}%r'");
                while ($k = $name->fetch_array())  {
                    echo '<td>';
                    $result = $c->query("select stddev(wynik) from $k[0]");    
                    $result= $result->fetch_array();
                    $mediana = $result['stddev(wynik)'];
                    echo round($mediana * 0.5  *100, 2);
                    echo '</td>';
                }  
            #####################
            $zse = $c->query("select stddev(wynik) from {$rok}_wyniki_klas_r");
            while($row = $zse->fetch_array())
            {
                echo '<td>';
                $mediana = $row['stddev(wynik)'];
                echo round($mediana * 0.5  *100, 2);
                echo '</td>';
            }
                                                        $oke = $c->query("select * from {$rok}_oke");
            while($row = $oke->fetch_assoc())
            {
                
                echo "<td>";
                echo 0.5 * $row['odoke'];
               
                echo "</td>"; 
                
                echo "<td>";
                echo 0.5 * $row['odote'];
                echo "</td>";
                
                echo "<td>";
              
                echo 0.5 * $row['odkraj'];
                echo "</td>";
                        
                echo "<td>";
             
                echo 0.5 * $row['odkrajt'];
                echo "</td>";
                
                
            
            }
            
?>
        <tr>
        <tr>
            <td>Typowy przedział zmienności</td>


            <?php
            #####################
            
            $name = $c->query("show tables like '{$rok}%r'");
                while ($k = $name->fetch_array())  {
                    echo '<td>(';
                    $result = $c->query("select avg(wynik)-stddev(wynik), avg(wynik)+stddev(wynik) from $k[0]");    
                    $result= $result->fetch_array();
                    $mediana = $result['avg(wynik)-stddev(wynik)'];
                    $mediana2 = $result['avg(wynik)+stddev(wynik)'];
                    echo round($mediana * 0.5  * 100, 2);
                    echo '; ';
                    echo round($mediana2 * 0.5  *100, 2);
                    echo ')</td>';
                }  
            #####################
            $zse = $c->query("select avg(wynik)-stddev(wynik), avg(wynik)+stddev(wynik) from {$rok}_wyniki_klas_r");
            while($row = $zse->fetch_array())
            {
                echo '<td>(';
               $mediana = $row['avg(wynik)-stddev(wynik)'];
                    $mediana2 = $row['avg(wynik)+stddev(wynik)'];
                    echo round($mediana * 0.5  *100, 2);
                    echo '; ';
                    echo round($mediana2 * 0.5  *100, 2);
                    echo ')</td>';
            }
            $oke = $c->query("select * from {$rok}_oke");
            while($row = $oke->fetch_assoc())
            {
                
                echo "<td>(";
                echo (0.5 * $row['aoke']) - (0.5 * $row['odoke']);
                echo '; ';
                echo (0.5 * $row['aoke']) + (0.5 * $row['odoke']);
               
                echo ")</td>"; 
                
                echo "<td>(";
                echo (0.5 * $row['aoke']) - (0.5 * $row['odote']);
                echo '; ';
                echo (0.5 * $row['aoke']) + (0.5 * $row['odote']);
                echo ")</td>";
                
                echo "<td>(";
              
                echo (0.5 * $row['aoke']) - (0.5 * $row['odkraj']);
                echo '; ';
                echo (0.5 * $row['aoke']) + (0.5 * $row['odkraj']);
                echo ")</td>";
                        
                echo "<td>(";
             
                echo (0.5 * $row['aoke']) - (0.5 * $row['odkrajt']);
                echo '; ';
                echo (0.5 * $row['aoke']) + (0.5 * $row['odkrajt']);
                echo ")</td>";
                
                
            
            }
?>
        </tr>
        <!--
        <tr>
            <td>Średnia - odchylenie</td>


            <?php
            #####################
            
            $name = $c->query("show tables like '{$rok}%r'");
                while ($k = $name->fetch_array())  {
                    echo '<td>';
                    $result = $c->query("select avg(wynik)-stddev(wynik) from $k[0]");    
                    $result= $result->fetch_array();
                    $mediana = $result['avg(wynik)-stddev(wynik)'];
                    echo round($mediana * 0.5  *100, 2);
                    echo '</td>';
                }  
            #####################
                        $zse = $c->query("select avg(wynik)-stddev(wynik), avg(wynik)+stddev(wynik) from {$rok}_wyniki_klas_r");
            while($row = $zse->fetch_array())
            {
                echo '<td>';
               $mediana = $row['avg(wynik)-stddev(wynik)'];
                    echo round($mediana * 0.5  *100, 2);
                    echo '</td>';
            }
             $oke = $c->query("select * from {$rok}_oke");
            while($row = $oke->fetch_assoc())
            {
                
                echo "<td>";
                echo (0.5 * $row['aoke']) - (0.5 * $row['odoke']);
                echo "</td>"; 
                
                echo "<td>";
                echo (0.5 * $row['aoke']) - (0.5 * $row['odote']);
                echo "</td>";
                
                echo "<td>";              
                echo (0.5 * $row['aoke']) - (0.5 * $row['odkraj']);
                echo "</td>";
                        
                echo "<td>";
             
                echo (0.5 * $row['aoke']) - (0.5 * $row['odkrajt']);
                echo "</td>";
                
                
            
            }
?>
        </tr>
        <tr>
            <td>Średnia + odchylenie</td>


            <?php
            #####################
            
            $name = $c->query("show tables like '{$rok}%r'");
                while ($k = $name->fetch_array())  {
                    echo '<td>';
                    $result = $c->query("select avg(wynik)+stddev(wynik) from $k[0]");    
                    $result= $result->fetch_array();
                    $mediana = $result['avg(wynik)+stddev(wynik)'];
                    echo round($mediana * 0.5  *100, 2);
                    echo '</td>';
                }  
            #####################
                                    $zse = $c->query("select avg(wynik)-stddev(wynik), avg(wynik)+stddev(wynik) from {$rok}_wyniki_klas_r");
            while($row = $zse->fetch_array())
            {
                echo '<td>';
               $mediana = $row['avg(wynik)+stddev(wynik)'];
                    echo round($mediana * 0.5  *100, 2);
                    echo '</td>';
            }
                         $oke = $c->query("select * from {$rok}_oke");
            while($row = $oke->fetch_assoc())
            {
                
                echo "<td>";
                echo (0.5 * $row['aoke']) + (0.5 * $row['odoke']);
                echo "</td>"; 
                
                echo "<td>";
                echo (0.5 * $row['aoke']) + (0.5 * $row['odote']);
                echo "</td>";
                
                echo "<td>";              
                echo (0.5 * $row['aoke']) + (0.5 * $row['odkraj']);
                echo "</td>";
                        
                echo "<td>";
             
                echo (0.5 * $row['aoke']) + (0.5 * $row['odkrajt']);
                echo "</td>";
                
                
            
            }
?>
        </tr>
-->

    </table>
    <br>
    <br>
     
    <!--    DANE PROCENTOWE-->
    <table>
        <tr>
            <th></th>

            <?php
            #####################
            $i=0;
            $w = null;
            $name = $c->query("show tables like '{$rok}%r'");
                while ($k = $name->fetch_array())  {
                    $result = $c->query("select round(avg(wynik), 4) as avg from $k[0]");    
                    $w[$i] = $result->fetch_assoc();
            
                    echo "<th>";
                    echo substr($k[0], 12, -2);
                    echo "</th>";
                    $i++; 
        }  
            #####################
        ?>

            <th>ZSE</th>
            <th>OKE Łódź</th>
            <th>technikum</th>
            <th>Kraj</th>
            <th>technikum</th>

        </tr>
        <tr>
            <td>Średnia</td>
            <?php
            
        for($j = 0; $j<$i; $j++)
        {
            echo '<td>';
           
            print_r($w[$j]['avg'] * 100);
             echo '</td>';
        }
            $xdd = $c->query("select round(avg(wynik), 4) as avg from {$rok}_wyniki_klas_r");
            while($row = $xdd->fetch_array())
            {
                
                echo "<td>" . 100*$row['avg'] . "</td>";
            }
            $oke = $c->query("select * from {$rok}_oke");
            while($row = $oke->fetch_assoc())
            {
                
                echo "<td>";
                echo $row['aoke'];
               
                echo "</td>"; 
                
                echo "<td>";
                echo  $row['aote'];
                echo "</td>";
                
                echo "<td>";
              
                echo $row['akraj'];
                echo "</td>";
                        
                echo "<td>";
             
                echo $row['akrajt'];
                echo "</td>";
                
                
            
            }
        ?>
        </tr>
        <tr>
            <td>Mediana</td>


            <?php
            #####################
            
            $name = $c->query("show tables like '{$rok}%r'");
                while ($k = $name->fetch_array())  {
                    echo '<td>';
                    $result = $c->query("select median(wynik) from $k[0]");    
                    $result= $result->fetch_array();
                    $mediana = $result['median(wynik)'];
                    echo round($mediana * 100, 3);
                    echo '</td>';
                }  
            #####################
            $wklas_r = $c->query("select median(wynik) as md from {$rok}_wyniki_klas_r");
            while($row = $wklas_r->fetch_array())
            {
                echo '<td>';
                $mediana = $row['md'];
                    echo round($mediana* 100, 3);
                 echo '</td>';
            }
                                     $oke = $c->query("select * from {$rok}_oke");
            while($row = $oke->fetch_assoc())
            {
                
                echo "<td>";
                echo $row['moke'];
               
                echo "</td>"; 
                
                echo "<td>";
                echo $row['mote'];
                echo "</td>";
                
                echo "<td>";
              
                echo $row['mkraj'];
                echo "</td>";
                        
                echo "<td>";
             
                echo $row['mkrajt'];
                echo "</td>";
                
                
            
            }
            ?>

        <tr>
        <tr>
            <td>Dominanta</td>


            <?php
            #####################
            
            $name = $c->query("show tables like '{$rok}%r'");
                while ($k = $name->fetch_array())  {
                    echo '<td>';
                    $result = $c->query("SELECT stats_mode(wynik) from $k[0]");    
                    $result= $result->fetch_array();
                    $mediana = $result['stats_mode(wynik)'];
                    echo round($mediana *100, 3);
                    echo '</td>';
                }  
            #####################
            $wklas_r = $c->query("select stats_mode(wynik) from {$rok}_wyniki_klas_r");
            while($row = $wklas_r->fetch_array())
            {
                echo '<td>';
                 $mediana = $row['stats_mode(wynik)'];
                    echo round($mediana * 100, 3);
                 echo '</td>';
            }
                         $oke = $c->query("select * from {$rok}_oke");
            while($row = $oke->fetch_assoc())
            {
                
                echo "<td>";
                echo $row['doke'];
               
                echo "</td>"; 
                
                echo "<td>";
                echo $row['dote'];
                echo "</td>";
                
                echo "<td>";
              
                echo $row['dkraj'];
                echo "</td>";
                        
                echo "<td>";
             
                echo $row['dkrajt'];
                echo "</td>";
                
                
            
            }
            ?>
        <tr>
        <tr>
            <td>Rozstęp</td>


            <?php
            #####################
            
            $name = $c->query("show tables like '{$rok}%r'");
                while ($k = $name->fetch_array())  {
                    echo '<td>';
                    $result = $c->query("select round(max(wynik),2) - round(min(wynik),2) as rozstep from $k[0]");    
                    $result= $result->fetch_array();
                    $mediana = $result['rozstep'];
                    echo round($mediana *100, 3);
                    echo '</td>';
                }  
            #####################

            $wklas_r = $c->query("select round(max(wynik),2) - round(min(wynik),2) as rozstep from {$rok}_wyniki_klas_r");
            while($row = $wklas_r->fetch_array())
            {
                echo '<td>';
                 $mediana = $row['rozstep'];
                    echo round($mediana * 100, 3);
                 echo '</td>';
            }
             $oke = $c->query("select * from {$rok}_oke");
            while($row = $oke->fetch_assoc())
            {
                
                echo "<td>";
                echo $row['roke'];
               
                echo "</td>"; 
                
                echo "<td>";
                echo $row['rote'];
                echo "</td>";
                
                echo "<td>";
              
                echo $row['rkraj'];
                echo "</td>";
                        
                echo "<td>";
             
                echo $row['rkrajt'];
                echo "</td>";
                
                
            
            }
            ?>
        <tr>

            <td>Maksimum</td>
            <?php
            #####################
            $i=0;
            $name = $c->query("show tables like '{$rok}%r'");
                while ($k = $name->fetch_array())  {
                    $result = $c->query("select round(max(wynik), 2) as max from $k[0]");    
                    $l[$i] = $result->fetch_assoc();
                    $i++; 
        }  
            #####################
           
            
            for($j = 0; $j<$i; $j++)
        {
            echo '<td>';
                $max = explode(".", ($l[$j]['max'] * 100));
//                $max = substr(($l[$j]['max'] * 0.5 * 100), 0, 2);
                print_r($max[0]);
             echo '</td>';
        }
            $zse = $c->query("select round(max(wynik), 2) as max from {$rok}_wyniki_klas_r");
            while($row = $zse->fetch_array())
            {
                $max = explode(".", 100*$row['max']);
                echo "<td>";
                print_r($max[0]);
                echo "</td>";
            }
                                                                    $oke = $c->query("select * from {$rok}_oke");
            while($row = $oke->fetch_assoc())
            {
                
                echo "<td>";
                echo $row['maxoke'];
               
                echo "</td>"; 
                
                echo "<td>";
                echo $row['maxote'];
                echo "</td>";
                
                echo "<td>";
              
                echo $row['maxkraj'];
                echo "</td>";
                        
                echo "<td>";
             
                echo $row['maxkrajt'];
                echo "</td>";
                
                
            
            }
            ?>

        </tr>
        <tr>
            <td>Minimum</td>
            <?php
            #####################
            $i=0;
            $name = $c->query("show tables like '{$rok}%r'");
                while ($k = $name->fetch_array())  {
                    $result = $c->query("select round(min(wynik), 2) as max from $k[0]");    
                    $l[$i] = $result->fetch_assoc();
                    $i++; 
        }  
            #####################
        ?>
            <?php
            
            for($j = 0; $j<$i; $j++)
        {
            echo '<td>';
           
                $max = explode(".", ($l[$j]['max']* 100));
                print_r($max[0]);
             echo '</td>';
        }
            $zse = $c->query("select round(min(wynik), 2) as max from {$rok}_wyniki_klas_r");
            while($row = $zse->fetch_array())
            {
                
                echo "<td>" . substr(100*$row['max'], 0, 2) . "</td>";
            }
                                                        $oke = $c->query("select * from {$rok}_oke");
            while($row = $oke->fetch_assoc())
            {
                
                echo "<td>";
                echo $row['minoke'];
               
                echo "</td>"; 
                
                echo "<td>";
                echo $row['minote'];
                echo "</td>";
                
                echo "<td>";
              
                echo $row['minkraj'];
                echo "</td>";
                        
                echo "<td>";
             
                echo $row['minkrajt'];
                echo "</td>";
                
                
            
            }
            ?>
        </tr>
        <tr>
            <td>Odchylenie standardowe</td>


            <?php
            #####################
            
            $name = $c->query("show tables like '{$rok}%r'");
                while ($k = $name->fetch_array())  {
                    echo '<td>';
                    $result = $c->query("select stddev(wynik) from $k[0]");    
                    $result= $result->fetch_array();
                    $mediana = $result['stddev(wynik)'];
                    echo round($mediana *100, 2);
                    echo '</td>';
                }  
            #####################
            $zse = $c->query("select stddev(wynik) from {$rok}_wyniki_klas_r");
            while($row = $zse->fetch_array())
            {
                echo '<td>';
                $mediana = $row['stddev(wynik)'];
                echo round($mediana *100, 2);
                echo '</td>';
            }
                                                        $oke = $c->query("select * from {$rok}_oke");
            while($row = $oke->fetch_assoc())
            {
                
                echo "<td>";
                echo $row['odoke'];
               
                echo "</td>"; 
                
                echo "<td>";
                echo $row['odote'];
                echo "</td>";
                
                echo "<td>";
              
                echo $row['odkraj'];
                echo "</td>";
                        
                echo "<td>";
             
                echo $row['odkrajt'];
                echo "</td>";
                
                
            
            }
            
?>
        <tr>
        <tr>
            <td>Typowy przedział zmienności</td>


            <?php
            #####################
            
            $name = $c->query("show tables like '{$rok}%r'");
                while ($k = $name->fetch_array())  {
                    echo '<td>(';
                    $result = $c->query("select avg(wynik)-stddev(wynik), avg(wynik)+stddev(wynik) from $k[0]");    
                    $result= $result->fetch_array();
                    $mediana = $result['avg(wynik)-stddev(wynik)'];
                    $mediana2 = $result['avg(wynik)+stddev(wynik)'];
                    echo round($mediana *100, 2);
                    echo '; ';
                    echo round($mediana2 *100, 2);
                    echo ')</td>';
                }  
            #####################
            $zse = $c->query("select avg(wynik)-stddev(wynik), avg(wynik)+stddev(wynik) from {$rok}_wyniki_klas_r");
            while($row = $zse->fetch_array())
            {
                echo '<td>(';
               $mediana = $row['avg(wynik)-stddev(wynik)'];
                    $mediana2 = $row['avg(wynik)+stddev(wynik)'];
                    echo round($mediana *100, 2);
                    echo '; ';
                    echo round($mediana2 *100, 2);
                    echo ')</td>';
            }
            $oke = $c->query("select * from {$rok}_oke");
            while($row = $oke->fetch_assoc())
            {
                
                echo "<td>(";
                echo ($row['aoke']) - ($row['odoke']);
                echo '; ';
                echo ($row['aoke']) + ($row['odoke']);
               
                echo ")</td>"; 
                
                echo "<td>(";
                echo ($row['aoke']) - ($row['odote']);
                echo '; ';
                echo ($row['aoke']) + ($row['odote']);
                echo ")</td>";
                
                echo "<td>(";
              
                echo ($row['aoke']) - ($row['odkraj']);
                echo '; ';
                echo ($row['aoke']) + ($row['odkraj']);
                echo ")</td>";
                        
                echo "<td>(";
             
                echo ($row['aoke']) - ($row['odkrajt']);
                echo '; ';
                echo ($row['aoke']) + ($row['odkrajt']);
                echo ")</td>";
                
                
            
            }?>
        <tr>
            <!--
        <tr>
            <td>Średnia - odchylenie</td>


            <?php
            #####################
            
            $name = $c->query("show tables like '{$rok}%r'");
                while ($k = $name->fetch_array())  {
                    echo '<td>';
                    $result = $c->query("select avg(wynik)-stddev(wynik) from $k[0]");    
                    $result= $result->fetch_array();
                    $mediana = $result['avg(wynik)-stddev(wynik)'];
                    echo round($mediana *100, 2);
                    echo '</td>';
                }  
            #####################
                        $zse = $c->query("select avg(wynik)-stddev(wynik), avg(wynik)+stddev(wynik) from {$rok}_wyniki_klas_r");
            while($row = $zse->fetch_array())
            {
                echo '<td>';
               $mediana = $row['avg(wynik)-stddev(wynik)'];
                    echo round($mediana *100, 2);
                    echo '</td>';
            }
                                                 $oke = $c->query("select * from {$rok}_oke");
            while($row = $oke->fetch_assoc())
            {
                
                echo "<td>";
                echo ($row['aoke']) - ($row['odoke']);
                echo "</td>"; 
                
                echo "<td>";
                echo ($row['aoke']) - ($row['odote']);
                echo "</td>";
                
                echo "<td>";              
                echo ($row['aoke']) - ($row['odkraj']);
                echo "</td>";
                        
                echo "<td>";
             
                echo ($row['aoke']) - ($row['odkrajt']);
                echo "</td>";
                
                
            
            }
?>
        <tr>
        <tr>
            <td>Średnia + odchylenie</td>


            <?php
            #####################
            
            $name = $c->query("show tables like '{$rok}%r'");
                while ($k = $name->fetch_array())  {
                    echo '<td>';
                    $result = $c->query("select avg(wynik)+stddev(wynik) from $k[0]");    
                    $result= $result->fetch_array();
                    $mediana = $result['avg(wynik)+stddev(wynik)'];
                    echo round($mediana *100, 2);
                    echo '</td>';
                }  
            #####################
                                    $zse = $c->query("select avg(wynik)-stddev(wynik), avg(wynik)+stddev(wynik) from {$rok}_wyniki_klas_r");
            while($row = $zse->fetch_array())
            {
                echo '<td>';
               $mediana = $row['avg(wynik)+stddev(wynik)'];
                    echo round($mediana *100, 2);
                    echo '</td>';
            }
                                     $oke = $c->query("select * from {$rok}_oke");
            while($row = $oke->fetch_assoc())
            {
                
                echo "<td>";
                echo ($row['aoke']) + ($row['odoke']);
                echo "</td>"; 
                
                echo "<td>";
                echo ($row['aoke']) + ($row['odote']);
                echo "</td>";
                
                echo "<td>";              
                echo ($row['aoke']) + ($row['odkraj']);
                echo "</td>";
                        
                echo "<td>";
             
                echo ($row['aoke']) + ($row['odkrajt']);
                echo "</td>";
                
                
            
            }
            ?>
        <tr>
-->

    </table>
    <?php
    $result = $c->query("SELECT round(wynik*0.5*100) as pkt, COUNT(*) AS ilosc FROM {$rok}_wyniki_klas_r GROUP BY pkt ORDER BY pkt desc");
    $result=$result->fetch_assoc();
//    print_r($result);
//    echo $result['pkt'] $result['ilosc'];
    echo "<p>Najwyższym wynikiem był wynik {$result['pkt']} punktów (" . 2*$result['pkt'] . "%) - {$result['ilosc']} osób</p>";


    $result = $c->query("select count(wynik) AS ilosc FROM {$rok}_wyniki_klas_r where wynik > 0.29 ");
    $res = $c->query("select count(wynik) as ogol FROM {$rok}_wyniki_klas_r ");
 $result=$result->fetch_array();
 $res=$res->fetch_array();
    echo "<p>Wynik powyżej 30% osiągnęło {$result['ilosc']} osób, co stanowi " . round($result['ilosc'] / $res['ogol'] *100, 2)."% wszystkich osób</p>";


    $result = $c->query("select count(wynik) AS ilosc FROM {$rok}_wyniki_klas_r where wynik < 0.30 ");
    $res = $c->query("select count(wynik) as ogol FROM {$rok}_wyniki_klas_r ");
 $result=$result->fetch_array();
 $res=$res->fetch_array();
    echo "<p>Wynik poniżej 30% osiągnęło {$result['ilosc']} osób, co stanowi " . round($result['ilosc'] / $res['ogol'] *100, 2)."% wszystkich osób</p>";

    $xxx= $c->query("SELECT stats_mode(wynik) from {$rok}_wyniki_klas_r");    
    $xxx= $xxx->fetch_array();
    $dome = $xxx['stats_mode(wynik)'];
    
    $iledome = round($dome, 2);

    $dome =  round($dome * 100, 3);
    $ile= $c->query("SELECT count(wynik) from {$rok}_wyniki_klas_r where wynik like $iledome");    

    $ile= $ile->fetch_array();
    $ile = $ile['count(wynik)'];
    // $ile = $result['ile'];
    echo "<p>Wynikiem najczęściej powtarzającym się było: " . $dome  . ". Było $ile takich osób</p>";
   
			
    
?>

   <div class="wlasne-wnioski">
    <h3>Własne wnioski</h3>
    <p>
<?php
$czy = $c->query("select * from {$rok}_podstawa_wnioski");
@$ile_row = $czy->num_rows;
if($ile_row>0)
{
    $czy = $czy->fetch_array();
    echo $czy['wniosek'] ;
}?>
</p>
</div>
<form action="wniosekroz.php" method="post">
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

<div class="button-container">
<button type="submit" class=" button pdf"><span>Drukuj / zapisz do PDF </span></button>
</div>
    <script>
        pdf = document.querySelector(".pdf");
        pdf.addEventListener("click", function() {
            window.print();
        })

    </script>
</main>
<?php
}?>